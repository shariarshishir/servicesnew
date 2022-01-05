<?php

namespace App\Http\Controllers;

use App\Models\Rfq;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Models\SupplierBid;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Events\NewRfqHasBidEvent;

class RfqBidController extends Controller
{
    public function create($rfq_id)
    {
        $business_profile=BusinessProfile::where('user_id',auth()->id())->get();
        if($business_profile->isEmpty())
        {
            $business_profile=BusinessProfile::where('representative_user_id',auth()->id())->get();
        }
        if(count($business_profile) <= 0 ){
            return response()->json(array(
                'success' => false,
                'error' => ['errors' => 'you do not have any business']),
                401);

        }
        $rfq=Rfq::findOrFail($rfq_id);
        // if($rfq->bids()->exists()){
            $bid=SupplierBid::where('rfq_id', $rfq->id)->where('supplier_id',auth()->id())->first();
            if($bid){
                return response()->json(array(
                    'success' => true,
                    'data' => $rfq,
                    'bid'  => $bid,
                    'my_business' => $business_profile),
                    200);
            }
        // }
        return response()->json(array(
            'success' => true,
            'data' => $rfq,
            'my_business' => $business_profile),
            200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rfq_id' => 'required',
            'business_profile_id'=>'required',
            'payment_method'=>'required',
            'quantity'=>'required',
            'unit_price'=>'required',
            'total_price'=>'required',
            'delivery_time'=>'required',
           ]);
           if ($validator->fails())
         {
             return response()->json(array(
             'success' => false,
             'error' => $validator->getMessageBag()),
             400);
         }

            $allData=$request->all();
            $allData['supplier_id']=auth()->id();
            $rfq = Rfq::find($request->rfq_id);
            $allData['title'] =$rfq->title;
            $allData['unit'] = $rfq->unit;
            $allData['destination'] =$rfq->destination;
            $image_path =[];

            if ($request->hasFile('rfq_images')){
                foreach ($request->file('rfq_images') as $product_image){
                    $path=$product_image->store('images','public');

                    $image = Image::make(Storage::get($path))->fit(555, 555)->encode();
                    Storage::put($path, $image);

                    $image_path[] = $path;
                }

                unset($allData['rfq_images']);
            }else{

                foreach($rfq->images as $item){
                    $image_path[] = $item->image;
                }

            }

            $allData['media'] = json_encode($image_path);
            $bidData=SupplierBid::create($allData);

            //send mail to the user who had created rfq
            if(env('APP_ENV') == 'production')
            {
                $selectedUserToSendMail= $rfq;
                event(new NewRfqHasBidEvent($selectedUserToSendMail, $bidData));

                //send mail to merchantbay
                $selectedUserToSendMail="success@merchantbay.com";
                event(new NewRfqHasBidEvent($selectedUserToSendMail, $bidData));
            }

            return response()->json([
                'success' => true,
                'msg'    => 'Congratulations!!! Your Quotation has been successfully submitted. Buyer will contact you upon interest for further communication'
            ]);

    }


    public function  notificationMarkAsRead(Request $request){

        foreach(auth()->user()->unreadNotifications->where('read_at',null) as $notification){
            if($notification->type == "App\Notifications\RfqBidNotification" && $notification->data['notification_data']['rfq_id'] == $request->rfqId)
            {
                $notification->markAsRead();
                $message="Notification mark as read successfully";
            }
        }

        if(!isset($message)){
            $message="not found";
        }
        $unreadNotifications=auth()->user()->unreadNotifications->where('read_at',null);
        $noOfnotification=count($unreadNotifications);
        return response()->json(['message'=>$message,'noOfnotification'=>$noOfnotification]);

    }

}
