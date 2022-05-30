<?php

namespace App\Http\Controllers\BusinessProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proforma;

class ProformaOrderController extends Controller
{
    public function profomaPendingOrders($alias){
        $proformas = Proforma::with('performa_items')->where('status',0)->where('buyer_id',auth()->id())->get();
        $status = 0;
        return view('new_business_profile.proforma_orders',compact('proformas','alias','status'));
    }

    public function profomaOngoingOrders($alias){
        $proformas = Proforma::with('performa_items')->where('status',1)->where('buyer_id',auth()->id())->get();
        $status = 1;
        return view('new_business_profile.proforma_orders',compact('proformas','alias','status'));
    }

    public function profomaShippedOrders($alias){
        $proformas = Proforma::with('performa_items')->where('status',2)->where('buyer_id',auth()->id())->get();
        $status = 2;
        return view('new_business_profile.proforma_orders',compact('proformas','alias','status'));
    }
}
