<div id="factory-tour-edit-modal-block" class="modal profile_form_modal">
    <div class="modal-content">
        <div id="factory-rour-edit-form-errors">

        </div>

        <form  method="post" action="#" id="factory-tour-edit-form"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="business_profile_id" value="{{$business_profile->id ?? ''}}">
            <input type="hidden" name="company_factory_tour_id"  value="{{$companyFactoryTour->id ?? ''}}">
            <input type="hidden" name="company_factory_tour_image_ids">
            <input type="hidden" name="company_factory_tour_large_image_ids">
            
            <div class="row">
                <div class="form-group input-field factory-tour-photo">
                    <legend>Virtual Tour Url</legend>
                    <input type="text" name="virtual_tour" value="{{$companyFactoryTour->virtual_tour ?? ''}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group factory-tour-photo factory_images_box">
                    <legend>Factory Images</legend>
                    
                    <div class="row factory_images_box_wrap">
                        @if(isset($companyFactoryTour->companyFactoryTourImages))
                        @if(count($companyFactoryTour->companyFactoryTourImages)>0 )
                        @foreach($companyFactoryTour->companyFactoryTourImages as $image)
                        <div class="col s6 m3 l2 uploaded-factory-image-block">
                            <a href="javascript:void(0)"  data-imageId="{{$image->id}}" class="delete-factory-image" ><i class="material-icons dp48">remove_circle_outline</i></a>
                            <img id="previous-uploaded-factory-image" src="{{asset('storage/'.$image->factory_image)}}" alt="preview image" style="max-height: 80px;min-height:80px">
                        </div>
                        @endforeach
                        @endif
                        @endif

                    </div>
                    
                    <div class="factory_file_uploader">

                        <label for="product-upload">Media</label>

                        <div class="factory-image-block row ">
                            <div class="upload_img_box_wrap col s6 m3 l2">
                                <a href="javascript:void(0);" class="btn_delete" onclick="removeFactoryImage(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a>
                                <div class="upload_imgage_box">
                                    <img id="preview-image-before-upload" src="https://via.placeholder.com/80" alt="preview image" style="max-height: 80px;min-height:80px">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="factory_images[]" placeholder="Choose image"  id="factory-image">
                                </div>
                            </div>
                        </div>

                        <div class="factory_add_more row">
                            <a href="javascript:void(0);" class="add-more-factory-image-block" onclick="addFactoryImageBlock()"><i class="material-icons dp48">add</i> Add More</a>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="form-group factory-tour-photo factory_large_images_box">
                    <legend>Factory Large Images</legend>

                    <div class="row factory_images_box_wrap">
                        @if(isset($companyFactoryTour->companyFactoryTourImages))
                        @if(count($companyFactoryTour->companyFactoryTourLargeImages)>0 )
                            @foreach($companyFactoryTour->companyFactoryTourLargeImages as $image)
                                <div class="col s6 m3 l2 uploaded-factory-large-image-block">
                                    <a href="javascript:void(0)"  data-largeImageId="{{$image->id}}" class="delete-factory-large-image" ><i class="material-icons dp48">remove_circle_outline</i></a>
                                    <img id="previous-uploaded-factory-image" src="{{asset('storage/'.$image->factory_large_image)}}" alt="preview image" style="max-height: 80px;min-height:80px">
                                </div>
                            @endforeach
                        @endif
                        @endif
                    </div>

                    <div class="factory_file_uploader">
                        <label for="product-upload">Media</label>
                        <div class="factory-large-image-block row">
                            <div class="upload_img_box_wrap col s6 m3 l2">
                                <a href="javascript:void(0);" class="btn_delete" onclick="removeFactoryLargeImage(this)"><i class="material-icons dp48">delete_outline</i> <span>Delete</span></a>
                                <div class="upload_imgage_box">
                                    <img id="preview-image-before-upload" src="https://via.placeholder.com/80" alt="preview image" style="max-height: 80px;min-height:80px">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="factory_large_images[]" placeholder="Choose image"  id="factory-large-image">
                                </div>
                            </div>
                        </div>
                        <div class="factory_add_more row">
                            <a href="javascript:void(0);" class="add-more-factory-large-image-block" onclick="addFactoryLargeImageBlock()"><i class="material-icons dp48">add</i> Add More</a>
                        </div>
                    </div>

                </div>
            </div>
           
            <div class="submit_btn_wrap" style="padding-top: 30px;">
                <div class="row">
                    <div class="col s12 m6 l6 left-align"><a href="#!" class="modal-close btn_grBorder">Cancel</a></div>
                    <div class="col s12 m6 l6 right-align">
                    <button class="btn waves-effect waves-light btn_green" type="submit" name="action">Submit</button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</div>        