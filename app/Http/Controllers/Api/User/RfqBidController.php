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
            'payment_method'=>'required',
            'quantity'=>'required',
            'unit_price'=>'required',
            'total_price'=>'required',
            'delivery_time'=>'required',
           ]);
        if ($validator->fails()){
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
                $extension = $product_image->getClientOriginalExtension();
                if($extension =='pdf' || $extension =='PDF' || $extension =='doc'||$extension =='docx'||$extension =='xlsx'||$extension =='xl'){
                    $path = $product_image->store('images','public');
                }
                else{
                    $path = $product_image->store('images','public');
                    $image = Image::make(Storage::get($path))->fit(555, 555)->encode();
                    Storage::put($path, $image);
                }
                $image_path[] = $path;
            }
            //if images exist in rfq bid form then take new images as rfq bid image
            unset($allData['rfq_images']);
        }else{
            //if images does not exist in rfq bid form then take old images as rfq bid image
            foreach($rfq->images as $item){
                $image_path[] = $item->image;
            }
        }

        $allData['media'] = json_encode($image_path);
        $bidData=SupplierBid::create($allData);

        // $selectedUserToSendMail= $rfq;
        // event(new NewRfqHasBidEvent($selectedUserToSendMail, $bidData));
        // $selectedUserToSendMail="success@merchantbay.com";
        // event(new NewRfqHasBidEvent($selectedUserToSendMail, $bidData));
        
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
