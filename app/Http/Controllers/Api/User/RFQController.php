<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Rfq;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\RfqImage;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class RFQController extends Controller
{
    public function index()
    {
        $rfqs=Rfq::withCount('bids')->with('images','user')->latest()->paginate(10);
        if(count($rfqs)>0){

            return response()->json(['rfqs'=>$rfqs,"success"=>true],200);
        }
        else{
            return response()->json(['rfqs'=>[],"success"=>false],204);
        }
    }
    public function store(Request $request){
        
        // $validator = Validator::make($request->all(), [
        //     'category_id' => 'required',
        //     'title'       => 'required',
        //     'quantity'    => 'required',
        //     'unit'        =>  'required',
        //     'unit_price'     => 'required',
        //     'payment_method' => 'required',
        //     'delivery_time'  => 'required',
        //     'destination'   => 'required',
        // ]);
        // if ($validator->fails())
        // {
        //     return response()->json(array(
        //     'success' => false,
        //     'error' => $validator->getMessageBag()),
        //     400);
        // }
        try{
            $rfqData = $request->except(['product_images']);
            $rfqData['created_by']=auth()->id();
            $rfqData['status']='approved';
            $rfq = Rfq::create($rfqData);
            if ($request->hasFile('product_images')){
                foreach ($request->file('product_images') as $index=>$product_image){
                    $path=$product_image->store('images','public');
                    $image = Image::make(Storage::get($path))->fit(555, 555)->encode();
                    Storage::put($path, $image);
                    RfQImage::create(['rfq_id'=>$rfq->id, 'image'=>$path]);
                }
            }
            
            $message = "Congratulations! Your RFQ was posted successfully. Soon you will receive quotation from Merchant Bay verified relevant suppliers.";
            
            if($rfq){

                return response()->json(['rfq'=>$rfq,'rfqImages'=>$rfq->images,"message"=>$message,"success"=>true],200);
            }
            else{
                return response()->json(["success"=>false],204);
            }
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'error'   => ['message' => $e->getLine()],
            ],500);
        }
    }

    public function storeRfqFromOMD(Request $request){
      
        try{  
            $userObj = json_decode($request->user);
            //user loging credential
            $email = $userObj->email;
            $password = base64_decode($userObj->password);

            //check user exists or not
            $user=User::where('email', $email)->first();
            if(!$user){
                $user_id = IdGenerator::generate(['table' => 'users', 'field' => 'user_id','reset_on_prefix_change' =>true,'length' => 18, 'prefix' => date('ymd').time()]);
                $user = User::create([
                    'user_id'=>$user_id,
                    'name' => $userObj->name,
                    'email' => $email,
                    'password' => bcrypt($password),
                    'user_type' => 'buyer',
                    'sso_reference_id' =>$userObj->id,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                    'phone'     => $userObj->phone,
                    'company_name' => $userObj->company->name,
                    'is_email_verified' => 1,
                ]);
            }
        
            $rfqData = $request->except(['product_images','user','sso_reference_id']);
            $rfqData['created_by']=$user->id;
            $rfqData['status']='approved';
            $rfq=Rfq::create($rfqData);

            if ($request->hasFile('product_images')){
                foreach ($request->file('product_images') as $index=>$product_image){
                    $path=$product_image->store('images','public');
                    $image = Image::make(Storage::get($path))->fit(555, 555)->encode();
                    Storage::put($path, $image);
                    RfQImage::create(['rfq_id'=>$rfq->id, 'image'=>$path]);
                }
            }

            $message = "Congratulations! Your RFQ was posted successfully. Soon you will receive quotation from Merchant Bay verified relevant suppliers.";
            if($rfq){
                return response()->json(['rfq'=>$rfq,'rfqImages'=>$rfq->images,"success"=>true],200);
            }

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'error'   => ['msg' => $e->getMessage()],
            ],500);
        }
    }
}
