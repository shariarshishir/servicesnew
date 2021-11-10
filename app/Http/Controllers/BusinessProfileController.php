<?php

namespace App\Http\Controllers;

use App\Models\BusinessProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class BusinessProfileController extends Controller
{

    public function index()
    {
        $business_profile=BusinessProfile::where('user_id',auth()->id())->get();
        return view('business_profile.index',['business_profile' => $business_profile]);
    }

    public function create()
    {
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
            'email' => 'required_if:has_representative,0|email|unique:users',
            'phone' => 'required_if:has_representative,0',
            'nid_passport' => 'required_if:has_representative,0',
            'representive_name' =>'required_if:has_representative,0',

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
                    'trade_license' => $request->trade_license,
                    'industry_type' => $request->industry_type,
                    'has_representative'=> $request->has_representative,
                    'number_of_outlets' => $request->number_of_outlets,
                    'number_of_factories' => $request->number_of_factories,
                ];

                if($request->has_representative == true){
                    BusinessProfile::create($business_profile_data);
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
                    BusinessProfile::create($business_profile_data);
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
        $business_profile= BusinessProfile::findOrFail($id);
        return view('business_profile.show',['business_profile' => $business_profile]);

    }

}
