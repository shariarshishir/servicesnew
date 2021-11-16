<div id="product-add-modal-block" class="modal modal-fixed-footer ">

    <div class="modal-content">
        <section class="ic-buying-req">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 title">
                        <h2>Upload Product</h2>
                        <p>Upload your new product</p>
                    </div>
                </div>
                <div id="manufacture-product-upload-errors"></div>

                <form action="" method="post" enctype="multipart/form-data" id="manufacture-product-upload-form">
                    @csrf
                    <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
                    <input type="hidden" name="industry" value="{{$business_profile->industry_type}}">
                    {{-- <div class="row"> --}}
                        <div class="form-group row">
                            <label for="product_category_id">{{ __('Product Category') }}</label>
                            <select name="category_id" class="select2 browser-default" id="category_id">
                                <option value="" selected="true">Choose your option</option>
                                @foreach($manufacture_product_categories_type[$business_profile->industry_type ?? 'apparel'] as $product_category)
                                    <option value="{{ $product_category->id }}">{{ $product_category->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text category_id_err"></span>
                        </div>
                        {{-- <div class="col-xs-12">
                            <label for="product-cat" class="select-icon">Product subcategory</label>
                            <select class="form-control appearance-none" name="product_subcategory_id" id="product_subcategory"></select>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col m12">
                            <label for="producut-title">Title</label>
                            <input type="text" id="producut-title" name="title" class="form-control" placeholder="Product Title ..." required>
                        </div>
                        <div class="col m12">
                            <div class="col m6">
                                <label for="producut-quality">Price Range</label>
                                <input type="text" name="price_per_unit" id="producut-quality" class="form-control" placeholder="ex. 5.00 - 6.00" required>
                            </div>
                            <div class="col m6">
                                <label for="price_unit">Price Unit</label>
                                <select class="select2 browser-default price_unit" name="price_unit">
                                    <option value="BDT">BDT</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>

                        </div>
                        <div class="col m12">
                        <div class="col m6">
                            <label for="product-moq">MOQ</label>
                            <input type="number" name="moq" id="product-moq" class="form-control" placeholder="Minimum Order Quantity" required>
                        </div>
                        <div class="col m6">
                            <label for="qty_unit">Qty Unit</label>
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

                    <div class="row">
                        <div class="col-sm-12 col-md-6 form-group">
                            <label for="product-colors">Colors <small>EXP: Red,Blue,...</small></label>
                            <select class="select2 browser-default product-colors" name="colors[]" id="colors" multiple>
                                @foreach ($colors as $color)
                                    <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6 form-group">
                            <label for="product-sizes">Sizes <small>EXP: XL,XXL,...</small></label>
                                <select class="select2 browser-default product-sizes" name="sizes[]" id="sizes"  multiple="multiple">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size }}">{{ ucfirst($size) }}</option>
                                    @endforeach
                                </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label for="product-desc">Product Details</label>
                            <textarea name="product_details" id="product-desc" class="form-control editor" cols="30" rows="10" placeholder="Product Details" ></textarea>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="product-spec">Full specification</label>
                            <textarea name="product_specification" id="product-spec" class="form-control editor" cols="30" rows="10" placeholder="Full Specification" ></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="lead_time">Lead time</label>
                            <input type="text" name="lead_time" id="lead_time" class="form-control" placeholder="Lead Time" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="">
                                <label for="product-upload">
                                    <span>Media</span>
                                </label>
                                <div class="col-lg-12">
                                    <div class="row" style="padding-top: 25px;">
                                        <!--1-->
                                        <div class="col-md-3" style="width:20%; text-align:center;">
                                            <div class="col-md-12">
                                              <img src="https://placehold.it/80x80" id="img1" class="img-thumbnail">
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
                                        <div class="col-md-3" style="width:20%; text-align:center;">
                                            <div class="col-md-12">
                                              <img src="https://placehold.it/80x80" id="img2" class="img-thumbnail">
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
                                        <div class="col-md-3" style="width:20%; text-align:center;">
                                            <div class="col-md-12">
                                              <img src="https://placehold.it/80x80" id="img3" class="img-thumbnail">
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
                                        <div class="col-md-3" style="width:20%; text-align:center;">
                                            <div class="col-md-12">
                                              <img src="https://placehold.it/80x80" id="img4" class="img-thumbnail">
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
                                        <div class="col-md-3" style="width:20%; text-align:center;">
                                            <div class="col-md-12">
                                              <img src="https://placehold.it/80x80" id="img5" class="img-thumbnail">
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
                                </div>
                                {{--<input type="file" id="files" name="product_images[]" multiple class="form-control"/>--}}
                            </div>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group row">
                                <button type="submit" class="btn waves-effect waves-light green seller_product_create">Save</button>
                                <button type="button" class="btn modal-close waves-effect waves-light green btn-back-to-product-list">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <div class="modal-footer">
        <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat">
            <i class="material-icons green-text text-darken-1">close</i>
        </a>
    </div>

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
    </script>
@endpush
