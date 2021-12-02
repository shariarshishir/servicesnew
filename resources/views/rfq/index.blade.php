@extends('layouts.app')

@section('content')

<!-- <div>
    <a class="waves-effect waves-light btn modal-trigger" href="#create-rfq-form">Create Rfq</a>
</div> -->
@include('rfq._create_rfq_form_modal')
<div id="errors">

</div>

<!-- RFQ html start -->

<div class="box_shadow_radius rfq_content_box ">
	<div class="rfq_info_wrap right-align rfq_top_navbar">
		<ul>
			<li><a href="{{route('rfq.index')}}" class="btn_grBorder">RFQ Home</a></li>
			<li><a href="{{route('rfq.my')}}" class="btn_grBorder">My RFQs</a></li>
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
					<p>Merchandiser, <br/> Fashion Tex Ltd.</p>
				</div>
				<!--div class="profile_view_time right-align col s12 m4 l4">
					<span> <i class="material-icons"> watch_later </i> 35 mins</span>
				</div-->
			</div>
			<p>{{$rfqSentList->title}}</p>
			<p>{{$rfqSentList->short_description}}</p>
			<!--div class="tagS">
				<a href="javascript:void(0);"> #Sweater</a> <a href="javascript:void(0);"> #Apparel</a>
			</div-->
			<div class="row rfq_thum_imgs">
                @if($rfqSentList->images()->exists())
                    @foreach ($rfqSentList->images as  $key => $rfqImage )
                        @if($key == 4)
                            @break
                        @endif
                        <div class="col s12 m6 l4"><img src="{{asset('storage/'.$rfqImage->image)}}" alt="" /> </div>
                    @endforeach
                @endif
			</div>
			<div class="rfq_view_detail_wrap center-align">
				<button class="none_button btn_view_detail" onclick="myFunction()" id="rfqViewDetail">View Detail</button>
				<div class="rfq_view_detail_info">
					<h6>Query for {{$rfqSentList->category_id}}</h6>
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
								<td>{{$rfqSentList->unit_price}}</td>
							</tr>
							<tr>
								<td>Deliver to:</td>
								<td>{{$rfqSentList->destination}}</td>
							</tr>
							<tr>
								<td>Within:</td>
								<td>{{$rfqSentList->delivery_time}}</td>
							</tr>
							<tr>
								<td>Payment method:</td>
								<td>{{$rfqSentList->payment_method}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="responses_wrap right-align">
				<!--span><i class="material-icons">favorite</i> Saved</span-->
                @if($rfqSentList->user->id != auth()->id())
                    @if(isset($rfqSentList->bid_user_id))
                        <a href="javascript:void(0);" class="bid_rfq" onclick="openBidRfqModal({{$rfqSentList->id}})">{{ in_array(auth()->id(), $rfqSentList->bid_user_id) ? 'Replied' : 'Replay On this RFQ' }}</a>
                    @else
                        <a href="javascript:void(0);" class="bid_rfq" onclick="openBidRfqModal({{$rfqSentList->id}})">Reply on this RFQ</a>
                    @endif
                @endif
				<button class="none_button btn_responses" id="rfqResponse" >
					Responses <span class="respons_count  res_count_{{$rfqSentList->id}}_">{{$rfqSentList->bids_count}}</span>
				</button>
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
