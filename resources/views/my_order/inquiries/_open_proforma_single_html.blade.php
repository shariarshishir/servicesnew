@extends('layouts.app')

@section('content')
<div class="main_content_wrapper invoice_container_wrap  purchase_order_wrap" id="purchase_order_wrap">
    
    <div class="card">
        @if(auth()->id() == $po->buyer_id && $po->status != 1)
        <button class="btn_green" type="submit" onclick="work_trigger()" id="createRfqForm">Accept</button> &nbsp;
        <a class="waves-effect waves-light btn_green modal-trigger"  href="#rejectOrderDetailsModal">Reject</a>
        @endif
        <button onclick="printDiv('purchase_order_wrap');" id="printPageButtonTrigger" class="btn_green printPageButton">Print</button>

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
                                        <div class="col m6" id="buyerdata">
                                            <p> <b>Name:</b> {{$po->buyer->name}}</p>
                                            <p> <b>Email:</b>{{$po->buyer->email}}</p>
                                        </div>
                                        <div class="col m6">
                                            <div class="form-group has-feedback">
                                                <label>Beneficiary</label>
                                                <span style="display: block">{{ $po->businessProfile->business_name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 input-field">
                                        <div class="row">
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <label>Pro-forma ID</label>
                                                    <span>{{ $po->proforma_id }}</span>
                                                </div>
                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <label>Pro-forma Date</label>
                                                    <span>{{ $po->proforma_date }}</span>
                                                </div>
                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <label>Payment Within</label>
                                                    <span>{{ $po->payment_within  }}</span>
                                                </div>
                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <label>Payment term</label>
                                                    <span>{{ $po->paymentTerm->name  }}</span>
                                                </div>

                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                                    <label>Shipment Term</label>
                                                    <span>{{$po->shipmentTerm->name}}</span>
                                                </div>

                                            </div>
                                            <div class="col s6 m3 l2">
                                                <div class="form-group has-feedback">
                                                    <!-- <div style="height: 25px;width: 0px;border-left: 5px solid rgb(255, 0, 0);position: absolute;top:25px;"></div> -->
                                                    <label>Shipping Address</label>
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
                                            @foreach($po->supplierCheckedProFormaTermAndConditions as $supplierCheckedProFormaTermAndCondition)
                                            <li class="list-group-item">
                                                <div class="input-group input-field">
                                                    <label class="terms-label">
                                                        <span class="material-icons"> check </span> <span>{{$supplierCheckedProFormaTermAndCondition->proFormaTermAndCondition->term_and_condition}}</span>
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
                                                        <span class="material-icons"> check </span> <span>{{$condition}}</span>
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
                                            <h6>Buyer Side</h6>
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

            <div class="shipping-files">
                <legend><span class="material-icons">attach_file</span> Attachment</legend>
                <ul>
                @foreach($po->proFormaShippingFiles as $image)
                    <li><span class="material-icons"> insert_drive_file </span> {{ asset('storage/'.$image->shipping_details_files) }}</li>
                @endforeach
                </ul>
            </div>            

            <!-- end row -->

            <!-- end row -->
        </section>
        <!-- end widget grid -->

    </div>
</div>

<div class="modal" id="rejectOrderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="rejectOrderDetailsModal"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
            <div class="modal-header modal-hdr-custum" style="background: rgb(85, 168, 96) none repeat scroll 0% 0%; border-radius: 4px 4px 0px 0px;">
            	<h4 class="modal-title" style="color: #fff; font-size: 14px;">
            		PO: {{ $po->proforma_id }} <br />
            		Date: {{$po->proforma_date}}
            	</h4>
            </div>
            <div class="modal-body modal-bdy-bdr">
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 35px;">
                    	<form action="{{route('reject.proforma.invoice')}}" class="rejectRfqForm" method="post" enctype="multipart/form-data">
                    		@csrf
                    		<div class="input-field">
	                        	<textarea name="reject_message" id="reject_message" placeholder="Please enter here the details of rejection." style="width: 100%; height: 200px; border: 1px solid #ccc; padding: 10px;"></textarea>
	                    	</div>
						    <input type="hidden" id="proforma_id" name="proforma_id" value="{{ $po->proforma_id }}">
						    <input type="hidden" id="po_id" name="po_id" value="{{ $po->id }}" />
						    <input type="hidden" id="supplier_id" name="supplier_id" value="{{ $supplierInfo->id }}" />
						    <input type="hidden" id="po_rejected_status" name="po_rejected_status" value="Rejected" />
	                        <button type="submit" onclick="work_trigger()" class="btn btn-success" id="rejectRfqForm">Submit</button>
                    	</form>
                    </div>
                </div>
            </div>
       </div>
       <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
      </div>
    </div>
</div>

<form action="" class="createRfqForm" method="post" enctype="multipart/form-data">
	@csrf
    <input type="hidden" id="proforma_id" name="proforma_id" value="{{ $po->proforma_id }}">
    <input type="hidden" id="po_id" name="po_id" value="{{ $po->id }}" />
    <input type="hidden" id="supplier_id" name="supplier_id" value="{{ $supplierInfo->id }}" />
    <input type="hidden" id="po_accepted_status" name="po_accepted_status" value="Accepted" />
</form>



@endsection

@include('my_order.inquiries._scripts')
@push('js')
    <script>
            var serverURL = "{{ env('CHAT_URL'), 'localhost' }}:3000";
            var socket = io.connect(serverURL);
            socket.on('connect', function(data) {
                //alert('connect');
            });

        $(document).ready(function()
        {
            $("#createRfqForm").on('click', function(e)
            {
                e.preventDefault();
                let proforma_id = $("#proforma_id").val();
                let po_id = $("#po_id").val();
                let supplier_id = $("#supplier_id").val();
                let csrftoken = $("[name=_token]").val();
                let poAcceptedStatus = $("[name=po_accepted_status]").val();

                data_json = {
                    "proforma_id": proforma_id,
                    "po_id": po_id,
                    "supplier_id": supplier_id,
                    "csrftoken": csrftoken
                }

                var url='{{route("accept.proforma.invoice")}}';
                $.ajax({
                    method: "POST",
                    url: url,
                    headers:{
                        "X-CSRF-TOKEN": csrftoken
                    },
                    data: data_json,
                    dataType:"json",

                    success: function(data){
                        //console.log(data);
                        //work_trigger();
                        var inquires_index= '{{route("po.index")}}';
                        window.location.href = inquires_index;
                        //sendAcceptedMessageToSupplier(poAcceptedStatus);
                    }

                });
            });

            $("#rejectOrderTrigger").on('click', function(e)
            {
                e.preventDefault();
                let proforma_id = $("#proforma_id").val();
                let po_id = $("#po_id").val();
                let supplier_id = $("#supplier_id").val();
                let reject_message = $("#reject_message").val();
                let csrftoken = $("[name=_token]").val();
                let poRejectedStatus = $("[name=po_rejected_status]").val();

                data_json = {
                    "proforma_id": proforma_id,
                    "po_id": po_id,
                    "supplier_id": supplier_id,
                    "reject_message": reject_message,
                    "csrftoken": csrftoken
                }
                var url ='{{route("reject.proforma.invoice")}}';
                $.ajax({
                    method: "POST",
                    url:url,
                    headers:{
                        "X-CSRF-TOKEN": csrftoken
                    },
                    data: data_json,
                    dataType:"json",

                    success: function(data){
                        //console.log(data);
                        work_trigger();
                        //sendRejectedMessageToSupplier(poRejectedStatus, reject_message);
                    }

                });
            });
        }); 

        function work_trigger()
        {
            setTimeout(function(){
                //window.location.href = "/message-center";
                var inquires_index= '{{route("po.index")}}';
                    window.location.href = inquires_index;
                // window.location.href = "/pro-forma-invoices";
            }, 1000);
            //window.location.replace("/pro-forma-invoices");
        }

        function sendAcceptedMessageToSupplier(status)
        {

            let message = {'message': 'Your PI have been '+status+'. To see the PI please check this URL : {{ $app->make('url')->to('/') }}/open-proforma-single-html/{{$po->id}}','from_id' : "{{Auth::user()->id}}", 'to_id' : "{{ $supplierInfo->id }}"};
            socket.emit('new message', message);
            
        }

        function sendRejectedMessageToSupplier(status, statusmessage)
        {
            //let message = '/open-proforma-single-html/{{$po->id}}';
            let message = {'message': 'Your PI have been '+status+'. Due to: '+statusmessage+'. To see the PI please check this URL : {{ $app->make('url')->to('/') }}/open-proforma-single-html/{{$po->id}}','from_id' : "{{Auth::user()->id}}", 'to_id' : "{{ $supplierInfo->id }}"};
            socket.emit('new message', message);
            
        }
 
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
       
    </script>

@endpush



