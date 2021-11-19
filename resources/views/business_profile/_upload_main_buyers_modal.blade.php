<div id="main-buyers-upload-form-modal" class="modal">
    <div class="modal-content">
        <div id="main-buyers-upload-errors">

        </div>

        <form  method="post" action="#" id="main-buyer-upload-form"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
            <div class="row">
                <div class="form-group  main-buyers-details-block">
                    <label>Main buyers Details</label>
                    <div class="main-buyers-details-block">
                        <table class="main-buyers-details-table-block">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Short description</th>
                                    <th>Image</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($business_profile->mainBuyers)>0)
                                <tr>
                                    <td><input class="input-field" name="title[]" id="main-buyer-title" type="text"  ></td>
                                    <td>
                                        <textarea class="input-field" name="short_description[]" id="main-buyer-short-description" rows="4" cols="50"></textarea>
                                    </td>
                                    <td><input class="input-field" name="image[]" id="main-buyer-image" type="file"></td>
                                    <td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeMainBuyersDetails(this)"><i class="material-icons dp48">remove</i></a></td>
                                </tr>
                                @else
                                <tr id="main-buyers-details-table-no-data">
                                    <td>No data</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addMainBuyersDetails()"><i class="material-icons dp48">add</i> Add More</a>
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