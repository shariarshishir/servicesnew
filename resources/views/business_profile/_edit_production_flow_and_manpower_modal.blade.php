<div id="production-flow-and-manpower-modal" class="modal">
    <div class="modal-content">
        <div id="production-flow-and-manpower-errors">

        </div>

        <form  method="post" action="#" id="production-flow-and-manpower-form">
            @csrf
           <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
            <div class="row">
                <div class="form-group  production-flow-and-manpower-block">
                    <label>Production Capacity (Annual)</label>
                    <div class="production-flow-and-manpower-block">
                        <table class="production-flow-and-manpower-table-block">
                            <thead>
                                <tr>
                                    <th>Production Type</th>
                                    <th>No of Jacquard Machines</th>
                                    <th>Manpower</th>
                                    <th>Daily Capacity</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($business_profile->productionFlowAndManpowers)>0)
                                    @foreach($business_profile->productionFlowAndManpowers as $productionFlowAndManpower)
                                    <tr>
                                        <td><input name="production_type[]" id="production_type" type="text" class="form-control "  value="{{$productionFlowAndManpower->production_type}}" ></td>
                                        @foreach(json_decode($productionFlowAndManpower->flow_and_manpower) as $flowAndManpower)
                                            @if($flowAndManpower->name=='no_of_jacquard_machines')
                                            <td><input name="no_of_jacquard_machines[]" id="no_of_jacquard_machines" type="number" class="form-control "  value="{{$flowAndManpower->value}}"></td>
                                            @endif
                                            @if($flowAndManpower->name=='manpower')
                                            <td><input name="manpower[]" id="manpower" type="number" class="form-control " value="{{$flowAndManpower->value}}"></td>
                                            @endif
                                            @if($flowAndManpower->name=='daily_capacity')
                                            <td><input name="daily_capacity[]" id="daily_capacity" type="number" class="form-control "  value="{{$flowAndManpower->value}}"></td>
                                            @endif
                                        @endforeach
                                        <td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeProductionFlowAndManpower(this)"><i class="material-icons dp48">remove</i></a></td>
                                    </tr>
                                    @endforeach
                                    
                                @endif
                            </tbody>
                        </table>
                        <a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addProductionFlowAndManpower()"><i class="material-icons dp48">add</i> Add More</a>
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