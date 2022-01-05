@extends('layouts.app')
@section('content')
@include('sweet::alert')

    <div class="row">
    <section class="manufactrue_product_details_top">
        <div class="container">
            <div class="row ic-breadcrumb product_category_bar">
                <div class="category_nav">
                    <a class="dropdown-trigger" href="#!" data-target="categories_dropdown">
                        <i class="material-icons left">dashboard</i> Categories<i class="material-icons right">arrow_drop_down</i>
                    </a>
                    <ul id="categories_dropdown" class="dropdown-content subNav" tabindex="0" style="">
                        <li tabindex="0"><a href="#">{{ $product->category['name'] }}</a></h3>
                    </ul>
                </div>
            </div>
            <div class="back_to">
                <a  href="{{ url()->previous() }}"> <img src="{{asset('images/frontendimages/new_layout_images/back-arrow.png')}}" alt="" ></a>
            </div>

        </div>
    </section>

    <section class="ic-single-product-details manufactrue_product_details_wrap">
        <div class="container">
            <div class="row ic-pg-container">

                <div class="col s12 m12 l9 product_preview_info_wrap">
                    <div class="row">
                        <div class="col s12 m5 l4 product_preview_wrap">
                            @if(isset($product->product_video->video))
                                <div class="simpleLens-gallery-container" id="ic-gallery">
                                    <div class="video_content">
                                        <center>
                                            <video controls height="245" width="300">
                                                <source src="{{asset('storage/'.$product->product_video->video)}}" />
                                            </video>
                                        </center>
                                    </div>
                                    <div class="simpleLens-thumbnails-container">
                                        @foreach($product->product_images as $product_image)
                                            <a href="{{ asset('storage/'.$product_image['product_image']) }}" data-fancybox="gallery" class="simpleLens-thumbnail-wrapper"
                                                data-lens-image="{{ asset('storage/'.$product_image['product_image']) }}"
                                                data-big-image="{{ asset('storage/'.$product_image['product_image']) }}">
                                                <img src="{{ asset('storage/'.$product_image['product_image']) }}" style="width:80px !important; height:80px !important; margin-top:4px;" id="smallImages[]" />
                                            </a>
                                        @endforeach

                                        @php $productImage = (!empty($product->product_images[0]->product_image))?asset('storage/' .$product->product_images[0]->product_image):asset('images/supplier.png'); @endphp
                                    </div>
                                </div>
                            @else
                                <div class="simpleLens-gallery-container" id="ic-gallery">
                                    @if(isset($product->product_images[0]['product_image']) && !is_null($product->product_images[0]['product_image']))
                                        <div class="simpleLens-container">
                                            <div class="simpleLens-big-image-container">
                                                <a class="simpleLens-lens-image" data-lens-image="{{ asset('storage/'. $product->product_images[0]['product_image']) }}">
                                                    <img id="largeImage" src="{{ asset('storage/'. $product->product_images[0]['product_image']) }}" class="simpleLens-big-image" width="380px" height="320px">
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="simpleLens-thumbnails-container">
                                        @foreach($product->product_images as $product_image)
                                            <a href="{{ asset('storage/'.$product_image['product_image']) }}" data-fancybox="gallery" class="simpleLens-thumbnail-wrapper"
                                                data-lens-image="{{ asset('storage/'.$product_image['product_image']) }}"
                                                data-big-image="{{ asset('storage/'.$product_image['product_image']) }}">
                                                <img src="{{ asset('storage/'.$product_image['product_image']) }}" style="width:80px !important; height:80px !important; margin-top:4px;" id="smallImages[]" />
                                            </a>
                                        @endforeach

                                        @php $productImage = (!empty($product->product_images[0]->product_image))?asset('storage/' .$product->product_images[0]->product_image):asset('images/supplier.png'); @endphp
                                    </div>
                                </div>
                            @endif
                        </div>


                        <div class="col s12 m7 l8 product_details_info_wrap">

                            <div class="row">
                                <div class="col s12 m6 l6">
                                    <div class="seller-store">
                                        <h3><a href="#">{{ $product->category['name'] }}</a></h3>
                                    </div>
                                </div>

                                <!-- <div class="product_stock col s12 m6 l6 right-align">
                                    <div class="single-product-availability">Availability: <span>instock</span></div>
                                </div> -->
                            </div>

                            <div class="ic-pg-container">
                                <div class="col-md-5 col-sm-12 ic-product-infobox">
                                    <div class="ic-product-details">
                                        {{-- <form id="productOrderForm" action="{{ route('orders.placeing', $product->id) }}" method="POST" style="padding:10px 15px"> --}}
                                            <h2 class="ic-product-title">{{ $product->title }}</h2>
                                            <table class="table table-bordered-less">
                                                <tbody>
                                                    <tr>
                                                        <th>Product Code</th>
                                                        <th>:</th>
                                                        <td>mb-{{ $product->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Price per Unit</th>
                                                        <th>:</th>
                                                        <td>{{$product->price_unit}} {{$product->price_per_unit}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Lead Time</th>
                                                        <th>:</th>
                                                        <td>{{ $product->lead_time }} days</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Min Quantity</th>
                                                        <th>:</th>
                                                        <td>{{ $product->moq }} {{ $product->qty_unit }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            @php
                                                $colors = $product->colors ?? [];
                                                $sizes = $product->sizes ?? [];
                                            @endphp

                                            @if( !empty($colors) && is_array($colors) && !empty($sizes) && is_array($sizes) )
                                                <div class="mycolorwrapper">
                                                    <h3>Colors: <span id="mycolorboxColor">&nbsp;</span></h3>
                                                    <div class="mycolorboxs">
                                                        @foreach($colors as $idx=>$color)
                                                        <label class="mycolorbox">
                                                            <input type="hidden" class="mycolorbox-input{{ ($idx===0)? ' active' : '' }}" id="colorbox_{{ $color }}" name="colors[]" value="{{ $color }}" data-target="#mysizeboxPanel_{{ $color }}">
                                                            @if($color== "Multicolor")
                                                            <span class="mycolorbox-color" style="border: 2px solid  #2c3e50; color: black ">{{ strtolower($color) }}</span>
                                                            @else
                                                            <span class="mycolorbox-color" style="border: 2px solid {{ strtolower($color) }}; color: {{ strtolower($color) }} ">{{ strtolower($color) }}</span>
                                                            @endif
                                                            <!-- <span class="mycolorbox-color" style="background-color:{{ strtolower($color) }}; border: 1px solid {{ strtolower($color) }}">{{ strtolower($color) }}</span> -->
                                                        </label>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="mysizewrapper">
                                                    <h3>Sizes</h3>
                                                    <div class="mysizeboxs">

                                                            <div id="mysizeboxPanel_{{ $color }}" data-color="{{ $color }}" class="mysizebox-panel{{ ($idx===0)? ' itChecked' : '' }}" style="display:{{ ($idx===0)? 'block' : 'none' }}">
                                                                @foreach($sizes as $size)
                                                                    <div class="mysizebox" data-size="{{ $size }}">
                                                                        <span>{{ strtoupper($size) }}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                    </div>
                                                </div>

                                            @endif


                                        {{-- </form> --}}

                                        {{-- contactSupplierModal --}}
                                        <div id="contactSupplierModal" class="modal">
                                            <form class="contact-supplier-form" id="contactSupplierForm" action="" method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <h2>Contact Supplier</h2>
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="name" placeholder="Name*" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" name="email" placeholder="Email Address*" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="address" placeholder="Address*" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="description" rows="3" placeholder="Description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                                                    <button type="submit" class="btn btn-success">SEND</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="single-product-description-block-wrapper product_details_tab_wrap">
                        <div class="row">
                            <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s4"><a class="active"  href="#product-details">Product Details</a></li>
                                <li class="tab col s4"><a href="#company-profile">Company Profile</a></li>
                                <li class="tab col s4"><a href="#factory-tour">Factory Tour</a></li>
                            </ul>
                            </div>
                            <div id="product-details" class="col s12">
                                <div class="card product_details_tab">
                                    <h3>Overview</h3>
                                    <div class="ic-tabcontent-tbl ic-hz">
                                        <h4>Product Details</h4>
                                        {!! $product->product_details !!}
                                    </div>
                                    <div class="ic-tabcontent-tbl ic-hz">
                                        <h4>Full Specification</h4>
                                        {!! $product->product_specification !!}
                                    </div>
                                </div>
                            </div>
                            <div id="company-profile" class="col s12">
                                <div class="card product_details_tab">
                                    <h3>Basic information <span class="ic-verified"><i class="icofont icofont-check"></i> Verified</span></h3>
                                    <div class="ic-dbl-tbl">
                                        <div class="ic-company-tbl ic-hz">
                                            <table>
                                                <tr>
                                                    <td>Company Name:</td>
                                                    <td>{{ $product->businessProfile->business_name}}</td>

                                                </tr>
                                                <tr>
                                                    <td>Business type:</td>
                                                    <td>
                                                        @if($product->businessProfile)
                                                            @switch($product->businessProfile->business_type)
                                                                @case(1)
                                                                    Manufacture
                                                                    @break
                                                                @case(2)
                                                                    Wholesaler
                                                                    @break
                                                                @case(3)
                                                                    Design Studio
                                                                    @break

                                                                @default
                                                            @endswitch
                                                        @endif
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Main products:</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Annual Revenue:</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Top 3 Markets:</td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="ic-company-tbl ic-right-tbls ic-hz">
                                            <table>
                                                <tr>
                                                    <td>Location:</td>
                                                    <td>{{ $product->businessProfile ? $product->businessProfile->location : '' }}</td>

                                                </tr>
                                                <tr>
                                                    <td>Total Employees:</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Year Established:</td>
                                                    <td class="ic-primary"></td>

                                                </tr>
                                            </table>
                                        </div>
                                        <div class="ic-hr-devider"></div>
                                    </div>
                                    <span class="com_detalts" >Comapny Details</span>

                                    <div class="ic-product-detail">
                                        <div class="ic-product-overview">
                                            <div class="ic-product-description">
                                                <div class="ic-s-product-desc">

                                                </div>
                                            </div>
                                            <div class="ic-p-overview-video company-profile-intro-video" style="background-image:">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="factory-tour" class="col s12">
                                <div class="card product_details_tab">
                                    <h3>Overview</h3>
                                    <div class="ic-factory-flex">
                                        <div class="ic-ff-left">
                                            <h4>Factory tour photos</h4>
                                        </div>
                                        <div class="ic-ff-right">

                                        </div>
                                    </div>
                                    <div class="ic-factory-flex">
                                        <div class="ic-ff-left">
                                            <h4>Factory &amp; machinery detail</h4>
                                        </div>
                                        <div class="ic-ff-right">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>

                <div class="col s12 m12 l3 product_preview_right center-align">
                    <div id="place_order_buttons" class="ic-place-order right-align">
                        {{-- <a href="{{ route('wishlist.store',[$product->id,'product']) }}" class="ic-btn" style="margin-right:10px"><i class="fa fa-heart-o"></i></a> --}}

                        @if( !empty($colors) && is_array($colors) && !empty($sizes) && is_array($sizes) )
                            @csrf

                            <input type="hidden" id="total_qty2" name="quantity" value="0">
                            {{-- <button type="button" class="ic-btn js__btn" data-toggle="modal" data-target="#productOrderModal" disabled>Place order</button> --}}

                        @else

                            {{-- <a href="#" class="ic-btn" data-toggle="modal" data-target="#product-order"></a> --}}
                            {{-- <a href="{{ action('ProductController@contactSupplier', $product->id) }}" class="ic-btn">Place order</a> --}}


                        @endif
                        @if(Auth::guard('web')->check())
                            <button type="button" class="ic-btn btn_green" onClick="contactSupplierFromProduct({{ $product->businessProfile->user->id}}); updateUserLastActivity('{{Auth::id()}}', '{{$product->businessProfile->user->id}}'); sendmessage('{{$product->id}}','{{$product->title}}','{{$product->category['name']}}','{{$product->moq}}','{{$product->qty_unit}}','{{$product->price_per_unit}}','{{$product->price_unit}}','@if(!empty(@$product->product_images[0]->product_image)){{ asset('storage/' .$product->product_images[0]->product_image) }} @else{{ asset('images/supplier.png') }} @endif','{{$product->businessProfile->user->id}}')"">Contact supplier</button>
                        @else
                            <button type="button" class="ic-btn btn_green modal-trigger" href="#login-register-modal">Contact supplier</button>
                        @endif
                        <br/>

                    </div>
                    {{-- send request sample --}}
                    <div class="preview_right_infobox">
                        <div class="samplebox">
                            <h3>Company Detail</h3>
                            <div class="requestbox">
                                {{-- <a class="modal-trigger" href="javascript:void(0);">Request Sample</a> --}}
                                <p>contact for order customization or bulk volume rate-</p>
                            </div>
                            <form class="sampleformbox" id="requestSampleForm" action="" method="POST">
                                @csrf
                                <div class="modal" id="requestSampleForm">
                                    <div class="modal-content">
                                        <h5>Request Sample</h5>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Name*" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Email Address*" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="address" placeholder="Address*" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="sample_details" rows="3" placeholder="Sample details"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">SEND</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="right_view_details">
                            <div class="row" style="height:90px; background-image: url({{ asset('images/single-product-logo-background.jpg') }}); background-repeat: no-repeat;">
                                <div class="col-md-12">
                                    @if(isset($supplier->profile->company_logo))
                                        <img src="{{ asset('storage/'.$supplier->profile->company_logo) }}" width="30%" height="70px" alt="Missing" style="border-radius: 190px; margin-top:50px; margin-left:90px;" />
                                    @endif
                                </div>
                            </div>

                            <p class="text-center" style="font-size: 16px; font-weight:bold;"><span style=" color: #333333;"> {{ @$supplier->profile->company_name }}</span></p>

                            <p class="text-center">{{ @$supplier->profile->company_info['city'] }}, {{ @$supplier->profile->company_info['country'] }}</p>

                            <div class="ic-badges" style="padding-left: 16px;">
                                {{-- @foreach($supplier->badges as $badge)
                                    <p><img src="{{ asset('storage/'.$badge->badge['image']) }}" alt="right" style="width:40px;">
                                    {{ $badge->badge->name }}</p>
                                @endforeach --}}
                            </div>


                            <br/><br/>
                            <span class="col-md-3"></span>
                            @if(!empty($product->business_profile_id))
                                <a href="{{ route('supplier.profile', $product->business_profile_id) }}" class="text-center ic-primary">View Company Profile</a>
                            @else
                                <a href="javascript:void(0);" class="text-center ic-primary">View Company Profile</a>
                            @endif
                        </div>
                    </div>
                </div>




            </div> <!-- row ic-pg-container emd -->
        </div>
    </section>

{{-- product details, company profile, factory tour --}}
    <!-- <section class="single-product-description-block-wrapper product_details_tab_wrap">
        <div class="row">
            <div class="col s12">
              <ul class="tabs">
                <li class="tab col s3"><a class="active"  href="#product-details">Product Details</a></li>
                <li class="tab col s3"><a href="#company-profile">Company Profile</a></li>
                <li class="tab col s3"><a href="#factory-tour">Factory Tour</a></li>
              </ul>
            </div>
            <div id="product-details" class="col s12">
                <div class="card product_details_tab">
                    <h3>Overview</h3>
                    <div class="ic-tabcontent-tbl ic-hz">
                        <h4>Product Details</h4>
                        {!! $product->product_details !!}
                    </div>
                    <div class="ic-tabcontent-tbl ic-hz">
                        <h4>Full Specification</h4>
                        {!! $product->product_specification !!}
                    </div>
                </div>
            </div>
            <div id="company-profile" class="col s12">
                <div class="card product_details_tab">
                    <h3>Basic information <span class="ic-verified"><i class="icofont icofont-check"></i> Verified</span></h3>
                    <div class="ic-dbl-tbl">
                        <div class="ic-company-tbl ic-hz">
                            <table>
                                <tr>
                                    <td>Company Name:</td>
                                    <td>{{ $product->businessProfile->business_name}}</td>

                                </tr>
                                <tr>
                                    <td>Business type:</td>
                                    <td>
                                        @if($product->businessProfile)
                                            @switch($product->businessProfile->business_type)
                                                @case(1)
                                                    Manufacture
                                                    @break
                                                @case(2)
                                                    Wholesaler
                                                    @break
                                                @case(3)
                                                    Design Studio
                                                    @break

                                                @default
                                            @endswitch
                                        @endif
                                    </td>

                                </tr>
                                <tr>
                                    <td>Main products:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Total Annual Revenue:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Top 3 Markets:</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <div class="ic-company-tbl ic-right-tbls ic-hz">
                            <table>
                                <tr>
                                    <td>Location:</td>
                                    <td>{{ $product->businessProfile ? $product->businessProfile->location : '' }}</td>

                                </tr>
                                <tr>
                                    <td>Total Employees:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Year Established:</td>
                                    <td class="ic-primary"></td>

                                </tr>
                            </table>
                        </div>
                        <div class="ic-hr-devider"></div>
                    </div>
                    <span class="com_detalts" >Comapny Details</span>

                    <div class="ic-product-detail">
                        <div class="ic-product-overview">
                            <div class="ic-product-description">
                                <div class="ic-s-product-desc">

                                </div>
                            </div>
                            <div class="ic-p-overview-video company-profile-intro-video" style="background-image:">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="factory-tour" class="col s12">
                <div class="card product_details_tab">
                    <h3>Overview</h3>
                    <div class="ic-factory-flex">
                        <div class="ic-ff-left">
                            <h4>Factory tour photos</h4>
                        </div>
                        <div class="ic-ff-right">

                        </div>
                    </div>
                    <div class="ic-factory-flex">
                        <div class="ic-ff-left">
                            <h4>Factory &amp; machinery detail</h4>
                        </div>
                        <div class="ic-ff-right">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
@endsection


@push('js')
    <script>

        var serverURL = "{{ env('CHAT_URL'), 'localhost' }}:3000";
        var socket = io.connect(serverURL);
        socket.on('connect', function(data) {
        //alert('connect');
        });
        @if(Auth::check())
        function sendmessage(productId,productTitle,productCategory,moq,qtyUnit,pricePerUnit,priceUnit,productImage,createdBy)
        {
        let message = {'message': 'We are Interested in Your Product ID:mb-'+productId+' and would like to discuss More about the Product', 'product': {'id': "MB-"+productId,'name': productTitle,'category': productCategory,'moq': moq,'price': priceUnit+" "+pricePerUnit, 'image': productImage}, 'from_id' : "{{Auth::user()->id}}", 'to_id' : createdBy};
        socket.emit('new message', message);
        setTimeout(function(){
            //window.location.href = "/message-center";
            var url = '{{ route("message.center") }}?uid='+createdBy;
                // url = url.replace(':slug', sku);
                window.location.href = url;
            // window.location.href = "/message-center?uid="+createdBy;
        }, 1000);
        }

        function updateUserLastActivity(form_id, to_id)
        {
        var form_id = form_id;
        var to_id = to_id;
        var csrftoken = $("[name=_token]").val();

        data_json = {
            "form_id": form_id,
            "to_id": to_id,
            "csrftoken": csrftoken
        }
        var url= '{{route("message.center.update.user.last.activity")}}';
        jQuery.ajax({
            method: "POST",
            url: url,
            headers:{
                "X-CSRF-TOKEN": csrftoken
            },
            data: data_json,
            dataType:"json",

            success: function(data){
                console.log(data);
            }
        });

        }

        function contactSupplierFromProduct(supplierId)
        {

        var supplier_id = supplierId;
        var csrftoken = $("[name=_token]").val();
        var buyer_id = "{{Auth::id()}}";
        data_json = {
            "supplier_id": supplier_id,
            "buyer_id": buyer_id,
            "csrftoken": csrftoken
        }
        var url='{{route("message.center.contact.supplier.from.product")}}';
        jQuery.ajax({
            method: "POST",
            url:url,
            headers:{
                "X-CSRF-TOKEN": csrftoken
            },
            data: data_json,
            dataType:"json",
            success: function(data){
                console.log(data);
            }
        });

        /*
        let message = {'message': 'Hi I would like to discuss More about your Product', 'product': null, 'from_id' : "{{Auth::user()->id}}", 'to_id' : supplierId};
        socket.emit('new message', message);
        setTimeout(function(){
            window.location.href = "/message-center?uid="+supplierId;
        }, 1000);
        */
        }

        function sendsamplemessage(productId,productTitle,productCategory,moq,qtyUnit,pricePerUnit,priceUnit,productImage,createdBy)
        {
        let message = {'message': 'We are Interested in Your Product ID:mb-'+productId+' and would like to discuss More about the Product', 'product': {'id': "MB-"+productId,'name': productTitle,'category': productCategory,'moq': moq,'price': priceUnit+" "+pricePerUnit, 'image': productImage}, 'from_id' : "{{Auth::user()->id}}", 'to_id' : createdBy};
        socket.emit('new message', message);
        setTimeout(function(){
            window.location.href = "/message-center";
        }, 1000);
        }
        @endif
    </script>

@endpush
