@extends('layouts.app_containerless')

@section('content')
@php
    $product_type = array_key_exists('product_type', app('request')->input())?app('request')->input('product_type'):[];
    $location = array_key_exists('location', app('request')->input())?app('request')->input('location'): '';
    $product_name = array_key_exists('product_name', app('request')->input())?app('request')->input('product_name'): '';
    $lead_minimum_range = array_key_exists('lead_minimum_range', app('request')->input())?app('request')->input('lead_minimum_range'): '';
    $lead_maximum_range = array_key_exists('lead_maximum_range', app('request')->input())?app('request')->input('lead_maximum_range'): '';
    $select_product_category= array_key_exists('product_category', app('request')->input())?app('request')->input('product_category'): '';
    $factory_category = array_key_exists('factory_category', app('request')->input())?app('request')->input('factory_category'): '';
    $price_minimum_range = array_key_exists('price_minimum_range', app('request')->input())?app('request')->input('price_minimum_range'): '';
    $price_maximum_range = array_key_exists('price_maximum_range', app('request')->input())?app('request')->input('price_maximum_range'): '';
    $gender = array_key_exists('gender', app('request')->input())?app('request')->input('gender'): [];
    $sample_availability = array_key_exists('sample_availability', app('request')->input())?app('request')->input('sample_availability'): [];
@endphp

    {{-- @if(count($low_moq_lists)>0) --}}
    <div class="mainContainer">
        <div class="container">

        <div class="products_filter_wrapper">
                <div class="row">
                    <div class="col s12 m3 left-column">
                        <div class="products_filter_list">
                            <h3>Filter by</h3>
                            <form action="{{route('low.moq')}}" method="get" id="product_filter_form">
                                {{--location search  --}}
                                <div class="filter_search filter_box">
                                    <h4>Location</h4>
                                    <div class="filter_search_inputbox">
                                        <i class="material-icons">pin_drop</i>
                                        <input class="filter_search_input typeahead" type="text" name="location" placeholder="Type any location" value="{{$location}}">
                                        {{-- <input class="btn_green btn_search" type="submit" value="search" onclick="this.form.submit();"> --}}

                                    </div>
                                </div>
                                {{-- product_type --}}
                                <div class="filter_box">
                                    <h4>Product Type</h4>
                                    <p>
                                        <label>
                                            <input class="btn_radio" type="checkbox" value="2"  name="product_type[]" {{ (in_array('2', $product_type))?'checked':'' }} onclick="this.form.submit();"/>
                                            <span>Ready to Ship</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                        <input class="btn_radio" type="checkbox" value="1" name="product_type[]" {{ (in_array('1', $product_type))?'checked':'' }}  onclick="this.form.submit();"/>
                                            <span>Design</span>
                                        </label>
                                    </p>
                                </div>

                                {{--category--}}
                                <div class="filter_box filter_min_max">
                                    <h4>Product Category</h4>
                                    <select class="select2" name="product_category" id="product_category">
                                        <option value="">Select</option>
                                        @foreach($product_category as $category)
                                        <option value="{{$category->id}}" {{$category->id == $select_product_category ? 'selected' : ''}}>
                                            {{$category['name']}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{--factory category--}}
                                <div class="filter_box filter_min_max">
                                    <h4>Factory Category</h4>
                                    <select class="select2" name="factory_category" id="factory_category">
                                        <option value="">Select</option>
                                        @foreach($manufacture_product_categories as $category)
                                        <option value="{{$category->id}}" {{$category->id == $factory_category ? 'selected' : ''}}>
                                            {{$category['name']}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- price --}}
                                <div class="filter_box filter_min_max">
                                    <h4>Price</h4>
                                    <div class="price-slider-wrapper">
                                        <div class="row price-value">
                                            <input type="text" name="price_minimum_range" id="minimum_range" class="form-control filter-search-price-range" placeholder="min"  value="{{$price_minimum_range}}" />
                                            <span class="price-divider to">to</span>
                                            <input type="text" name="price_maximum_range" id="maximum_range" class="form-control filter-search-price-range" placeholder="max" value="{{$price_maximum_range}}" />
                                            <span class="price-divider"></span>
                                            {{-- <a href="javascript:void(0);"class="waves-effect waves-block waves-light btn green lighten-1 btn-filter-search-price-range filter-search-check-price-range" style="display: none;">Ok </a> --}}
                                            <input class="btn_green btn_search btn_filter_submit" type="submit" value="ok" onclick="this.form.submit();">
                                        </div>
                                    </div>
                                </div>

                                {{-- lead time --}}
                                <div class="filter_box filter_min_max">
                                    <h4>Lead Time</h4>
                                    <div class="price-slider-wrapper">
                                        <div class="row price-value">
                                            <input type="text" name="lead_minimum_range" id="minimum_range" class="form-control filter-search-price-range" placeholder="min"  value="{{$lead_minimum_range}}" />
                                            <span class="price-divider to">to</span>
                                            <input type="text" name="lead_maximum_range" id="maximum_range" class="form-control filter-search-price-range" placeholder="max" value="{{$lead_maximum_range}}" />
                                            <span class="price-divider"></span>
                                            {{-- <a href="javascript:void(0);"class="waves-effect waves-block waves-light btn green lighten-1 btn-filter-search-price-range filter-search-check-price-range" style="display: none;">Ok </a> --}}
                                            <input class="btn_green btn_search btn_filter_submit" type="submit" value="ok" onclick="this.form.submit();">
                                        </div>
                                    </div>
                                </div>

                                {{-- gender --}}
                                <div class="filter_box">
                                    <h4>Gender</h4>
                                    <p>
                                        <label>
                                            <input class="btn_radio" type="checkbox" value="1"  name="gender[]" {{in_array(1, $gender) ? 'checked' : ''}}  onclick="this.form.submit();"/>
                                            <span>Male</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input class="btn_radio" type="checkbox" value="2"  name="gender[]" {{in_array(2, $gender) ? 'checked' : ''}}  onclick="this.form.submit();"/>
                                            <span>Female</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input class="btn_radio" type="checkbox" value="3"  name="gender[]" {{in_array(3, $gender) ? 'checked' : ''}} onclick="this.form.submit();"/>
                                            <span>Unisex</span>
                                        </label>
                                    </p>
                                </div>

                                {{-- Sample availability --}}
                                <div class="filter_box">
                                    <h4>Sample availability</h4>
                                    <p>
                                        <label>
                                            <input class="btn_radio" type="checkbox" value="1"  name="sample_availability[]" {{in_array(1, $sample_availability) ? 'checked' : ''}}  onclick="this.form.submit();"/>
                                            <span>Yes</span>
                                        </label>
                                    </p>
                                    <p>
                                        <label>
                                            <input class="btn_radio" type="checkbox" value="0"  name="sample_availability[]" {{in_array(0, $sample_availability) ? 'checked' : ''}}   onclick="this.form.submit();"/>
                                            <span>No</span>
                                        </label>
                                    </p>
                                </div>

                                <a class='btn_green btn_clear' href="{{route('low.moq')}}"> Reset </a>
                            </form>
                        </div>
                    </div>
                    <div class="col s12 m9 content-column">
                        <div class="show-product-results-wrapper products_filter_search_wrap">
                            <div class="filter_search">
                                <form action="" method="get">
                                    <div class="filter_search_inputbox">
                                        <i class="material-icons">search</i>
                                        <input class="filter_search_input " type="text" name="product_name" placeholder="Type product name" value="{{$product_name}}">
                                        <input class="btn_green btn_search" type="submit" value="search" onclick="">
                                    </div>
                                </form>
                            </div>
                            <div class="show-product-results-inside-wrapper">
                                <div class="show-total-results">
                                    Showing {{($low_moq_lists->currentpage()-1)*$low_moq_lists->perpage()+1}} to {{$low_moq_lists->currentpage()*$low_moq_lists->perpage()}} of  {{$low_moq_lists->total()}} results
                                </div>
                            </div>
                        </div>
                        @if(count($low_moq_lists)>0)
                        <div class="prodcuts-list">
                            <div class="product_wrapper">
                                <h3>Low MOQ Products</h3>
                                <div class="low_moq_products_wrap product_boxwrap row"  id="low_moq_body">
                                @foreach ($low_moq_lists  as $list )

                                    <div class="col s6 m4">
                                        <div class="productBox">
                                            @php
                                                if($list->flag == 'shop'){
                                                    $title=$list->name;
                                                    if($list->images()->exists()){
                                                        $img= asset('storage').'/'.$list->images[0]->image;
                                                    }else{
                                                        $img= asset('storage').'/'.'images/supplier.png';
                                                    }
                                                }else{
                                                    $title=$list->title;
                                                    if($list->product_images()->exists()){
                                                        $img= asset('storage').'/'.$list->product_images[0]->product_image;
                                                    }else{
                                                        $img= asset('storage').'/'.'images/supplier.png';
                                                    }
                                                }
                                            @endphp
                                            <div class="favorite">
                                                @if(in_array($list->id,$wishListShopProductsIds) || in_array($list->id,$wishListMfProductsIds))
                                                    <a href="javascript:void(0);" onclick="addToWishList('{{$list->flag}}', '{{$list->id}}', $(this));"  class="product-add-wishlist active">
                                                        <i class="material-icons dp48">favorite</i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0);" onclick="addToWishList('{{$list->flag}}', '{{$list->id}}', $(this));" class="product-add-wishlist">
                                                        <i class="material-icons dp48">favorite</i>
                                                    </a>
                                                @endif
                                            </div>

                                            <div class="inner_productBox">
                                                <div class="imgBox"><a href="{{ route("mix.product.details", [$list->flag, $list->id]) }}"><img src="{{$img}}"></a></div>
                                                <div class="products_inner_textbox">
                                                        <div class="priceBox row">
                                                            <div class="col s12 m4 apperal">
                                                                <a href="{{ route("supplier.profile",$list->businessProfile->alias) }}">
                                                                    @if($list->flag == 'mb')
                                                                        {{ucfirst($list->category->name)}}
                                                                    @else
                                                                        {{$list->product_type == 3 ? 'Non-Clothing' : 'Apparel'}}
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="price col s12 m8 right-align moq-value">
                                                                @if($list->flag == 'mb') $ {{$list->price_per_unit}} / {{$list->qty_unit}} @endif
                                                                @if($list->flag == 'shop')
                                                                    @php
                                                                        $count= count(json_decode($list->attribute));
                                                                        $count = $count-2;
                                                                    @endphp
                                                                    @foreach (json_decode($list->attribute) as $k => $v)
                                                                        @if($k == 0 && $v[2] == 'Negotiable')
                                                                            <span class="price_negotiable">{{ 'Negotiable' }}</span>
                                                                        @endif
                                                                        @if($loop->last && $v[2] != 'Negotiable')
                                                                        $ {{ $v[2] }} / {{$list->product_unit}}{{-- $ is the value for price unite --}}
                                                                        @endif
                                                                        @if($loop->last && $v[2] == 'Negotiable')
                                                                            @foreach (json_decode($list->attribute) as $k => $v)
                                                                                    @if($k == $count)
                                                                                    $ {{ $v[2]  }} {{ 'Negotiable' }} {{-- $ is the value for price unite --}}
                                                                                    @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <h4><a href="{{ route("mix.product.details", [$list->flag, $list->id]) }}" >{{$title}}</a></h4>

                                                        @if(isset($list->moq))
                                                            <div class="product_moq">MOQ: {{$list->moq}} {{$list->flag == 'mb' ? $list->qty_unit : $list->product_unit}}</div>
                                                        @endif
                                                        @if($list->flag == 'mb' && isset($list->lead_time))
                                                            <div class="product_lead_time">Lead time:
                                                                @php
                                                                    $pattern= '/[^0-9\-]/';
                                                                    $preg_replace= preg_replace($pattern, '', $list->lead_time);
                                                                @endphp
                                                                {{$preg_replace}} days
                                                            </div>
                                                        @else
                                                            @if($list->product_type == 1)
                                                                <div class="product_lead_time">Lead time:

                                                                    {{getLeadTime($list)}}
                                                                    {{-- @php
                                                                    $count= count(json_decode($list->attribute));
                                                                    $count = $count-2;
                                                                    @endphp
                                                                    @foreach (json_decode($list->attribute) as $k => $v)
                                                                        @if($k == 0 && $v[2] == 'Negotiable')
                                                                        {{$v[3]}}
                                                                        @endif
                                                                        @if($loop->last && $v[2] != 'Negotiable')
                                                                            {{ $v[3] }}
                                                                        @endif
                                                                        @if($loop->last && $v[2] == 'Negotiable')
                                                                            @foreach (json_decode($list->attribute) as $k => $v)
                                                                                    @if($k == $count)
                                                                                        {{ $v[3]  }}
                                                                                    @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach --}}
                                                                </div>
                                                            @endif
                                                        @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                                </div>
                            </div>
                        </div>

                        @else
                            <div class="card-alert card cyan">
                                <div class="card-content white-text">
                                    <p>INFO : No products available.</p>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>





        </div>
    </div>
    <div class="pagination-block-wrapper">
        <div class="col s12 center">
            {!! $low_moq_lists->appends(request()->query())->links() !!}
        </div>
    </div>
    {{-- @else
        <div class="card-alert card cyan">
            <div class="card-content white-text">
                <p>INFO : No products available.</p>
            </div>
        </div>
    @endif --}}

@endsection

@push('js')
    <script>
          var path = "{{ route('get.supplier.location.data') }}";
            $('input.typeahead').typeahead({
                source:  function (query, process) {
                return $.get(path, { query: query }, function (data) {
                        return process(data);
                    });
                }
            });

        $("#product_category").change(function(){
            $('#product_filter_form').submit();
        });
        $("#factory_category").change(function(){
            $('#product_filter_form').submit();
        });
        /*$(document).ready(function(){
            var $pagination = $('#pagination'),
                totalRecords = 0,
                records = [],
                displayRecords = [],
                recPerPage = 12,
                page = 1,
                totalPages = 0;
                var url = '{{ route("low.moq.data") }}';
                $.ajax({
                    url: url,
                    async: true,
                    crossDomain: true,
                    dataType: 'json',
                    beforeSend: function() {
                        $('.loading-message').html("Please Wait.");
                        $('#loadingProgressContainer').show();
                    },
                    success: function (data) {
                                $('.loading-message').html("");
                                $('#loadingProgressContainer').hide();
                                records = data;
                                console.log(records);
                                totalRecords = records.length;
                                totalPages = Math.ceil(totalRecords / recPerPage);
                                apply_pagination();
                    }
                });

                function generate_table() {
                    var tr;
                    $('#low_moq_body').html('');
                    for (var i = 0; i < displayRecords.length; i++) {
                            //title, name
                            if(displayRecords[i].hasOwnProperty('title')){
                                var title = displayRecords[i].title;
                            }else
                            {
                                var  title = displayRecords[i].name;
                            }
                            //img
                            if(displayRecords[i].flag == 'shop'){
                                var img= "{{asset('storage/')}}"+'/'+displayRecords[i].images[0].image;
                            }else{
                                var img= "{{asset('storage/')}}"+'/'+displayRecords[i].product_images[0].product_image;
                            }
                            //details route
                                var details_url = '{{ route("mix.product.details", [":flag", ":product_id"]) }}';
                                    details_url = details_url.replace(':flag', displayRecords[i].flag);
                                    details_url = details_url.replace(':product_id', displayRecords[i].id);
                            //business name
                                var business_profile_url='{{ route("supplier.profile",":business_profile_id") }}';
                                    business_profile_url= business_profile_url.replace(':business_profile_id', displayRecords[i].business_profile_id);
                            tr = $('<div class="col m3 productBox">');
                            tr.append('<div class="imgBox"><a href='+details_url+'><img src='+img+'></a></div>');
                            tr.append('<h4>' +title+ '</h4');
                            tr.append('<div class="moqBox">MOQ:' + displayRecords[i].moq  + '</div>');
                            tr.append('<div class="moq_view_details">');
                            tr.append('<a class="moq_buss_name moq_left left" href="'+business_profile_url+'">'+displayRecords[i].business_profile.business_name+'</a>')
                            tr.append('<a class="moq_view moq_right right" href='+details_url+'>View Details </a>');
                            tr.append('</div>');
                            tr.append('</div>');
                            $('#low_moq_body').append(tr);
                    }
                }

                function apply_pagination() {
                    $pagination.twbsPagination({
                            totalPages:totalPages ,
                            visiblePages: 6,
                            onPageClick: function (event, page) {
                                displayRecordsIndex = Math.max(page - 1, 0) * recPerPage;
                                endRec = (displayRecordsIndex) + recPerPage;

                                displayRecords = records.slice(displayRecordsIndex, endRec);
                                generate_table();
                            }
                    });
                }

        });*/



    </script>
@endpush
