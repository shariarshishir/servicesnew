<div id="business-term-modal" class="modal">
<div class="modal-content">
	<div id="business-term-errors">
	</div>
	<form  method="post" action="#" id="business-term-form">
		@csrf
		<input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
		
		<div class="row">
			<div class="form-group  business-term-details-block">
				<label>Create Business Terms</label>
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
								<td><input name="business_term_title[]" id="business-term-title" type="text" class="input-field" value="{{$businessTerm->machine_name}}" ></td>
								<td><input name="business_term_quantity[]" id="business-term-quantity" type="number" class="input-field"  value="{{$businessTerm->quantity}}" ></td>
								<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeBusinessTermDetails(this)"><i class="material-icons dp48">remove</i></a></td>
							</tr>
							@endforeach
							@else
							<tr id="business-term-details-table-no-data">
								<td>No data</td>
							</tr>
							@endif
						</tbody>
					</table>
					<a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addBusinessTermDetails()"><i class="material-icons dp48">add</i> Add More</a>
				</div>
			</div>
		</div>
		<button class="btn waves-effect waves-light" type="submit" name="action">Submit
		<i class="material-icons right">send</i>
		</button>
	</form>
	<div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-green btn-flat">close</a>
	</div>
</div>
</div>