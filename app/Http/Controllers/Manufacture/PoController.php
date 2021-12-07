<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Manufacture\Product;
use App\Models\Manufacture\Proforma;
use App\Models\Manufacture\ProformaProduct;
use Carbon\Carbon;

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
        $products=$allproducts;
		return view('po.add',compact('buyers','products'));
	}

    public function getsupplierbycat($id)
	{
		$products = Product::where('id',$id)->get();
		//echo '<pre>';print_r($products);exit;
		// $allsuppliers = User::where([['product_category',$id],['is_verified',1]])->with('profile.membership')->get();
		return view('po.allsuppliers',compact('products'));
	}

    public function store(Request $request)
	{

		//echo '<pre>';print_r($request->input());exit;
		$data = new Proforma;
		$data->buyer_id = $request->input('selected_buyer_id');
		$data->proforma_id = $request->input('po_id');
		$data->proforma_date = $request->input('po_date');
		$data->payment_within = $request->input('payment_within');
		$data->po_no = '';
		$data->condition = json_encode($request->input('conditions'));
		$data->status = 0;
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

        return back()->withSuccess('Created Successfully');

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
}
