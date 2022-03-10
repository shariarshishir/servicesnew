<section class="content">
    <div class="card card-primary">
        <div class="row">
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
        </div>
        <div class="row" >
            <div class="col-md-6">
                <p>Product Category : {{$product->category->name}}</p>
                <p>Title : {{$product->title}}</p>
                <p>Price Range : {{$product->price_per_unit}}</p>
                <p>Price Unit : {{$product->price_unit}}</p>
                <p>MOQ : {{$product->moq}}</p>
            </div>
            <div class="col-md-6">
                <p>Qty Unit : {{$product->qty_unit}}</p>
                <p>Lead time : {{$product->lead_time}}</p>
                <p>Gender :@switch($product->gender)
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
                </p>
                <p>Sample Availability : {{$product->sample_availability == true ? 'Yes' : 'No'}}</p>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <p>Colors :@if($product->colors) @foreach($product->colors as $key => $value ) {{$value}} @endforeach @endif</p>
                <p>Sizes :@if($product->sizes) @foreach($product->sizes as $key => $value ) {{$value}} @endforeach @endif</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_details">Product Details:</label>
                    <textarea class="form-control" id="product_details"  cols="50">{!! $product->product_details !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="product_specification">Product Specification:</label>
                    <textarea class="form-control"  id="product_specification" cols="50">{!! $product->product_specification !!}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 ">
                <div class="input-field">
                    <label class="active">Image:</label>
                    <div class="uploaded-product-images">
                        @foreach ($product->product_images as $image)
                            <div>
                                <center><img alt="preview-image" id="singleImage" src="{{asset('storage/' .$image->product_image)}}" alt="image" style="height:100px;" width="100%"/></center>
                            </div>
                        @endforeach
                    </div>
                    <div class="input-images-1" style="padding-top: .5rem;"></div>
                </div>
                <div class="input-field">
                    <label class="active">Video:</label>
                    @if($product->product_video)
                    <div class="uploaded-product-images">
                        <video controls autoplay width="320" height="240">
                            <source src="{{asset('storage'.'/'.$product->product_video->video)}}">
                        </video>
                    </div>
                   @endif
                </div>
            </div>
        </div>
    </div>

</section>
