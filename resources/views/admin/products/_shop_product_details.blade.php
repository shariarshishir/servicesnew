<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{route('admin.product.change.priority.level', ['flag'=>$product->flag, 'id' => $product->id ])}}" id="priority_level_form" method="get">
                                    <div class="form-group">
                                        <label for="priority_level">Priority Level</label><br>
                                        <label>
                                            <input class="with-gap" name="priority_level" type="radio" value="1" @if($product->priority_level==1) checked @endif />
                                            <span>High</span>
                                        </label>
                                        <label>
                                            <input class="with-gap" name="priority_level" type="radio" value="2" @if($product->priority_level==2) checked @endif />
                                            <span>Medium</span>
                                        </label>
                                        <label>
                                            <input class="with-gap" name="priority_level" type="radio" value="3" @if($product->priority_level==3) checked @endif />
                                            <span>Low</span>
                                        </label>
                                    </div>
                                </form>
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Product Name: {{$product->name}}</label>
                                </div>
                                <div class="form-group">
                                    <label for="product_type">{{ __('Product Type') }}</label><br>
                                    <label>
                                        <input class="with-gap" name="product_type" type="radio" value="1" @if($product->product_type==1) checked @endif disabled/>
                                        <span>Fresh Order</span>
                                    </label>
                                    <label>
                                        <input class="with-gap" name="product_type" type="radio" value="2" @if($product->product_type==2) checked @endif disabled/>
                                        <span>Ready Stock</span>
                                    </label>
                                    <label>
                                        <input class="with-gap" name="product_type" type="radio" value="3" @if($product->product_type==3) checked @endif disabled/>
                                        <span>Non Clothing</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender : @switch($product->gender)
                                        @case(1)
                                            Male
                                            @break
                                        @case(2)
                                            Female
                                            @break
                                        @case(3)
                                            Unisex
                                            @break

                                        @default

                                        @endswitch
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Sample Availability: {{$product->sample_availability == true ? 'Yes' : 'No'}}</label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input name="is_new_arrival" type="checkbox"  {{ $product->is_new_arrival == "1" ? 'checked' : '' }}/>
                                        <span>{{ __('New Arrival') }}</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input name="is_featured" type="checkbox"  {{ $product->is_featured == "1" ? 'checked' : ''}}/>
                                        <span>{{ __('Featured') }}</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input name="published" type="checkbox" {{  $product->state == "1" ? 'checked' : ''}} />
                                        <span>Published</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <input name="rel-products" type="checkbox"  {{  count($related_products_id) > 0 ? 'checked' : ''}}/>
                                        <span>Related Products</span>
                                    </label>
                                </div>

                                <div class="related-product form-group" style="{{ count($related_products_id) > 0 ? ' ' : 'display: none;' }}">
                                    <label for="">Select Related Products</label>
                                    <select class="js-example-basic-multiple" name="related_products[]" multiple="multiple">
                                          @foreach ($related_products as $key => $value)
                                               <option value="{{ $key }}" @if (in_array($key,$related_products_id)) selected @endif>{{ $value }}</option>
                                          @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="product_category_id">Product Category: {{$product->category->name}}</label>
                                </div>
                                @if($product->product_type==1)
                                <div class="form-group">
                                    <label>
                                        <input name="can_be_customizable" type="checkbox" {{  $product->customize== "1" ? 'checked' : ''}} />
                                        <span>Can be Customizable</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Prices Breakdown</label>
                                    <table class="fresh-order-attribute-table-block table-bordered">
                                        <tr>
                                            <th>Quantity Min</th>
                                            <th>Quantity Max</th>
                                            <th>Price(usd)</th>
                                            <th>Lead Time(days)</th>
                                        </tr>
                                        @foreach(json_decode($product->attribute) as $key=>$list)
                                        <tr>
                                            <td>{{$list[0]}}</td>
                                            <td>{{$list[1]}}</td>
                                            <td>{{$list[2]}}</td>
                                            <td>{{$list[3]}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    <div class="form-group">
                                        <label for="copyright-price" class="col-form-label text-md-right">Copyright Price: {{$product->copyright_price}}</label>
                                    </div>
                                </div>
                                @endif

                                @if($product->product_type==2)
                                    <div class="col-md-12" id="color-size-block">
                                        <label>Available Size & Colors</label>
                                        <div class="row">
                                            <table class="color-size-table-block table-bordered" width="100%" border="1" cellpadding="0" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <td>Color</td>
                                                        <td>Small</td>
                                                        <td>Medium</td>
                                                        <td>Large</td>
                                                        <td>Extra Large</td>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach(json_decode($product->colors_sizes) as $color)
                                                        <tr>
                                                            <td>{{$color->color}}</td>
                                                            <td>{{$color->small}}</td>
                                                            <td>{{$color->medium}}</td>
                                                            <td>{{$color->large}}</td>
                                                            <td>{{$color->extra_large}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                @if($product->product_type==3)
                                    <div class="col-md-12" id="color-size-block">
                                        <label>Available Size & Colors</label>
                                        <div class="row">
                                            <table class="color-size-table-block table-bordered" width="100%" border="1" cellpadding="0" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <td>Color</td>
                                                        <td>Quantity</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach(json_decode($product->colors_sizes) as $color)
                                                        <tr>
                                                            <td>{{$color->color}}</td>
                                                            <td>{{$color->quantity}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                @if($product->product_type==2 || $product->product_type == 3)
                                    <div class="form-group">
                                        <label>
                                            <input name="can_be_customizable" type="checkbox" {{  $product->full_stock== "1" ? 'checked' : ''}} />
                                            <span>Sell full stock only</span>
                                        </label>
                                    </div>
                                    @if($product->full_stock == false)
                                        <div class="form-group">
                                            <label>Prices Breakdown</label>
                                            <table class="ready-order-attribute-table-block table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Qty Min</th>
                                                        <th>Qty Max</th>
                                                        <th>Price (usd)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach(json_decode($product->attribute) as $key=>$list)
                                                    <tr>
                                                        <td>{{$list[0]}}</td>
                                                        <td>{{$list[1]}}</td>
                                                        <td>{{$list[2]}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label for="full_stock_price" class="col-form-label">Full Stock Price :  {{$product->full_stock_price}}</label>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="availability" class="col-form-label">Availability :  {{$product->availability}}</label>
                                    </div>

                                @endif
                                <div class="form-group">
                                    <label for="moq" class="col-form-label">Minimum Order Quantity : {{$product->moq}}</label>
                                </div>
                                <div class="form-group">
                                    <label for="unit" class="col-form-label text-md-right">Unit: {{$product->product_unit}}</label>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="input-field">
                                    <label class="active">Image:</label>
                                    <div class="uploaded-product-images">
                                        @foreach ($product->images as $image)
                                            <div>
                                                <center><img alt="preview-image" id="singleImage" src="{{asset('storage/'.$image->image)}}" alt="image" style="width:300px; height:300px;" /></center>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="input-images-1" style="padding-top: .5rem;"></div>
                                </div>
                                <div class="input-field">
                                    <label class="active">Video:</label>
                                    @if($product->video)
                                    <div class="uploaded-product-images">
                                        <video controls autoplay width="320" height="240">
                                            <source src="{{asset('storage'.'/'.$product->video->video)}}">
                                        </video>
                                    </div>
                                   @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea class="form-control" id="description"  cols="50">{!! $product->description!!}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="additional_description">Additional Description:</label>
                                        <textarea class="form-control"  id="additional_description" cols="50">{!! $product->additional_description!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>


