<section class="ic-buying-req">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 title">
                <h2>Upload Product</h2>
                <p>Upload your new product</p>
            </div>
        </div>
        <div id="manufacture-product-upload-errors"></div>

            <input type="hidden" name="edit_product_id" value="{{$product->id}}" >
            {{-- <div class="row"> --}}
                <div class="form-group row">
                    <label for="product_category_id">{{ __('Product Category') }}</label>
                    <select name="category_id" class="select2 browser-default" id="category_id">
                        <option value="" selected="true">Choose your option</option>
                        @foreach($manufacture_product_categories_type[$business_profile->industry_type ?? 'apparel'] as $product_category)
                            <option value="{{ $product_category->id }}" @if($product_category->id == $product->product_category){{ 'selected' }} @endif>{{ $product_category->name }}</option>
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
                    <input type="text" id="producut-title" name="title" value="{{$product->title}}" class="form-control" placeholder="Product Title ..." required>
                </div>
                <div class="col m12">
                    <div class="col m6">
                        <label for="producut-quality">Price Range</label>
                        <input type="text" name="price_per_unit" value="{{$product->price_per_unit}}" id="producut-quality" class="form-control" placeholder="ex. 5.00 - 6.00" required>
                    </div>
                    <div class="col m6">
                        <label for="price_unit">Price Unit</label>
                        <select class="select2 browser-default price_unit" name="price_unit">
                            <option value="BDT" {{($product->price_unit == 'BDT') ? 'selected' : ''}}>BDT</option>
                            <option value="USD" {{($product->price_unit == 'USD') ? 'selected' : ''}}>USD</option>
                        </select>
                    </div>

                </div>
                <div class="col m12">
                <div class="col m6">
                    <label for="product-moq">MOQ</label>
                    <input type="number" name="moq" value="{{ $product->moq }}" id="product-moq" class="form-control" placeholder="Minimum Order Quantity" required>
                </div>
                <div class="col m6">
                    <label for="qty_unit">Qty Unit</label>
                    <select class="select2 browser-default qty_unit" name="qty_unit">
                        <option value="Pcs" {{($product->qty_unit == 'Pcs') ? 'selected' : ''}}>Pcs</option>
                        <option value="Lbs" {{($product->qty_unit == 'Lbs') ? 'selected' : ''}}>Lbs</option>
                        <option value="Gauge" {{($product->qty_unit == 'Gauge') ? 'selected' : ''}}>Gauge</option>
                        <option value="Kg" {{($product->qty_unit == 'Kg') ? 'selected' : ''}}>Kg</option>
                        <option value="Meter" {{($product->qty_unit == 'Meter') ? 'selected' : ''}}>Meter</option>
                        <option value="Dozens" {{($product->qty_unit == 'Dozens') ? 'selected' : ''}}>Dozens</option>
                    </select>
                </div>
            </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-6 form-group">
                    <label for="product-colors">Colors <small>EXP: Red,Blue,...</small></label>
                    <select class="select2 browser-default product-colors" name="colors[]" multiple>
                        @foreach ($colors as $color)
                            <option value="{{ $color }}" {{ (in_array($color, $product->colors))?'selected':'' }}>{{ ucfirst($color) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                    <label for="product-sizes">Sizes <small>EXP: XL,XXL,...</small></label>
                        <select class="select2 browser-default product-sizes" name="sizes[]"  multiple="multiple">
                            @foreach ($sizes as $size)
                                    <option value="{{ $size }}" {{ (in_array($size, $product->sizes))?'selected':'' }}>{{ ucfirst($size) }}</option>
                            @endforeach
                        </select>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <label for="product-desc">Product Details</label>
                    <textarea name="product_details" id="product-desc" class="form-control editor" cols="30" rows="10" placeholder="Product Details" >{!! $product->product_details !!}</textarea>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-12">
                    <label for="product-spec">Full specification</label>
                    <textarea name="product_specification" id="product-spec" class="form-control editor" cols="30" rows="10" placeholder="Full Specification" >{!! $product->product_specification !!}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="lead_time">Lead time</label>
                    <input type="text" name="lead_time" value="{{ $product->lead_time }}" id="lead_time" class="form-control" placeholder="Lead Time" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="">
                        <label for="product-upload">
                            <span>Media</span>
                        </label>
                        <div class="col-lg-12">
                            @foreach($product->product_images as $product_image)
                                <!--1-->
                                <div class="col-md-3" style="width:20%; text-align:center;">
                                    <div class="col-md-12">
                                    <img src="{{ asset('storage/' .$product_image->product_image) }}" id="img{{ $product_image->id }}" class="img-thumbnail">
                                    </div>
                                    <div class="clear10"></div>
                                    <div class="col-md-12" style="text-align:center;">
                                    <div id="msg"></div>
                                        <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img{{ $product_image->id }}')">
                                        <div class="input-group my-3" style="display:block;">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/1-->
                            @endforeach
                            @if(count($product->product_images) < 5)
                                @for($i = 1; $i <= (5 - count($product->product_images)); $i++)
                                    @php $rand = rand();@endphp
                                    <div class="col-md-3" style="width:20%; text-align:center;">
                                        <div class="col-md-12">
                                        <img src="https://placehold.it/80x80" id="img{{ $rand }}" class="img-thumbnail">
                                        </div>
                                        <div class="clear10"></div>
                                        <div class="col-md-12" style="text-align:center;">
                                        <div id="msg"></div>
                                            <input type="file" name="product_images[]" class="file" accept="image/*" style="display:none;" onchange="readURL(this,'img{{ $rand }}')">
                                            <div class="input-group my-3" style="display:block;">
                                            <input type="text" class="form-control" disabled placeholder="Upload File" id="file"  style="display:none;">
                                            <div class="input-group-append">
                                                <button type="button" class="browse btn btn-search btn-default" style="background:#55A860; color:#fff;" onclick="$(this).parent().parent().prev().click();"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif


                        </div>
                    </div>
                </div>
            </div><br>


            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group row">
                        <button type="submit" class="btn waves-effect waves-light green seller_product_create">Update</button>
                        <button type="button" class="btn modal-close waves-effect waves-light green btn-back-to-product-list">Cancel</button>
                    </div>
                </div>
            </div>
    </div>
</section>
