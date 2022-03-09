@extends('layouts.admin')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">PI-PO</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    
                    @include('include.admin._message')
                        <div class="row">
                            <div class="offset-6 col-6">
                                <button onclick="printDiv('purchase_order_wrap');" id="printPageButtonTrigger" class="btn_green printPageButton">Print</button>
                            </div>
                        </div>
                        <div class="main_content_wrapper invoice_container_wrap purchase_order_wrap" id="purchase_order_wrap">
        
                            <div class="card">
                                

                                <div class="invoice_page_header">
                                    <legend>
                                        <i class="fa fa-table fa-fw "></i> Pro-Forma Invoice
                                    </legend>
                                </div>

                                <!-- widget grid -->
                                <section id="widget-grid" class="pro_porma_invoice">
                                    <!-- NEW WIDGET START -->
                                    <article class="">
                                        <div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">
                                            <!-- widget content -->
                                            <div class="widget-body p-0">
                                                <div class="row buyerdata_info_top">
                                                    <div class="col m6 input-field" id="buyerdata">
                                                        <span><b>{{$po->buyer->name}} </b></span><br/>
                                                        <span>{{$po->buyer->email}}</span>
                                                    </div>
                                                    <div class="col m6 input-field">
                                                        <div class="form-group has-feedback">
                                                            <label style="margin-bottom: 0;"><b>Beneficiary</b></label>
                                                            <span style="display: block">{{ $po->businessProfile->business_name }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="input-field has_feedback_wrap">
                                                    <div class="row">
                                                        <div class="col s6 m4 l2">
                                                            <div class="form-group input-field has-feedback">
                                                                <label>Pro-forma ID</label>
                                                                <p><span>{{ $po->proforma_id }}</span></p>
                                                            </div>
                                                        </div>
                                                        <div class="col s6 m4 l2">
                                                            <div class="form-group input-field has-feedback">
                                                                <label>Pro-forma Date</label>
                                                                <span>{{ $po->proforma_date }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col s6 m4 l2">
                                                            <div class="form-group input-field has-feedback">
                                                                <label>Payment Within</label>
                                                                <span>{{ $po->payment_within  }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col s6 m4 l2">
                                                            <div class="form-group input-field has-feedback">
                                                                <label>Payment term</label>
                                                                <span>{{ $po->paymentTerm->name  }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col s6 m4 l2">
                                                            <div class="form-group input-field has-feedback">
                                                                <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                                                <label>Shipment Term</label>
                                                                <span>{{$po->shipmentTerm->name}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col s6 m4 l2">
                                                            <div class="form-group input-field has-feedback">
                                                                <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                                                <label>Shipping Address</label>
                                                                <span> {{$po->shipping_address}} </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="line_item_wrap buyer_shipping_details">
                                                    <legend>Shipping Details</legend>
                                                    <div class="shipping_details input-field row">
                                                        <div class="form-group has-feedback col s12">
                                                            <label><b>Forwarder name </b></label>
                                                            <span> {{ $po->forwarder_name }} </span>
                                                        </div>
                                                        <div class="form-group has-feedback col s12">
                                                            <label><b>Forwarder Address </b></label>
                                                            <span> {{ $po->forwarder_address }} </span>
                                                        </div>
                                                        <div class="form-group  has-feedback col s12">
                                                            <label><b>Payable party </b></label>
                                                            <span> {{ $po->payable_party}} </span>
                                                        </div>
                                                    </div>
                                                    <div class="shipping_details_table no_more_tables">
                                                        <table class="table" style="border-bottom:1px solid #ccc; margin-bottom:15px;">
                                                            <thead class="cf">
                                                                <tr>
                                                                    <th>Shipping Method</th>
                                                                    <th>Shipment Type</th>
                                                                    <th>UOM</th>
                                                                    <th>Per UOM Price ($)</th>
                                                                    <th >QTY</th>
                                                                    <!-- <th style="width:15%;">Tax</th> -->
                                                                    <th>Total ($)</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="shipping-details-table-body" class="input-field">
                                                            @foreach($po->proFormaShippingDetails as $shippingDetails)
                                                                <tr>
                                                                    <td data-title="Shipping Method">
                                                                        <span>{{ $shippingDetails->shippingMethod->name }}</span>
                                                                    </td>
                                                                    <td  data-title="Shipment Type">
                                                                        <span>{{ $shippingDetails->shipmentType->name }}</span>
                                                                    </td>
                                                                    <td data-title="UOM">
                                                                        <span>{{ $shippingDetails->uom->name }} </span>
                                                                    </td>
                                                                    <td data-title="Per UOM Price ($)">
                                                                        <span>{{ $shippingDetails->shipping_details_uom }}</span>
                                                                    </td>
                                                                    <td data-title="QTY"> 
                                                                        <span>{{ $shippingDetails->shipping_details_qty }}</span>
                                                                    </td>
                                                                    <td data-title="Total ($)">
                                                                        <span>{{ $shippingDetails->shipping_details_total }}</span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                
                                                <div class="line_item_wrap">
                                                    <legend>Line Items</legend>
                                                    <div class="col s12">
                                                        <div class="no_more_tables">
                                                            <table class="table" style="border-bottom:1px solid #ccc; margin-bottom:15px;">
                                                                <thead class="cf">
                                                                    <tr>
                                                                        <th>Sl. No.</th>
                                                                        <th>Item / Description</th>
                                                                        <th>Quantity</th>
                                                                        <th>Unit Price</th>
                                                                        <th>Sub Total</th>
                                                                        <!-- <th style="width:15%;">Tax</th> -->
                                                                        <th>Total Price</th>
                                                                        <!-- <th style="width:5%; text-align:center;"></th> -->
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="lineitems" class="input-field">
                                                                @foreach($po->performa_items as  $key => $proFormaItem)
                                                                    <tr>
                                                                        <td data-title="Sl. No.">{{$key+1 }}</td>
                                                                        <td data-title="Item / Description">
                                                                            <span>{{ $proFormaItem->item_title }}</span>
                                                                        </td>
                                                                        <td data-title="Quantity">
                                                                            <span>{{ $proFormaItem->unit }}</span>
                                                                        </td>
                                                                        <td data-title="Unit Price">
                                                                            <span>{{ $proFormaItem->unit_price }}</span>
                                                                        </td>
                                                                        <td data-title="Sub Total">
                                                                            <span>{{ $proFormaItem->total_price }}</span>
                                                                        </td>
                                                                        <td data-title="Total Price">
                                                                            <span>{{ $proFormaItem->tax_total_price }}</span>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                                <tr>
                                                                    <td colspan="5" class="right-align grand_total_title" style="padding-right: 20px"><b>Total Invoice Amount: </b></td>
                                                                    <td data-title="Total Invoice Amount:" colspan="2" id="total_price_amount"><b>{{$totalInvoice}}<b></td>
                                                                </tr>
                                                                @foreach($po->checkedMerchantAssistances as $assistance)
                                                                <tr>
                                                                    <td colspan="5" class="right-align grand_total_title" style="padding-right: 20px"><b>{{$assistance->merchantAssistance->name}}: </b></td>
                                                                    <td data-title="Total Invoice Amount:" colspan="2" id="total_price_amount">{{ $assistance->merchantAssistance->amount }}<b> {{ $assistance->merchantAssistance->type=='Percentage' ? '%' :'USD'}} <b></td>
                                                                </tr>
                                                                @endforeach
                                                                @if($po->total_invoice_amount_with_merchant_assistant)
                                                                <tr>
                                                                    <td colspan="5" class="right-align grand_total_title" style="padding-right: 20px"><b>Your total order amount with merchant assistant : </b></td>
                                                                    <td data-title="Total Invoice Amount:" colspan="2" id="total_price_amount">{{$po->total_invoice_amount_with_merchant_assistant}} <b> USD <b></td>
                                                                </tr>
                                                                @endif
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="invoice_terms_conditions invoice_buyer_conditions">
                                                    <legend>Terms & Conditions</legend>
                                                    <div class="terms_conditions_list" >
                                                        <ul class="list-group terms-lists">
                                                            @foreach($po->supplierCheckedProFormaTermAndConditions as $supplierCheckedProFormaTermAndCondition)
                                                            <li class="list-group-item">
                                                                <div class="input-group input-field">
                                                                    <label class="terms-label">
                                                                        <i class="material-icons"> check </i> <span>{{$supplierCheckedProFormaTermAndCondition->proFormaTermAndCondition->term_and_condition}}</span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                        <ul class="list-group terms-lists">
                                                            @foreach(json_decode($po->condition) as $key=>$condition)
                                                            <li class="list-group-item">
                                                                <div class="input-group input-field">
                                                                    <label class="terms-label">
                                                                        <i class="material-icons"> check </i> <span>{{$condition}}</span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            @endforeach
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                                
                                                <div class="invoice_advising_bank">
                                                    <legend>Advising Bank</legend>
                                                    <div class="row input-field">
                                                        <div class="col s6 m4 l3">
                                                            <div class="form-group has-feedback">
                                                                <label>Name of the bank</label> <br>
                                                                <span> {{$po->proFormaAdvisingBank->bank_name}} </span>
                                                            </div>
                                                        </div>
                                                        <div class="col s6 m4 l3">
                                                            <div class="form-group has-feedback">
                                                                <label>Branch name</label><br>
                                                                <span>{{ $po->proFormaAdvisingBank->branch_name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col s6 m4 l3">
                                                            <div class="form-group has-feedback">
                                                                <label>Address of the bank </label><br>
                                                                <span> {{ $po->proFormaAdvisingBank->bank_address }} </span>
                                                            </div>
                                                        </div>
                                                        <div class="col s6 m4 l3">
                                                            <div class="form-group has-feedback">
                                                                <label>Swift code</label><br>
                                                                <span>{{ $po->proFormaAdvisingBank->swift_code }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="line_item_wrap buyer_signature">
                                                    <legend>Signature</legend>
                                                    <div class="row">
                                                        <div class="col s6 input-field">
                                                            <h6>Buyer Side</h6>
                                                            <div class="form-group has-feedback">
                                                                <span> {{ $po->proFormaSignature->buyer_singature_name }} </span>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <span>{{$po->proFormaSignature->buyer_singature_designation}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col s6 input-field">
                                                            <h6>Beneficiary Side</h6>
                                                            <div class="form-group has-feedback">
                                                                <span> {{$po->proFormaSignature->beneficiar_singature_name}} </span>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <span> {{ $po->proFormaSignature->beneficiar_singature_designation }} </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                            </div>
                                            <!-- end widget content -->

                                        </div>
                                        <!-- end widget -->

                                        <div class="shipping-files shipping_attachment_wrap">
                                            <legend><i class="material-icons">attach_file</i> Attachment</legend>
                                            <ul>
                                                @foreach($po->proFormaShippingFiles as $image)
                                                    <li><i class="material-icons"> insert_drive_file </i>{{ asset('storage/'.$image->shipping_details_files) }}</li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </article>
                                    <!-- WIDGET END -->
                                    
                                </section>
                                <!-- end widget grid -->

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
@push('js')
<script>
function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
</script>
@end


