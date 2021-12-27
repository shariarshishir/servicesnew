<div id="certification-upload-form-modal" class="modal profile_form_modal">
    <div class="modal-content">
        <div id="certification-upload-errors">

        </div>

        <form  method="post" action="#" id="certification-upload-form"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
            <div class="row">
                {{-- <div class="input-field col s12">
                    <select class="select2" id="defaut_certification" multiple>
                      <option value="" disabled selected>Choose your option</option>
                      @foreach ($default_certification as $list)
                        <option value="{{$list->id}}">{{$list->certification_programs}}</option>
                      @endforeach
                    </select>
                    <label>Certification</label>
                </div>
                <div class="defaut-certification-block"></div> --}}
                <div class="form-group  certification-details-block">
                    <legend>Certification Details</legend>
                    <div class="certification-details-block">
                        <table class="certification-details-table-block">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Issue date</th>
                                    <th>Expiry date</th>
                                    <th>Short description</th>
                                    <th>Image</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="certificate-select2"  name="certification_id[]">
                                            <option value="" disabled selected>Choose your option</option>
                                            @foreach ($default_certification as $list)
                                            <option value="{{$list->id}}">{{$list->certification_programs}}</option>
                                            @endforeach
                                       </select>
                                    </td>
                                    <td><input type="date" name="issue_date[]"></td>
                                    <td><input type="date" name="expiry_date[]"></td>
                                    <td>
                                        <textarea class="input-field" name="short_description[]" id="certification-short-description" rows="4" cols="50"></textarea>
                                    </td>
                                    <td><input class="input-field file_upload" name="image[]" id="certification-image" type="file"></td>
                                    <td><a href="javascript:void(0);" class="btn_delete" onclick="removeCertificationDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="add_more_box">
                            <a href="javascript:void(0);" class="add-more-block" onclick="addCertificationDetails()"><i class="material-icons dp48">add</i> Add More</a>
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

@push('js')
<script>
     function addCertificationDetails()
    {
        $('#certification-details-table-no-data').hide();
        var html = '<tr>';
        html +='<td><select class="certificate-select2"  name="certification_id[]"><option value="" disabled selected>Choose your option</option>@foreach ($default_certification as $list)<option value="{{$list->id}}">{{$list->certification_programs}}</option>@endforeach</select></td>';
        html +='<td><input type="date" name="issue_date[]"></td>';
        html +='<td><input type="date" name="expiry_date[]"></td>';
        html +='<td><textarea class="input-field" name="short_description[]" id="certification-short-description" rows="4" cols="50"></textarea></td>';
        html +='<td><input name="image[]" class="input-field file_upload"  id="certification-image" type="file"></td>';
        html +='<td><a href="javascript:void(0);" class="btn_delete" onclick="removeCertificationDetails(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a></td>';
        html +='</tr>';
        $('.certification-details-table-block tbody').append(html);
        selectRefresh();

    }
    function removeCertificationDetails(el)
    {
        $(el).parent().parent().remove();
    }


</script>
@endpush
