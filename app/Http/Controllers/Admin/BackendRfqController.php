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
use App\Models\Proforma;
use App\Models\Manufacture\ProductCategory;
use Illuminate\Support\Facades\Http;
use App\Http\Traits\PushNotificationTrait;
use Illuminate\Support\Facades\Auth;

class BackendRfqController extends Controller
{
    use PushNotificationTrait;
    public function index(Request $request){
        $response = Http::get(env('RFQ_APP_URL').'/api/quotation/status/all/filter/null/page/1/limit/10');
        $data = $response->json();
        $rfqs = $data['data'];
        $rfqsCount = $data['count'];
        $noOfPages = ceil($data['count']/10);
        return view('admin.rfq.index',compact('rfqs','rfqsCount','noOfPages'));
    }

    public function fetchRFQsByQueryStringOrPagination(Request $request){
        $limit = $request->limit;
        $filter = $request->filter??'null';
        $page = $request->page??'1';
        $response = Http::get(env('RFQ_APP_URL').'/api/quotation/status/all/filter/'.$filter.'/page/'.$page.'/limit/'.$limit);
        $data = $response->json();
        $rfqs = $data['data'];
        $rfqsCount = $data['count'];
        $noOfPages = ceil($data['count']/10);
        return view('admin.rfq.table',compact('rfqs'))->render();
    }

    public function show($id, $link = false){
        $response = Http::get(env('RFQ_APP_URL').'/api/quotation/'.$id);
        $data = $response->json();
        $rfq = $data['data']['data'];
        $businessProfiles = BusinessProfile::select('business_profiles.*')
        ->leftJoin('rfq_quotation_sent_supplier_to_buyer_rel', 'rfq_quotation_sent_supplier_to_buyer_rel.business_profile_id', '=', 'business_profiles.id')
        ->with(['user','supplierQuotationToBuyer'=> function($q) use ($id){
            $q->where('rfq_id', $id);}])
        ->whereIn('business_category_id',$rfq['category_id'])
        ->where('profile_verified_by_admin', '!=', 0)
        ->groupBy('business_profiles.id')
        ->orderBy('rfq_quotation_sent_supplier_to_buyer_rel.created_at', 'desc')
        ->get()
        ->toArray();
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
        if($rfq['user']['user_picture'] !=""){
            $to_user_image = $rfq['user']['user_picture'];
            $userNameShortForm = "";
        }else{
            $to_user_image = $rfq['user']['user_picture'];
            $nameWordArray = explode(" ", $rfq['user']['user_name']);
            $firstWordFirstLetter = $nameWordArray[0][0];
            $secorndWordFirstLetter = $nameWordArray[1][0] ??'';
            $userNameShortForm = $firstWordFirstLetter.$secorndWordFirstLetter;
        }
        $response =   Http::get(env('RFQ_APP_URL').'/api/messages/'.$rfq['id'].'/admin/'.$user.'/user/'.$rfq['created_by']);
        $data = $response->json();
        $chats = $data['data']['messages'];
        $profromaInvoice = Proforma::where('generated_po_from_rfq',$id)->first();
        $chatdata = $chats;
        $buyer = $to_user;
        $userSsoIds = [];
        foreach($businessProfiles as $profile){
            array_push($userSsoIds, $profile['user']['sso_reference_id']);
        }
        $commaSeparatedStringOfSsoId = implode(",",$userSsoIds);
        $response = Http::get(env('RFQ_APP_URL').'/api/rfq/'.$id.'/users/'.$commaSeparatedStringOfSsoId.'/conversations');
        $data = $response->json();
        $usersWithMessageUnseen = $data['data'] ?? [];
        $associativeArrayUsingIDandCount = [];
        foreach($usersWithMessageUnseen as $user){
            $associativeArrayUsingIDandCount[$user['user_id']]  = $user;
        }
        $proforma_invoice_url_for_buyer =$profromaInvoice ? route('open.proforma.single.html', $profromaInvoice->id) : '';
        $url_exists=$link;
        return view('admin.rfq.show', compact('rfq','businessProfiles','chatdata','from_user_image','to_user_image','user','buyer','productCategories','userNameShortForm','profromaInvoice','associativeArrayUsingIDandCount','proforma_invoice_url_for_buyer','url_exists'));
    }

    public function sendFireBasePushNotificationToAdminForNewMessage(Request $request){
        $admin = Auth::guard('admin')->user();
        $response = Http::get(env('RFQ_APP_URL').'/api/quotation/'.$request->rfq_id);
        $data = $response->json();
        $rfq = $data['data']['data'];
        $fcmToken = $admin->fcm_token;
        $title = "New message arrived";
        $message = "A new message has arrived for rfq:".$rfq['title'];
        $action_url = route('admin.rfq.show',$request->rfq_id);
        $this->pushNotificationSend($fcmToken,$title,$message,$action_url);
        return response()->json(['message'=>'successfully send push notification'],200);
    }

    public function businessProfilesWithUnseenMessageCount(Request $request){
        $response = Http::get(env('RFQ_APP_URL').'/api/conversations/unseen/rfq/'.$request->rfq_id);
        $data = $response->json();
        $suppliersWithMessageCount = $data['data'];
        $supplierSsoIds = [];
        foreach($suppliersWithMessageCount as $supplierWithMessageCount){
            array_push($supplierSsoIds,$supplierWithMessageCount['user_id']);
        }
        $userIds = User::whereIn('sso_reference_id',$supplierSsoIds)->pluck('id')->toArray();
        $businessProfiles = BusinessProfile::with(['user','supplierQuotationToBuyer' => function ($q) use ($request){
            $q->where('rfq_id', 'LIKE',"%$request->rfq_id%");
        } ])->whereIn('user_id',$userIds)->where('profile_verified_by_admin', '!=', 0)->orderBy('profile_rating', 'DESC')->get();
        $associativeArrayUsingIDandCount = [];
        foreach($suppliersWithMessageCount as $supplierWithMessageCount){
            $associativeArrayUsingIDandCount[$supplierWithMessageCount['user_id']]  = $supplierWithMessageCount;
        }
        return response()->json(['businessProfiles'=>$businessProfiles, 'associativeArrayUsingIDandCount' => $associativeArrayUsingIDandCount],200);
    }

    public function getChatDataBySupplierId(Request $request){
        $supplier = User::where('sso_reference_id',$request->sso_reference_id)->first();
        if( env('APP_ENV') == 'production') {
            $user = "5771";
        }
        else{
            $user = "5552";
        }
        $adminUser = User::find($user);
        $adminUserImage = isset($adminUser->image) ? asset($adminUser->image) : asset('images/frontendimages/no-image.png');

        if(isset($supplier->image)){
            $supplierImage = asset($supplier->image);
            $supplierNameShortForm = "";
        }else{
            $nameWordArray = explode(" ", $request->business_name);
            $firstWordFirstLetter = $nameWordArray[0][0];
            $secondWordFirstLetter = $nameWordArray[1][0] ??'';
            $supplierNameShortForm = $firstWordFirstLetter.$secondWordFirstLetter;
            $supplierImage = "";
        }


        $response =   Http::get(env('RFQ_APP_URL').'/api/messages/'.$request->rfq_id.'/admin/'.$user.'/user/'.$request->supplier_id);
        $data = $response->json();
        $chats = $data['data']['messages'];
        $chatdata = $chats;
        return response()->json([
            'chatdata' => $chatdata,
            'supplierImage' => $supplierImage,
            'supplierNameShortForm'=>$supplierNameShortForm,
            'adminUserImage' => $adminUserImage
        ],200);

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
                $q->where('rfq_id', 'LIKE',"%$request->rfq_id%");
            } ])->where('business_category_id',$request->category_id)->where('profile_rating','<=',$request->profile_rating)->where('profile_verified_by_admin', '!=', 0)->orderBy('profile_rating', 'DESC')->get();

        }
        elseif($request->category_id && $request->profile_rating ==0)
        {
            //$businessProfiles = BusinessProfile::select('id','business_name','alias','business_type')->where('business_category_id',$request->category_id)->where('profile_verified_by_admin', '!=', 0)->get();
            $businessProfiles = BusinessProfile::with(['user','supplierQuotationToBuyer' => function ($q) use ($request){
                $q->where('rfq_id', 'LIKE',"%$request->rfq_id%");
            } ])->where('business_category_id',$request->category_id)->where('profile_verified_by_admin', '!=', 0)->get();
        }
        $userSsoIds = [];
        foreach($businessProfiles as $profile){
            array_push($userSsoIds, $profile['user']['sso_reference_id']);
        }
        $commaSeparatedStringOfSsoId = implode(",",$userSsoIds);
        $response = Http::get(env('RFQ_APP_URL').'/api/conversations/unseen/rfq/'.$request->rfq_id.'/users/'.$commaSeparatedStringOfSsoId);
        $data = $response->json();
        $usersWithMessageUnseen = $data['data'] ?? [];
        $associativeArrayUsingIDandCount = [];
        foreach($usersWithMessageUnseen as $user){
            $associativeArrayUsingIDandCount[$user['user_id']]  = $user;
        }
        return response()->json(['businessProfiles'=>$businessProfiles, 'associativeArrayUsingIDandCount' => $associativeArrayUsingIDandCount],200);
    }

    public function supplierQuotationToBuyer(Request $request){
        //dd($request->all());

        $quotation = supplierQuotationToBuyer::where('business_profile_id',$request->business_profile_id)->where('rfq_id',$request->rfq_id)->where('from_backend',1)->first();

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
