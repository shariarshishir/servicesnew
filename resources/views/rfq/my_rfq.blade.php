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
			<li class="{{ Route::is('rfq.index') ? 'active' : ''}}"><a href="{{route('rfq.index')}}" class="btn_grBorder">RFQ Home</a></li>
			<li class="{{ Route::is('rfq.my') ? 'active' : ''}}"><a href="{{route('rfq.my')}}" class="btn_grBorder">My RFQs</a></li>
			<li style="display: none;"><a href="javascript:void(0);" class="btn_grBorder">Saved RFQs</a></li>
			<li><a class="btn_grBorder modal-trigger open-create-rfq-modal">Create RFQ</a></li>
		</ul>
	</div>
	<!--div class="rfq_day_wrap center-align"><span>Today</span></div-->
	@php $i = 1; @endphp
	@foreach ($rfqLists as $rfqSentList)
	<div class="rfq_profile_detail row">
		<div class="col s12 m3 l2">
			<div class="rfq_profile_img">
				@if(isset($rfqSentList['user']['image']))
				<img src="{{ asset('storage/'.$rfqSentList['user']['image']) }}" alt="" />
				@else
				<img src="{{asset('images/frontendimages/no-image.png')}}" alt="avatar">
				@endif
			</div>
		</div>
		<div class="col s12 m9 l10 rfq_profile_info">
			<div class="row">
				<div class="profile_info col s12 m8 l8">
					<h4>
						{{ $rfqSentList['user']['user_name']}}
						@if(isset($rfqSentList->businessProfile->is_business_profile_verified))
						<img src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" alt="" />
						@endif
					</h4>
					<!--p>Fashion Tex Ltd.</p-->
				</div>

				<div class="profile_view_time right-align col s12 m4 l4">
					<div style="float: right;" class="rfq_share_box">
						<a class="btn_green btn_share" href="javascript:void(0);" onclick= "openShareModel({{$rfqSentList['id']}})"> <i class="material-icons"> share </i> <span>Share</span></a>
					</div>
				</div>
			</div>

			<div class="rfq_view_detail_wrap">
				<h5>{{$rfqSentList['title']}}</h5>
				<span class="short_description">{{$rfqSentList['short_description']}}</span>
				<button class="none_button btn_view_detail"  data-rfqId="{{$rfqSentList['id']}}" id="rfqViewDetail">Show More</button>

				<div class="rfq_view_detail_info" style="display: none;">
					<h6>Query for {{$rfqSentList['category'][0]['name']}}</h6>
					<div class="full_specification"><span class="title">Details:</span> {{$rfqSentList['full_specification']}}</div>
					<div class="full_details">
						<span class="title">Qty:</span> {{$rfqSentList['quantity']}} {{$rfqSentList['unit']}},
						@if($rfqSentList['unit_price']==0.00)
						<span class="title">Target Price:</span> N/A,
						@else
						<span class="title">Target Price:</span> $ {{$rfqSentList['unit_price']}},
						@endif
						<span class="title">Deliver to:</span> {{$rfqSentList['destination']}},
						<span class="title">Within:</span> {{ date('F j, Y',strtotime($rfqSentList['delivery_time'])) }},
						<span class="title">Payment method:</span> {{$rfqSentList['payment_method']}} </p>
					</div>
				</div>
			</div>

			<div class="row rfq_thum_imgs left-align">
				@if(count($rfqSentList['images'])>0)
						@foreach ($rfqSentList['images'] as  $key => $rfqImage )
							<div class="rfq_thum_img">
								<a data-fancybox="gallery-{{$i}}" href="{{$rfqImage['image']}}">
									<img src="{{$rfqImage['image']}}" alt="" />
								</a>
							</div>
                    @endforeach
                @endif
			</div>

			<div class="responses_wrap right-align">
                <a href="javascript:void(0);" class="bid_rfq">Reply on this RFQ</a>
				<button class="none_button btn_responses" id="rfqResponse" >
					Responses <span class="respons_count">0</span>
				</button>

			</div>

		</div>
	</div>
	@php $i++; @endphp
	@endforeach
</div>
<!-- RFQ html end -->

@include('rfq._create_rfq_bid_form_modal')
@include('rfq.share_modal')
@endsection

@include('rfq._scripts')
