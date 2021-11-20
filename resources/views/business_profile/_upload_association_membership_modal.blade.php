<div id="association-membership-upload-form-modal" class="modal">
    <div class="modal-content">
        <div id="association-membership-upload-errors">

        </div>

        <form  method="post" action="#" id="association-membership-upload-form"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
            <div class="row">
                <div class="form-group  association-membership-details-block">
                    <label>Main buyers Details</label>
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
                                    <td><input class="input-field" name="image[]" id="association-membership-image" type="file"></td>
                                    <td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeAssociationMembershipDetails(this)"><i class="material-icons dp48">remove</i></a></td>
                                </tr>
                                @else
                                <tr id="association-membership-details-table-no-data">
                                    <td>No data</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addAssociationMembershipDetails()"><i class="material-icons dp48">add</i> Add More</a>
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