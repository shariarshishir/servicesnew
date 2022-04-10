<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Rfq;
use App\Models\BusinessProfile;
use App\Models\supplierQuotationToBuyer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\NewRfqHasAddedEvent;
use App\Http\Controllers\Controller;
use App\Userchat;
use App\Models\Manufacture\ProductCategory;
use Illuminate\Support\Facades\Http;

class BackendRfqController extends Controller
{
    public function index(Request $request){
        $response = Http::get(env('RFQ_APP_URL').'/api/quotation/status/all/filter/null/page/1/limit/10');
        $data = $response->json();
        $rfqs = $data['data'];
        $rfqsCount = $data['count'];
        return view('admin.rfq.index',compact('rfqs','rfqsCount'));
    }

    public function show($id){
        $response = Http::get(env('RFQ_APP_URL').'/api/quotation/'.$id);
        $data = $response->json();
        $rfq = $data['data']['data'];
        //$businessProfiles = BusinessProfile::select('id','business_name','alias','business_type')->where('business_category_id',$rfq['category_id'][0])->where('profile_verified_by_admin', '!=', 0)->get()->toArray();
        $businessProfiles = BusinessProfile::with('user','supplierQuotationToBuyer')->whereIn('business_category_id',$rfq['category_id'])->where('profile_verified_by_admin', '!=', 0)->get()->toArray();
        $productCategories = ProductCategory::all('id','name');
        if( env('APP_ENV') == 'production') {
            $user = "5771";
        }
        else{
            $user = "5552";
        }
        $from_user = User::find($user);
        $to_user = User::where('email',$rfq['user']['email'])->first();
        $from_user_image = isset($adminUser->image) ? asset($adminUser->image) : asset('images/frontendimages/no-image.png');
        $to_user_image = $rfq['user']['user_picture'];
        $chats = Userchat::where('rfq_id',$id)->get();
        // if($chats->exists()){
        //     $chat = $chats->first();
        //     $chatdataAllData = $chat->chatdata;
        //     $chatdata = $chatdataAllData;
        //     foreach ($chatdataAllData as $key => $value) {
        //         $messageStr = preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $value['message']);
        //         $chatdata[$key]['message'] = $messageStr;
        //     }
        // }
        // else{
        //     $chatdata = [];
        // }
        $chatdata = $chats;
        return view('admin.rfq.show', compact('rfq','businessProfiles','chatdata','from_user_image','to_user_image','user','productCategories'));
    }

    public function status(Request $request,$id){

        $response = Http::put(env('RFQ_APP_URL').'/api/quotation/'.$id, [
            'status' => ( $request->status == 'pending' ) ? 'approved' : 'pending',
        ]);
        if( $response->status()  == 200){
            return redirect()->back()->withSuccess('Rfq status updated successfully');
        }else{
            return redirect()->back()->withSuccess('Something went wrong!!');
        }
        
    }
    public function businessProfileFilter(Request $request){

        if($request->category_id && $request->profile_rating !=0)
        {
            //$businessProfiles = BusinessProfile::select('id','business_name','alias','business_type')->where('business_category_id',$request->category_id)->where('profile_rating',$request->profile_rating)->where('profile_verified_by_admin', '!=', 0)->get();
            $businessProfiles = BusinessProfile::with(['user','supplierQuotationToBuyer' => function ($q) use ($request){
                $q->where('rfq_id', $request->rfq_id);
            } ])->where('business_category_id',$request->category_id)->where('profile_rating','<=',$request->profile_rating)->where('profile_verified_by_admin', '!=', 0)->orderBy('profile_rating', 'DESC')->get();
        }
        elseif($request->category_id && $request->profile_rating ==0)
        {
            //$businessProfiles = BusinessProfile::select('id','business_name','alias','business_type')->where('business_category_id',$request->category_id)->where('profile_verified_by_admin', '!=', 0)->get();
            $businessProfiles = BusinessProfile::with(['user','supplierQuotationToBuyer' => function ($q) use ($request){
                $q->where('rfq_id', $request->rfq_id);
            } ])->where('business_category_id',$request->category_id)->where('profile_verified_by_admin', '!=', 0)->get();
        }
        return response()->json(['businessProfiles'=>$businessProfiles],200);
    }

    public function supplierQuotationToBuyer(Request $request){
        //dd($request->all());

        $quotation = supplierQuotationToBuyer::where('business_profile_id',$request->business_profile_id)->where('rfq_id',$request->rfq_id)->first();

        if($quotation)
        {
            $quotation->update(['offer_price_unit'=> $request->offer_price_unit]);
            $quotation->update(['offer_price'=> $request->offer_price]);
        }
        else
        {
            $supplierQuotationToBuyer = new supplierQuotationToBuyer();
            $supplierQuotationToBuyer->rfq_id = $request->rfq_id;
            $supplierQuotationToBuyer->business_profile_id = $request->business_profile_id;
            $supplierQuotationToBuyer->offer_price = $request->offer_price;
            $supplierQuotationToBuyer->offer_price_unit = $request->offer_price_unit;
            $supplierQuotationToBuyer->save();
        }

        return response()->json(["status" => 1, "message" => "successful"]);
    }
}
