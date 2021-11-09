<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\OrderModificationComment;

class OrderModificationCommentController extends Controller
{
    public function store( Request $request)
    {
       // dd($request->all());
       try{
            $details=[];
            $product=Product::where('id', $request->product_id)->first();
            foreach($request->order_modification_reply as $key => $value)
                    {
                        foreach($value as $key2 => $value2 )
                        {
                            if($key== 'image')
                            {
                                $filename = $value2->store('images/'.$product->vendor->vendor_name.'/products/modification_request','public');
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
            $data=OrderModificationComment::create([
                'order_modification_request_id' => $request->order_modification_request_id,
                'user_id'                       => auth()->user()->id,
                'parent_id'                     => isset($request->parent_id) ? $request->parent_id : null,
                'details'                       => json_encode($details),
            ]);
            // $admin= Admin::find(1);
            // Notification::send($admin,new QueryCommuncationNotification($data ,'user'));
            // Mail::to('success@merchantbay.com')->send(new QueryCommuncationMail($data, 'user'));
            return response()->json([
                'message' => 'Comment Created Successfully!',
                'code' => true,
            ],200);
       }catch(\Exception $e){
            return response()->json(array(
                'code' => false,
                'error' => $e->getMessage(),),
                500);
            }
    }
}
