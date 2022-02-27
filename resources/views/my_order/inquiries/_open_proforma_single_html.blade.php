@extends('layouts.app')

@section('content')
<div class="main_content_wrapper invoice_container_wrap">
    <div class="card">
        <div class="invoice_page_header">
            <legend class="">
                <i class="fa fa-table fa-fw "></i> Pro-Forma Invoice
            </legend>
        </div>

         <!-- widget grid -->
         <section id="widget-grid" class="pro_porma_invoice">

            <div class="row">
                <div class="col s12 m6 l6"></div>
                <div class="col s12 m6 l6"></div>
            </div>
                <!-- row -->
            <div class="row">
                <!-- NEW WIDGET START -->
                <article class="col-12">
                    <div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

                        <!-- widget content -->
                        <div class="widget-body p-0">
                                <!-- <div style="padding-top: 30px;"></div> -->
                                <div class="row">
                                    <!-- <div class="col s12 m6 l6"> -->
                                    <div class="col s12 input-field">
                                        <div class="col-md-6" id="buyerdata">
                                            <span> <b>Name:</b> {{$po->buyer->name}}</span>
                                            <span> <b>Email:</b>{{$po->buyer->email}}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label>Beneficiary</label>
                                                <span>{{ $po->businessProfile->business_name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 input-field">
                                        <div class="row">
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <label>Pro-forma ID <span class="required_star" style="color: rgb(255, 0, 0)" ></span> </label>
                                                    <span>{{ $po->proforma_id }}</span>
                                                </div>
                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <label>Pro-forma Date <span class="required_star" style="color: rgb(255, 0, 0)" ></span></label>
                                                    <span>{{ $po->proforma_date }}</span>
                                                </div>
                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <label>Payment Within <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <span>{{ $po->payment_within  }}</span>
                                                </div>
                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <label>Payment term <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <span>{{ $po->paymentTerm->name  }}</span>
                                                </div>

                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                                    <label>Shipment Term <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <span>{{$po->shipmentTerm->name}}</span>
                                                </div>

                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                                    <label>Shipping Address <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <span> {{$po->shipping_address}} </span>
                                                </div>
                                            </div>
                                        </div>
                                       
                                       
                                       
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <div class="line_item_wrap">
                                    <legend>Shipping Details</legend>
                                    <div class="col s12 input-field">
                                        <div class="row">
                                            <div class="col s6 m4">
                                                <div class="form-group has-feedback">
                                                    <label>Forwarder name <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <span> {{ $po->forwarder_name }} </span>
                                                </div>
                                            </div>
                                            <div class="col s6 m4">
                                                <div class="form-group has-feedback">
                                                    <label>Forwarder Address <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <span> {{ $po->forwarder_address }} </span>
                                                </div>
                                            </div>
                                            <div class="col s6 m4">
                                                <div class="form-group has-feedback">
                                                    <label>Payable party <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <span> {{ $po->payable_party}} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table" style="border-bottom:1px solid #ccc; margin-bottom:15px;">
                                        <thead>
                                            <tr>
                                                <th style="width:5%;">Shipping Method</th>
                                                <th style="width:15%;">Shipment Type</th>
                                                <th style="width:15%;">UOM</th>
                                                <th style="width:15%;">Per UOM Price ($) <span class="required_star" style="color:red;">*</span></th>
                                                <th style="width:15%;" >QTY <span class="required_star" style="color:red;">*</span></th>
                                                <!-- <th style="width:15%;">Tax</th> -->
                                                <th style="width:15%;">Total ($)</th>
                                                <th style="width:5%; text-align:center;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="shipping-details-table-body" class="input-field">
										@foreach($po->proFormaShippingDetails as $shippingDetails)
                                            <tr>
                                                <td>
                                                    <span>{{ $shippingDetails->shippingMethod->name }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $shippingDetails->shipmentType->name }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $shippingDetails->uom->name }} </span>
                                                </td>
                                                <td>
                                                    <span>{{ $shippingDetails->shipping_details_uom }}</span>
                                                </td>
                                                <td> 
                                                    <span>{{ $shippingDetails->shipping_details_qty }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $shippingDetails->shipping_details_total }}</span>
                                                </td>
                                            </tr>
										@endforeach
                                        </tbody>
                                       
                                    </table>
                                    <div class="shipping-files">
                                        @foreach($po->proFormaShippingFiles as $image)
                                            <div ><a href="" style="display:block"><img src="{{ asset('storage/'.$image->shipping_details_files) }}" class="img-responsive" alt=""></a></div>
                                        @endforeach
                                    </div>
                                </div>
                                


                                <div class="line_item_wrap">
                                    <legend>Line Items</legend>
                                    <table class="table" style="border-bottom:1px solid #ccc; margin-bottom:15px;">
                                        <thead>
                                            <tr>
                                                <th style="width:5%;">Sl. No.</th>
                                                <th style="width:15%;">Item / Description</th>
                                                <th style="width:15%;">Quantity</th>
                                                <th style="width:15%;">Unit Price <span class="required_star" style="color: red;">*</span></th>
                                                <th style="width:15%;">Sub Total <span class="required_star" style="color: red;">*</span></th>
                                                <!-- <th style="width:15%;">Tax</th> -->
                                                <th style="width:15%;">Total Price</th>
                                                <th style="width:5%; text-align:center;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="lineitems" class="input-field">
										@foreach($po->performa_items as  $key => $proFormaItem)
                                            <tr>
                                                <td>{{$key+1 }}</td>
                                                <td>
                                                    <span>{{ $proFormaItem->product->title }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $proFormaItem->unit }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $proFormaItem->unit_price }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $proFormaItem->total_price }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $proFormaItem->tax_total_price }}</span>
                                                </td>
                                            </tr>
										@endforeach
                                        </tbody>
                                        <tfoot>
                                           
                                            <tr>
                                                <td colspan="5"class="right-align"><b>Total Invoice Amount</b></td>
                                                <td colspan="2" align="left" id="total_price_amount">{{$totalInvoice}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="invoice_terms_conditions">
                                    <legend>Terms & Conditions</legend>
                                    <div class="terms_conditions_list">
                                        <ul class="list-group terms-lists">
                                            @foreach(json_decode($po->condition) as $condition)
                                            <li class="list-group-item">
                                                <div class="input-group input-field">
                                                    <label class="terms-label">
                                                        <span>{{$condition}}</span>
                                                    </label>
                                                </div>
                                            </li>
                                            @endforeach
                                            
                                        </ul>
                                    </div>
                                </div>

                                <div class="invoice_terms_conditions">
                                    <div class="col s12 input-field">
                                    <legend>Advising Bank</legend>
                                        <div class="row">
                                            <div class="col s6 m3">
                                                <div class="form-group has-feedback">
                                                    <label>Name of the bank <span> {{$po->proFormaAdvisingBank->bank_name}} </span></label>
                                                </div>
                                            </div>
                                            <div class="col s6 m3">
                                                <div class="form-group has-feedback">
                                                    <label>Branch name <span>{{ $po->proFormaAdvisingBank->branch_name }}</span></label>
                                                </div>
                                            </div>
                                            <div class="col s6 m3">
                                                <div class="form-group has-feedback">
                                                    <label>Address of the bank<span> {{ $po->proFormaAdvisingBank->bank_address }} </span></label>
                                                </div>
                                            </div>
                                            <div class="col s6 m3">
                                                <div class="form-group has-feedback">
                                                    <label>Swift code <span>{{ $po->proFormaAdvisingBank->swift_code }}</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="line_item_wrap">
                                    <div class="col s12 input-field">
                                        <legend>Signature</legend>
                                        <div class="col s6 input-field">
                                            <h6>Buyer</h6>
                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="form-group has-feedback">
                                                        <label>Name <span> {{ $po->proFormaSignature->buyer_singature_name }} </span></label>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="form-group has-feedback">
                                                        <label>Designation <span>{{$po->proFormaSignature->buyer_singature_designation}}</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s6 input-field">
                                            <h6>Beneficiary Side</h6>
                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="form-group has-feedback">
                                                        <label>Name <span> {{$po->proFormaSignature->beneficiar_singature_name}} </span></label>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="form-group has-feedback">
                                                        <label> Designation <span> {{ $po->proFormaSignature->beneficiar_singature_designation }} </span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget -->
                </article>
                <!-- WIDGET END -->
            </div>

            <!-- end row -->

            <!-- end row -->
        </section>
        <!-- end widget grid -->

    </div>






</div>

@endsection



