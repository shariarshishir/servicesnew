@extends('layouts.app')

@section('content')

<div>
    <a class="waves-effect waves-light btn modal-trigger" href="#create-rfq-form">Create Rfq</a>
</div>
@include('rfq._create_rfq_form_modal')


<!-- RFQ html start -->
{{-- <div class="box_shadow_radius rfq_content_box">
	<div class="quick_rfq_wrap" style="display: none;">
		<div class="quick_rfqForm_wrap">
			<h4>Write your Quick RFQ here</h4>
			<form class="rfq_from">
				<div class="input-field">
					<textarea type="text" name="Description" value="" placeholder="Within 250 words..."></textarea>
				</div>
			</form>
			<form class="rfq_from rfq_detail_from">
				<div class="input-field row">
					<div class="col s12 m4 l3">
						<label>Title</label>
					</div>
					<div class="col s12 m8 l9">
						<input type="text" name="Title" value="" placeholder="" />
					</div>
				</div>
				<div class="input-field row">
					<div class="col s12 m4 l3">
						<label>Description</label>
					</div>
					<div class="col s12 m8 l9">
						<textarea type="text" name="Description" value="" placeholder="Within 250 words..."></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col s12 m6 l6">
						<div class="input-field row">
							<div class="col s12 m6 l6">
								<label>Quantity</label>
							</div>
							<div class="col s12 m6 l6">
								<input type="text" name="Quantity" value="" placeholder="">
							</div>
						</div>
					</div>
					<div class="col s12 m6 l6">
						<div class="input-field row">
							<div class="col s12 m6 l6">
								<label>Select Unit</label>
							</div>
							<div class="col s12 m6 l6">
								<select class="select2 browser-default">
									<option value="square">Square</option>
									<option value="rectangle">Rectangle</option>
									<option value="rombo">Rombo</option>
									<option value="romboid">Romboid</option>
									<option value="trapeze">Trapeze</option>
									<option value="traible">Triangle</option>
									<option value="polygon">Polygon</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12 m6 l6">
						<div class="input-field row">
							<div class="col s12 m6 l6">
								<label>Target Price</label>
							</div>
							<div class="col s12 m6 l6">
								<input type="text" name="TargetPrice" value="" placeholder="">
							</div>
						</div>
					</div>
					<div class="col s12 m6 l6">
						<div class="input-field row">
							<div class="col s12 m6 l6">
								<label>Destination</label>
							</div>
							<div class="col s12 m6 l6">
								<input type="text" name="Destination" value="" placeholder="">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12 m6 l6">
						<div class="input-field row">
							<div class="col s12 m6 l6">
								<label>Select Payment Method</label>
							</div>
							<div class="col s12 m6 l6">
								<select class="select2 browser-default">
									<option value="square">Square</option>
									<option value="rectangle">Rectangle</option>
									<option value="rombo">Rombo</option>
									<option value="romboid">Romboid</option>
									<option value="trapeze">Trapeze</option>
									<option value="traible">Triangle</option>
									<option value="polygon">Polygon</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col s12 m6 l6">
						<div class="input-field row">
							<div class="col s12 m6 l6">
								<label>Expected Delivery Time</label>
							</div>
							<div class="col s12 m6 l6">
								<input type="date" name="dateTime" value="" placeholder="">
							</div>
						</div>
					</div>
				</div>
			</form>
			<div class="rfq_select">
				<a class="dropdown-trigger btn_grBorder btn_filter_dropMenu" href="javascript:void(0);" data-target="dropdown1">
				<span>To</span>
				Merchant Bay <i class="material-icons">arrow_drop_down</i>
				</a>
				<ul id="dropdown1" class="dropdown-content" tabindex="0" style="width: 200px; left: 152.938px; top: 203.1px; height: 518.9px; transform-origin: 0px 0px; opacity: 1; transform: scaleX(1) scaleY(1);">
					<li><a href="javascript:void(0);" class="disable">Circle </a></li>
					<li><a href="javascript:void(0);">Industry</a></li>
					<li><a href="javascript:void(0);">Circle & Industry</a></li>
					<li><a href="javascript:void(0);">Merchant Bay</a></li>
				</ul>
				<!-- Dropdown Structure -->
			</div>
			<div class="file_attach">
				<button class="none_button" ><img src="images/attachment.png" alt="" /></button>
				<button class="none_button" ><img src="images/image.png" alt="" /></button>
			</div>
			<button type="submit" class="btn_green btn_rfq_post">Post</button>
		</div>
		<div class="center-align rfq_btn_wrap">
			<button type="button" onclick="myFunction()" id="detailedRfq" class="none_button btn_detailed_rfq">Detailed RFQ</button>
		</div>
	</div>
	<div class="rfq_info_wrap right-align">
		<button type="button" class="btn_grBorder active">RFQ Home</button>
		<button type="button" class="btn_grBorder">My RFQs</button>
		<button type="button" class="btn_grBorder">Saved RFQs</button>
	</div>
	<div class="rfq_day_wrap center-align"><span>Today</span></div>
	<div class="rfq_profile_detail row">
		<div class="col s12 m3 l2">
			<div class="rfq_profile_img">
				<img src="images/rfq_profile_img.png" alt="" />
			</div>
		</div>
		<div class="col s12 m9 l10 rfq_profile_info">
			<div class="row">
				<div class="profile_info col s12 m8 l8">
					<h4>Adbul Kuddus <img src="images/verified.png" alt="" /> </h4>
					<p>Merchandiser, <br/> Fashion Tex Ltd.</p>
				</div>
				<div class="profile_view_time right-align col s12 m4 l4">
					<span> <i class="material-icons"> watch_later </i> 35 mins</span>
				</div>
			</div>
			<p>I need 5000 pieces Full sleeve sweater for women, price US $5/pcs by Sep 28, 2021. </p>
			<div class="tagS">
				<a href="javascript:void(0);"> #Sweater</a> <a href="javascript:void(0);"> #Apparel</a>
			</div>
			<div class="row rfq_thum_imgs">
				<div class="col s12 m6 l4"><img src="images/sweater_3.png" alt="" /> </div>
				<div class="col s12 m6 l4"><img src="images/sweater_2.png" alt="" /> </div>
			</div>
			<div class="rfq_view_detail_wrap center-align">
				<button class="none_button btn_view_detail" onclick="myFunction()" id="rfqViewDetail">View Detail</button>
				<div class="rfq_view_detail_info">
					<h6>Query for Women's Sweater</h6>
					<table class="detail_table">
						<tbody>
							<tr>
								<td>Qty:</td>
								<td>2000 pcs</td>
							</tr>
							<tr>
								<td>Target price:</td>
								<td>$4.00</td>
							</tr>
							<tr>
								<td>Deliver to:</td>
								<td>London</td>
							</tr>
							<tr>
								<td>Within:</td>
								<td>May 5, 2022</td>
							</tr>
							<tr>
								<td>Payment method:</td>
								<td>LC</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="responses_wrap right-align">
				<span><i class="material-icons">favorite</i> Saved</span>
				<button class="none_button btn_responses" id="rfqResponse" ><i class="material-icons">arrow_drop_down</i> Responses <span class="respons_count">2</span> </button>
			</div>
			<div class="respones_detail_wrap">
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
			</div>
		</div>
	</div>
</div> --}}
<!-- RFQ html end -->


<div class="rfq-sent-list">
    <b>Rfq Lists</b>
    <table>
        <thead>
            <tr>
                <th>RFQ ID</th>
                <th>Title</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Destination</th>
                <th>Payment</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($rfqLists as $rfqSentList)
                <tr>
                    <td><b>{{ sprintf("%04d", $rfqSentList->id) }}</b></td>
                    <td>{{$rfqSentList->title}}</td>
                    <td>{{$rfqSentList->unit_price}}</td>
                    <td>{{$rfqSentList->quantity}}</td>
                    <td>{{$rfqSentList->destination}}</td>
                    <td>{{$rfqSentList->payment_method}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pagination-block-wrapper">
    <div class="col s12 center">
        {!! $rfqLists->links() !!}
    </div>
</div>

@endsection

@include('rfq._scripts')
