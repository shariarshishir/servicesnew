<?php

namespace App\Http\Controllers\BusinessProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Rfq;
use App\Models\User;
use App\Models\Product;
use App\Models\RfqImage;
use App\Userchat;
use App\RfqApp;
use Illuminate\Support\Str;
use App\Jobs\NewRfqHasAddedJob;
use App\Models\BusinessProfile;
use App\Events\NewRfqHasAddedEvent;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
Use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Manufacture\Product as ManufactureProduct;
use App\Models\Product as WholesalerProduct;
use App\Models\ProductTag;


class RfqController extends Controller
{
    public function index($alias, Request $request)
    {
        $business_profile=BusinessProfile::where('alias',$alias)->firstOrFail();
        if((auth()->id() == $business_profile->user_id) || (auth()->id() == $business_profile->representative_user_id))
        {
            
            if($business_profile->profile_type == 'supplier' && $business_profile->business_type == 'manufacturer'){
                $collection=collect(ManufactureProduct::withTrashed()
                ->latest()
                ->with('product_images','product_video','businessProfile')
                ->where(function($query) use ($request, $business_profile){
                    $query->where('business_profile_id', '!=', null)->get();
                    if(isset($request->search)){
                        $query->where('title','like', '%'.$request->search.'%')->get();
                    }

                })
                ->get());

                $controller_max_moq = $collection->max('moq');
                $controller_min_moq = $collection->min('moq');
                $controller_max_lead_time = $collection->max('lead_time');
                $controller_min_lead_time = $collection->min('lead_time');

                if(isset($request->product_tag)){
                    $ptags = [];
                    foreach($request->product_tag as $tag){
                        $product_tag = ProductTag::where('id',$tag)->first();
                        array_push($ptags,$product_tag->name);
                    }
                    $collection= $collection->filter(function($item) use ($ptags){
                        if(isset($item['product_tag'])){
                            $check = array_intersect($item['product_tag'], $ptags);
                            if(empty($check)){
                                return false;
                            }
                            return true;
                        }
                        return false;
                    });
                }

                if(isset($request->product_type_mapping_child_id)){
                    $collection = $collection->filter(function($item) use ($request){
                        if(isset($item['product_type_mapping_child_id'])){
                            $check = array_intersect($item['product_type_mapping_child_id'], $request->product_type_mapping_child_id);
                            if(empty($check)){
                                return false;
                            }
                            return true;
                        }
                        return false;
                    });
                }

                if(isset($request->min_moq) && isset($request->max_moq)){
                    $collection = $collection->whereBetween('moq', [$request->min_moq, $request->max_moq]);
                    $collection->all();
                }

                if(isset($request->min_lead) && isset($request->max_lead)){
                    $collection = $collection->whereBetween('lead_time', [$request->min_lead, $request->max_lead]);
                    $collection->all();
                }

                $page = Paginator::resolveCurrentPage() ?: 1;
                $perPage = 8;
                $products = new \Illuminate\Pagination\LengthAwarePaginator(
                    $collection->forPage($page, $perPage),
                    $collection->count(),
                    $perPage,
                    $page,
                    ['path' => Paginator::resolveCurrentPath()],
                );

                $colors=['Red','Blue','Green','Black','Brown','Pink','Yellow','Orange','Lightblue','Multicolor'];
                $sizes=['S','M','L','XL','XXL','XXXL'];
                $view = isset($request->view)? $request->view : 'grid';
                return view('new_business_profile.rfqs',compact('alias','products','business_profile','view','colors','sizes','controller_max_moq','controller_min_moq','controller_max_lead_time','controller_min_lead_time'));
            }


            if($business_profile->profile_type == 'supplier' && $business_profile->business_type == 'wholesaler'){

                $collection=collect(WholesalerProduct::withTrashed()
                ->where(function($query) use ($request, $business_profile){
                    $query->where('business_profile_id', '!=', null)->get();
                    if(isset($request->search)){
                        $query->where('name','like', '%'.$request->search.'%')->get();
                    }})
                ->latest()
                ->with('images','video')
                ->get());

                $controller_max_moq = $collection->max('moq');
                $controller_min_moq = $collection->min('moq');
                $controller_max_lead_time = 0;
                $controller_min_lead_time = 0;
                foreach($collection as $product){
                    if(isset($product->attribute) && $product->product_type == 1){
                        foreach(json_decode($product->attribute) as $lead_time)
                        {
                            if ($lead_time[3] > $controller_max_lead_time) {
                                $controller_max_lead_time = $lead_time[3];
                            }

                            if ($lead_time[3] < $controller_min_lead_time) {
                                $controller_min_lead_time = $lead_time[3];
                            }
                        }
                    }
                }

                if(isset($request->product_tag)){
                    $ptags = [];
                    foreach($request->product_tag as $tag){
                        $product_tag = ProductTag::where('id',$tag)->first();
                        array_push($ptags,$product_tag->name);
                    }
                    $collection = $collection->filter(function($item) use ($ptags){
                        if(isset($item['product_tag'])){
                            $check = array_intersect($item['product_tag'], $ptags);
                            if(empty($check)){
                                return false;
                            }
                            return true;
                        }
                        return false;

                    });
                }

                if(isset($request->product_type_mapping_child_id)){
                    $collection = $collection->filter(function($item) use ($request){
                        if(isset($item['product_type_mapping_child_id'])){
                            $check = array_intersect($item['product_type_mapping_child_id'], $request->product_type_mapping_child_id);
                            if(empty($check)){
                                return false;
                            }
                            return true;
                        }
                        return false;
                    });
                }

                if(isset($request->min_lead) && isset($request->max_lead)){
                    $p_id=[];
                    foreach($collection as $product){
                        if(isset($product->attribute) && $product->product_type == 1){
                            foreach(json_decode($product->attribute) as $lead_time)
                            {
                                if ( $lead_time[3] >= $request->min_lead && $lead_time[3] <= $request->max_lead){
                                    array_push($p_id,$product->id);
                                }
                            }
                        }
                    }

                    $collection = $collection->whereIn('id', $p_id);
                    $collection->all();
                }

                if(isset($request->min_moq) && isset($request->max_moq)){
                    $collection = $collection->whereBetween('moq', [$request->min_moq, $request->max_moq]);
                    $collection->all();
                }

                $page = Paginator::resolveCurrentPage() ?: 1;
                $perPage = 8;
                $products = new \Illuminate\Pagination\LengthAwarePaginator(
                    $collection->forPage($page, $perPage),
                    $collection->count(),
                    $perPage,
                    $page,
                    ['path' => Paginator::resolveCurrentPath()],
                );
                $view = isset($request->view)? $request->view : 'grid';
                return view('new_business_profile.rfqs',compact('alias','products','business_profile','view','controller_max_moq','controller_min_moq','controller_max_lead_time','controller_min_lead_time'));
            }

        }
        abort(401);
    }

    public function searchRfq(Request $request,$alias)
    {
        $response = Http::get(env('RFQ_APP_URL').'/api/quotation/filter/'.$request->search_input.'/page/1/limit/20');
        $data = $response->json();
        $rfqLists = $data['data'] ?? [];
        $business_profile = BusinessProfile::with('user')->where('alias',$alias)->firstOrFail();
        return view('new_business_profile.rfqs',compact('rfqLists','alias','business_profile'));
    }

    public function rfqByPageNumber(Request $request)
    {
        $page = $request->page;
        $response = Http::get(env('RFQ_APP_URL').'/api/quotation/filter/null/page/'.$page.'/limit/10');
        $data = $response->json();
        $rfqLists = $data['data'] ?? [];
        return view('rfq.rfq_list',compact('rfqLists'))->render();
    }
    public function myRfqList($alias)
    {
        $business_profile = BusinessProfile::with('user')->where('alias',$alias)->firstOrFail();
        $user = Auth::user();
        $token = Cookie::get('sso_token');
        //get all rfqs of auth user
        $response = Http::withToken($token)
        ->get(env('RFQ_APP_URL').'/api/quotation/user/'.$user->sso_reference_id.'/filter/null/page/1/limit/10');
        $data = $response->json();
        $rfqLists = $data['data'] ?? [];
        $rfqsCount = $data['count'];
        $noOfPages = ceil($data['count']/10);
        //all messages of auth user from mongodb messages collection
        $chatdataRfqIds = Userchat::where('to_id',$user->sso_reference_id)->orWhere('from_id',$user->sso_reference_id)->pluck('rfq_id')->toArray();
        $uniqueRfqIdsWithChatdata = array_unique($chatdataRfqIds);
        //all rfqs where auth user has messages
        $rfqs = RfqApp::whereIn('id',$uniqueRfqIdsWithChatdata)->latest()->get();
        if(count($rfqs)>0){ 
            //messages of first rfq of auth user
            $response = Http::get(env('RFQ_APP_URL').'/api/messages/'.$rfqLists[0]['id'].'/user/'.$user->sso_reference_id);
            $data = $response->json();
            $chats = $data['data']['messages'];
            $chatdata = $chats;
            if($rfqs[0]['user']['user_picture'] !=""){
                $userImage = $rfqs[0]['user']['user_picture'];
                $userNameShortForm = "";
            }else{
                $userImage = $rfqs[0]['user']['user_picture'];
                //if user picture does not exist then we need to show user name short form insetad of user image in chat box 
                $nameWordArray = explode(" ", $rfqs[0]['user']['user_name']);
                $firstWordFirstLetter = $nameWordArray[0][0];
                $secorndWordFirstLetter = $nameWordArray[1][0] ??'';
                $userNameShortForm = $firstWordFirstLetter.$secorndWordFirstLetter;
            }
        }else{
            $chatdata = [];
            $userImage ="";
            //if user picture does not exist then we need to show user name short form insetad of user image in chat box 
            $nameWordArray = explode(" ", $user->name);
            $firstWordFirstLetter = $nameWordArray[0][0];
            $secorndWordFirstLetter = $nameWordArray[1][0] ??'';
            $userNameShortForm = $firstWordFirstLetter.$secorndWordFirstLetter;
        }
        $quotations = Userchat::select("*", DB::raw('count(*) as total'))
        ->groupBy('rfq_id')
        ->get();

        if(env('APP_ENV') == 'local'){
            $adminUser = User::Find('5552');
        }else{
            $adminUser = User::Find('5771');
        }
        $adminUserImage = isset($adminUser->image) ? asset($adminUser->image) : asset('images/frontendimages/no-image.png');
        return view('new_business_profile.my_rfqs',compact('rfqLists','noOfPages','alias','chatdata','business_profile','adminUserImage','userImage','userNameShortForm','user'));
    }

    public function myQueries($alias)
    {
        $business_profile = BusinessProfile::with('user')->where('alias',$alias)->firstOrFail();
        $user = Auth::user();
        $token = Cookie::get('sso_token');
        //get all queries of auth user
        $response = Http::withToken($token)
        ->get(env('RFQ_APP_URL').'/api/queries/user/'.$user->sso_reference_id.'/filter/null/page/1/limit/10');
        $data = $response->json();
        $rfqLists = $data['data'] ?? [];
        $rfqsCount = $data['count'];
        $noOfPages = ceil($data['count']/10);
        //all messages of auth user from mongodb messages collection
        $chatdataRfqIds = Userchat::where('to_id',$user->sso_reference_id)->orWhere('from_id',$user->sso_reference_id)->pluck('rfq_id')->toArray();
        $uniqueRfqIdsWithChatdata = array_unique($chatdataRfqIds);
        //all queries where auth user has messages
        $rfqs = RfqApp::whereIn('id',$uniqueRfqIdsWithChatdata)->latest()->get();
        if(count($rfqs)>0){
            //messages of first queries of auth user
            $response = Http::get(env('RFQ_APP_URL').'/api/messages/'.$rfqs[0]['id'].'/user/'.$user->sso_reference_id);
            $data = $response->json();
            $chats = $data['data']['messages'];
            $chatdata = $chats;
            if($rfqs[0]['user']['user_picture'] !=""){
                $userImage = $rfqs[0]['user']['user_picture'];
                $userNameShortForm = "";
            }else{
                //if user picture does not exist then we need to show user name short form insetad of user image in chat box 
                $userImage = $rfqs[0]['user']['user_picture'];
                $nameWordArray = explode(" ", $rfqs[0]['user']['user_name']);
                $firstWordFirstLetter = $nameWordArray[0][0];
                $secorndWordFirstLetter = $nameWordArray[1][0] ??'';
                $userNameShortForm = $firstWordFirstLetter.$secorndWordFirstLetter;
            }
        }else{
            $chatdata = [];
            $userImage ="";
            //if user picture does not exist then we need to show user name short form insetad of user image in chat box 
            $nameWordArray = explode(" ", $user->name);
            $firstWordFirstLetter = $nameWordArray[0][0];
            $secorndWordFirstLetter = $nameWordArray[1][0] ??'';
            $userNameShortForm = $firstWordFirstLetter.$secorndWordFirstLetter;
        }
        $quotations = Userchat::select("*", DB::raw('count(*) as total'))
        ->groupBy('rfq_id')
        ->get();

        if(env('APP_ENV') == 'local'){
            $adminUser = User::Find('5552');
        }else{
            $adminUser = User::Find('5771');
        }
        $adminUserImage = isset($adminUser->image) ? asset($adminUser->image) : asset('images/frontendimages/no-image.png');
        return view('new_business_profile.my_rfqs',compact('rfqLists','noOfPages','alias','chatdata','business_profile','adminUserImage','userImage','userNameShortForm','user'));
    }

    public function authUserQuotationsByRFQId(Request $request){
        $quotations = Userchat::where('rfq_id',$request->rfqId)->where('factory',true)->get();
        return response()->json(["quotations"=>$quotations],200);
        
    }

    public function authUserConversationsByRFQId(Request $request){
        $user = Auth::user();
        $response = Http::get(env('RFQ_APP_URL').'/api/messages/'.$request->rfqId.'/user/'.$user->sso_reference_id);
        $data = $response->json();
        $chats = $data['data']['messages'];

        $response = Http::get(env('RFQ_APP_URL').'/api/quotation/'.$request->rfqId);
        $data = $response->json();
        $rfq = $data['data']['data'];
        return response()->json(["chats"=>$chats,"rfq"=>$rfq],200);
    }

    public function myRfqByPageNumber(Request $request){
        $user = Auth::user();
        $response = Http::get(env('RFQ_APP_URL').'/api/quotation/user/'.$user->sso_reference_id.'/filter/null/page/1/limit/10');
        $data = $response->json();
        $rfqLists = $data['data'] ?? [];
        return view('rfq.my_rfq_list',compact('rfqLists'))->render();
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title'       => 'required',
            'quantity'    => 'required',
            'unit'        =>  'required',
            'unit_price'     => 'required',
            'payment_method' => 'required',
            'delivery_time'  => 'required',
            'destination'   => 'required',
            'short_description' => 'required',
            'full_specification' => 'required',

        ]);

        $rfqData = $request->except(['_token','captcha_token','product_images']);
        $rfqData['created_by']=auth()->id();
        $rfqData['status']='pending';
        $rfqData['rfq_from'] = "service";
        $rfqData['link'] = $this->generateUniqueLink();

        $rfq=Rfq::create($rfqData);

        if ($request->hasFile('product_images')){
            foreach ($request->file('product_images') as $index=>$product_image){

                $extension = $product_image->getClientOriginalExtension();
                if($extension=='pdf' ||$extension=='PDF' ||$extension=='doc'||$extension=='docx'|| $extension=='xlsx' || $extension=='ZIP'||$extension=='zip'|| $extension=='TAR' ||$extension=='tar'||$extension=='rar' ||$extension=='RAR'  ){

                    $path=$product_image->store('images','public');
                }
                else{
                    $path=$product_image->store('images','public');
                    $image = Image::make(Storage::get($path))->fit(555, 555)->encode();
                    Storage::put($path, $image);
                }
                RfqImage::create(['rfq_id'=>$rfq->id, 'image'=>$path]);
            }
        }
        $rfq = Rfq::with('images','category')->where('id',$rfq->id)->first();
        
            $selectedUserToSendMail="success@merchantbay.com";
            event(new NewRfqHasAddedEvent($selectedUserToSendMail,$rfq));


        $msg = "Your RFQ was posted successfully.<br><br>Soon you will receive quotation from <br>Merchant Bay verified relevant suppliers.";
        return back()->with(['rfq-success'=> $msg]);

    }
    
    public function delete($rfq_id)
    {
        $rfq=Rfq::findOrFail($rfq_id);
        $rfq->delete();
        \Session::flash('success', 'Rfq Successfully deleted');
        return redirect()->back();
    }

    public function active($rfq_id)
    {
        $rfq=Rfq::withTrashed()->findOrFail($rfq_id)->restore();
        \Session::flash('success', 'Rfq Successfully activited');
        return redirect()->back();
    }

    public function edit($rfq_id)
    {
        $rfq=Rfq::withTrashed()->where('id',$rfq_id)->with('images')->first();
        if(!$rfq){
            return response()->json([
                'success' => false,
                'error'  => 'id not exists',
            ],404);
        }
        $date=Carbon::parse($rfq->delivery_time)->format('Y-m-d');
        return response()->json([
            'success' => true,
            'data' => $rfq,
            'date' => $date,
        ],200);
    }

    public function update(Request $request, $rfq_id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title'       => 'required',
            'quantity'    => 'required',
            'unit'        =>  'required',
            'unit_price'     => 'required',
            'payment_method' => 'required',
            'delivery_time'  => 'required',
            'destination'   => 'required',
            'edit_rfq_id'  => 'required',
            'product_images.*' => 'max:10000',
            'short_description' => 'required',
            'full_specification' => 'required',

        ]);

        if ($validator->fails())
        {
            return response()->json(array(
            'success' => false,
            'error' => $validator->getMessageBag()),
            400);
        }

        $rfq=Rfq::withTrashed()->where('id',$rfq_id)->first();
        if(!$rfq){
            return response()->json(array(
                'success' => false,
                'error' => 'rfq not exists'),
                400);
        }
        $rfq->update($request->only(['category_id','title','quantity','unit','unit_price','payment_method','delivery_time','destination','short_description','full_specification']));
        if($request->publish == true && $rfq->deleted_at){
            $rfq->restore();
        }else if($request->publish == false && !$rfq->deleted_at){
            $rfq->delete();
        }
        if ($request->hasFile('product_images')){
            foreach ($request->file('product_images') as $index=>$product_image){

                $extension = $product_image->getClientOriginalExtension();
                if($extension=='pdf' ||$extension=='PDF' ||$extension=='doc'||$extension=='docx'|| $extension=='xlsx' || $extension=='ZIP'||$extension=='zip'|| $extension=='TAR' ||$extension=='tar'||$extension=='rar' ||$extension=='RAR'  ){
                    $path=$product_image->store('images','public');
                }
                else{
                    $path=$product_image->store('images','public');
                    $image = Image::make(Storage::get($path))->fit(555, 555)->encode();
                    Storage::put($path, $image);
                }
                RfqImage::create(['rfq_id'=>$rfq->id, 'image'=>$path]);
            }
        }
        return response()->json([
            'success' => true,
            'msg' => 'rfq successfully updated',
        ],200);


    }

    public function singleImageDelete($rfq_image_id)
    {
            $rfq_image=RfqImage::findOrFail($rfq_image_id);
            if(Storage::exists($rfq_image->image)){
                Storage::delete($rfq_image->image);
            }
            $rfq_image->delete();
            return response()->json([
                'success' => true,
                'msg'   => 'image delete successfully',
            ],200);
    }

    public function generateUniqueLink()
    {
        do {
            $link = Str::random(20);
        } while (Rfq::where('link', $link)->first());

        return $link;
    }

    public function showRfqUsingLink($link, Request $request)
    {
        if (Auth::check() && env('APP_ENV') == 'production'){
            $token= $request->cookie('sso_token');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->get(env('RFQ_APP_URL').'/api/quotation/'.$link);
        }else{
            $response = Http::get(env('RFQ_APP_URL').'/api/quotation/'.$link);
        }

        $data = $response->json();
        $rfqLists = $data['data'] ?? [];
        return view('rfq.show_using_link',compact('rfqLists'));
    }

    public function share($rfq_id)
    {
        $rfq=Rfq::where('id',$rfq_id)->first();
        if(!$rfq){
            return response()->json(['error' => 'Record not found'],404);
        }

        if($rfq->link){
            $link=route('show.rfq.using.link',$rfq->link);
            return response()->json(['link'=> $link],200);
        }

        $link=$this->generateUniqueLink();
        $rfq->update(['link'=> $link]);
        $link=route('show.rfq.using.link',$rfq->link);
        return response()->json(['link'=> $link],200);
    }

    public function loginFromRfqShareLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rfqpassword' => 'required',
            'rfqemail' => 'required|email',
        ]);

        if ($validator->passes()) {
            // sso checking authentication
            if(env('APP_ENV') == 'production')
            {
                $sso=Http::post(env('SSO_URL').'/api/auth/token/',[
                    'email' => $request->rfqemail,
                    'password' => $request->rfqpassword,
                ]);
                if($sso->successful()){
                    $access_token=$sso['access'];
                    $explode=explode(".",$access_token);
                    $time= base64_decode($explode[1]);
                    $decode_time=json_decode($time);
                    $get_time=$decode_time->exp;
                    $current=strtotime(date('d.m.Y H:i:s'));
                    $totalSecondsDiff = abs($get_time-$current);
                    $totalMinutesDiff = $totalSecondsDiff/60;
                    // $totalHoursDiff   = $totalSecondsDiff/60/60;
                    // $totalDaysDiff    = $totalSecondsDiff/60/60/24;
                    // $totalMonthsDiff  = $totalSecondsDiff/60/60/24/30;
                    // $totalYearsDiff   = $totalSecondsDiff/60/60/24/365;

                    // if($request->hasCookie('sso_token') !== null){
                    //     Cookie::forget('sso_token');
                    // }
                    if(Cookie::has('sso_token')){
                        Cookie::queue(Cookie::forget('sso_token'));
                    }
                   // $set_cookie=Cookie::make('sso_token', $access_token, $totalMinutesDiff);
                    Cookie::queue(Cookie::make('sso_token', $access_token, $totalMinutesDiff));

                    if($request->session()->has('sso_password')){
                        $request->session()->forget('sso_password');
                    }
                    $request->session()->put('sso_password', $request->password);


                }
                else{
                    return response()->json(['msg' => 'No active account found with the given credentials']);
                }
            }


            $credentials = [
                'email' => $request->rfqemail,
                'password' => $request->rfqpassword,
            ];
            $remember_me = $request->remember == 'true' ? true : false;
            if(Auth::attempt($credentials,$remember_me))
            {
                $userId = auth()->user()->id;
                $user = User::whereId($userId)->first();
                $user->update(['last_activity' => Carbon::now(),'fcm_token'=>$request->fcm_token]);

                return response()->json(['user_id'=>$user->user_id, 'url' => url()->previous() ]);
            }
            return response()->json(['msg' => 'Wrong email or password']);

        }

        return response()->json(['error'=>$validator->errors()]);

    }

    public function create()
    {
        return view('rfq.create');
    }

    public function storeFromProductDetails(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'title'       => 'required',
            'rfq_quantity'    => 'required',
            'unit'        =>  'required',
            'rfq_unit_price'     => 'required',
            'payment_method' => 'required',
            'delivery_time'  => 'required',
            'destination'   => 'required',
            'short_description' => 'required',
            'full_specification' => 'required',

        ]);

        $rfqData = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'quantity' => $request->rfq_quantity,
            'unit' => $request->unit,
            'unit_price' => $request->rfq_unit_price,
            'payment_method' => $request->payment_method,
            'delivery_time' => $request->delivery_time,
            'destination' => $request->destination,
            'short_description' => $request->short_description,
            'full_specification' => $request->full_specification,
            'created_by' => auth()->id(),
            'status' => 'pending',
            'rfq_from' => "service",
            'link' => $this->generateUniqueLink(),

        ];

        $rfq=Rfq::create($rfqData);

        /*if ($request->hasFile('product_images')){
            foreach ($request->file('product_images') as $index=>$product_image){

                $extension = $product_image->getClientOriginalExtension();
                if($extension=='pdf' ||$extension=='PDF' ||$extension=='doc'||$extension=='docx'|| $extension=='xlsx' || $extension=='ZIP'||$extension=='zip'|| $extension=='TAR' ||$extension=='tar'||$extension=='rar' ||$extension=='RAR'  ){

                    $path=$product_image->store('images','public');
                }
                else{
                    $path=$product_image->store('images','public');
                    $image = Image::make(Storage::get($path))->fit(555, 555)->encode();
                    Storage::put($path, $image);
                }
                RfqImage::create(['rfq_id'=>$rfq->id, 'image'=>$path]);
            }
        }*/
        if($request->flag == 'mb'){
            $product=ManufactureProduct::with('product_images')->where('id', $request->product_id)->first();
            foreach($product->product_images  as $key => $image){
                RfqImage::create(['rfq_id'=>$rfq->id, 'image'=>$image->product_image]);
               if($key == 2){
                   break;
               }
            }
        }
        if($request->flag == 'shop'){
            $product=Product::with('images')->where('id', $request->product_id)->first();
            foreach($product->images  as $key => $image){
                RfqImage::create(['rfq_id'=>$rfq->id, 'image'=>$image->image]);
               if($key == 2){
                   break;
               }
            }
        }
        $rfq = Rfq::with('images','category')->where('id',$rfq->id)->first();
        //SEND CREATED RFQ DATA TO RFQ APP
        // $response = Http::post(env('RFQ_APP_URL').'/api/quotation',[
        //     $rfq
        // ]);

        // if(env('APP_ENV') == 'production')
        // {
            /* code using redis-cli

            $selectedUsersToSendMail = User::where('id','<>',auth()->id())->get();
            foreach($selectedUsersToSendMail as $selectedUserToSendMail) {
                NewRfqHasAddedJob::dispatch($selectedUserToSendMail, $rfq);
            }

            $selectedUserToSendMail="success@merchantbay.com";
            NewRfqHasAddedJob::dispatch($selectedUserToSendMail, $rfq);

            */
            // $selectedUsersToSendMail = User::where('id','<>',auth()->id())->take(10)->get();
            // foreach($selectedUsersToSendMail as $selectedUserToSendMail) {
            //     event(new NewRfqHasAddedEvent($selectedUserToSendMail,$rfq));
            // }

            $selectedUserToSendMail="success@merchantbay.com";
            event(new NewRfqHasAddedEvent($selectedUserToSendMail,$rfq));
        // }


        $msg = "Your RFQ was posted successfully.<br><br>Thank you for your request. We will get back to you with quotations within 48 hours.";
        return back()->with(['rfq-success'=> $msg]);
    }

    public function storeWithLogin(Request $request)
    {
        if(env('APP_ENV') == 'local')
        {
            return  response()->json(['error' => "change the environment.now environment is local"],401);
        }
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:r_email',
            'password' => 'required_without:r_password',
            'r_email' => 'required_without:email|unique:users,email',
            'r_password' => 'required_without:password',
            'name'      => 'required_without:email',
        ],[
            'r_email.unique' => 'The email has already been taken.'
        ]);
        if ($validator->fails())
        {
            return response()->json(array(
            'success' => false,
            'error' => $validator->getMessageBag()),
            400);
        }


        if(isset($request->email) && isset($request->password))
        {
            $sso=Http::post(env('SSO_URL').'/api/auth/token/',[
                'email' => $request->email,
                'password' => $request->password,
            ]);
            if($sso->successful()){
                $access_token=$sso['access'];
                $explode=explode(".",$access_token);
                $time= base64_decode($explode[1]);
                $decode_time=json_decode($time);
                $get_time=$decode_time->exp;
                $get_time=strtotime(date('d.m.Y H:i:s')) + strtotime(date('d.m.Y H:i:s'));
                $current=strtotime(date('d.m.Y H:i:s'));
                $totalSecondsDiff = abs($get_time-$current);
                $totalMinutesDiff = $totalSecondsDiff/60;

                if(Cookie::has('sso_token')){
                    Cookie::queue(Cookie::forget('sso_token'));
                }
                Cookie::queue(Cookie::make('sso_token', $access_token, $totalMinutesDiff));

                if($request->session()->has('sso_password')){
                    $request->session()->forget('sso_password');
                }
                $request->session()->put('sso_password', $request->password);


            }
            else{
                return response()->json(['error' => 'No active account found with the given credentials or maybe you have provided wrong email or password.'],401);
            }

            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            if(!Auth::attempt($credentials))
            {
                return  response()->json(['error' => "Wrong email or password"],401);
            }

            return response()->json(['access_token' =>  $access_token],200);

        }else{
            $registration_data = [
                'email' => $request->r_email,
                'password' => $request->r_password,
                'name' => $request->name,
                'company' =>'No Company',
                'user_type' => 'buyer',
                'user_flag' => 'rfq',
            ];

            $registration=Http::post(env('SSO_URL').'/api/auth/signup/',$registration_data);
            if(!$registration->successful()){
                return  response()->json(['error' => 'Registration failed, please try again'],403);
            }
            $fromSso=json_decode($registration->getBody());
            $user_id = IdGenerator::generate(['table' => 'users', 'field' => 'user_id','reset_on_prefix_change' =>true,'length' => 18, 'prefix' => date('ymd').time()]);
            $registration_data_new_user = [
                'user_id'=>$user_id,
                'sso_reference_id' => $fromSso->id,
                'email' => $request->r_email,
                'password' => Hash::make($request->r_password),
                'name' => $request->name,
                'company_name' =>'No Company',
                'user_type' => 'buyer',
                'is_email_verified' => 1,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ];
            $new_user=User::create($registration_data_new_user);
            if(!$new_user){
                return  response()->json(['error' => 'Somethings went wrong'],403);
            }
            $sso=Http::post(env('SSO_URL').'/api/auth/token/',[
                'email' => $request->r_email,
                'password' => $request->r_password,
            ]);
            if($sso->successful())
            {
                $access_token=$sso['access'];
                $explode=explode(".",$access_token);
                $time= base64_decode($explode[1]);
                $decode_time=json_decode($time);
                $get_time=$decode_time->exp;
                $get_time=strtotime(date('d.m.Y H:i:s')) + strtotime(date('d.m.Y H:i:s'));
                $current=strtotime(date('d.m.Y H:i:s'));
                $totalSecondsDiff = abs($get_time-$current);
                $totalMinutesDiff = $totalSecondsDiff/60;

                if(Cookie::has('sso_token')){
                    Cookie::queue(Cookie::forget('sso_token'));
                }
                Cookie::queue(Cookie::make('sso_token', $access_token, $totalMinutesDiff));

                if($request->session()->has('sso_password')){
                    $request->session()->forget('sso_password');
                }
                $request->session()->put('sso_password', $request->r_password);


            }
            else{
                return response()->json(['error' => 'No active account found with the given credentials or maybe you have provided wrong email or password.'],401);
            }

            $credentials = [
                'email' => $request->r_email,
                'password' => $request->r_password,
            ];
            if(!Auth::attempt($credentials))
            {
                return  response()->json(['error' =>  "Wrong email or password"],401);
            }

            return response()->json(['access_token' =>  $access_token],200);
        }


    }

}
