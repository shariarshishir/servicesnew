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
                            <form action="{{route('po.store')}}" method="post" >
                            @csrf
                                <!-- <div style="padding-top: 30px;"></div> -->
                                <div class="row">
                                    <!-- <div class="col s12 m6 l6"> -->
                                    <div class="col s12 m6 l5 input-field">
                                        <div class="col-md-12" style="display: none;">
                                            <div class="form-group has-feedback">
                                                <label>Select Buyer</label>
                                                <select name="buyer" id="buyerOptionsList" class="form-control" onChange="getbuyerdetails(this.value)">
                                                    <option value="">--Select Buyer--</option>
                                                    @foreach($buyers as $buyer)
                                                        <option value="{{$buyer['id']}}">{{ucfirst($buyer['name'])}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="buyerdata"></div>
                                        <input type="hidden" name="selected_buyer_id" value="{{ request()->route()->parameters['id'] }}" />
                                    </div>
                                    <div class="col s12 m6 l7 input-field">
                                        <div class="form-group has-feedback">
                                            <label>Pro-forma ID <span class="required_star" style="color: rgb(255, 0, 0)" >*</span> </label>
                                            <input type="text" class="form-control" required name="po_id"/>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                            <label>Pro-forma Date <span class="required_star" style="color: rgb(255, 0, 0)" >*</span></label>
                                            <input type="date" class="form-control" required name="po_date"/>
                                        </div>
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
                                    <!-- </div> -->
                                </div>
                                <div class="line_item_wrap">
                                    <legend>Line Items</legend>
                                    <table class="table" style="border-bottom:1px solid #ccc; margin-bottom:15px;">
                                        <thead>
                                            <tr>
                                                <th style="width:5%;">Sl. No.</th>
                                                <th style="width:15%;">Item / Description</th>
                                                <th style="width:15%;">Quantity</th>
                                                <th style="width:15%;">Unit Price</th>
                                                <th style="width:15%;">Sub Total</th>
                                                <!-- <th style="width:15%;">Tax</th> -->
                                                <th style="width:15%;">Total Price</th>
                                                <th style="width:5%; text-align:center;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="lineitems" class="input-field">
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <select class="select2" onchange="changecat(this)">
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
                                                <td style="position: relative;"> <span class="required_star" style="position: absolute; top:10; right:11px;">*</span>
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:8px;"></div> -->
                                                    <input type="number" class="form-control unit" style="border:1px solid #ccc; margin-bottom:0;" name="unit[]" onkeyup="changeunit(this)" required/>
                                                </td>
                                                <td style="position: relative;"> <span class="required_star" style="position: absolute; top:10; right:11px;">*</span>
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
                                            <li class="list-group-item">
                                                <div class="input-group input-field">
                                                    <input type="text" class="form-control" Placeholder="Terms and Condition 1" name="conditions[]" readonly>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <label>
                                                                <input type="checkbox" aria-label="Checkbox for following text input" onclick="$(this).parent().parent().parent().prev().prop('readonly', function(i, v) { return !v; });">
                                                                <span>Check to Edit</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="input-group input-field">
                                                    <input type="text" class="form-control" Placeholder="Terms and Condition 2" name="conditions[]" readonly>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <label>
                                                                <input type="checkbox" aria-label="Checkbox for following text input" onclick="$(this).parent().parent().parent().prev().prop('readonly', function(i, v) { return !v; });">
                                                                <span>Check to Edit</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="input-group input-field">
                                                    <input type="text" class="form-control" Placeholder="Terms and Condition 3" name="conditions[]" readonly>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <label>
                                                                <input type="checkbox" aria-label="Checkbox for following text input" onclick="$(this).parent().parent().parent().prev().prop('readonly', function(i, v) { return !v; });">
                                                                <span>Check to Edit</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="input-group input-field">
                                                    <input type="text" class="form-control" Placeholder="Terms and Condition 4" name="conditions[]" readonly>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <label>
                                                                <input type="checkbox" aria-label="Checkbox for following text input" onclick="$(this).parent().parent().parent().prev().prop('readonly', function(i, v) { return !v; });">
                                                                <span>Check to Edit</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="input-group input-field">
                                                    <input type="text" class="form-control" Placeholder="Terms and Condition 5" name="conditions[]" readonly>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <label>
                                                                <input type="checkbox" aria-label="Checkbox for following text input" onclick="$(this).parent().parent().parent().prev().prop('readonly', function(i, v) { return !v; });">
                                                                <span>Check to Edit</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
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
