<div id="export-destination-upload-form-modal" class="modal profile_form_modal">
    <div class="modal-content">
        <div id="export-destination-upload-errors">

        </div>

        <form  method="post" action="#" id="export-destination-upload-form"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
            <div class="row">
                <div class="form-group  export-destination-details-block">
                    <legend>
                        <div class="row">
                            <span class="tooltipped_title">Export Destinations</span> <a class="tooltipped" data-position="top" data-tooltip="Mention the countries you export most often.<br />This information will help to recommend your profile <br />to the buyers from those regions."><i class="material-icons">info</i></a>
                        </div>
                    </legend>
                    <div class="export-destination-details-block">
                        <div class="no_more_tables">
                            <table class="export-destination-table-block">
                                <thead class="cf">
                                    <tr>
                                        <th>Name</th>
                                        <th>Short description</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-title="Name" class="input-field">
                                            <select name="country_id[]"  class="certificate-select2">
                                                <option value="" disabled selected>Choose your option</option>
                                                @foreach ($country as $key => $name)
                                                    <option value="{{$key}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td data-title="Short Description">
                                            <textarea class="input-field" name="short_description[]" id="export-destination-short-description" rows="4" cols="50"></textarea>
                                        </td>
                                        <td><a href="javascript:void(0);" class="btn_delete" onclick="removeExportDestinationDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

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
