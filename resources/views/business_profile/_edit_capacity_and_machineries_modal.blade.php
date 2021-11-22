<div id="capacity-and-machineries-modal" class="modal profile_form_modal">
<div class="modal-content">
	<div id="capacity-machineries-errors">
	</div>
	<form  method="post" action="#" id="capacity-machinaries-form">
		@csrf
		<input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
		<div class="row">
			<div class="col s12 capacity_block_box">
				<div class="form-group production-capacity-block">
					<label>Production Capacity (Annual)</label>
					<div class="production-capacity-block">
						<table class="production-capacity-table-block">
							<thead>
								<tr>
									<th>Machine Type</th>
									<th>Annual Capacity</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@if(count($business_profile->productionCapacities)>0)
								@foreach($business_profile->productionCapacities as $productionCapacity)
								<tr>
									<td><input name="machine_type[]" id="machine_type" type="text" class="form-control "  value="{{$productionCapacity->machine_type}}" ></td>
									<td><input name="annual_capacity[]" id="annual_capacity" type="number" class="form-control "  value="{{$productionCapacity->annual_capacity}}" ></td>
									<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeProductionCapacity(this)"><i class="material-icons dp48">remove</i></a></td>
								</tr>
								@endforeach
								@else
								<tr id="production-capacity-table-no-data">
									<td>No data</td>
								</tr>
								@endif
							</tbody>
						</table>
						<a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block btn_green" onclick="addProductionCapacity()"><i class="material-icons dp48">add</i> Add More</a>
					</div>
				</div>
			</div>
			<div class="col s12 capacity_block_box">
				<div class="form-group categories-produced-block">
					<label>Categories Produced</label>
					<div class="categories-produced-block">
						<table class="categories-produced-table-block">
							<thead>
								<tr>
									<th>Type</th>
									<th>Percentage</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@if(count($business_profile->categoriesProduceds)>0)
								@foreach($business_profile->categoriesProduceds as $categoriesProduced)
								<tr>
									<td><input name="type[]" id="type" type="text" class="form-control "  value="{{$categoriesProduced->type}}" ></td>
									<td><input name="percentage[]" id="percentage" type="number" class="form-control "  value="{{$categoriesProduced->percentage}}" ></td>
									<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeCategoriesProduced(this)"><i class="material-icons dp48">remove</i></a></td>
								</tr>
								@endforeach
								@else
								<tr id="categories-produced-table-no-data">
									<td>No data</td>
								</tr>
								@endif
							</tbody>
						</table>
						<a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block btn_green" onclick="addCategoriesProduced()"><i class="material-icons dp48">add</i> Add More</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row capacity_block_box">
			<div class="form-group machinaries-details-block">
				<label>machinaries Details</label>
				<div class="machinaries-details-block">
					<table class="machinaries-details-table-block">
						<thead>
							<tr>
								<th>Machine Name</th>
								<th>Quantity</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@if(count($business_profile->machineriesDetails)>0)
							@foreach($business_profile->machineriesDetails as $machineriesDetail)
							<tr>
								<td><input name="machine_name[]" id="machine_name" type="text" class="form-control "  value="{{$machineriesDetail->machine_name}}" ></td>
								<td><input name="quantity[]" id="quantity" type="number" class="form-control "  value="{{$machineriesDetail->quantity}}" ></td>
								<td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeMachinariesDetails(this)"><i class="material-icons dp48">remove</i></a></td>
							</tr>
							@endforeach
							@else
							<tr id="machinaries-details-table-no-data">
								<td>No data</td>
							</tr>
							@endif
						</tbody>
					</table>
					<a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block btn_green" onclick="addMachinariesDetails()"><i class="material-icons dp48">add</i> Add More</a>
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