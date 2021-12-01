<!-- profile tabcontent end -->
<div id="profile" class="tabcontent profile_table_design ">
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
						@if($company_overview->status==1)
						<td><i class="material-icons {{$company_overview->name}}_status" style="color:green">check_circle</i></td>
						@else
						<td><i class="material-icons {{$company_overview->name}}_status"style="color:gray">check_circle</i></td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="membership_wrap">
		<div class="row top_titleWrap upload_delete_wrap">
			<div class="col s6 m6">
				<h3>Association memberships test</h3>
			</div>
			<div class="col s6 m6 right-align editBox">
				<button type="button" data-target="association-membership-upload-form-modal" class="btn_upload btn_green_White modal-trigger"><span class="material-icons">file_upload</span></span> Upload</button>
				<button type="button" class="btn_delete btn_green_White delete-association-membership-button"><span><span class="material-icons">delete</span></span> Delete</button>
			</div>
		</div>
		<div class="membership_textBox association-membership-block">
			@foreach($business_profile->associationMemberships as $associationMembership)
			<div class="center-align association-membership-img">
				<a href="javascript:void(0)" style="display: none;"data-id="{{$associationMembership->id}}" class="remove-association-membership"><i class="material-icons dp48">remove_circle_outline</i></a>
				<div class="imgbox"><img  src="{{ asset('storage/'.$associationMembership->image) }}" alt=""></div>
				<p>{{$associationMembership->title}}</p>
			</div>
			@endforeach
		</div>
	</div>
	<div class="pr_highlights_wrap">
		<div class="row top_titleWrap upload_delete_wrap">
			<div class="col s6 m6">
				<h3>PR Highlights</h3>
			</div>
			<div class="col s6 m6 right-align editBox">
				<button type="button" data-target="press-highlight-upload-form-modal" class="btn_upload btn_green_White modal-trigger"  ><span class="material-icons">file_upload</span></span> Upload</button>
				<button type="button" class="btn_delete btn_green_White delete-press-highlight-button" ><span><span class="material-icons">delete</span></span> Delete</button>
			</div>
		</div>
		<div class="row press-highlight-block">
		@foreach($business_profile->pressHighlights as $pressHighlight)
			<div class="col s6 m4 l2 paper_img press-highlight-img">
				<a href="javascript:void(0)" style="display: none;"data-id="{{$pressHighlight->id}}" class="remove-press-highlight"><i class="material-icons dp48">remove_circle_outline</i></a>
				<div class="press_img">
					<img src="{{ asset('storage/'.$pressHighlight->image) }}" alt="" />
				</div>
			</div>
		@endforeach
			
		</div>
	</div>
</div>
