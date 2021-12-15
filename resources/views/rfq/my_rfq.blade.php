@extends('layouts.app')

@section('content')

<!-- <div>
    <a class="waves-effect waves-light btn modal-trigger" href="#create-rfq-form">Create Rfq</a>
</div> -->
@include('rfq._create_rfq_form_modal')
<div id="errors">

</div>

<!-- RFQ html start -->

<div class="box_shadow_radius rfq_content_box">
	<div class="rfq_info_wrap right-align rfq_top_navbar">
		<ul>
            <li class="{{ Route::is('rfq.index') ? 'active' : ''}}"><a href="{{route('rfq.index')}}" class="btn_grBorder">RFQ Home</a></li>
			<li class="{{ Route::is('rfq.my') ? 'active' : ''}}"><a href="{{route('rfq.my')}}" class="btn_grBorder">My RFQs</a></li>
			<li><a href="javascript:void(0);" class="btn_grBorder">Saved RFQs</a></li>
			<li><a class="btn_green modal-trigger" href="#create-rfq-form">Create Rfq</a></li>
		</ul>
	</div>
	<!--div class="rfq_day_wrap center-align"><span>Today</span></div-->
	@foreach ($rfqLists as $rfqSentList)
	<div class="rfq_profile_detail row">
		<div class="col s12 m3 l2">
			<div class="rfq_profile_img">
				<img src="{{asset('images/frontendimages/new_layout_images/rfq_profile_img.png')}}" alt="" />
			</div>
		</div>
		<div class="col s12 m9 l10 rfq_profile_info">
			<div class="row">
				<div class="profile_info col s12 m8 l8">
					<h4>{{ $rfqSentList->user->name}}<img src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" alt="" /> </h4>
					<p>Merchandiser, Fashion Tex Ltd.</p>
				</div>
				<!--div class="profile_view_time right-align col s12 m4 l4">
					<span> <i class="material-icons"> watch_later </i> 35 mins</span>
				</div-->
			</div>

			<div class="rfq_view_detail_wrap">
				<h5>{{$rfqSentList->title}}</h5>
				<span class="short_description">{{$rfqSentList->short_description}}</span>
				<button class="none_button btn_view_detail" id="rfqViewDetail">Show More</button>
				<div class="rfq_view_detail_info" style="display: none;">
					<h6>Query for {{$rfqSentList->category->name}}</h6>
					<div class="full_specification"><span class="title">Details:</span> {{$rfqSentList->full_specification}} </div>
					<div class="full_details">
						<span class="title">Qty:</span> {{$rfqSentList->quantity}} {{$rfqSentList->unit}},
						<span class="title">Target Price:</span> $ {{$rfqSentList->unit_price}},
						<span class="title">Deliver to:</span>  {{$rfqSentList->destination}},
						<span class="title">Within:</span> {{ date('F j, Y',strtotime($rfqSentList->delivery_time)) }},
						<span class="title">Payment method:</span> {{$rfqSentList->payment_method}} </p>
					</div>
				</div>
			</div>


			<!-- <p>{{$rfqSentList->title}}</p>
			<p>{{$rfqSentList->short_description}}</p> -->
			<!--div class="tagS">
				<a href="javascript:void(0);"> #Sweater</a> <a href="javascript:void(0);"> #Apparel</a>
			</div-->
			<div class="row rfq_thum_imgs left-align">

				@if($rfqSentList->images()->exists())
					@foreach ($rfqSentList->images as  $key => $rfqImage )
						@if(pathinfo($rfqImage->image, PATHINFO_EXTENSION) == 'pdf' || pathinfo($rfqImage->image, PATHINFO_EXTENSION) == 'PDF')
							<div class="rfq_thum_img">
								<a href="{{ asset('storage/'.$rfqImage->image) }}" class="pdf_icon" >&nbsp; PDF</a>
							</div>
						@elseif(pathinfo($rfqImage->image, PATHINFO_EXTENSION) == 'doc' || pathinfo($rfqImage->image, PATHINFO_EXTENSION) == 'docx')
							<div class="rfq_thum_img">
								<a href="{{ asset('storage/'.$rfqImage->image) }}" class="doc_icon" >&nbsp; DOC</a>
							</div>
						@elseif(pathinfo($rfqImage->image, PATHINFO_EXTENSION) == 'xlsx')
							<div class="rfq_thum_img">
								<a href="{{ asset('storage/'.$rfqImage->image) }}" class="xlsx_icon" >&nbsp; XLSX</a>
							</div>
						@else
							<div class="rfq_thum_img">
								<img src="{{asset('storage/'.$rfqImage->image)}}" alt="" />
							</div>
						@endif
					@endforeach
				@endif

			</div>

			<!-- <div class="rfq_view_detail_wrap center-align">
				<button class="none_button btn_view_detail" onclick="myFunction()" id="rfqViewDetail">View Detail</button>
				<div class="rfq_view_detail_info" style="display: none;">
					<h6>Query for {{$rfqSentList->category->name}}</h6>
					<table class="detail_table">
						<tbody>
							<tr>
								<td>Details:</td>
								<td>{{$rfqSentList->full_specification}}</td>
							</tr>
							<tr>
								<td>Qty:</td>
								<td>{{$rfqSentList->quantity}} {{$rfqSentList->unit}}</td>
							</tr>
							<tr>
								<td>Target price:</td>
								<td>$ {{$rfqSentList->unit_price}}</td>
							</tr>
							<tr>
								<td>Deliver to:</td>
								<td>{{$rfqSentList->destination}}</td>
							</tr>
							<tr>
								<td>Within:</td>
								<td>{{ date('F j, Y',strtotime($rfqSentList->delivery_time)) }}</td>
							</tr>
							<tr>
								<td>Payment method:</td>
								<td>{{$rfqSentList->payment_method}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div> -->
			<div class="responses_wrap right-align">
				<!--span><i class="material-icons">favorite</i> Saved</span-->
				{{-- <a href="javascript:void(0);" class="bid_rfq" onclick="openBidRfqModal({{$rfqSentList->id}})">Reply on this RFQ</a> --}}
				<button class="none_button btn_responses" id="rfqResponse" >
					Responses <span class="respons_count">{{$rfqSentList->bids_count}}</span>
				</button>
				@if($rfqSentList->bids()->exists())
				<div class="respones_detail_wrap">
					<div class="responses_open">&nbsp;</div>
						@foreach ($rfqSentList->bids as $bid)

							<div class="row respones_box">
								<div class="col s12 m2 l2">
									<div class="rfq_profile_img">
										@if(auth()->user()->image)
										<img src="{{ asset('storage/'.auth()->user()->image) }}" alt="avatar">
										@else
										<img src="{{asset('images/frontendimages/no-image.png')}}" alt="avatar">
										@endif										
									</div>
								</div>
								<div class="col s12 m10 l10 rfq_profile_info">
									<div class="row">
										<div class="col m7 l7 profile_info">
											<h4>{{$bid->businessProfile->business_name}} </h4>
											<p>{{$bid->businessProfile->business_type == 1 ? 'Manufacture' : 'Wholesalser'}}</p>
										</div>
                                        @if(Auth::guard('web')->check())
                                            <div class="col m5 l5 right-align"><a href="javascript:void(0);" class="ic-btn btn_green" onClick="contactSupplierFromProduct({{ $bid->id }}); updateUserLastActivity('{{Auth::id()}}', '{{$bid->supplier_id}}'); sendmessage('{{$bid->id}}','{{$bid->title}}','{{$bid->quantity}}','{{$bid->unit}}','{{$bid->unit_price}}','{{$bid->total_price}}','{{$bid->payment_method}}','{{$bid->delivery_time}}','{{strip_tags($bid->description)}}','{{$bid->supplier_id}}')">Contact Supplier</a></div>
                                        @else
                                            <div class="col m5 l5 right-align"><a href="javascript:void(0);" class="ic-btn btn_green">Contact Supplier</a></div>
                                        @endif

									</div>

									<div class="full_specification"><span class="title">Description:</span> {!! $bid->description !!} </div>
									<div class="full_details">
										<span class="title">Quantity:</span> {{$bid->quantity}},
										<span class="title">Unit Price:</span> {{$bid->unit_price}},
										<span class="title">Total Price:</span>  {{$bid->total_price}},
										<span class="title">Payment Method:</span> {{$bid->payment_method}},
										<span class="title">Delivery Time:</span> {{$bid->delivery_time}} 
									</div>

									<!-- <p>Description: {{$bid->description}}</p>
									<p>Quantity: {{$bid->quantity}}</p>
									<p>Unit Price: {{$bid->unit_price}}</p>
									<p>Total Price: {{$bid->total_price}}</p>
									<p>Payment Method: {{$bid->payment_method}}</p>
									<p>Delivery Time: {{$bid->delivery_time}}</p> -->

									<div class="respones_img_wrap">
										@if(isset($bid->media))
											@foreach (json_decode($bid->media) as $image)
												<div class="respones_img">
													<img src="{{asset('storage/'.$image)}}" alt="">
												</div>
											@endforeach
										@endif
									</div>
								</div>
							</div>
						@endforeach
				</div>
				@endif
			</div>

			<!--div class="respones_detail_wrap">
				<div class="row respones_box">
					<div class="col s12 m2 l2">
						<div class="rfq_profile_img"><img src="images/ic-logo.png" alt=""></div>
					</div>
					<div class="col s12 m10 l10 rfq_profile_info">
						<div class="row">
							<div class="col m7 l7 profile_info">
								<h4>Sayem Fashion Ltd. <img src="images/verified.png" alt="" /> </h4>
								<p>Manufacturer, Sweater</p>
							</div>
							<div class="col m5 l5 right-align"><a href="" class="btn_white btn_supplier">Contact Supplier</a></div>
						</div>
						<p>I need 5000 pieces Full sleeve sweater for women, price US $5/pcs by Sep 28, 2021.</p>
					</div>
				</div>
				<div class="row respones_box">
					<div class="col s12 m2 l2">
						<div class="rfq_profile_img"><img src="images/ic-logo.png" alt=""></div>
					</div>
					<div class="col s12 m10 l10">
						<div class="row">
							<div class="col m7 l7 profile_info">
								<h4>Sayem Fashion Ltd. <img src="images/verified.png" alt="" /> </h4>
								<p>Manufacturer, Sweater</p>
							</div>
							<div class="col m5 l5 right-align"><a href="" class="btn_white btn_supplier">Contact Supplier</a></div>
						</div>
						<p>I need 5000 pieces Full sleeve sweater for women, price US $5/pcs by Sep 28, 2021.</p>
					</div>
				</div>
			</div-->

		</div>
	</div>
	@endforeach
</div>
<!-- RFQ html end -->

<div class="pagination-block-wrapper">
    <div class="col s12 center">
        {!! $rfqLists->links() !!}
    </div>
</div>
@include('rfq._create_rfq_bid_form_modal')
@endsection

@include('rfq._scripts')
@push('js')
    <script>

        var serverURL = "{{ env('CHAT_URL'), 'localhost' }}:3000";
        var socket = io.connect(serverURL);
        socket.on('connect', function(data) {
        //alert('connect');
        });
        @if(Auth::check())
        function sendmessage(bid_id,title,quantity,unit,unit_price,total_price,payment_method,delivery_time,description,supplier_id)
        {
        let message = {'message': 'We are Interested in Your rfq bid title: '+title+' and would like to discuss More about that', 'product': {'rfq_bid_id': "rb-"+bid_id,'title': title,'quantity': quantity,'unit_price': unit_price+" "+unit, 'total_price': total_price, 'payment_method': payment_method, 'delivery_time': delivery_time, 'description': description}, 'from_id' : "{{Auth::user()->id}}", 'to_id' : supplier_id};
        socket.emit('new message', message);
        setTimeout(function(){
            //window.location.href = "/message-center";
            var url = '{{ route("message.center") }}?uid='+supplier_id;
                // url = url.replace(':slug', sku);
                window.location.href = url;
            // window.location.href = "/message-center?uid="+supplier_id;
        }, 1000);
        }

        function updateUserLastActivity(form_id, to_id)
        {
        var form_id = form_id;
        var to_id = to_id;
        var csrftoken = $("[name=_token]").val();

        data_json = {
            "form_id": form_id,
            "to_id": to_id,
            "csrftoken": csrftoken
        }
        var url= '{{route("message.center.update.user.last.activity")}}';
        jQuery.ajax({
            method: "POST",
            url: url,
            headers:{
                "X-CSRF-TOKEN": csrftoken
            },
            data: data_json,
            dataType:"json",

            success: function(data){
                console.log(data);
            }
        });

        }

        function contactSupplierFromProduct(supplierId)
        {

        var supplier_id = supplierId;
        var csrftoken = $("[name=_token]").val();
        var buyer_id = "{{Auth::id()}}";
        data_json = {
            "supplier_id": supplier_id,
            "buyer_id": buyer_id,
            "csrftoken": csrftoken
        }
        var url='{{route("message.center.contact.supplier.from.product")}}';
        jQuery.ajax({
            method: "POST",
            url:url,
            headers:{
                "X-CSRF-TOKEN": csrftoken
            },
            data: data_json,
            dataType:"json",
            success: function(data){
                console.log(data);
            }
        });

        /*
        let message = {'message': 'Hi I would like to discuss More about your Product', 'product': null, 'from_id' : "{{Auth::user()->id}}", 'to_id' : supplierId};
        socket.emit('new message', message);
        setTimeout(function(){
            window.location.href = "/message-center?uid="+supplierId;
        }, 1000);
        */
        }

        function sendsamplemessage(productId,productTitle,productCategory,moq,qtyUnit,pricePerUnit,priceUnit,productImage,createdBy)
        {
        let message = {'message': 'We are Interested in Your Product ID:mb-'+productId+' and would like to discuss More about the Product', 'product': {'id': "MB-"+productId,'name': productTitle,'category': productCategory,'moq': moq,'price': priceUnit+" "+pricePerUnit, 'image': productImage}, 'from_id' : "{{Auth::user()->id}}", 'to_id' : createdBy};
        socket.emit('new message', message);
        setTimeout(function(){
            window.location.href = "/message-center";
        }, 1000);
        }
        @endif
    </script>

@endpush
