<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorOrder;

class MyOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = VendorOrder::where('user_id',auth()->user()->id)->with(['billingAddress','shippingAddress'])->latest()->get();
        return view('my_order.orders.index',compact('orders'));
    }

}
