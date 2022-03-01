@extends('layouts.app')

@section('content')
<div class="main_content_wrapper invoice_container_wrap">
    <div class="card">
        <div class="invoice_page_header">
            <legend class="">
                <i class="fa fa-table fa-fw "></i> Create Pro-Forma Invoice
            </legend>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- <div class="col-md-12">
                <div style="height: 25px; width: 0px; border-left: 5px solid rgb(255, 0, 0); display: inline;"></div>
                <span style="padding-left: 10px; font-size: 12px; color: rgb(255, 0, 0);">Indicates Mandatory field</span>
            </div> -->
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
                    {{-- @include('flash::message') --}}
                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

                        <!-- widget content -->
                        <div class="widget-body p-0">
                            <form action="{{route('po.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <!-- <div style="padding-top: 30px;"></div> -->
                                <div class="row">
                                    <!-- <div class="col s12 m6 l6"> -->
                                    <div class="col s12 input-field">
                                        <div class="col-md-6" id="buyerdata"></div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label>Beneficiary</label>
                                                <select name="business_profile_id" id="buyerOptionsList" class="form-control select2" onChange = "getProductListBybusinessProfileId(this.value)" required>
                                                    <option value="">--Select a Beneficiary--</option>
                                                    @foreach($businessProfileList as $businessProfile)
                                                        <option value="{{$businessProfile->id}}">{{$businessProfile->business_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="selected_buyer_id" value="{{ request()->route()->parameters['id'] }}" />
                                    </div>
                                    <div class="col s12 input-field">
                                        <div class="row">
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <label>Pro-forma ID <span class="required_star" style="color: rgb(255, 0, 0)" >*</span> </label>
                                                    <input type="text" class="form-control" required name="po_id"/>
                                                </div>
                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                                    <label>Pro-forma Date <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <input type="date" class="form-control" required name="po_date"/>
                                                </div>
                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                                    <label>Payment Within <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <select class="select2" required name="payment_within">
                                                        <option value="On Delivery">On Delivery</option>
                                                        <option value="Immediate">Immediate</option>
                                                        <option value="Within 7 Days">Within 7 Days</option>
                                                        <option value="Within 15 Days">Within 15 Days</option>
                                                        <option value="Within 30 Days">Within 30 Days</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                                    <label>Payment term<span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <select class="select2" required name="payment_term">
                                                        @foreach($paymentTerms as $paymentTerm)
                                                            <option value="{{$paymentTerm->id}}">{{$paymentTerm->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                                    <label>Shipment Term <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <select class="select2" required name="shipment_term">
                                                        @foreach($shipmentTerms as $shipmentTerm)
                                                            <option value="{{$shipmentTerm->id}}">{{$shipmentTerm->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                                    <label>Shipping Address <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <input type="text" class="form-control" required name="shipping_address"/>
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
                                                    <label>Forwarder name  </label>
                                                    <input type="text" class="form-control" required name="forwarder_name"/>
                                                </div>
                                            </div>
                                            <div class="col s6 m4">
                                                <div class="form-group has-feedback">
                                                    <label>Forwarder Address</label>
                                                    <input type="text" class="form-control" required name="forwarder_address"/>
                                                </div>
                                            </div>
                                            <div class="col s6 m4">
                                                <div class="form-group has-feedback">
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                                    <label>Payable party </label>
                                                    <select class="select2" required name="payable_party">
                                                        <option value="Buyer">Buyer</option>
                                                        <option value="Buyer">Supplier</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table" style="border-bottom:1px solid #ccc; margin-bottom:15px;">
                                        <thead>
                                            <tr>
                                                <th style="width:5%;">Shipping Method <span class="required_star" style="color: red;">*</span></th>
                                                <th style="width:15%;">Shipment Type <span class="required_star" style="color: red;">*</span></th>
                                                <th style="width:15%;">UOM <span class="required_star" style="color: red;">*</span></th>
                                                <th style="width:15%;">Per UOM Price ($) <span class="required_star" style="color: red;">*</span></th>
                                                <th style="width:15%;" >QTY <span class="required_star" style="color: red;">*</span></th>
                                                <!-- <th style="width:15%;">Tax</th> -->
                                                <th style="width:15%;">Total ($)</th>
                                                <th style="width:5%; text-align:center;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="shipping-details-table-body" class="input-field">
                                            <tr>
                                                <td>
                                                    <select name="shipping_details_method[]" class="select2" >
                                                        <option value="">Select</option>
                                                        @foreach($shippingMethods as $shippingMethod)
                                                            <option value="{{ $shippingMethod->id }}">{{ $shippingMethod->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select  name="shipping_details_type[]" class="select2">
                                                        <option value="">Select</option>
                                                        @foreach($shipmentTypes as $shipmentType)
                                                            <option value="{{ $shipmentType->id }}">{{ $shipmentType->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="shipping_details_uom[]" class="select2">
                                                        <option value="">Select</option>
                                                        @foreach($uoms as $uom)
                                                            <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="shipping_details_per_uom_price[]" class="form-control unit" style="border:1px solid #ccc; margin-bottom:0;"  onkeyup="changeunit(this)" required/>
                                                </td>
                                                <td> 
                                                    <input type="text" name="shipping_details_qty[]" class="form-control unit_price" style="border:1px solid #ccc; margin-bottom:0;"  onkeyup="changeunitprice(this)" required/>
                                                </td>
                                                <td>
                                                    <input type="text"  name="shipping_details_total[]" class="form-control total_price" style="border:1px solid #ccc; margin-bottom:0;"  readonly/>
                                                </td>
                                                <td><a href="javascript:void(0);" class="ic-btn4" onclick="addShippingDetails()"><i aria-hidden="true" class="fa fa-plus fa-lg"></i></a></td>
                                            </tr>
                                        </tbody>
                                       
                                    </table>
                                </div>
                                <a href="#modal1" class="waves-effect waves-light btn modal-trigger btn shipment-file-upload-trigger">Upload Files</a>
                                <!-- Modal Structure -->
                                <div id="modal1" class="modal">
                                    <div class="modal-content">
                                        <div class="shipment-file-upload--block">
                                            <div class="no_more_tables">
                                                <table class="shipment-file-upload-table-block">
                                                    <thead class="cf">
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Image</th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><input class="input-field" name="shipping_details_file_names[]" id="shipping-details-title" type="text"  ></td>
                                                        <td><input class="input-field file_upload" name="shipping_details_files[]" id="shipping-details-file" type="file"></td>
                                                        <td><a href="javascript:void(0);" class="btn_delete" onclick="removeShippingDetailsFile(this)"><i class="material-icons dp48">delete_outline</i><span>Delete</span> </a></td>
                                                    </tr>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                            <div class="add_more_box">
                                                <a href="javascript:void(0);" class="add-more-block" onclick="addShippingDetailsFile()"><i class="material-icons dp48">add</i> Add More</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat">Save</a>
                                    </div>
                                </div>


                                <div class="line_item_wrap">
                                    <legend>Line Items</legend>
                                    <table class="table" style="border-bottom:1px solid #ccc; margin-bottom:15px;">
                                        <thead>
                                            <tr>
                                                <th style="width:5%;">Sl. No.</th>
                                                <th style="width:15%;">Item / Description <span class="required_star" style="color: red;">*</span></th>
                                                <th style="width:15%;">Quantity <span class="required_star" style="color: red;">*</span></th>
                                                <th style="width:15%;">Unit Price <span class="required_star" style="color: red;">*</span></th>
                                                <th style="width:15%;">Sub Total <span class="required_star" style="color: red;">*</span></th>
                                                <!-- <th style="width:15%;">Tax</th> -->
                                                <th style="width:15%;">Total Price </th>
                                                <th style="width:5%; text-align:center;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="lineitems" class="input-field">
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <select class="select2 product-dropdown" onchange="changecat(this)">
                                                        <option value="">Select Products</option>
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="supplier[]" required/>
                                                    <input type="hidden" name="product[]" required/>
                                                    <input type="hidden" name="price_unit[]" required/>
                                                    <span class="supplier_details" style="color: #50AA5B;"></span>
                                                </td>
                                                <td>
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:8px;"></div> -->
                                                    <input type="number" class="form-control unit" style="border:1px solid #ccc; margin-bottom:0;" name="unit[]" onkeyup="changeunit(this)" required/>
                                                </td>
                                                <td>
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:8px;"></div> -->
                                                    <input type="text" class="form-control unit_price" style="border:1px solid #ccc; margin-bottom:0;" name="unit_price[]" onkeyup="changeunitprice(this)" required/>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control total_price" style="border:1px solid #ccc; margin-bottom:0;" name="total_price[]" readonly/>
                                                    <input type="hidden" class="taxprice" name="tax[]" value="0" />
                                                </td>
                                                <td><input type="text" class="form-control tax_total_price" style="border:1px solid #ccc; margin-bottom:0;" name="tax_total_price[]" readonly/></td>
                                                <td><a href="javascript:void(0);" class="ic-btn4" onclick="addlineitem()"><i aria-hidden="true" class="fa fa-plus fa-lg"></i></a></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <!--tr>
                                                <td colspan="6" align="right"><b>Total Tax</b></td>
                                                <td colspan="2" align="left" id="total_tax_price_amount">0.00</td>
                                            </tr-->
                                            <tr>
                                                <td colspan="5"class="right-align"><b>Total Invoice Amount</b></td>
                                                <td colspan="2" align="left" id="total_price_amount">0.00</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="invoice_terms_conditions">
                                    <legend>Terms & Conditions</legend>
                                    <div class="terms_conditions_list">
                                        <ul class="list-group terms-lists">
                                            @foreach($proFormaTermAndConditions as $proFormaTermAndCondition)
                                            <li class="list-group-item">
                                                <div class="input-group input-field">
                                                    <label class="terms-label">
                                                        <input class="checkbox" type="checkbox"  name="fixed_terms_conditions[]" value="{{$proFormaTermAndCondition->id}}" >
                                                        <span>{{ $proFormaTermAndCondition->term_and_condition }}</span>
                                                    </label>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <h6>More terms & conditions</h6>
                                        <ul class="list-group terms-lists more-term-and-condition-unorder-list">
                                            <li class="list-group-item ">
                                                <div class="input-group input-field">
                                                    <input class="form-control" type="text"  name="terms_conditions[]" placeholder="Terms and condition" value="">
                                                    <a href="javascript:void(0);" class="ic-btn4" onclick="addMoreTermAndCondition()"><i aria-hidden="true" class="fa fa-plus fa-lg"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                              

                                <div class="invoice_terms_conditions">
                                    <div class="col s12 input-field">
                                    <legend>Advising Bank</legend>
                                        <div class="row">
                                            <div class="col s6 m3">
                                                <div class="form-group has-feedback">
                                                    <label>Name of the bank <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <input type="text" name="bank_name" class="form-control" required/>
                                                </div>
                                            </div>
                                            <div class="col s6 m3">
                                                <div class="form-group has-feedback">
                                                    <label>Branch name <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <input type="text" name="branch_name" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="col s6 m3">
                                                <div class="form-group has-feedback">
                                                    <label>Address of the bank<span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <input type="text" name="bank_address" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="col s6 m3">
                                                <div class="form-group has-feedback">
                                                    <label>Swift code <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                    <input type="text" name="swift_code" class="form-control" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="line_item_wrap">
                                    <div class="col s12 input-field">
                                        <legend>Signature</legend>
                                        <div class="col s6 input-field">
                                            <h6>Buyer Side</h6>
                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="form-group has-feedback">
                                                        <label>Name<span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                        <input type="text" class="form-control" required name="buyer_singature_name"/>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="form-group has-feedback">
                                                        <label>Designation <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                        <input type="text" class="form-control" required name="buyer_singature_designation"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s6 input-field">
                                            <h6>Beneficiary Side</h6>
                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="form-group has-feedback">
                                                        <label>Name <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                        <input type="text" class="form-control"  name="beneficiar_singature_name" required/>
                                                    </div>
                                                </div>
                                                <div class="col s12">
                                                    <div class="form-group has-feedback">
                                                        <label>Designation <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                                        <input type="text" class="form-control"  name="beneficiar_singature_designation" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="right">
                                    <button type="submit" class="btn_green btn-success">
                                        <i class="fa fa-send"></i> Submit
                                    </button>
                                </div>
                            </form>
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

<div class="modal" id="selectcat">
<div class="modal-dialog modal-xl" style="width:900px;">
    <div class="modal-content">

        <!--Modal Header-->
        <div class="modal-header modal-hdr-custum" style="background:#55A860; border-radius:4px 4px 0 0;">
            <div class="col-md-11"><h4 class="modal-title" style="color:#fff;"><b>Select Supplier</b></h4></div>
        </div>
        <!--Modal Header-->

        <!-- Modal body -->
        <div class="modal-body" id="modal_body">
            <!--Add Product Form-->
            <div class="col-md-12" style="margin-top: 33px;">
                <!--1-->

            </div>
            <!--/Add Product Form-->
        </div>
        <!-- Modal body -->
        <div class="clear"></div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary modal-close" >No</button>
            <button type="button" class="btn btn-danger" onclick="addsupplier()">Ok</button>
        </div>
    </div>
</div>
</div>

@endsection

@include('po._scripts')
