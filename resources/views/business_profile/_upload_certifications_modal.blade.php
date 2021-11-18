<div id="certification-upload-form-modal" class="modal">
    <div class="modal-content">
        <div id="certification-upload-errors">

        </div>

        <form  method="post" action="#" id="certification-upload-form"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
            <div class="row">
                <div class="form-group  certification-details-block">
                    <label>Certification Details</label>
                    <div class="certification-details-block">
                        <table class="certification-details-table-block">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Short description</th>
                                    <th>Image</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($business_profile->machineriesDetails)>0)
                                @foreach($business_profile->machineriesDetails as $machineriesDetail)
                                <tr>
                                    <td><input class="input-field" name="title[]" id="certification-title" type="text" class="form-control "  value="{{$machineriesDetail->machine_name}}" ></td>
                                    <td>
                                        <textarea class="input-field" name="cerification_short_description[]" id="certification-short-description" rows="4" cols="50"></textarea>
                                    </td>
                                    <td><input class="input-field" name="certification_image[]" id="certification-image" type="file"></td>
                                    <td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeCertificationDetails(this)"><i class="material-icons dp48">remove</i></a></td>
                                </tr>
                                @endforeach
                                @else
                                <tr id="certification-details-table-no-data">
                                    <td>No data</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addCertificationDetails()"><i class="material-icons dp48">add</i> Add More</a>
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