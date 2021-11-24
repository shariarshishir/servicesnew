<div id="association-membership-upload-form-modal" class="modal profile_form_modal">
    <div class="modal-content">
        <div id="association-membership-upload-errors">

        </div>

        <form  method="post" action="#" id="association-membership-upload-form"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
            <div class="row">
                <div class="form-group  association-membership-details-block">
                    <label>Association memberships Details</label>
                    <div class="association-membership-details-block">
                        <table class="association-membership-details-table-block">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Short description</th>
                                    <th>Image</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($business_profile->associationMemberships)>0)
                                <tr>
                                    <td><input class="input-field" name="title[]" id="association-membership-title" type="text"  ></td>
                                    <td>
                                        <textarea class="input-field" name="short_description[]" id="association-membership-short-description" rows="4" cols="50"></textarea>
                                    </td>
                                    <td><input class="input-field file_upload" name="image[]" id="association-membership-image" type="file"></td>
                                    <td><a href="javascript:void(0);" class="btn_delete" onclick="removeAssociationMembershipDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>
                                </tr>
                                @else
                                <tr id="association-membership-details-table-no-data">
                                    <td>No data</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="add_more_box">
                            <a href="javascript:void(0);" class="add-more-block" onclick="addAssociationMembershipDetails()"><i class="material-icons dp48">add</i> Add More</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <!-- <div class="center-align submit_btn_wrap">
                <button class="btn waves-effect waves-light btn_green" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
            </div> -->

            <div class="submit_btn_wrap" style="padding-top: 30px;">
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