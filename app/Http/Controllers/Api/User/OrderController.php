<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorOrder;
use App\Models\Country;
use App\Models\VendorOrderItem;
use App\Models\UserAddress;
use DB;
use Exception;
use App\Models\Product;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Events\NewOrderHasPlacedEvent;
use stdClass;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    //received order by a store

    public function orderByVendorId($vendorId){
        $orders=VendorOrder::where('vendor_id',$vendorId)->whereNotIn('state', ['pending','cancel'])->get();
        $vendor=Vendor::with('user')->where('id',$vendorId)->first();


        $orderArray=[];

        foreach($orders as $order){
            $newFormatedOrder=new stdClass;
            $newFormatedOrder->id=$order->id;
            $newFormatedOrder->order_number=$order->order_number;
            $newFormatedOrder->vendor_id=$order->vendor_id;
            $newFormatedOrder->order_by=$order->user->name;
            $newFormatedOrder->email=$order->user->email;
            $newFormatedOrder->grand_total=$order->grand_total;
            $newFormatedOrder->created_at=$order->created_at;
            $newFormatedOrder->state=$order->state;
            $notifications = $vendor->user->unreadNotifications->where('read_at',null)->where('type','App\Notifications\NewOrderHasApprovedNotification');
            foreach($notifications as $notification)
            {
                if($notification->data['notification_data'] == $order->id){
                    $newFormatedOrder->notification_id=$notification->id;
                }else{
                    $newFormatedOrder->notification_id=NULL;
                }
            }
            array_push($orderArray,$newFormatedOrder);
           
        }


        if(count($orders)>0){
            return response()->json(array('success' => true, 'orders' => $orderArray),200);
        }
        else{
            return response()->json(array('success' => true,'orders' => $orderArray, 'message' => 'No orders found'),200);
        }

    }

    //orders placed by auth user 
    public function orderByAuthenticatedUser(){
        $orders=VendorOrder::where('user_id',auth()->user()->id)->get();

        $orderArray=[];

        foreach($orders as $order){
            $newFormatedOrder=new stdClass;
            $newFormatedOrder->id=$order->id;
            $newFormatedOrder->order_number=$order->order_number;
            $newFormatedOrder->vendor_id=$order->vendor_id;
            $newFormatedOrder->order_by=$order->user->name;
            $newFormatedOrder->email=$order->user->email;
            $newFormatedOrder->grand_total=$order->grand_total;
            $newFormatedOrder->created_at=$order->created_at;
            $newFormatedOrder->state=$order->state;
            array_push($orderArray,$newFormatedOrder);
        }

        if(count($orders)>0){
            return response()->json(array('success' => true, 'orders' => $orderArray),200);

        }
        else{
            return response()->json(array('success' => true,'orders' => $orderArray, 'message' => 'No orders found'),200);

        }

    }

    public function vendorOrderByOrderId($vendorId,$orderId){
        $order=VendorOrder::where('vendor_id',$vendorId)->where('id',$orderId)->first();
        if(count($order)>0){
            return response()->json(array('success' => true, 'orders' => $order),200);
        }
        else{
            return response()->json(array('success' => true, 'message' => 'No order found'),200);

        }
    }


    public function orderCreate(Request $request)
    {

    
        $response = Http::withToken($request->sso_token)->get(env('SSO_URL').'/api/auth/token/verify');
       
        if(!$response->successful()){
            return response()->json([
                'success' => 'SSO session is over!',
                'code'=>false,
                'sso_verified'=>false
            ]);
        }
        

        DB::beginTransaction();

        if(isset($request->billing_address_id)){
            $billing_address_id=$request->billing_address_id;
        }
        else{
            $request->validate([
               'billing_name'=>'required',
               'billing_company_name'=>'required',
               'billing_email'=>'required|email',
               'billing_phone'=>'required',
               'billing_address'=>'required',
               'billing_zip'=>'required',
               'billing_city'=>'required',
               'b_country'=>'required',
            ]);
            $address_id=UserAddress::create([
                'user_id' =>auth()->id(),
                'address_type' => 1,
                'name'    => $request->billing_name,
                'company_name'    => $request->billing_company_name,
                'email'   => $request->billing_email,
                'phone'   => $request->billing_phone,
                'address' => $request->billing_address,
                'zip'     => $request->billing_zip,
                'city'    => $request->billing_city,
                'country' => $request->b_country,

            ]);
            $billing_address_id=$address_id->id;
        }
        if(isset($request->shipping_address_id)){
            $shipping_address_id=$request->shipping_address_id;
        }
        else{

            $request->validate([
                'shipping_name'=>'required',
                'shipping_company_name'=>'required',
                'shipping_email'=>'required|email',
                'shipping_phone'=>'required',
                'shipping_address'=>'required',
                'shipping_zip'=>'required',
                'shipping_city'=>'required',
                's_country'=>'required',
             ]);
            $address_id=UserAddress::create([
                'user_id' =>auth()->id(),
                'address_type' => 2,
                'name'    => $request->shipping_name,
                'company_name'   => $request->shipping_company_name,
                'email'   => $request->shipping_email,
                'phone'   => $request->shipping_phone,
                'address' => $request->shipping_address,
                'zip'     => $request->shipping_zip,
                'city'    => $request->shipping_city,
                'country' => $request->s_country,

            ]);
            $shipping_address_id=$address_id->id;
        }

        try {


            $vendorIds=[];
            foreach($request->cart_items as $item){
                array_push($vendorIds,$item['vendor_id']);
            }
            $unique_vendorIds=array_unique($vendorIds);




            foreach($unique_vendorIds as $vendorId){
                $sum_price=0;
                foreach($request->cart_items  as $item){
                    if($item['vendor_id'] == $vendorId)
                    {
                        $sum_price=$item['unit_price']*$item['quantity']+$sum_price;
                    }
                }


                $orderNumber = IdGenerator::generate(['table' => 'vendor_orders', 'field' => 'order_number','reset_on_prefix_change' =>true,'length' => 12, 'prefix' => date('ymd')]);
                $order=VendorOrder::create([
                        'user_id'         => auth()->user()->id,
                        'vendor_id'       => $item['vendor_id'],
                        'order_number'    => $orderNumber,
                        'grand_total'     => $sum_price,
                        'shipping_id'     => $shipping_address_id,
                        'billing_id'      => $billing_address_id,
                        'payment_id'      => $request['payment_id']?? 1,
                        'payment_name'    => $request['payment_name']?? '10% with merchant assistance',
                        'state'           => 'pending',
                        'ip_address'      => $request->ip(),
                        'user_agent'      => $request->header('User-Agent'),
                    ]);



                foreach($request->cart_items  as $item){
                    if($item['vendor_id'] == $vendorId)
                    {
                        $orderItem=VendorOrderItem::create([
                            'order_id'      => $order->id,
                            'product_sku'   => $item['sku'],
                            'quantity'      => $item['quantity'],
                            'unit_price'    => $item['unit_price'],
                            'copyright_price' => $item['copyright_price'] ?? null,
                            'price'         => $item['quantity']*$item['unit_price'],
                            'color_attr'  => json_encode($item['color_attr']),
                            'order_modification_req_id' => $item['order_modification_req_id'] ?? null,
                        ]);
                    }
                }

            }


               
            CartItem::where('user_id',auth()->user()->id)->delete();


            DB::commit();
            return response()->json(["message"=>"Order created successfully","order"=>$order,"code"=>true],200);
        }catch(Exception $e){
            DB::rollback();
            return response()->json(["message"=>$e->getMessage(),"order"=>$order,"code"=>false],200);
        }


    }


    public function countries(){
        $countries=Country::all();
         return response()->json(array('success' => true, 'countries' =>$countries),200);

    }


    public function orderDetails($id){
        $order=VendorOrder::with('orderItems','shippingCharge')->where('id',$id)->first();
        $orderItemArray=[];
        foreach($order->orderItems as $item){
            $newFormatedItem=new stdClass;
            $newFormatedItem->id=$item->id;
            $newFormatedItem->product_sku=$item->product_sku;
            $newFormatedItem->product_name=$item->product->name;
            $newFormatedItem->quantity=$item->quantity;
            $newFormatedItem->unit_price=$item->unit_price;
            $newFormatedItem->colors_sizes=json_decode($item->colors_sizes);
            $newFormatedItem->copyright_price=$item->copyright_price;
            array_push($orderItemArray,$newFormatedItem);
        }
        if(isset($order->shippingCharge) &&  $order->shippingCharge->status==2 ){
            $newFormatedShippingCharge=new stdClass;
            $newFormatedShippingCharge->id=$order->shippingCharge->id;
            $newFormatedShippingCharge->order_id=$order->shippingCharge->order_id;
            $newFormatedShippingCharge->forwarder_name=$order->shippingCharge->forwarder_name;
            $newFormatedShippingCharge->forwarder_address=$order->shippingCharge->forwarder_address;
            $newFormatedShippingCharge->details=json_decode($order->shippingCharge->details);
            $newFormatedShippingCharge->grand_total=$order->shippingCharge->grand_total;
            $newFormatedShippingCharge->file=$order->shippingCharge->file;
        }
        else{
            $newFormatedShippingCharge=new stdClass;
        }
      
        if($order){
            return response()->json(array('code' => true, 'order' =>$order,'orderItems'=>$orderItemArray,'billingAddress'=>$order->billingAddress,'shippingAddress'=>$order->shippingAddress,'shippingCharge'=>$newFormatedShippingCharge),200);
        }
        else{
            return response()->json(array('code' => false, 'order' =>$order),200);
        }

    }

}
