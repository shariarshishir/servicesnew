<div id="business-term-modal" class="modal profile_form_modal">
<div class="modal-content">
	<div id="business-term-errors">
	</div>
	<form  method="post" action="#" id="business-term-form">
		@csrf
		<input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
		
		<div class="row">
			<div class="form-group  business-term-details-block">
				<legend>Create Business Terms</legend>
				<div class="business-term-block">
					<table class="business-term-table-block">
						<thead>
							<tr>
								<th>Term Name</th>
								<th>Quantity</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@if(count($business_profile->businessTerms)>0)
							@foreach($business_profile->businessTerms as $businessTerm)
							<tr>
								<td><input name="business_term_title[]" id="business-term-title" type="text" class="input-field" value="{{$businessTerm->title}}" ></td>
								<td><input name="business_term_quantity[]" id="business-term-quantity" type="number" class="input-field"  value="{{$businessTerm->quantity}}" ></td>
								<td><a href="javascript:void(0);" class="btn_delete" onclick="removeBusinessTermDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>
							</tr>
							@endforeach
							@else
							<tr id="business-term-details-table-no-data">
							<td><input name="business_term_title[]" id="business-term-title" type="text" class="input-field" value="" ></td>
								<td><input name="business_term_quantity[]" id="business-term-quantity" type="number" class="input-field"  value="" ></td>
								<td><a href="javascript:void(0);" class="btn_delete" onclick="removeBusinessTermDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>
							</tr>
							@endif
						</tbody>
					</table>
					<div class="add_more_box">
						<a href="javascript:void(0);" class="add-more-block" onclick="addBusinessTermDetails()"><i class="material-icons dp48">add</i> Add More</a>
					</div>
					
				</div>
			</div>
		</div>
	
		<div class="submit_btn_wrap">
			<div class="row">
				<div class="col s12 m6 l6 left-align"><a href="#!" class="modal-close btn_grBorder">Cancel</a></div>
				<div class="col s12 m6 l6 right-align">
					<button class="btn waves-effect waves-light btn_green" type="submit" name="action">Submit </button>
				</div>
			</div>
		</div>


	</form>

	<!-- <div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-green btn-flat"><i class="material-icons">close</i></a>
	</div> -->

</div>
</div>