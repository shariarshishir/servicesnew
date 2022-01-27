<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Models\CompanyOverview;
use Illuminate\Validation\Rule;
use App\Models\MachineriesDetail;
use App\Models\CategoriesProduced;
use App\Models\CompanyFactoryTour;
use App\Models\ProductionCapacity;
use App\Models\Admin\Certification;
use App\Models\BusinessProfileVerification;
use App\Models\BusinessProfileVerificationsRequest;
use App\Models\Manufacture\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Events\NewBusinessProfileHasCreatedEvent;


class BusinessProfileController extends Controller
{

    public function index()
    {
        $business_profile=BusinessProfile::withTrashed()->where('user_id',auth()->id())->get();

        if($business_profile->isEmpty())
        {
            $business_profile=BusinessProfile::withTrashed()->where('representative_user_id',auth()->id())->get();
        }

        return view('business_profile.index',['business_profile' => $business_profile]);
    }

    public function create()
    {
        $user=User::where('id',auth()->id())->withCount('businessProfile')->first();
        $total_business_count=$user->business_profile_count;
        // if($total_business_count >= 3){
        //     abort( response('Not Permit To More Than 3 Business', 401) );
        // }
        if($user->is_representative	== true){
            $bf=BusinessProfile::where('representative_user_id', $user->id)->first();
            \Session::flash('business_profile_create_permission', 'Your email already associated with <b>'.$bf->business_name.'</b> as a representative, you can not open your business with this email.');
            return redirect()->back();
            abort(response('Your email already associated with '.$bf->business_name.'as a representative. you can not open your business with this email', 401) );
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
            //'nid_passport' => 'required_if:has_representative,0',
            'representive_name' =>'required_if:has_representative,0',
            'business_category_id' => 'required_if:business_type,1',
         ],[
             'email.required_if' => 'The representive email field is required.',
             'phone.required_if' => 'The representive phone field is required.',
             'representive_name.required_if' => 'The representive name field is required.',
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
                    'alias'   => $this->createAlias($request->business_name),
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
                    $business_profile = BusinessProfile::create($business_profile_data);
                    //create company overview
                    $this->createCompanyOverview($request,$business_profile->id);
                    event(new NewBusinessProfileHasCreatedEvent($business_profile));
                    return response()->json([
                        'success' => true,
                        'redirect_url' => route('business.profile'),
                        'msg' => 'Profile Created Successfully',
                    ],200);
                }
                if($request->has_representative == false){
                    $representive_info=[
                        'name' => $request->representive_name,
                        'company'=>auth()->user()->company_name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'password' =>'mb12345678',
                        'nid_passport' => $request->nid_passport,
                        'is_representative' => true,
                        'user_type'      => 'buyer',
                        'is_email_verified' => 1,
                    ];
                    $representive_data=[
                        'name' => $request->representive_name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'password' =>'mb12345678',
                        'nid_passport' => $request->nid_passport,
                        'is_representative' => true,
                        'user_type'      => 'buyer',
                        'is_email_verified' => 1,
                    ];
                    // sso registration
                    if(env('APP_ENV') == 'production')
                    {
                        $sso=Http::post(env('SSO_URL').'/api/auth/signup/',$representive_info);
                        if(!$sso->successful()){
                            return response()->json([
                                'success' => false,
                                'error' => 'Internal Server Error',
                            ],500);
                        }
                    }

                    //user registraion as represetative
                    $representive_data['password'] = bcrypt($representive_data['password']);
                    $user_id = IdGenerator::generate(['table' => 'users', 'field' => 'user_id','reset_on_prefix_change' =>true,'length' => 18, 'prefix' => date('ymd').time()]);
                    $representive_data['user_id'] = $user_id;
                    $user=User::create($representive_data);
                    //profile create
                    $business_profile_data['representative_user_id'] = $user->id;
                    $business_profile = BusinessProfile::create($business_profile_data);
                    //create company overview
                    $this->createCompanyOverview($request,$business_profile->id);

                   event(new NewBusinessProfileHasCreatedEvent($business_profile));

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

    public function removeSpecialCharacterFromAlais($alias)
    {
        $lowercase=strtolower($alias);
        $pattern= '/[^A-Za-z0-9\-]/';
        $preg_replace= preg_replace($pattern, '-', $lowercase);
        $single_hypen= preg_replace('/-+/', '-', $preg_replace);
        $alias= $single_hypen;
        return $alias;
    }


    public function createAlias($name)
    {
        $alias=$this->removeSpecialCharacterFromAlais($name);
        return $this->checkExistsAlias($alias);
    }

    public function checkExistsAlias($alias)
    {
        $check_exists=BusinessProfile::where('alias', $alias)->first();
        if($check_exists){
            $create_array= explode('-',$alias);
            $last_key=array_slice($create_array,-1,1);
            $last_key_string=implode(' ',$last_key);
            if(is_numeric($last_key_string)){
                $last_key_string++;
                array_pop($create_array);
                array_push($create_array,$last_key_string);
            }else{
                array_push($create_array,1);
            }
            $alias=implode("-",$create_array);
            return $this->checkExistsAlias($alias);

        }

        return $alias;
    }
    public function show($alias)
    {
        $business_profile = BusinessProfile::withTrashed()->with('companyOverview','machineriesDetails','categoriesProduceds','productionCapacities','productionFlowAndManpowers','certifications','mainbuyers','exportDestinations','associationMemberships','pressHighlights','businessTerms','samplings','specialCustomizations','sustainabilityCommitments','walfare','security','companyFactoryTour')->where('alias',$alias)->firstOrFail();
        $companyFactoryTour=CompanyFactoryTour::with('companyFactoryTourImages','companyFactoryTourLargeImages')->where('business_profile_id',$business_profile->id)->first();


        if((auth()->id() == $business_profile->user_id) || (auth()->id() == $business_profile->representative_user_id))
        {
            $colors=['Red','Blue','Green','Black','Brown','Pink','Yellow','Orange','Lightblue','Multicolor'];
            $sizes=['S','M','L','XL','XXL','XXXL'];
            $products=Product::withTrashed()->latest()->where('business_profile_id', $business_profile->id)->get();
            if($business_profile->business_type == 1){
                $mainProducts=Product::withTrashed()->with('product_images')->where('business_profile_id',$business_profile->id)->inRandomOrder()
                ->limit(4)
                ->get();
                $default_certification=Certification::get();
                $country=Country::pluck('name','id');
                return view('business_profile.show',compact('business_profile','companyFactoryTour', 'colors', 'sizes','products','mainProducts','default_certification','country'));
            }
            abort(404);
            // if($business_profile->business_type == 2){

            //    return view('wholesaler_profile.index',compact('business_profile'));
            // }


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
            $company_overview = CompanyOverview::findOrFail($id);

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

            $company_overview->update(['data' => json_encode($data),'address'=>$request->address,'factory_address'=> $request->same_as_office_adrs ? $request->address : $request->factory_address,'same_as_office_adrs' => $request->same_as_office_adrs ? true : false ,'about_company'=>$request->about_company]);

            $businessProfileVerification = BusinessProfileVerification::where('business_profile_id',$company_overview->business_profile_id )->first();
            if($businessProfileVerification){
                $businessProfileVerification->company_overview = 0 ;
                $businessProfileVerification->save();

            }


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

   /* public function capacityAndMachineriesCreateOrUpdate(Request $request){
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

            $businessProfileVerification = BusinessProfileVerification::where('business_profile_id',$request->business_profile_id )->first();
            if($businessProfileVerification){
                $businessProfileVerification->capacity_and_machineries = 0 ;
                $businessProfileVerification->save();
            }

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

    }*/

    public function categoriesProducedCreateOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type.*' => 'required_with:percentage|string|min:1|max:255',
            'percentage.*' => 'required_with:type|integer',

        ]);
        if ($validator->fails())
        {
            return response()->json(array(
            'success' => false,
            'error' => $validator->getMessageBag()),
            400);
        }
        try{


            $categoriesProduceds = CategoriesProduced::where('business_profile_id',$request->business_profile_id)->delete();
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

            $categoriesProduceds = CategoriesProduced::where('business_profile_id',$request->business_profile_id)->get();
            $businessProfileVerification = BusinessProfileVerification::where('business_profile_id',$request->business_profile_id )->first();
            if($businessProfileVerification){
                $businessProfileVerification->categories_produced = 0 ;
                $businessProfileVerification->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Categories Produceds information Updated',
                'categoriesProduceds'=>$categoriesProduceds,

            ],200);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'error'   => ['msg' => $e->getLine()],
            ],500);

        }
    }


    public function machineryDetailsCreateOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            $businessProfileVerification = BusinessProfileVerification::where('business_profile_id',$request->business_profile_id )->first();
            if($businessProfileVerification){
                $businessProfileVerification->machinery_details = 0 ;
                $businessProfileVerification->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Machineries information Updated',
                'machineriesDetails'=>$machineriesDetails,
            ],200);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'error'   => ['msg' => $e->getLine()],
            ],500);

        }
    }
    public function termsOfServiceCreateOrUpdate(Request $request){

        try{
            $company_overview = CompanyOverview::where('business_profile_id',$request->business_profile_id)->first();
            $company_overview->update(['terms_of_service'=>$request->terms_of_service??null]);
            $company_overview = CompanyOverview::where('business_profile_id',$request->business_profile_id)->first();
            return response()->json([
                'success' => true,
                'message' => 'Company Terms of service Updated',
                'company_overview'=>$company_overview

            ],200);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'error'   => ['message' => $e->getMessage()],
            ],500);

        }
    }

    public function aliasExistingCheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alias' =>'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(array(
            'error' => 'this field is required'),
            400);
        }

        $alias=$this->removeSpecialCharacterFromAlais($request->alias);
        $check_exists_alias=BusinessProfile::where('alias', $alias)->first();
        if($check_exists_alias){
            return response()->json(['error' => 'The alias has already been taken'],409);
        }
        return response()->json(['msg' => 'this alias you can use', 'alias' => $alias],200);
    }

    public function updateAlias(Request $request)
    {
        $alias=$this->removeSpecialCharacterFromAlais($request->alias);
        $validator = Validator::make(['alias' => $alias, 'business_profile_id' => $request->business_profile_id ], [
            'alias' =>'required|unique:business_profiles,alias',
            'business_profile_id' => 'required'

        ]);
        if ($validator->fails())
        {
            return response()->json(array(
            'success' => false,
            'error' => $validator->getMessageBag()),
            400);
        }
        $business_profile=BusinessProfile::where('id', $request->business_profile_id)->update(['alias' => $alias]);
        return response()->json([
            'success' => true,
            'msg'     => 'alias updated successfully.',
            'url'     => route('business.profile'),
        ],200);

    }


    public function businessProfileVerificationRequest(Request $request)
    {
        //dd($request);
        try
        {
            BusinessProfileVerificationsRequest::create([
                'business_profile_id' => $request->verificationRequestedBusinessProfileId,
                'business_profile_name' => $request->verificationRequestedBusinessProfileName,
                'verification_message'=> $request->verificationMsg,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Request sent successfully.'
            ],200);

        }
        catch(\Exception $e)
        {
            return response()->json([
                'success' => false,
                'error'   => ['message' => $e->getMessage()],
            ],500);

        }
    }

}
