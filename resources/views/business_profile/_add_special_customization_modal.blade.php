<div id="special-customization-modal" class="modal profile_form_modal">
<div class="modal-content">
	<div id="special-customization-errors">
	</div>
	<form  method="post" action="#" id="special-customization-form">
		@csrf
		<input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
		
		<div class="row">
			<div class="form-group  special-customization-details-block">
				<label>Create sampling</label>
				<div class="special-customization-block">
					<table class="special-customization-table-block">
						<thead>
							<tr>
								<th>Name</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@if(count($business_profile->specialCustomizations)>0)
							@foreach($business_profile->specialCustomizations as $specialCustomization)
							<tr>
								<td><input name="special_customization_title[]" id="special-customizations-title" type="text" class="input-field" value="{{$specialCustomization->title}}" ></td>
								<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeSpecialCustomizationDetails(this)"><i class="material-icons dp48">remove</i></a></td>
							</tr>
							@endforeach
							@else
							<tr id="special-customization-table-no-data">
								<td>No data</td>
							</tr>
							@endif
						</tbody>
					</table>
					<a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block btn_green" onclick="addSpecialCustomizationsDetails()"><i class="material-icons dp48">add</i> Add More</a>
				</div>
			</div>
		</div>
		<div class="center-align submit_btn_wrap">
			<button class="btn waves-effect waves-light btn_green" type="submit" name="action">Submit
				<i class="material-icons right">send</i>
			</button>
		</div>
	</form>
	<div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-green btn-flat"><i class="material-icons">close</i></a>
	</div>
</div>
</div>