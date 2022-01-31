<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rfq;
use App\Models\BusinessProfile;
use App\Models\SupplierBid;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Events\NewRfqHasBidEvent;
use stdClass;

class RfqBidController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rfq_id' => 'required',
            'business_profile_id'=>'required',
            'unit_price'=>'required',
            'description' => 'required',
           ]);
            if ($validator->fails())
            {
             return response()->json(array(
             'success' => false,
             'error' => $validator->getMessageBag()),
             400);
            }

            $allData=$request->only('rfq_id','business_profile_id','unit_price','description');
            $allData['supplier_id']=auth()->id();
            $rfq = Rfq::find($request->rfq_id);
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
        
        if($bidData){
            return response()->json([
                'success' => true,
                'rfqBid' => $bidData,
                'msg'    => 'Congratulations!!! Your Quotation has been successfully submitted. Buyer will contact you upon interest for further communication'
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
            ],200);

        }
        

    }
    public function rfqBidsByRfqId($rfqId){
        $bids = SupplierBid::where('rfq_id',$rfqId)->get();
        $bidsArray=[];
        foreach($bids as $bid){
                $newFormatedBid = new stdClass();
                $newFormatedBid->id = $bid->id;
                $newFormatedBid->business_profile_id = $bid->business_profile_id;
                $newFormatedBid->user_id = $bid->businessProfile->user->id;
                $newFormatedBid->user_image = $bid->businessProfile->user->image;
                $newFormatedBid->supplier_id = $bid->supplier_id;
                $newFormatedBid->titile = $bid->titile;
                $newFormatedBid->description = $bid->description;
                $newFormatedBid->media = json_decode($bid->media);
                $newFormatedBid->quantity =$bid->quantity;
                $newFormatedBid->unit   = $bid->unit;
                $newFormatedBid->unit_price   = $bid->unit_price;
                $newFormatedBid->total_price   = $bid->total_price;
                $newFormatedBid->destination   = $bid->destination;
                $newFormatedBid->payment_method   = $bid->payment_method;
                $newFormatedBid->delivery_time   = $bid->delivery_time;
                $newFormatedBid->destination   = $bid->destination;
                $newFormatedBid->user_id   = $bid->user->id;
                $newFormatedBid->user_name   = $bid->user->name;
                $newFormatedBid->company_name   = $bid->user->company_name;
                array_push($bidsArray,$newFormatedBid);
        }
        if(count($bidsArray)){
            return response()->json([
                'success' => true,
                'rfqBids' => $bidsArray,
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'rfqBids' => $bidsArray,
            ],200);

        }

    }
}
