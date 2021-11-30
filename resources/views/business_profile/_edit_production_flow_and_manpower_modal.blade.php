<div id="production-flow-and-manpower-modal" class="modal profile_form_modal">
    <div class="modal-content">
        <div id="production-flow-and-manpower-errors">

        </div>

        <form  method="post" action="#" id="production-flow-and-manpower-form">
            @csrf
           <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
            <div class="row">
                <div class="form-group production-flow-and-manpower-block">
                    <legend>Production Capacity (Annual)</legend>
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
                                    <tr id="production-flow-and-manpower-table-no-data">
                                        <td><input name="production_type[]" id="production_type" type="text" class="form-control "  value="{{$productionFlowAndManpower->production_type}}" ></td>
                                        @foreach(json_decode($productionFlowAndManpower->flow_and_manpower) as $flowAndManpower)
                                            @if($flowAndManpower->name=='No of Jacquard Machines')
                                            <td><input name="no_of_jacquard_machines[]" id="no_of_jacquard_machines" type="number" class="form-control "  value="{{$flowAndManpower->value}}"></td>
                                            @endif
                                            @if($flowAndManpower->name=='Manpower')
                                            <td><input name="manpower[]" id="manpower" type="number" class="form-control " value="{{$flowAndManpower->value}}"></td>
                                            @endif
                                            @if($flowAndManpower->name=='Capacity Daily')
                                            <td><input name="daily_capacity[]" id="daily_capacity" type="number" class="form-control "  value="{{$flowAndManpower->value}}"></td>
                                            @endif
                                        @endforeach
                                        <td><a href="javascript:void(0);" class="btn_delete" onclick="removeProductionFlowAndManpower(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr id="production-flow-and-manpower-table-no-data">
                                    <td><input name="production_type[]" id="production_type" type="text" class="form-control "  value="" ></td>
                                    <td><input name="no_of_jacquard_machines[]" id="no_of_jacquard_machines" type="number" class="form-control "  value=""></td>
                                    <td><input name="manpower[]" id="manpower" type="number" class="form-control " value=""></td>
                                    <td><input name="daily_capacity[]" id="daily_capacity" type="number" class="form-control "  value=""></td>
                                    <td><a href="javascript:void(0);" class="btn_delete" onclick="removeProductionFlowAndManpower(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="add_more_box">
                            <a href="javascript:void(0);" class="add-more-block" onclick="addProductionFlowAndManpower()"><i class="material-icons dp48">add</i> Add More</a>
                        </div>
                        
                    </div>
                </div>
            </div>

            

            <div class="submit_btn_wrap">
                <div class="row">
                    <div class="col s12 m6 l6 left-align"><a href="#!" class="modal-close btn_grBorder">Cancel</a></div>
                    <div class="col s12 m6 l6 right-align">
                        <button class="btn waves-effect waves-light btn_green" type="submit" name="action">Submit</button>
                    </div>
                </div>
            </div>


        </form>
    
        <!-- <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat"><i class="material-icons">close</i></a>
        </div> -->
    </div>
</div>