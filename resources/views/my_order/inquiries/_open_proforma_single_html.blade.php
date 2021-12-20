@extends('layouts.app')

@section('content')

@include('my_order.partials._profile_list')

<div class="col s12">
	<table style="width: 100%;">
		<tr>
			<td style="width:50%;">Purchase Order</td>
			<td style="width:50%; text-align: right;">
				@if(auth()->id() == $po->buyer_id && $po->status != 1)
				<button class="btn btn_green" type="submit" onclick="work_trigger()" id="createRfqForm">Accept</button> &nbsp;
				{{-- <a href="javascript:void(0);" class="btn btn_red rejectPiBtn" data-toggle="modal" data-target="#rejectOrderDetailsModal">Reject</a> &nbsp; --}}
				<a class="waves-effect waves-light btn modal-trigger" href="#rejectOrderDetailsModal">Reject</a>
				@endif
				<button onclick="window.print()" class="btn btn_green printPageButton">Print</button>				
			</td>
		</tr>
		<tr>
			<td>DATE : {{$po->proforma_date}}</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>PO # : {{$po->proforma_id}}</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Payment Due : {{$po->payment_within}}</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="width:50%;">
				<table style="width: 100%;">
					<tr>
						<td>Vendor</td>
					</tr>
					<tr>
						<td>Merchant Bay</td>
					</tr>
					<tr>
						<td>House#27, Uttara Dhaka, 1230, Bangladesh</td>
					</tr>
					<tr>
						<td>Ph: +880 9611-677345 Email: info@merchantbay.com</td>
					</tr>
					<tr>
						<td>www.merchantbay.com</td>
					</tr>
				</table>
			</td>
			<td style="width:50%;">
				<table style="width: 100%;">
					<tr>
						<td>Buyer</td>
					</tr>
					<tr>
						<td>{{$po->buyer->name}}</td>
					</tr>
					<tr>
						<td>{{ @$po->buyer->profile->contact_info['street'] }}, {{ @$po->buyer->profile->contact_info['city'] }}, {{ @$po->buyer->profile->contact_info['state'] }}, {{ @$po->buyer->profile->contact_info['region'] }}, {{ @$po->buyer->profile->contact_info['zipCode'] }}</td>
					</tr>
					<tr>
						<td>Ph: {{ @$po->buyer->phone}} Email: {{ @$po->buyer->email }}</td>
					</tr>
				</table>
			</td>			
		</tr>

		<tr>
			<td colspan="2">
				<table style="width:100%;">
					<tr>
						<td style="width:2%; background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">Sl.</td>
						<td style="width:22%; background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">Product Category</td>
						<td style="width:22%; background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">Unit Price</td>
						<td style="width:22%; background-color:#53AB57; color:#fff; padding:1%; font-weight:bold; text-align;center;">QTY</td>
						<td style="width:22%; background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">Total Price</td>
						<!--td style="width:9%; background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">Tax</td-->
						<!--td style="width:20%; background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">Tax Amount</td-->
					</tr>
					@php $supplier_id = 0; @endphp
					@php $total_price = 0; @endphp
                    @php $total_tax_price = 0; @endphp
                    @php $price_unit = 'BDT'; @endphp
                    @if(Auth::user()->id == $po->buyer->id)
	                    @foreach($po->performa_items as $ik => $item)
							<tr>
								<td style="border-bottom:1px solid #ddd; padding:1%;">{{$ik + 1}}</td>
								<td style="border-bottom:1px solid #ddd; padding:1%;">{{ $item->product->title }}</td>
								<td style="border-bottom:1px solid #ddd; padding:1%;">
									BDT {{ number_format($item->unit_price, 2) }}
									<span style="display:block;font-size:10px;color:#999;">Vat & Tax included.</span>
								</td>
								<td style="border-bottom:1px solid #ddd; padding:1%; text-align;center;">{{ $item->unit }}</td>
								<td style="border-bottom:1px solid #ddd; padding:1%;">{{$item->price_unit}} {{ number_format($item->total_price, 2) }}</td>
								<!--td style="border-bottom:1px solid #ddd; padding:1%;">{{ $item->tax }}%</td-->
								<!--td style="border-bottom:1px solid #ddd; padding:1%;">{{$item->price_unit}} {{ number_format($item->tax_total_price, 2) }}</td-->
							</tr>
							@php $price_unit = $item->price_unit; @endphp
							@php $total_price += $item->total_price; @endphp
	                        @php $total_tax_price += $item->tax_total_price; @endphp
	                        @php $supplier_id += $item->supplier_id; @endphp
	                    @endforeach
	                @else
	                	@foreach($po->performa_items as $ik => $item)
	                	@if(in_array($item->supplier->id, $users))
							<tr>
								<td style="border-bottom:1px solid #ddd; padding:1%;">{{$ik + 1}}</td>
								<td style="border-bottom:1px solid #ddd; padding:1%;">{{ $item->product->title }}</td>
								<td style="border-bottom:1px solid #ddd; padding:1%;">
									{{$price_unit}} {{ number_format($item->unit_price, 2) }}
									<span style="display:block;font-size:10px;color:#999;">Vat included.</span>
								</td>
								<td style="border-bottom:1px solid #ddd; padding:1%; text-align;center;">{{ $item->unit }}</td>
								<td style="border-bottom:1px solid #ddd; padding:1%;">{{$price_unit}} {{ number_format($item->total_price, 2) }}</td>
								<!--td style="border-bottom:1px solid #ddd; padding:1%;">{{ $item->tax }}%</td-->
								<!--td style="border-bottom:1px solid #ddd; padding:1%;">{{$price_unit}} {{ number_format($item->tax_total_price, 2) }}</td-->
							</tr>
							@php $total_price += $item->total_price; @endphp
	                        @php $total_tax_price += $item->tax_total_price; @endphp
	                    @endif
	                    @endforeach
	                @endif
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td style="background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">SUBTOTAL</td>
						<!--td style="background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">&nbsp;</td-->
						<td style="background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">{{$price_unit}} {{ number_format($total_price, 2) }}</td>
					</tr>
					<!--tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td style="background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">&nbsp;</td>
						<td style="background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">Taxes 5%</td>
						<td style="background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">&nbsp;</td>
						<td style="background-color:#53AB57; color:#fff; padding:1%; font-weight:bold;">{{$price_unit}} {{ number_format(($total_tax_price - $total_price), 2) }}</td>
					</tr-->
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td style="background-color:#40874C; color:#fff; padding:1%; font-weight:bold;">Total Invoice Amount</td>
						<!--td style="background-color:#40874C; color:#fff; padding:1%; font-weight:bold;">&nbsp;</td-->
						<td style="background-color:#40874C; color:#fff; padding:1%; font-weight:bold;">{{$price_unit}} {{ number_format($total_tax_price, 2) }}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="padding:1% 0 1% 5%;"><h3 style="font-size:15px; font-weight:bold; border-bottom:3px solid #000; padding-bottom:5px;">Terms & Conditions</h3></td>
		</tr>
		@php $ti = 1; @endphp
		@foreach(json_decode($po->condition) as $t)
            @if($t != '')
                <tr>
                    <td colspan="2" style="padding:1% 0 0.5% 5%;">{{ $ti }}. {{$t}}</td>
                </tr>
                @php $ti += 1; @endphp
            @endif
		@endforeach
		<tr>
			<td colspan="2" style="background-color:#53AB57;">
				<table style="width:100%;">
					<tr>
						<td>If you have any questions, please contact</td>
					</tr>
					<tr>
						<td>Merchant Bay, +880-2-09611677345, info@merchantbay.com.com</td>
					</tr>
				</table>
			</td>
		</tr>

	</table>
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
                    	<form action="" class="rejectRfqForm" method="post" enctype="multipart/form-data">
                    		@csrf
                    		<div class="input-field">
	                        	<textarea name="reject_message" id="reject_message" placeholder="Please enter here the details of rejection." style="width: 100%; height: 200px; border: 1px solid #ccc; padding: 10px;"></textarea>
	                    	</div>
						    <input type="hidden" id="proforma_id" name="proforma_id" value="{{ $po->proforma_id }}">
						    <input type="hidden" id="po_id" name="po_id" value="{{ $po->id }}" />
						    <input type="hidden" id="supplier_id" name="supplier_id" value="{{ $supplier_id }}" />
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
    <input type="hidden" id="supplier_id" name="supplier_id" value="{{ $supplier_id }}" />
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

            $("#rejectRfqForm").on('click', function(e)
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

            //let message = '/open-proforma-single-html/{{$po->id}}';
            let message = {'message': 'Your PI have been '+status+'. To see the PI please check this URL : {{ $app->make('url')->to('/') }}/open-proforma-single-html/{{$po->id}}','from_id' : "{{Auth::user()->id}}", 'to_id' : "{{ $supplier_id }}"};
            socket.emit('new message', message);
            /*
            setTimeout(function(){
                window.location.href = "/message-center?uid={{ $supplier_id }}";
            }, 1000);
            */
        }

        function sendRejectedMessageToSupplier(status, statusmessage)
        {

            //let message = '/open-proforma-single-html/{{$po->id}}';
            let message = {'message': 'Your PI have been '+status+'. Due to: '+statusmessage+'. To see the PI please check this URL : {{ $app->make('url')->to('/') }}/open-proforma-single-html/{{$po->id}}','from_id' : "{{Auth::user()->id}}", 'to_id' : "{{ $supplier_id }}"};
            socket.emit('new message', message);
            /*
            setTimeout(function(){
                window.location.href = "/message-center?uid={{ $supplier_id }}";
            }, 1000);
            */
        }
    </script>

@endpush
