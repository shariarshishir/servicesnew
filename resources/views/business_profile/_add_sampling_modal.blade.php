<div id="sampling-modal" class="modal">
<div class="modal-content">
	<div id="sampling-errors">
	</div>
	<form  method="post" action="#" id="sampling-form">
		@csrf
		<input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
		
		<div class="row">
			<div class="form-group  sampling-details-block">
				<label>Create sampling</label>
				<div class="sampling-block">
					<table class="sampling-table-block">
						<thead>
							<tr>
								<th> Name</th>
								<th>Quantity</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@if(count($business_profile->samplings)>0)
							@foreach($business_profile->samplings as $sampling)
							<tr>
								<td><input name="sampling_title[]" id="sampling-title" type="text" class="input-field" value="{{$sampling->title}}" ></td>
								<td><input name="sampling_quantity[]" id="sampling-quantity" type="number" class="input-field"  value="{{$sampling->quantity}}" ></td>
								<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeSamplingDetails(this)"><i class="material-icons dp48">remove</i></a></td>
							</tr>
							@endforeach
							@else
							<tr id="sampling-details-table-no-data">
								<td>No data</td>
							</tr>
							@endif
						</tbody>
					</table>
					<a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addSamplingDetails()"><i class="material-icons dp48">add</i> Add More</a>
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