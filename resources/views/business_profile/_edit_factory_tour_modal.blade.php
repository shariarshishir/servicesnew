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
                <div class="form-group factory-tour-photo factory_mages_box">
                    <legend>Factory Images</legend>
                    
                    <div class="row">
                        @if(isset($companyFactoryTour->companyFactoryTourImages))
                        @if(count($companyFactoryTour->companyFactoryTourImages)>0 )
                        @foreach($companyFactoryTour->companyFactoryTourImages as $image)
                        <div class="col-md-12 mb-2 factory-image-block">
                            <a href="javascript:void(0)"  data-imageId="{{$image->id}}" class="delete-factory-image" ><i class="material-icons dp48">remove_circle_outline</i></a>
                            <img id="previous-uploaded-factory-image" src="{{asset('storage/'.$image->factory_image)}}" alt="preview image" style="max-height: 80px;min-height:80px">
                        </div>
                        @endforeach
                        @endif
                        @endif
                        <div class="col 12 factory-image-block">
                            <div class="col l2">
                                <label for="product-upload">Media</label>
                            </div>
                            <br>
                            <div class="col-md-12 mb-2">
                                <img id="preview-image-before-upload" src="https://via.placeholder.com/80" alt="preview image" style="max-height: 80px;min-height:80px">
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
                <div class="form-group factory-tour-photo factory_large_mages_box">
                    <legend>Factory Large Images</legend>

                    <div class="row">
                        @if(isset($companyFactoryTour->companyFactoryTourImages))
                        @if(count($companyFactoryTour->companyFactoryTourLargeImages)>0 )
                            @foreach($companyFactoryTour->companyFactoryTourLargeImages as $image)
                                <div class="col-md-12 mb-2 factory-large-image-block">
                                    <a href="javascript:void(0)"  data-largeImageId="{{$image->id}}" class="delete-factory-large-image" ><i class="material-icons dp48">remove_circle_outline</i></a>
                                    <img id="previous-uploaded-factory-image" src="{{asset('storage/'.$image->factory_large_image)}}" alt="preview image" style="max-height: 80px;min-height:80px">
                                </div>
                            @endforeach
                        @endif
                        @endif
                        <div class="col 12 factory-large-image-block">
                            <div class="col l2">
                                <label for="product-upload">Media</label>
                            </div>
                            <br>
                            <div class="col-md-12 mb-2">
                                <img id="preview-image-before-upload" src="https://via.placeholder.com/80" alt="preview image" style="max-height: 80px;min-height:80px">
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
          

            
            <!-- <div class="row">
                <div class="col s12 m6 l6 right-align">
                    <button class="btn waves-effect waves-light btn_green" type="submit" name="action">Submit</button>
                </div>
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
    <!-- <div class="modal-footer">
        <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat">
            <i class="material-icons green-text text-darken-1">close</i>
        </a>
    </div> -->
</div>        