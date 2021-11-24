
<div id="product-edit-modal-block" class="modal fullscreen-modal profile_form_modal">
    <div class="modal-content">

            <legend>Edit Product</legend>

            <form method="POST" action="javascript:void(0);" enctype="multipart/form-data" id="seller_product_form_update">
                @method('PUT')
                @csrf
                @if ($errors->any())
                    <div class="card-alert card red">
                        <div class="card-content white-text card-with-no-padding">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div role="">
                    <ul id="edit_errors"></ul>
                </div>


                <div class="wholesaler_edit_product_form container">

                    {{-- <div class="col m6 product-upload-block">
                        <div class="edit-image-preview"></div>
                        <label for="images">Product Images :</label>
                        <div class="input-group  control-group increment" >
                        Product photos (can add more than one):
                            <input type="file" id="edit_fileupload" name="images[]" data-url="/upload-edit" multiple="">
                            <br>
                            <div id="edit_files_list"></div>
                            <p id="edit_loading"></p>
                            <input type="hidden" name="file_ids" id="edit_file_ids" value="">

                        </div>
                    </div> --}}

                    <div class="row input-field product-upload-block edit-image-block">
                        <div class="col s12 m3 l3">
                            <label class="active">Image:</label>
                        </div>
                        <div class="col s12 m9 l9">
                            <div class="input-images-2" style="padding-top: .5rem;"></div>
                            <div class="image-upload-message">Minimum image size 300 X 300</div>
                        </div>
                    </div>

                    <div class="product-details-block">
                        <div class="row input-field">
                            <div class="col s12 m3 l3">
                                <label for="p-edit-name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>
                            </div>
                            <div class="col s12 m9 l9">
                                <input id="p-edit-name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="row input-field">
                            <div class="col s12 m3 l3">
                                <label for="product_type">{{ __('Product Type') }}</label>
                            </div>
                            <div class="col s12 m9 l9">
                                <div class="radio-block">
                                    <label class="radio_box">
                                        <input class="with-gap" name="product_type" type="radio" value="1" id="p-type-fresh" disabled/>
                                        <span>Fresh Order</span>
                                    </label>
                                    <label class="radio_box">
                                        <input class="with-gap" name="product_type" type="radio" value="2" id="p-type-ready" disabled/>
                                        <span>Ready Stock</span>
                                    </label>
                                    <label class="radio_box">
                                        <input class="with-gap" name="product_type" type="radio" value="3" id="p-type-non-clothing" disabled/>
                                        <span>Non Clothing Item</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row input-field">
                            <div class="col s12 m3 l3">
                                <label for="product_category_id">{{ __('Product Category') }}</label>
                            </div>
                            <div class="col s12 m9 l9">
                                <select name="category_id" class="select2 browser-default " id="edit_category_id">
                                    <option value="" selected="true" class="edit_category_id">Choose your option</option>
                                    @foreach($categories as $categoryitem)
                                        <option value="{{$categoryitem['id']}}">{{$categoryitem['name']}}</option>
                                            @if(!empty($categoryitem['children'])) <!-- 1st sub level -->
                                                @foreach($categoryitem['children'] as $childcategoryitem)
                                                <option value="{{ $childcategoryitem['id'] }}"> - {{ $childcategoryitem['name'] }}</option>
                                                    @if(!empty($childcategoryitem['children'])) <!-- 2nd sub level -->
                                                        @foreach($childcategoryitem['children'] as $subchildcategoryitem)
                                                        <option value="{{ $subchildcategoryitem['id'] }}"> -- {{ $subchildcategoryitem['name'] }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                    @endforeach
                                </select>
                                <span class="text-danger error-text category_id_err"></span>
                            </div>
                        </div>
                        <div class="fresh-rtd-attr">
                            <div class="row input-field">
                                <div class="col s12">
                                    <label>Prices Breakdown</label>
                                </div>
                                <div class="col s12">
                                    <div class="prices-breakdown-block">
                                        <table class="fresh-order-attribute-table-block">
                                            <thead>
                                                <tr>
                                                    <th>Qty Min</th>
                                                    <th>Qty Max</th>
                                                    <th>Price (usd)</th>
                                                    <th>Lead Time (days)</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fresh-attr-tbody">
                                            </tbody>
                                        </table>
                                        <div class="add_more_box" style="padding-top: 20px">
                                            <a href="javascript:void(0);" class="add-more-block" onclick="addFreshOrderAttribute()"><i class="material-icons dp48">add</i> Add More</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row input-field copyright-price">
                                <div class="col s12 m3 l3">
                                    <label for="copyright-price" class="col-md-4 col-form-label text-md-right">Copyright Price</label>
                                </div>
                                <div class="col s12 m9 l9">
                                    <input type="text" name="copyright_price" class="copyright_price_edit_val" onchange="allowTwoDecimal('.copyright_price_edit_val')" />
                                </div>
                            </div>
                            <div class="row input-field">
                                {{-- customize --}}
                                <div class="col s12">
                                    <label>
                                        <input name="customize" type="checkbox" {{old('customize')=='on'? 'checked' : " "}} />
                                        <span>{{ __('Can be Customizable') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="ready-rtd-attr">
                            <div class="col-md-12" id="color-size-block">
                                <div class="row input-field">
                                    <div class="col s12">
                                        <label>Available Size & Colors</label>
                                    </div>
                                    <div class="col s12">
                                        <div class="color-and-size-block">
                                            <table class="color-size-table-block striped edit-color-sizes">
                                                <thead>
                                                    <tr>
                                                        <th>Color</th>
                                                        <th>XXS</th>
                                                        <th>XS</th>
                                                        <th>Small</th>
                                                        <th>Medium</th>
                                                        <th>Large</th>
                                                        <th>Extra Large</th>
                                                        <th>XXL</th>
                                                        <th>XXXL</th>
                                                        <th>4XXL</th>
                                                        <th>One Size</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="ready-attr-tbody-colors-sizes">

                                                </tbody>
                                            </table>

                                            <div class="add_more_box" >
                                            <a href="javascript:void(0);" class="add-more-block" onclick="addProductColorSize()"><i class="material-icons dp48">add</i> Add More</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- full stock --}}
                            <div class="row input-field">
                                <div class="col s12">
                                    <label>
                                        <input name="full_stock" type="checkbox" {{old('full_stock')=='on'? 'checked' : " "}} />
                                        <span>{{ __('Sell full stock only') }}</span>
                                    </label>
                                </div>
                            </div>

                            <div class="full-stock-price" style="display: none">
                                <div class="row input-field full-stock-price-block">
                                    <div class="col s12 m3 l3">
                                        <label for="full_stock_price" class="col-md-4 col-form-label text-md-right">Full Stock Price</label>
                                    </div>
                                    <div class="col s12 m9 l9">
                                        <input id="full_stock_price" type="number" step=".01" class="form-control @error('full_stock_price') is-invalid @enderror" name="full_stock_price" value="{{ old('full_stock_price') }}"  autocomplete="full_stock_price" autofocus>
                                    </div>
                                </div>
                                <div class="row input-field">
                                    <div class="col s12">
                                        <label>
                                            <input name="ready_full_stock_negotiable" type="checkbox" {{old('ready_full_stock_negotiable')=='on'? 'checked' : " "}} />
                                            <span>{{ __('Price can be Negotiable') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- end full stock --}}
                            <div class="row input-field ready-stock-prices-breakdown">
                                <div class="col s12">
                                    <label>Prices Breakdown</label>
                                </div>
                                <div class="col s12">
                                    <div class="prices-breakdown-block">
                                        <table class="ready-order-attribute-table-block striped">
                                            <thead>
                                                <tr>
                                                    <th>Qty Min</th>
                                                    <th>Qty Max</th>
                                                    <th>Price (usd)</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody class='ready-attr-tbody'>
                                            </tbody>
                                        </table>

                                        <div class="add_more_box" style="padding-top: 20px">
                                            <a href="javascript:void(0);" class="add-more-block" onclick="addReadyOrderAttribute()"><i class="material-icons dp48">add</i> Add More</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row input-field">
                                <div class="col s12 m3 l3">
                                    <label for="edit_ready_stock_availability" class="col-md-4 col-form-label text-md-right">Availability</label>
                                </div>
                                <div class="col s12 m9 l9">
                                    <input id="edit_ready_stock_availability" type="number" class="form-control availability @error('ready_stock_availability') is-invalid @enderror" name="ready_stock_availability" value="{{ old('ready_stock_availability') }}"  autocomplete="ready_stock_availability" autofocus readonly>
                                </div>
                            </div>
                        </div>

                        {{-- non clothing item block --}}
                        <div class="edit-non-clothing-item-block" >
                            <div class="col-md-12" id="color-size-block">
                                <div class="row input-field">
                                    <div class="col s12">
                                        <label>Available Size & Colors</label>
                                    </div>
                                    <div class="col s12">
                                        <div class="color-and-size-block">
                                            <table class="non-clothing-color-quantity-table-block edit-non-clothing-attr-counting striped">
                                                <thead>
                                                    <tr>
                                                        <th>Color</th>
                                                        <th>Quantity</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="non-clothing-color-quantity-tbody">

                                                </tbody>
                                            </table>

                                            <div class="add_more_box" style="padding-top: 20px">
                                                <a href="javascript:void(0);" class="add-more-block" onclick="addNonClothingAttr()"><i class="material-icons dp48">add</i> Add More</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- full stock --}}
                            <div class="row input-field">
                                <div class="col s12">
                                    <label>
                                        <input name="non_clothing_full_stock" type="checkbox" {{old('non_clothing_full_stock')=='on'? 'checked' : " "}} />
                                        <span>{{ __('Sell full stock only') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="non-clothing-full-stock-price" style="display: none">
                                <div class="input-field row non-clothing-full-stock-price-block" >
                                    <div class="col s12 m3 m3">
                                        <label for="non_clothing_full_stock_price" class="col-md-4 col-form-label text-md-right">Full Stock Price</label>
                                    </div>
                                    <div class="col s12 m9 m9">
                                        <input id="non_clothing_full_stock_price" type="number" step=".01" class="form-control @error('non_clothing_full_stock_price') is-invalid @enderror" name="non_clothing_full_stock_price" value="{{ old('non_clothing_full_stock_price') }}"  autocomplete="non_clothing_full_stock_price" autofocus>
                                    </div>
                                </div>
                                <div class="input-field row" >
                                    <div class="col s12">
                                        <label>
                                            <input name="non_clothing_full_stock_negotiable" type="checkbox" {{old('non_clothing_full_stock_negotiable')=='on'? 'checked' : " "}} />
                                            <span>{{ __('Price can be Negotiable') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- end full stock --}}
                            <div class="input-field row non-clothing-prices-breakdown">
                                <div class="col s12">
                                    <label>Prices Breakdown</label>
                                </div>
                                <div class="col s12">
                                    <div class="prices-breakdown-block">
                                        <table class="non-clothing-prices-breakdown-block striped">
                                            <thead>
                                                <tr>
                                                    <th>Qty Min</th>
                                                    <th>Qty Max</th>
                                                    <th>Price (usd)</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody class='edit-non-clothing-prices-breakdown-tbody'>

                                            </tbody>
                                        </table>

                                        <div class="add_more_box">
                                            <a href="javascript:void(0);" class="add-more-block" onclick="addNonClothingPriceBreakDown()"><i class="material-icons dp48">add</i> Add More</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="input-field row">
                                <div class="col s12 m3 l3">
                                    <label for="edit_non_clothing_availability" class="col-md-4 col-form-label text-md-right">Availability</label>
                                </div>
                                <div class="col s12 m9 l9">
                                    <input id="edit_non_clothing_availability" type="number" class="form-control availability @error('non_clothing_availability') is-invalid @enderror" name="non_clothing_availability" value="{{ old('non_clothing_availability') }}"  autocomplete="non_clothing_availability" autofocus readonly>
                                </div>
                            </div>
                        </div>


                        <div class="input-field row moq-unit-block">
                            <div class="col m8">
                                <label for="moq" class="col-md-4 col-form-label text-md-right">Minimum Order Quantity</label>
                                <input id="moq" type="number" class="form-control minimun-order-qty @error('moq') is-invalid @enderror" name="moq" value="{{ old('moq') }}"  autocomplete="moq" autofocus>
                            </div>
                            <div class="col m4">
                                <label for="product_unit" class="col-md-4 col-form-label text-md-right">Unit</label>
                                <select class="select2 browser-default product_unit" name="product_unit">
                                    <option value="">Select</option>
                                    <option value="LBS/Pound">LBS / Pound</option>
                                    <option value="PCS">PCS</option>
                                    <option value="Yards">Yards</option>
                                    <option value="Feet">Feet</option>
                                    <option value="Meter">Meter</option>
                                    <option value="Ton">Ton</option>
                                </select>
                            </div>
                        </div>

                        <div class="input-field row">
                            <div class="col s12">
                                <label>
                                    <input name="is_new_arrival" class="edit_is_new_arrival" type="checkbox" {{old('is_new_arrival')=='on'? 'checked' : " "}} />
                                    <span>{{ __('New Arrival') }}</span>
                                </label>
                            </div>
                            <div class="col s12">
                                <label>
                                    <input name="is_featured" class="edit_is_featured" type="checkbox" {{old('is_featured')=='on'? 'checked' : " "}}/>
                                    <span>{{ __('Featured') }}</span>
                                </label>
                            </div>
                        </div>

                        <div class="input-field row">
                            <div class="col s12 m3 l3">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            </div>
                            <div class="col s12 m9 l9">
                                <textarea id="edit-description" class="editor edit-description" name="description" >{{old('description')}}</textarea>
                            </div>
                        </div>
                        <div class="input-field row">
                            <div class="col s12 m3 l3">
                                <label for="additional_description" class="col-md-4 col-form-label text-md-right">{{ __('Additional Description') }}</label>
                            </div>
                            <div class="col s12 m9 l9">
                                <textarea id="edit-additional-description" class="editor edit-additional-description" name="additional_description" >{{old('additional_description')}}</textarea>
                            </div>
                        </div>
                        <div class="input-field row">
                            <div class="col s12">
                                <label>
                                    <input name="rel-products" type="checkbox"  {{old('rel-products')=='on'? 'checked' : " "}} />
                                    <span>Select Related Products</span>
                                </label>
                            </div>
                        </div>
                        <div class="input-field row related-product" style="display: none;">
                            <div class="col s12 m3 l3">
                                <label for="">Select Related Products</label>
                            </div>
                            <div class="col s12 m9 l9">
                                <select class="js-example-basic-multiple" name="related_products[]" multiple="multiple"></select>
                            </div>
                        </div>
                        <div class="input-field row">
                            <div class="col s12">
                                <label>
                                    <input name="published" class="edit_published" type="checkbox"  {{old('published')=='on'? 'checked' : " "}}/>
                                    <span>Published</span>
                                </label>
                            </div>
                        </div>
                        <div class="input-field row  right-align">
                            <input type="hidden" name="seller_p_edit_sku">
                            <input type="hidden" name="p_type">
                            
                           
                        </div>

                        <div class="submit_btn_wrap">
                            <div class="row">
                                <div class="col s12 m6 l6 left-align">
                                    <button type="button" class="modal-close btn_grBorder btn-back-to-product-list">Cancel</button>
                                </div>
                                <div class="col s12 m6 l6 right-align">
                                    <button type="submit" class="btn_green btn waves-effect waves-light green ">Save</button>
                                </div>
                            </div>
                        </div>

                        

                    </div>  <!-- End product-details-block -->




                    <!-- <div class="">
                        {{-- end non clothing item --}}
                        <div class="input-field row moq-unit-block">
                            <div class="row">
                                
                            </div>
                        </div>
                    </div> -->


            </form>

    
        </div>
    </div>

    
    <!-- <div class="modal-footer">
        <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat">
            <i class="material-icons green-text text-darken-1">close</i>
        </a>
    </div> -->

    
</div>





