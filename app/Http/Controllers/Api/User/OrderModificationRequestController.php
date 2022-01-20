<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\OrderModificationRequest;
use stdClass;
use App\Events\NewOrderModificationRequestEvent;

class OrderModificationRequestController extends Controller
{
    public function index()
    {
        $orderModificationRequests=OrderModificationRequest::latest()->where(['user_id' => auth()->user()->id, 'type' => 2])->with(['comments.replies', 'orderModification'])->get();
        $orderModificationRequestsArray=[];
        if(count($orderModificationRequests)>0){
            foreach($orderModificationRequests as $orderModificationRequest){

                   $newFormatedOrderModificationRequest= new stdClass();
                   $newFormatedOrderModificationRequest->id = $orderModificationRequest->id;
                   $newFormatedOrderModificationRequest->type = $orderModificationRequest->type;
                   $newFormatedOrderModificationRequest->user = $orderModificationRequest->user->name;
                   $newFormatedOrderModificationRequest->product_id = $orderModificationRequest->product_id;
                   $newFormatedOrderModificationRequest->product_name = $orderModificationRequest->product->name;
                   $newFormatedOrderModificationRequest->details = json_decode($orderModificationRequest->details);
                   $newFormatedOrderModificationRequest->created_at = $orderModificationRequest->created_at;
                   $newFormatedOrderModificationRequest->updated_at = $orderModificationRequest->updated_at;
                   array_push($orderModificationRequestsArray,$orderModificationRequest);
            }
            return response()->json(array(
                'code' => true,
                'orderModificationRequests' => $orderModificationRequestsArray
            ), 200);
 
        }
        else{
            return response()->json(array(
                'code' => false,
                'orderModificationRequests'=>[]
            ),200 );
        }
    }

    public function show($orderModificationRequestid)
    {
        $orderModificationRequest=OrderModificationRequest::with(['comments', 'orderModification'])->where(['id' => $orderModificationRequestid, 'type' => 2])->first();
        $commemntArray=[];
        foreach($orderModificationRequest->comments as $comment){
            $newFormatedComment= new stdClass();
            $newFormatedComment->user_id = $comment->user_id;
            $newFormatedComment->user_name = $comment->user_id ? $comment->user->name:'Merchantbay';
            $newFormatedComment->comment_details = json_decode($comment->details);
            $newFormatedComment->created_at=$comment->created_at;
            array_push($commemntArray,$newFormatedComment);
        }
        if($orderModificationRequest){

            $newFormatedOrderModificationRequest= new stdClass();
            $newFormatedOrderModificationRequest->id=$orderModificationRequest->id;
            $newFormatedOrderModificationRequest->type=$orderModificationRequest->type;
            $newFormatedOrderModificationRequest->user=$orderModificationRequest->user->name;
            $newFormatedOrderModificationRequest->product_id=$orderModificationRequest->product_id;
            $newFormatedOrderModificationRequest->details=json_decode($orderModificationRequest->details);
            $newFormatedOrderModificationRequest->color_sizes = $orderModificationRequest->orderModification ? json_decode($orderModificationRequest->orderModification->colors_sizes):NULL;
            $newFormatedOrderModificationRequest->unit_price = $orderModificationRequest->orderModification ? $orderModificationRequest->orderModification->unit_price:NULL;
            $newFormatedOrderModificationRequest->quantity = $orderModificationRequest->orderModification ? $orderModificationRequest->orderModification->quantity:NULL;
            $newFormatedOrderModificationRequest->total_price = $orderModificationRequest->orderModification ? $orderModificationRequest->orderModification->total_price:NULL;
            $newFormatedOrderModificationRequest->state=$orderModificationRequest->state;
            $newFormatedOrderModificationRequest->created_at=$orderModificationRequest->created_at;
            $newFormatedOrderModificationRequest->updated_at=$orderModificationRequest->updated_at;
            $newFormatedOrderModificationRequest->comments=$commemntArray;
            
            return response()->json(array(
                'code' => true,
                'orderModificationRequest' => $newFormatedOrderModificationRequest
            ), 200);
 
        }
        else{
            return response()->json(array(
                'code' => false,
            ),200 );
        }
    }
    
    public function store(Request $request)
    {  
        
        $validator = Validator::make($request->all(), [
            'prod_mod_req.details.*' => 'required',
        ],
        ['prod_mod_req.details.*.required' => 'Details are required']
        );

        if ($validator->fails())
        {
            return response()->json(array(
            'success' => false,
            'error' => $validator->getMessageBag()),
            400);
        }


        try{

            $product=Product::where('id',$request->product_id)->first();
            $details=[];
            foreach($request->prod_mod_req as $key => $value)
                    {
                        foreach($value as $key2 => $value2 )
                            {
                                if($key== 'image')
                                {
                                    $filename = $value2->store('images/'.$product->businessProfile->business_name.'/products/modification_request','public');
                                    $image_resize = Image::make(public_path('storage/'.$filename));
                                    $image_resize->fit(300, 300);
                                    $image_resize->save(public_path('storage/'.$filename));
                                    $details[$key2]['image']=$filename;
                                }
                                else if($key== 'details')
                                {
                                        $details[$key2]['details']=$value2;
                                }

                            }
                    }

                    $orderModificationRequest=OrderModificationRequest::create([
                        'type'      => config('constants.order_query_type.order_query_with_modification'),
                        'user_id'   => auth()->id(),
                        'product_id'=> $product->id,
                        'business_profile_id' => $product->business_profile_id,
                        'details'   => json_encode($details),
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->header('User-Agent'),
                ]);



                event(new NewOrderModificationRequestEvent($orderModificationRequest));
                return response()->json([
                    'success' => 'Request Created Successfully!',
                    'code' =>true,
                ],200);
           
        }catch (\Exception $e) {
            return response()->json(array(
                'code' => false,
                'error' => $e->getMessage(),),
                500);
        }
    }


}
