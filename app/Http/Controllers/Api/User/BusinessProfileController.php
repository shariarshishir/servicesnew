<?php

namespace App\Http\Controllers\API\USER;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manufacture\ProductCategory;
use App\Models\BusinessProfile;
use App\Models\CompanyOverview;
use App\Models\CategoriesProduced;
use App\Models\MachineriesDetail;
use App\Models\ProductionCapacity;
use App\Models\Product as WholesalerProduct;
use App\Models\Manufacture\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use stdClass;

class BusinessProfileController extends Controller
{
    public function show($id){
        $businessProfile= BusinessProfile::with('companyOverview','machineriesDetails','categoriesProduceds','productionCapacities','productionFlowAndManpowers','certifications','mainbuyers','exportDestinations','associationMemberships','pressHighlights','businessTerms','samplings','specialCustomizations','sustainabilityCommitments','walfare','security')->findOrFail($id);
        
        if( $businessProfile){

            //company overview without json
            $companyOverview = new stdClass();
            $companyOverview->id=$businessProfile->companyOverview->id;
            $companyOverview->data=json_decode($businessProfile->companyOverview->data);
            $companyOverview->about_company=$businessProfile->companyOverview->about_company;
            $companyOverview->status=$businessProfile->companyOverview->status;

            //production flow and manpower without json
            $productionFlowAndManpowerArray = [];
            foreach($businessProfile->productionFlowAndManpowers as $key => $productionFlowAndManpower){
                $productionFlowAndManpowerObject = new stdClass();
                $productionFlowAndManpowerObject->id =  $productionFlowAndManpower->id;
                $productionFlowAndManpowerObject->business_profile_id = $productionFlowAndManpower->business_profile_id;
                $productionFlowAndManpowerObject->production_type = $productionFlowAndManpower->production_type;
                $productionFlowAndManpowerObject->flow_and_manpower = json_decode($productionFlowAndManpower->flow_and_manpower);
                array_push($productionFlowAndManpowerArray,$productionFlowAndManpowerObject);
            }

            return response()->json(["businessProfile"=>$businessProfile,"companyOverview"=>$companyOverview,"productionFlowAndManpower"=>$productionFlowAndManpowerArray,"success"=>true],200);
            
        }
        else{
            return response()->json(["success"=>false],404);
        }
    }

    public function manufactureProductCategories(){
        $manufactureProductCategories=ProductCategory::with('subcategories')->get();
        if( count($manufactureProductCategories)>0){
            return response()->json(["productCategories"=>$manufactureProductCategories,"success"=>true],200);
        }
        else{
            return response()->json(["productCategories"=>$manufactureProductCategories,"success"=>false],204);
        }

    }
    
    public function manufactureProductCategoriesByIndustryType(Request $request){
        $manufactureProductCategoriesByInduestryType=ProductCategory::with('subcategories')->where('industry',$request->industry)->get();
        if( count($manufactureProductCategoriesByInduestryType)>0){
            return response()->json(["productCategories"=>$manufactureProductCategoriesByInduestryType,"success"=>true],200);
        }
        else{
            return response()->json(["productCategories"=>$manufactureProductCategoriesByInduestryType,"success"=>false],204);
        }
    }

    public function businessProfileCount(){
        $busenssProfile=BusenssProfile::where('user_id',auth()->user()->id)->get();
        return response()->json(["noOfBusinessProfile"=>count($busenssProfile),"success"=>true],200);
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
        if($validator->fails()){
             return response()->json(array(
             'success' => false,
             'error' => $validator->getMessageBag()),
             400);
        }
         try{
                $business_profile_data=[
                    'business_name' => $request->business_name,
                    'user_id'       => auth()->user()->id,
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
                    $companyOverview=$this->createCompanyOverview($request,$business_profile->id);
                    return response()->json([
                        'success' => true,
                        'business_profile'=>$business_profile,
                        'companyOverview'=>$companyOverview
                       
                    ],201);
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
                    $companyOverview=$this->createCompanyOverview($request,$business_profile->id);
                    $newCompanyOverview = new stdClass();
                    $newCompanyOverview->business_profile_id=$companyOverview->business_profile_id;
                    $newCompanyOverview->business_profile_id=json_decode($companyOverview->data);

                    return response()->json([
                        'success' => true,
                        'business_profile'=>$business_profile,
                        'companyOverview'=>$newCompanyOverview
                    ],201);
                }

            }catch(\Exception $e){
               return response()->json([
                   'success' => false,
                   'error'   => ['msg' => $e->getMessage()],
               ],500);
            }
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
          $companyOverview=CompanyOverview::create([
              'business_profile_id' => $profile_id,
              'data'        => json_encode($data),
          ]);
          return $companyOverview;
  
      }
        public function lowMOQProducts(Request $request)
        {
            //select('name','business_profile_id','product_type','moq','product_unit','sold','full_stock','full_stock_price','full_stock_negotiable')
            $wholesaler_products= WholesalerProduct::with(['images','businessProfile'])->where('moq','!=', null)->where(['state' => 1, 'sold' => 0,])->where('business_profile_id', '!=', null)->get(['id','name','moq','product_type','moq','product_unit','sold','full_stock','flag']);
            $manufacture_products=Product::with(['product_images','businessProfile'])->where('moq','!=', null)->where('business_profile_id', '!=', null)->get(['id','title','moq','price_per_unit','price_unit','moq','qty_unit','industry','lead_time','flag']);
            $merged = $wholesaler_products->merge($manufacture_products)->sortBy('moq');
            $sorted=$merged->sortBy('moq');
            $sorted_value= $sorted->values()->all();


            // $wholesaler_products=WholesalerProduct::with(['images','businessProfile'])->where('moq','!=', null)->where(['state' => 1, 'sold' => 0,])->where('business_profile_id', '!=', null)->get();
            // $manufacture_products=Product::with(['product_images','businessProfile'])->where('moq','!=', null)->where('business_profile_id', '!=', null)->get();
            // $merged = $wholesaler_products->merge($manufacture_products)->sortBy('moq');
            // $sorted=$merged->sortBy('moq');
            // $sorted_value= $sorted->values()->all();
            if(count($sorted_value)>0){
                return response()->json([
                    'success' => true,
                    'products'=>$sorted_value
                ],200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'products'=>[]
                ],404);
            }
           
        }

        public function productsWithShortestLeadTime()
        {
            $products=Product::with('product_images')->where('lead_time','!=', null)->where('business_profile_id', '!=', null)->orderBy('lead_time')->paginate(20);
            if(count($products)>0){
                return response()->json([
                    'success' => true,
                    'products'=>$products
                ],200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'products'=>[]
                ],200);
            }
            
        }

}
