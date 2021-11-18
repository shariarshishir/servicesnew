<div id="certification-upload-form-modal" class="modal">
    <div class="modal-content">
        <div id="certification-upload-errors">

        </div>

        <form  method="post" action="#" id="certification-upload-form">
            @csrf
           <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
           <input type="file" name="certification_image" >
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                <i class="material-icons right">send</i>
            </button>
        </form>
    
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">close</a>
        </div>
    </div>
</div>