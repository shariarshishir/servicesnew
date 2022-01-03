<?php

namespace App\Http\Controllers;

use App\Models\Rfq;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\RfqImage;
use App\Events\NewRfqHasAddedEvent;
use App\Models\BusinessProfile;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;


class RfqController extends Controller
{
    public function index()
    {
        $rfqList=Rfq::withCount('bids')->with('images','user','businessProfile')->latest()->get();

        foreach($rfqList as $list){
            $bid_user_id=[];
            if($list->bids()->exists()){
                foreach($list->bids as $user){
                    array_push($bid_user_id,$user->supplier_id);
                }
                $list['bid_user_id'] = array_unique($bid_user_id);

            }

        }

        $page = Paginator::resolveCurrentPage() ?: 1;
        $perPage = 6;
        $rfqLists = new \Illuminate\Pagination\LengthAwarePaginator(
            $rfqList->forPage($page, $perPage),
            $rfqList->count(),
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath()],
        );

        return view('rfq.index',compact('rfqLists'));
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
        ]);

        $rfqData = $request->except(['_token','captcha_token','product_images']);
        $rfqData['created_by']=auth()->id();
        $rfqData['status']='approved';

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
        
        if(env('APP_ENV') == 'production')
        {
            $selectedUsersToSendMail = User::get();
            foreach($selectedUsersToSendMail as $selectedUserToSendMail) {
                event(new NewRfqHasAddedEvent($selectedUserToSendMail,$rfq));
            }

            $selectedUserToSendMail="success@merchantbay.com";
            event(new NewRfqHasAddedEvent($selectedUserToSendMail,$rfq));
        }

        $msg = "Congratulations! Your RFQ was posted successfully. Soon you will receive quotation from Merchant Bay verified relevant suppliers.";
        return back()->with(['success'=> $msg]);

    }

    public function myRfq(Request $request)
    {
        if(isset($request->filter)){
            if($request->filter== 'all'){
                $rfqLists=Rfq::where('created_by', auth()->id())->withCount('bids')->with('images','user')->withTrashed()->latest()->paginate(6);
            }
            if($request->filter== 'active'){
                $rfqLists=Rfq::where('created_by', auth()->id())->withCount('bids')->with('images','user')->latest()->paginate(6);
            }
            if($request->filter== 'inactive'){
                $rfqLists=Rfq::where('created_by', auth()->id())->withCount('bids')->with('images','user')->onlyTrashed()->latest()->paginate(6);
            }
        }else{
            $rfqLists=Rfq::where('created_by', auth()->id())->withCount('bids')->with('images','user')->latest()->paginate(6);
        }
        return view('rfq.my_rfq',compact('rfqLists'));
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
        $date=Carbon::parse($rfq->delivery_date)->format('Y-m-d');
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
}
