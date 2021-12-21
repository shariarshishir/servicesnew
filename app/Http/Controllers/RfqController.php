<?php

namespace App\Http\Controllers;

use App\Models\Rfq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\RfqImage;
use App\Events\NewRfqHasAddedEvent;
use App\Models\BusinessProfile;
use Illuminate\Pagination\Paginator;

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

        // $allSelectedUsersToSendMail = BusinessProfile::with('user')->get();
        // event(new NewRfqHasAddedEvent($allSelectedUsersToSendMail));
        // foreach($allSelectedUsersToSendMail as $selectedUserToSendMail) {
        //     event(new NewRfqHasAddedEvent($selectedUserToSendMail));
        // }

        // $selectedUserToSendMail="success@merchantbay.com";
        // event(new NewRfqHasAddedEvent($selectedUserToSendMail));
        $msg = "Congratulations! Your RFQ was posted successfully. Soon you will receive quotation from Merchant Bay verified relevant suppliers.";
        return back()->with(['success'=> $msg]);

    }

    public function myRfq()
    {
        $rfqLists=Rfq::where('created_by', auth()->id())->withCount('bids')->with('images','user')->latest()->paginate(6);
        return view('rfq.my_rfq',compact('rfqLists'));
    }
}
