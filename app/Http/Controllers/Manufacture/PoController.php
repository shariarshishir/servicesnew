<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Manufacture\Product;
use App\Models\Proforma;
use App\Models\PaymentTerm;
use App\Models\ShipmentTerm;
use App\Models\ShippingMethod;
use App\Models\ProFormaShippingDetails;
use App\Models\ProFormaShippingFile;
use App\Models\ProFormaAdvisingBank;
use App\Models\ProFormaSignature;
use App\Models\ShipmentType;
use App\Models\UOM;
use App\Models\ProformaProduct;
use Carbon\Carbon;

use PDF;


class PoController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $giving =  Proforma::with('performa_items')->whereHas('performa_items', function($q){
                    $q->where('supplier_id', Auth::id());
                })
                //->where('status', 1)
                ->orderBy('id', 'desc')
                ->paginate(10);
        foreach($giving as $g){
            $g['proforma_type'] = 'giving';
        }
        $received=Proforma::with('performa_items')->where('buyer_id', auth()->id())->latest()->paginate(10);
        foreach($received as $r){
            $r['proforma_type'] = 'received';
        }

        $proforma=$giving->merge($received);

        return view('my_order.inquiries.index',compact('proforma'));

        if($user->is_group == 1)
        {
            $allusers = User::with('profile','badges','tour_photos')->where(['group_id' => Auth::id(), 'is_active' => 1])->get();
            $users = [];
            foreach($allusers as $u)
            {
                $users[] = $u->id;
            }
            //echo '<pre>';print_r($users);exit;
            if(count($users) > 0)
            {
                $pos =  Proforma::with('performa_items')->whereHas('performa_items', function($q) use ($users){
                    $q->whereIn('supplier_id', $users);
                })
                //->where('status', 1)
                ->orderBy('id', 'desc')
                ->paginate(10);
           }
           else
           {
                $pos = [];
           }
        }
        return view('rfq.supplierproforma',compact('pos'));
    }
    public function add()
	{

		$user=Auth::user();
        $business_profile = BusinessProfile::where('user_id', $user->id)->where('business_type',1)->get('id');
        $business_profile_id=[];
        foreach($business_profile as $profile){
            array_push($business_profile_id, $profile->id);
        }

        $allbuyers = User::where([['user_type','buyer'],['is_email_verified',1]])->with('businessProfile')->get();
		$allproducts = Product::whereIn('business_profile_id', $business_profile_id)->with('user')->latest()->get(['id','title']);
		$buyers = [];
		$products = [];
		foreach($allbuyers as $buy)
		{
			$buyers[] = [
							'name' => $buy->name,
							'id' => $buy->id,
							'street' => 'street',
							'city' => 'city',
							'state' => 'state',
							'country' => 'country',
							'zipcode' => 'zip_code'
						];
		}
		
        $products = $allproducts;
        $paymentTerms = PaymentTerm::latest()->get();
        $shipmentTerms = ShipmentTerm::latest()->get();
        $shippingMethods = ShippingMethod::latest()->get();
        $shipmentTypes = ShipmentType::latest()->get();
        $uoms = UOM::latest()->get();
        $businessProfileList = BusinessProfile::select('id','business_name')->where('user_id', $user->id)->where('business_type',1)->get();

		return view('po.add',compact('buyers','products','paymentTerms','shipmentTerms','shippingMethods','shipmentTypes','uoms','businessProfileList'));
	}

    public function getsupplierbycat($id)
	{
		$products = Product::where('id',$id)->get();
		return view('po.allsuppliers',compact('products'));
	}

    public function getProductListByBuisnessProfileId(Request $request){
        $products = Product::select('id','title')->where('business_profile_id', $request->id)->latest()->get();
        return response()->json([
            'success' => true,
            'products' => $products
        ],200);
    }

    public function store(Request $request)
	{ 
        //DB::beginTransaction();

        // try {
            $data = new Proforma;
            $data->buyer_id = $request->input('selected_buyer_id');
            $data->business_profile_id = $request->input('business_profile_id');
            $data->proforma_id = $request->input('po_id');
            $data->proforma_date = $request->input('po_date');
            $data->payment_within = $request->input('payment_within');
            $data->payment_term_id= $request->input('payment_term');
            $data->shipment_term_id = $request->input('shipment_term');
            $data->shipping_address = $request->input('shipping_address');
            $data->forwarder_name = $request->input('forwarder_name');
            $data->forwarder_address = $request->input('forwarder_address');
            $data->payable_party = $request->input('payable_party');
            
            $data->po_no = '';
            $data->condition = json_encode($request->input('terms_conditions'));
            $data->status = 0;
            $data->created_by= auth()->id();
            $data->save();
            $performa_id = $data->id;

            foreach($request->input('supplier') as $i => $sup)
            {
                $dataitem = new ProformaProduct;
                $dataitem->performa_id = $performa_id;
                $dataitem->supplier_id = $request->input('supplier')[$i];
                $dataitem->product_id = $request->input('product')[$i];
                $dataitem->unit = $request->input('unit')[$i];
                $dataitem->unit_price = $request->input('unit_price')[$i];
                $dataitem->tax = $request->input('tax')[$i];
                $dataitem->total_price = $request->input('total_price')[$i];
                $dataitem->tax_total_price = $request->input('tax_total_price')[$i];
                $dataitem->price_unit = $request->input('price_unit')[$i];
                $dataitem->save();
                
            }

            foreach($request->input('shipping_details_method') as $i => $sup)
            {
                $proFormaShippingDetails = new ProFormaShippingDetails;
                $proFormaShippingDetails->proforma_id = $data->id;
                $proFormaShippingDetails->shipping_details_method = $request->input('shipping_details_method')[$i];
                $proFormaShippingDetails->shipping_details_type = $request->input('shipping_details_type')[$i];
                $proFormaShippingDetails->shipping_details_uom = $request->input('shipping_details_uom')[$i];
                $proFormaShippingDetails->shipping_details_per_uom_price = $request->input('shipping_details_per_uom_price')[$i];
                $proFormaShippingDetails->shipping_details_qty = $request->input('shipping_details_qty')[$i];
                $proFormaShippingDetails->shipping_details_total = $request->input('shipping_details_total')[$i];
                $proFormaShippingDetails->save();
            }

            if($request->hasFile('shipping_details_files')){

                foreach( $request->file('shipping_details_files')  as $key => $file)
                {
                    $proFormaShippingFile = new ProFormaShippingFile;
                    $proFormaShippingFile->proforma_id = $data->id;
                    $proFormaShippingFile->shipping_details_file_names = $request->shipping_details_file_names[$key];
                    $extension = $file->getClientOriginalExtension();
                        if($extension=='pdf' ||$extension=='PDF' ||$extension=='doc'||$extension=='docx'|| $extension=='xlsx' || $extension=='ZIP'||$extension=='zip'|| $extension=='TAR' ||$extension=='tar'||$extension=='rar' ||$extension=='RAR'  ){

                            $path = $file->store('images','public');
                        }
                        else{
                            $path = $file->store('images','public');
                        }
                    $proFormaShippingFile->shipping_details_files = $path;
                    $proFormaShippingFile->save();

                }

            }
            

            
            $proFormaSignature = new ProFormaSignature;
            $proFormaSignature->proforma_id = $data->id;
            $proFormaSignature->buyer_singature_name = $request->input('buyer_singature_name');
            $proFormaSignature->buyer_singature_designation = $request->input('buyer_singature_designation');
            $proFormaSignature->beneficiar_singature_name = $request->input('beneficiar_singature_name');
            $proFormaSignature->beneficiar_singature_designation = $request->input('beneficiar_singature_designation');
            $proFormaSignature->save();

            $proFormaAdvisingBank = new ProFormaAdvisingBank;
            $proFormaAdvisingBank->proforma_id = $data->id;
            $proFormaAdvisingBank->bank_name = $request->input('bank_name');
            $proFormaAdvisingBank->branch_name = $request->input('branch_name');
            $proFormaAdvisingBank->bank_address = $request->input('bank_address');
            $proFormaAdvisingBank->swift_code = $request->input('swift_code');
            $proFormaAdvisingBank->save();
            

        // } catch (\Exception $e) {
        //     DB::rollback();
        // }

        \Session::flash('success','Po Created Successfully');
        return redirect()->route('po.index');
        //return back()->withSuccess('Created Successfully');

        $user = User::find($request->input('selected_buyer_id'));

        if ($user && in_array(\auth()->user()->user_type, ['supplier', 'both']))
        {

            $notification_data=[
                'title'=>'You have received a PO',
                'url'=>'/pro-forma-invoices'
            ];
            // Notification::send($user, new BuyerWantToContact($notification_data));
            /*
            return response()->json([
                'success' => $request
            ]);
            */
            return redirect()->to('/supplier-po');

        } else {
            abort(404);
        }

		//return redirect()->route('po.all');
		//return redirect()->to('/pro-forma-invoices');

	}

    public function openProformaSingleHtml($id)
    {
        $users[] = auth()->id();
        $po = Proforma::with('performa_items','proFormaShippingDetails','proFormaAdvisingBank','proFormaShippingFiles','proFormaSignature','paymentTerm','shipmentTerm','businessProfile')->where('id', $id)->first();
        $totalInvoice = ProformaProduct::where('performa_id',$id)->sum('tax_total_price');
        $supplierInfo = User::where('id', $po->created_by)->first();
        return view('my_order.inquiries._open_proforma_single_html',compact('po','users','supplierInfo','totalInvoice'));
    }

    public function acceptProformaInvoice(Request $request)
    {
        //Performa::where('id', $request->input('proforma_id'))->update(['po_no' => $request->input('po_id'), 'status' => 1]);

        Proforma::where(['proforma_id' => $request->proforma_id, 'id' => $request->po_id ])->update(['po_no' => $request->po_id, 'status' => 1]);

        //session()->flash('success_message', 'Pro-Forma Invoice accepted successfully.');
        //return redirect()->action('RFQController@proformainvoices');
        //$test = $request->proforma_id;
        /*
        $user = User::where('user_type', 'supplier')
            ->orWhere('user_type', 'both')
            ->where('id', $request->supplier_id)
            ->first();
        */
       /* $user = User::find($request->supplier_id);

        if ($user && in_array(\auth()->user()->user_type, ['buyer', 'both']))
        {

            $notification_data=[
                'title'=>'Your PO have been approved.',
                'url'=>'/supplier-po'
            ];
            Notification::send($user, new BuyerWantToContact($notification_data));

        } else {
            abort(404);
        }*/
        return response()->json([
            'success' => $request
        ]);
    }

    public function rejectProformaInvoice(Request $request)
    {
         Proforma::where(['proforma_id' => $request->proforma_id, 'id' => $request->po_id ])->update(['po_no' => $request->po_id, 'reject_message' => $request->reject_message, 'status' => -1]);

         //session()->flash('success_message', 'Pro-Forma Invoice accepted successfully.');
         //return redirect()->action('RFQController@proformainvoices');
         //$test = $request->proforma_id;
         /*
         $user = User::where('user_type', 'supplier')
             ->orWhere('user_type', 'both')
             ->where('id', $request->supplier_id)
             ->first();
         */
        //  $user = User::find($request->supplier_id);

        //  if ($user && in_array(\auth()->user()->user_type, ['buyer', 'both']))
        //  {

        //      $notification_data=[
        //          'title'=>'Your PO have been rejected.',
        //          'url'=>'/supplier-po'
        //      ];
        //      Notification::send($user, new BuyerWantToContact($notification_data));

        //  } else {
        //      abort(404);
        //  }

         return response()->json([
             'success' => $request
         ]);
    }

    public function proformaInvoices()
    {
        $user = Auth::user();
        //print_r($user->user_type);
        if($user->user_type == 'buyer')
        {
            //$pos = Performa::where('buyer_id', Auth::id())->with('performa_items')->paginate(20);

            $pos = Performa::where('buyer_id', Auth::id())
            ->with('performa_items')
            ->orderBy('id', 'desc')
            ->paginate(10);
        }
        elseif ($user->user_type == 'supplier')
        {
            $pos =  Performa::with('performa_items')->whereHas('performa_items', function($q){
                        $q->where('supplier_id', Auth::id());
                    })
                    //->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            if($user->is_group == 1)
            {
                $allusers = User::with('profile','badges','tour_photos')->where(['group_id' => Auth::id(), 'is_active' => 1])->get();
                $users = [];
                foreach($allusers as $u)
                {
                    $users[] = $u->id;
                }
                //echo '<pre>';print_r($users);exit;
                if(count($users) > 0)
                {
                    $pos =  Performa::with('performa_items')->whereHas('performa_items', function($q) use ($users){
                        $q->whereIn('supplier_id', $users);
                    })
                    //->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->paginate(10);
               }
               else
               {
                    $pos = [];
               }
            }
        }

        return view('rfq.proforma',compact('pos'));
    }

    public function openProformaSingle($id)
    {
        $users[] = Auth::user()->id;;
        $po = Proforma::where('id', $id)->with('performa_items')->get()[0];
        $pdf = PDF::loadView('my_order.inquiries._open_proforma_single_pdf',compact('po','users'));
        return $pdf->stream();
    }

    public function edit(Request $request)
    {
        // $user=Auth::user();

		// $allbuyers = User::where([['user_type','buyer'],['is_verified',1]])->with('profile.membership')->get();
		// $allproducts = Product::where([['created_by', $user->id]])->with('user')->get();
		// $selectedproduct = Performa::where('id', $request->poid)->with('performa_items')->get();
		// //$selectedproduct2 = Performa::where('id', $poid)->with('performa_items')->get()[0];
		// //echo "<pre>"; print_r($allbuyers); exit();
		// $buyers = [];
		// $products = [];
		// foreach($allbuyers as $buy)
		// {
		// 	$buyers[] = [
		// 					'name' => $buy->name,
		// 					'id' => $buy->id,
		// 					'street' => @$buy->profile['contact_info']['street'],
		// 					'city' => @$buy->profile['contact_info']['city'],
		// 					'state' => @$buy->profile['contact_info']['state'],
		// 					'country' => @$buy->profile['contact_info']['region'],
		// 					'zipcode' => @$buy->profile['contact_info']['zipCode']
		// 				];
		// }
		// foreach($allproducts as $prod)
		// {
		// 	$products[] = $prod->id .'_'. $prod->title;
		// }
		// //sort($products);

		// return view('po.edit',compact('buyers','products','selectedproduct'));


        $user=Auth::user();
        $business_profile=BusinessProfile::where('user_id', $user->id)->where('business_type',1)->get('id');
        $business_profile_id=[];
        foreach($business_profile as $profile){
            array_push($business_profile_id, $profile->id);
        }
		//$allbuyers = MerchantAssistanceRequest::with('product','buyer')->where('status','request')->groupBy('buyer_id')->get();
		// $allbuyers = User::where([['user_type','buyer'],['is_verified',1]])->with('profile.membership')->get();
        $allbuyers = User::where([['user_type','buyer'],['is_email_verified',1]])->with('businessProfile')->get();
		//$allproducts = Product::with('product_images')->get()->unique('title');
		$allproducts = Product::whereIn('business_profile_id', $business_profile_id)->with('user')->latest()->get(['id','title']);
        $selectedproduct = Proforma::where('id', $request->poid)->with('performa_items')->get();
		$buyers = [];
		$products = [];
		foreach($allbuyers as $buy)
		{
			$buyers[] = [
							'name' => $buy->name,
							'id' => $buy->id,
							'street' => 'street',
							'city' => 'city',
							'state' => 'state',
							'country' => 'country',
							'zipcode' => 'zip_code'
						];
		}
		// foreach($allproducts as $prod)
		// {
		// 	$products['title'] = $prod->title;
        //     $products['id'] = $prod->id;
		// }
		// sort($products);
        foreach($allproducts as $prod)
		{
			$products[] = $prod->id .'_'. $prod->title;
		}

		return view('po.edit',compact('buyers','products','selectedproduct'));
    }
}
