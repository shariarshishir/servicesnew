<div id="product-add-modal-block" class="modal ">

    <div class="modal-content">
        <section class="ic-buying-req">
            <div class="container">
                <div class="row">
                    <div class="title">
                        <legend>Upload Product</legend>
                        <!-- <p>Upload your new product</p> -->
                    </div>
                </div>
                <div id="manufacture-product-upload-errors"></div>

                <form action="" method="post" enctype="multipart/form-data" id="manufacture-product-upload-form">
                    @csrf
                    <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
                    <input type="hidden" name="industry" value="{{$business_profile->industry_type}}">
                    {{-- <div class="row"> --}}
                        <div class="form-group input-field row">
                            <div class="col s12 m3 l3">
                                <label for="product_category_id">{{ __('Product Category') }}</label>
                            </div>
                            <div class="col s12 m9 l9">
                                <select name="category_id" class="select2 browser-default" id="category_id">
                                    <option value="" selected="true">Choose your option</option>
                                    @foreach($manufacture_product_categories_type[$business_profile->industry_type ?? 'apparel'] as $product_category)
                                        <option value="{{ $product_category->id }}">{{ $product_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger error-text category_id_err"></span>
                        </div>
                        {{-- <div class="row input-field">
                            <div class="col s12 m3 l3">
                                <label for="product-cat" class="select-icon">Product subcategory</label>
                            </div>
                            <div class="col s12 m9 l9">
                                <select class="form-control appearance-none" name="product_subcategory_id" id="product_subcategory"></select>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="row input-field">
                            <div class="col s12 m3 l3">
                                <label for="producut-title">Title</label>
                            </div>
                            <div class="col s12 m9 l9">
                                <input type="text" id="producut-title" name="title" class="form-control" placeholder="Product Title ..." required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6 input-field">
                                <div class="s12">
                                    <label for="producut-quality">Price Range</label>
                                </div>
                                <input type="text" name="price_per_unit" id="producut-quality" class="form-control" placeholder="ex. 5.00 - 6.00" required>
                            </div>
                            <div class="col s12 m6 l6 input-field">
                                <div class="s12">
                                    <label for="price_unit">Price Unit</label>
                                </div>
                                <select class="select2 browser-default price_unit" name="price_unit">
                                    <option value="BDT">BDT</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6 l6 input-field">
                                <div class="s12">
                                    <label for="product-moq">MOQ</label>
                                </div>
                                <input type="number" name="moq" id="product-moq" class="form-control" placeholder="Minimum Order Quantity" required>
                            </div>
                            <div class="col s12 m6 l6 input-field">
                                <div class="s12">
                                    <label for="qty_unit">Qty Unit</label>
                                </div>
                                <select class="select2 browser-default qty_unit" name="qty_unit">
                                    <option value="Pcs">Pcs</option>
                                    <option value="Lbs">Lbs</option>
                                    <option value="Gauge">Gauge</option>
                                    <option value="Kg">Kg</option>
                                    <option value="Meter">Meter</option>
                                    <option value="Dozens">Dozens</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="product_colorSizw_wrap">
                        <div class="input-field row">
                            <div class="col s12 m3 l3 ">
                                <label for="product-colors">Colors <small>EXP: Red,Blue,...</small></label>
                            </div>
                            <div class="col s12 m9 l9 product_color_box">
                                <select class="select2 browser-default product-colors" name="colors[]" id="colors" multiple>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="input-field row">
                            <div class="col s12 m3 l3 ">
                                <label for="product-sizes">Sizes <small>EXP: XL,XXL,...</small></label>
                            </div>
                            <div class="col s12 m9 l9 product_size_box">
                                <select class="select2 browser-default product-sizes" name="sizes[]" id="sizes"  multiple="multiple">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size }}">{{ ucfirst($size) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-field row">
                        <div class="col s12 m3 l3">
                            <label for="product-desc">Product Details</label>
                        </div>
                        <div class="col s12 m9 l9 ">
                            <textarea name="product_details" id="product-desc" class="form-control editor" cols="30" rows="10" placeholder="Product Details" ></textarea>
                        </div>
                        
                    </div>
                    <div class="input-field row">
                        <div class="col s12 m3 l3 ">
                            <label for="product-spec">Full specification</label>
                        </div>
                        <div class="col s12 m9 l9 ">
                            <textarea name="product_specification" id="product-spec" class="form-control editor" cols="30" rows="10" placeholder="Full Specification" ></textarea>
                        </div>
                    </div>
                    <div class="input-field row">
                        <div class="col s12 m3 l3 ">
                            <label for="lead_time">Lead time</label>
                        </div>
                        <div class="col s12 m9 l9 ">
                            <input type="text" name="lead_time" id="lead_time" class="form-control" placeholder="Lead Time" required>
                        </div>
                    </div>
                    <div class="product_media_wrap">
                        <div class="input-field">
                            <div class="s12">
                                <label for="product-upload">Media</label>
                            </div>
                            <div class="row center-align" style="padding-top: 25px;">
                                <!--1-->
                                <div class="col s6 m2 l2 center-align">
                                    <div class="media_img">
                                        <img src="https://via.placeholder.com/80" id="img1" class="img-thumbnail">
                                    </div>
                                    <div class="clear10"></div>
                                    <div class="col-md-12" style="text-align:center;">
                                    <div id="msg"></div>
                                    {{-- <form method="post" id="image-form"> --}}
                                        <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img1')">
                                        <div class="input-group my-3" style="display:block;">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        </div>
                                    {{-- </form> --}}
                                    </div>
                                </div>
                                <!--/1-->

                                <!--2-->
                                <div class="col s6 m2 l2 center-align">
                                    <div class="media_img">
                                    <img src="https://via.placeholder.com/80" id="img2" class="img-thumbnail">
                                    </div>
                                    <div class="clear10"></div>
                                    <div class="col-md-12" style="text-align:center;">
                                    <div id="msg"></div>
                                    {{-- <form method="post" id="image-form"> --}}
                                        <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img2')">
                                        <div class="input-group my-3" style="display:block;">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        </div>
                                    {{-- </form> --}}
                                    </div>
                                </div>
                                <!--/2-->

                                <!--3-->
                                <div class="col s6 m2 l2 center-align">
                                    <div class="media_img">
                                    <img src="https://via.placeholder.com/80" id="img3" class="img-thumbnail">
                                    </div>
                                    <div class="clear10"></div>
                                    <div class="col-md-12" style="text-align:center;">
                                    <div id="msg"></div>
                                    {{-- <form method="post" id="image-form"> --}}
                                        <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img3')">
                                        <div class="input-group my-3" style="display:block;">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        </div>
                                    {{-- </form> --}}
                                    </div>
                                </div>
                                <!--/3-->

                                <!--4-->
                                <div class="col s6 m2 l2 center-align">
                                    <div class="media_img">
                                    <img src="https://via.placeholder.com/80" id="img4" class="img-thumbnail">
                                    </div>
                                    <div class="clear10"></div>
                                    <div class="col-md-12" style="text-align:center;">
                                    <div id="msg"></div>
                                    {{-- <form method="post" id="image-form"> --}}
                                        <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img4')">
                                        <div class="input-group my-3" style="display:block;">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        </div>
                                    {{-- </form> --}}
                                    </div>
                                </div>
                                <!--/4-->

                                <!--5-->
                                <div class="col s6 m2 l2 center-align">
                                    <div class="media_img">
                                    <img src="https://via.placeholder.com/80" id="img5" class="img-thumbnail">
                                    </div>
                                    <div class="clear10"></div>
                                    <div class="col-md-12" style="text-align:center;">
                                    <div id="msg"></div>
                                    {{-- <form method="post" id="image-form"> --}}
                                        <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img5')">
                                        <div class="input-group my-3" style="display:block;">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        </div>
                                    {{-- </form> --}}
                                    </div>
                                </div>
                                <!--/5-->
                            </div>

                            <div class="input-field">
                                {{--<input type="file" id="files" name="product_images[]" multiple class="form-control"/>--}}
                            </div>
                        </div>
                    </div><br>
                    {{-- video --}}
                    <div class="row input-field product-upload-block">
                        <div class="col s12 m3 l3">
                            <label class="active">Video:</label>
                        </div>
                        <div class="col s12 m9 l9" id="lineitems">
                            <input class="uplodad_video_box" type="file" name="video">
                        </div>
                    </div>


                    <!-- <div class="submit_wrap right-align">
                        <button type="submit" class="btn_green btn waves-effect waves-light green seller_product_create">Save</button>
                        <button type="button" class="btn_green btn modal-close waves-effect waves-light green btn-back-to-product-list">Cancel</button>
                    </div> -->
                    <div class="submit_btn_wrap">
                        <div class="row">
                            <div class="col s12 m6 l4 left-align"><a href="#!" class="modal-close btn_grBorder">Cancel</a></div>
                            <div class="col s12 m6 l8 right-align">
                                <button type="submit" class="btn_green  seller_product_create">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <!-- <div class="modal-footer">
        <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat">
            <i class="material-icons green-text text-darken-1">close</i>
        </a>
    </div> -->

</div>

@push('js')
    <script>
         function readURL(input,id)
        {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                $('#'+id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

    //add more video
    var  lineitemcontent= '<input type="file" name="videos[]"><p onclick="removeVideoEl(this);">Remove</p>';
    function addMoreVideo(obj)
        {
            $(obj).parent().append(lineitemcontent);
            // $('#lineitems').append(lineitemcontent);
        }

    function removeVideoEl(el)
    {
        $(el).prev('input').remove();
        $(el).remove();
    }
    </script>
@endpush
