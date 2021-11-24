<div id="export-destination-upload-form-modal" class="modal profile_form_modal">
    <div class="modal-content">
        <div id="export-destination-upload-errors">

        </div>

        <form  method="post" action="#" id="export-destination-upload-form"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
            <div class="row">
                <div class="form-group  export-destination-details-block">
                    <label>Export Destinations</label>
                    <div class="export-destination-details-block">
                        <table class="export-destination-table-block">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Short description</th>
                                    <th>Image</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($business_profile->exportDestinations)>0)
                                <tr>
                                    <td><input class="input-field" name="title[]" id="export-destination-title" type="text"  ></td>
                                    <td>
                                        <textarea class="input-field" name="short_description[]" id="export-destination-short-description" rows="4" cols="50"></textarea>
                                    </td>
                                    <td><input class="input-field file_upload" name="image[]" id="export-destination-image" type="file"></td>
                                    <td><a href="javascript:void(0);" class="btn_delete" onclick="removeExportDestinationDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>
                                </tr>
                                @else
                                <tr id="export-destination-details-table-no-data">
                                    <td>No data</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="add_more_box">
                            <a href="javascript:void(0);" class="add-more-block" onclick="addExportDestinationDetails()"><i class="material-icons dp48">add</i> Add More</a>
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