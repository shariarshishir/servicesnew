<?php

namespace App\Http\Controllers;

use App\Models\BusinessProfile;
use App\Models\CompanyOverview;
use App\Models\CategoriesProduced;
use App\Models\MachineriesDetail;
use App\Models\CompanyFactoryTour;
use App\Models\ProductionCapacity;
use App\Models\Manufacture\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use stdClass;

class BusinessProfileController extends Controller
{

    public function index()
    {
        $business_profile=BusinessProfile::where('user_id',auth()->id())->get();

        if($business_profile->isEmpty())
        {
            $business_profile=BusinessProfile::where('representative_user_id',auth()->id())->get();
        }

        return view('business_profile.index',['business_profile' => $business_profile]);
    }

    public function create()
    {
        $user=User::where('id',auth()->id())->withCount('businessProfile')->first();
        $total_business_count=$user->business_profile_count;
        if($total_business_count >= 3){
            abort( response('Not Permit To More Than 3 Business', 401) );
        }

        return view('business_profile.create');
    }

    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'business_name' => 'required',
            'location'      => 'required',
            'business_type' => 'required',
            'trade_license' => 'required',
            'industry_type' => 'required',
            'number_of_outlets' => Rule::requiredIf(function () use ($request) {
                return $request->business_type == 2;
            }),
            'number_of_factories' => Rule::requiredIf(function () use ($request) {
                return $request->business_type == 1;
            }),
            'email' => 'required_if:has_representative,0|unique:users',
            'phone' => 'required_if:has_representative,0',
            'nid_passport' => 'required_if:has_representative,0',
            'representive_name' =>'required_if:has_representative,0',
            'business_category_id' => 'required_if:business_type,1',

         ]);
         if ($validator->fails())
         {
             return response()->json(array(
             'success' => false,
             'error' => $validator->getMessageBag()),
             400);
         }
         try{
                $business_profile_data=[
                    'business_name' => $request->business_name,
                    'user_id'       => auth()->id(),
                    'location'      => $request->location,
                    'business_type' => $request->business_type,
                    'has_representative'=> $request->has_representative,
                    'number_of_outlets' => $request->number_of_outlets,
                    'number_of_factories' => $request->number_of_factories,
                    'business_category_id' => $request->business_category_id,
                    'industry_type' => $request->industry_type,

                ];

                if($request->has_representative == true){
                    $business_profile=BusinessProfile::create($business_profile_data);
                    //create company overview
                    $this->createCompanyOverview($request,$business_profile->id);
                    return response()->json([
                        'success' => true,
                        'redirect_url' => route('business.profile'),
                        'msg' => 'Profile Created Successfully',
                    ],200);
                }
                if($request->has_representative == false){
                    $representive_data=[
                        'name' => $request->representive_name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'password' =>'12345678',
                        'nid_passport' => $request->nid_passport,
                        'is_representative' => true,
                        'user_type'      => 'buyer',
                        'is_email_verified' => 1,
                    ];
                    // sso registration
                    if(env('APP_ENV') == 'production')
                    {
                        $sso=Http::post(env('SSO_URL').'api/auth/signup/',$representive_data);
                        if(!$sso->successful()){
                            return response()->json([
                                'success' => false,
                                'error' => 'Internal Server Error',
                            ],500);
                        }
                    }
                    //user registraion as represetative
                    $representive_data['password'] =bcrypt($representive_data['password']);
                    $user_id = IdGenerator::generate(['table' => 'users', 'field' => 'user_id','reset_on_prefix_change' =>true,'length' => 18, 'prefix' => date('ymd').time()]);
                    $representive_data['user_id'] =$user_id;
                    $user=User::create($representive_data);
                    //profile create
                    $business_profile_data['representative_user_id']= $user->id;
                    $business_profile=BusinessProfile::create($business_profile_data);
                    //create company overview
                    $this->createCompanyOverview($request,$business_profile->id);
                    return response()->json([
                        'success' => true,
                        'redirect_url' => route('business.profile'),
                        'msg' => 'Profile Created Successfully',
                    ],200);
                }

            }catch(\Exception $e){
               return response()->json([
                   'success' => false,
                   //'error'   => ['msg' => 'Something Went Worng'],
                   'error'   => ['msg' => $e->getMessage()],
               ],500);

            }



    }

    public function show($id)
    {
        $business_profile= BusinessProfile::with('companyOverview','machineriesDetails','categoriesProduceds','productionCapacities','productionFlowAndManpowers','certifications','mainbuyers','exportDestinations','associationMemberships','pressHighlights','businessTerms','samplings','specialCustomizations','sustainabilityCommitments','walfare','security','companyFactoryTour')->findOrFail($id);
        $companyFactoryTour=CompanyFactoryTour::with('companyFactoryTourImages','companyFactoryTourLargeImages')->where('business_profile_id',$id)->first();
        if((auth()->id() == $business_profile->user_id) || (auth()->id() == $business_profile->representative_user_id))
        {
            $colors=['Red','Blue','Green','Black','Brown','Pink','Yellow','Orange','Lightblue','Multicolor'];
            $sizes=['S','M','L','XL','XXL','XXXL'];
            $products=Product::latest()->where('business_profile_id', $business_profile->id)->get();
            if($business_profile->business_type == 1){
                $mainProducts=Product::with('product_images')->where('business_profile_id',$id)->inRandomOrder()
                ->limit(4)
                ->get();
    
                return view('business_profile.show',compact('business_profile','companyFactoryTour', 'colors', 'sizes','products','mainProducts'));
            }
            if($business_profile->business_type == 2){
    
               return view('wholesaler_profile.index',compact('business_profile'));
            }


        }
        abort(401);

    }

    //company overview data
    public function createCompanyOverview(Request $request, $profile_id)
    {
        $name=['annual_revenue','number_of_worker','number_of_female_worker','trade_license_number','year_of_establishment','opertaing_hours','shift_details','main_products'];
        $value=[null,null,null,$request->trade_license,null,null,null,null,null];
        $data=[];
        foreach($name as $key => $value2){
            array_push($data,['name' => $value2, 'value' => $value[$key], 'status' => 0]);
        }
        CompanyOverview::create([
            'business_profile_id' => $profile_id,
            'data'        => json_encode($data),
        ]);

    }

    public function companyOverviewUpdate(Request $request, $id)
    {
        try{
            $company_overview= CompanyOverview::findOrFail($id);
            $data=[];
            $count=0;
            foreach($request->name as $key => $value){
                foreach(json_decode($company_overview->data) as $data2){
                    if($data2->name == $key && $value != $data2->value){
                        array_push($data,['name' => $key, 'value' => $value, 'status' => 0]);
                    }
                    if($data2->name == $key && $value == $data2->value){
                        array_push($data,['name' => $key, 'value' => $value, 'status' =>  $data2->status]);
                    }
                }

                //array_push($data,['name' => $key, 'value' => $value, 'status' => $status[$count]]);
                $count++;
            }

            $company_overview->update(['data' => json_encode($data),'address'=>$request->address,'factory_address'=>$request->factory_address,'about_company'=>$request->about_company]);
            return response()->json([
                'success' => false,
                'msg'     => 'Company Overview Updated',
                'data'    => json_decode($company_overview->data),
                'address'=>$company_overview->address,
                'factory_address'=>$company_overview->factory_address,
                'about_company'=>$company_overview->about_company

            ],200);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                //'error'   => ['msg' => 'Something Went Worng'],
                'error'   => ['msg' => $e->getMessage()],
            ],500);

        }

    }

    public function capacityAndMachineriesCreateOrUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'machine_type.*' => 'required_with:annual_capacity|string|min:1|max:255',
            'annual_capacity.*' => 'required_with:machine_type|integer',
            'type.*' => 'required_with:percentage|string|min:1|max:255',
            'percentage.*' => 'required_with:type|integer',
            'machine_name.*' =>'required_with:quantity|string|min:1|max:255',
            'quantity.*' => 'required_with:machine_name|integer'

        ]);
        if ($validator->fails())
        {
            return response()->json(array(
            'success' => false,
            'error' => $validator->getMessageBag()),
            400);
        }
        try{

            $machineriesDetails = MachineriesDetail::where('business_profile_id',$request->business_profile_id)->delete();
            $categoriesProduceds = CategoriesProduced::where('business_profile_id',$request->business_profile_id)->delete();
            $productionCapacities = ProductionCapacity::where('business_profile_id',$request->business_profile_id)->delete();
            if(isset($request->machine_type)){
                $noOfMachineType=count($request->machine_type);
                if($noOfMachineType>0){
                    for($i=0;$i<$noOfMachineType ;$i++){
                        $productionCapacity  =  new ProductionCapacity();
                        $productionCapacity->machine_type = $request->machine_type[$i];
                        $productionCapacity->annual_capacity = $request->annual_capacity[$i];
                        $productionCapacity->business_profile_id = $request->business_profile_id;
                        $productionCapacity->status = 0;
                        $productionCapacity->created_by = Auth::user()->id;
                        $productionCapacity->updated_by = NULL;
                        $productionCapacity->save();
                    }
                }
            }


            if(isset($request->type)){
                $noOftype=count($request->type);
                if($noOftype>0){
                    for($i=0;$i<$noOftype; $i++){
                        $categoriesProduced  =  new CategoriesProduced();
                        $categoriesProduced->type = $request->type[$i];
                        $categoriesProduced->percentage = $request->percentage[$i];
                        $categoriesProduced->business_profile_id = $request->business_profile_id;
                        $categoriesProduced->status = 0;
                        $categoriesProduced->created_by = Auth::user()->id;
                        $categoriesProduced->updated_by = NULL;
                        $categoriesProduced->save();
                    }
                }

            }

            if(isset($request->machine_name)){
                $noOfMachineName=count($request->machine_name);
                if($noOfMachineName>0){
                    for($i=0; $i<$noOfMachineName ;$i++){

                        $machineriesDetail   =  new MachineriesDetail();
                        $machineriesDetail->machine_name = $request->machine_name[$i];
                        $machineriesDetail->quantity = $request->quantity[$i];
                        $machineriesDetail->business_profile_id = $request->business_profile_id;
                        $machineriesDetail->status = 0;
                        $machineriesDetail->created_by = Auth::user()->id;
                        $machineriesDetail->updated_by = NULL;
                        $machineriesDetail->save();
                    }

                }
            }

            $machineriesDetails = MachineriesDetail::where('business_profile_id',$request->business_profile_id)->get();
            $categoriesProduceds = CategoriesProduced::where('business_profile_id',$request->business_profile_id)->get();
            $productionCapacities = ProductionCapacity::where('business_profile_id',$request->business_profile_id)->get();

            return response()->json([
                'success' => true,
                'message' => 'Company information Updated',
                'machineriesDetails'=>$machineriesDetails,
                'categoriesProduceds'=>$categoriesProduceds,
                'productionCapacities'=>$productionCapacities

            ],200);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'error'   => ['msg' => $e->getLine()],
            ],500);

        }


    }

}
