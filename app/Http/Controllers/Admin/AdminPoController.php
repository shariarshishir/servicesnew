<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
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
use App\Models\ProFormaTermAndCondition;
use App\Models\SupplierCheckedProFormaTermAndCondition;
use Carbon\Carbon;
use App\Events\NewProfromaInvoiceHasCreatedEvent;
use PDF;

class AdminPoController extends Controller
{
    public function  create($buyerId){

        $buyer=User::findOrFail($buyerId);

        $proformaInvoices = new Proforma();
        $paymentTerms = PaymentTerm::get();
        $shipmentTerms = ShipmentTerm::get();
        $shippingMethods = ShippingMethod::latest()->get();
        $shipmentTypes = ShipmentType::latest()->get();
        $uoms = UOM::latest()->get();
        $proFormaTermAndConditions = ProFormaTermAndCondition::latest()->get();

        return view('admin.proforma_invoice.create',compact('buyer','proformaInvoices', 'paymentTerms', 'shipmentTerms', 'shippingMethods', 'shipmentTypes', 'uoms', 'proFormaTermAndConditions'));
    }
    public function index ()
    {
        $proformaInvoices = Proforma::with('performa_items','buyer','businessProfile')->latest()->get();
        return view('admin.proforma_invoice.index',compact('proformaInvoices'));
    }

    public function show($id)
    {
        $users[] = auth()->id();
        $po = Proforma::with('performa_items','checkedMerchantAssistances','proFormaShippingDetails','proFormaAdvisingBank','proFormaShippingFiles','proFormaSignature','paymentTerm','shipmentTerm','businessProfile','supplierCheckedProFormaTermAndConditions')->where('id', $id)->first();
        $totalInvoice = ProformaProduct::where('performa_id',$id)->sum('tax_total_price');
        $supplierInfo = User::where('id', $po->created_by)->first();
        if($po){
            return view('admin.proforma_invoice.show',compact('po','users','supplierInfo','totalInvoice'));
        }

    }



}
