<div id="factory-tour-add-modal-block" class="modal modal-fixed-footer ">
<div class="modal-content">
        <div id="factory-tour-form-errors">

        </div>

        <form  method="post" action="#" id="factory-tour-form"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
            <div class="row">
                <div class="form-group  factory-tour-photo">
                    <legend>Virtual Tour Url</legend>
                    <input type="text" name="virtual_tour" value=""  >
                </div>
            </div>
            <div class="row">
                <div class="form-group  factory-tour-photo">
                    <legend>Factory Images</legend>

                    <div class="row">
                        <div class="col 12 factory-image-block">
                            <div class="col l2">
                                <label for="product-upload">Media</label>
                            </div>
                            <br>
                            <div class="col-md-12 mb-2">
                                <img id="preview-image-before-upload" src="https://via.placeholder.com/80"
                                    alt="preview image" style="max-height: 80px;min-height:80px">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" name="factory_images[]" placeholder="Choose image"  id="factory-image">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <a href="javascript:void(0);" class="add-more-factory-image-block" onclick="addFactoryImageBlock()"><i class="material-icons dp48">add</i> Add More</a>
                    </div>

                    
                        
                </div>
            </div>
            
            <div class="row">
                <div class="form-group  factory-tour-photo">
                    <legend>Factory Large Images</legend>

                    <div class="row">
                        <div class="col 12 factory-large-image-block">
                            <div class="col l2">
                                <label for="product-upload">Media</label>
                            </div>
                            <br>
                            <div class="col-md-12 mb-2">
                                <img id="preview-image-before-upload" src="https://via.placeholder.com/80"
                                    alt="preview image" style="max-height: 80px;min-height:80px">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" name="factory_large_images[]" placeholder="Choose image"  id="factory-large-image">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <a href="javascript:void(0);" class="add-more-factory-large-image-block" onclick="addFactoryLargeImageBlock()"><i class="material-icons dp48">add</i> Add More</a>
                    </div>

                    
                        
                </div>
            </div>
          

            
                <div class="row">
                    <div class="col s12 m6 l6 right-align">
                        <button class="btn waves-effect waves-light btn_green" type="submit" name="action">Submit</button>
                    </div>
                </div>
            
        </form>
    
        <!-- <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat"><i class="material-icons">close</i></a>
        </div> -->
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat">
            <i class="material-icons green-text text-darken-1">close</i>
        </a>
    </div>
</div>        