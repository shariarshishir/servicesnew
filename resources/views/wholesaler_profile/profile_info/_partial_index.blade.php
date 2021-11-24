
<!-- Home tabcontent end -->
<div id="profile" class="tabcontent">
	<div class="overview_table_wrap">
		<div class="row top_titleWrap">
			<div class="col s6 m6">
				<h3>Company Overview</h3>
			</div>
			<div class="col s6 m6 right-align editBox">
				<button data-target="company-overview-modal" type="button" class="btn_edit btn_green_White modal-trigger"><span class="material-icons">border_color</span></span> Edit</button>
			</div>
		</div>
		<div class="overview_table box_shadow">
			<table>
				<tbody>
					@foreach (json_decode($business_profile->companyOverview->data) as $company_overview)
					<tr>
						<td>{{str_replace('_', ' ', ucfirst($company_overview->name))}}</td>
						<td class="{{$company_overview->name}}_value">{{$company_overview->value}}</td>
						<td class="{{$company_overview->name}}_status">{{$company_overview->status}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="membership_wrap">
		<div class="row top_titleWrap upload_delete_wrap">
			<div class="col s6 m6">
				<h3>Association memberships</h3>
			</div>
			<div class="col s6 m6 right-align editBox">
				<button type="button" class="btn_upload btn_green_White"><span class="material-icons">file_upload</span></span> Upload</button>
				<button type="button" class="btn_delete btn_green_White"><span><span class="material-icons">delete</span></span> Delete</button>
			</div>
		</div>
		<div class="row membership_textBox">
			<div class="col s12 m6 l5 center-align">
				<div class="imgbox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/bgmea.png')}}" alt="" /></a></div>
				<p>Bangladesh Garment Manufacturers and Exporters Association (BGMEA)</p>
			</div>
			<div class="col s12 m6 l5 center-align">
				<div class="imgbox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/bkmes.png')}}" alt="" /></a></div>
				<p>Bangladesh Knitwear Manufacturers and Exporters Association (BKMEA)</p>
			</div>
		</div>
	</div>
	<div class="pr_highlights_wrap">
		<div class="row top_titleWrap upload_delete_wrap">
			<div class="col s6 m6">
				<h3>PR Highlights</h3>
			</div>
			<div class="col s6 m6 right-align editBox">
				<button type="button" class="btn_upload btn_green_White" ><span class="material-icons">file_upload</span></span> Upload</button>
				<button type="button" class="btn_delete btn_green_White" ><span><span class="material-icons">delete</span></span> Delete</button>
			</div>
		</div>
		<div class="row">
			<div class="col s6 m4 l2 paper_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/fex.png')}}" alt="" /></a></div>
			<div class="col s6 m4 l2 paper_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/alo.png')}}" alt="" /></a></div>
			<div class="col s6 m4 l3 paper_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/dtribune.png')}}" alt="" /></a></div>
			<div class="col s6 m4 l2 paper_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/bs.png')}}" alt="" /></a></div>
			<div class="col s6 m4 l3 paper_img"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/dstar.png')}}" alt="" /></a></div>
		</div>
	</div>
</div>