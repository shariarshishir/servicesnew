<div id="sustainability-commitment-modal" class="modal">
<div class="modal-content">
	<div id="sustainability-commitment-errors">
	</div>
	<form  method="post" action="#" id="sustainability-commitment-form">
		@csrf
		<input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
		
		<div class="row">
			<div class="form-group  sustainability-commitment-details-block">
				<label>Create sampling</label>
				<div class="sustainability-commitment-block">
					<table class="sustainability-commitment-table-block">
						<thead>
							<tr>
								<th>Term Name</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@if(count($business_profile->sustainabilityCommitments)>0)
							@foreach($business_profile->sustainabilityCommitments as $sustainabilityCommitment)
							<tr>
								<td><input name="sustainability_commitment_title[]" id="sustainability-Commitment-title" type="text" class="input-field" value="{{$sustainabilityCommitment->title}}" ></td>
								<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeSustainabilityCommitmentDetails(this)"><i class="material-icons dp48">remove</i></a></td>
							</tr>
							@endforeach
							@else
							<tr id="sustainability-commitment-table-no-data">
								<td>No data</td>
							</tr>
							@endif
						</tbody>
					</table>
					<a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addSustainabilityCommitmentDetails()"><i class="material-icons dp48">add</i> Add More</a>
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