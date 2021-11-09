
@extends('layouts.app_containerless')


@section('content')
    <div id="main">
        <div class="row">
            <div class="main-content-area">
                <div class="container">
                    <div class="row">
                        <div class="col m3 left-column">
                            <div class="module shop-categories-wrap">
                                <h3>Price Filter</h3>
                                @php
                                    $segment2 = Request::segment(2);
                                    $segment3 = Request::segment(3);
                                    $segment4 = Request::segment(4);
                                @endphp
                                <ul>
                                    @foreach($categories as $category)
                                    <li class="@php echo ($category['slug'] == $segment2)?' active':''; @endphp">
                                        <a href="{{route('categories.product',$category['slug'])}}">
                                            {{$category['name']}}
                                            @if(!empty($category['children']))
                                                <span><i class="material-icons dp48">chevron_right</i></span>
                                            @endif
                                        </a>
                                        @if(!empty($category['children']))
                                        <ul class="sub-level">
                                            <li class="parent-cat-as-heading">{{$category['name']}}</li>
                                            @foreach($category['children'] as $childcategory)
                                                <li class="@php echo ($childcategory['slug'] == $segment3)?' active':''; @endphp">
                                                    {{-- <a href="{{route('categories.product',$childcategory['slug'])}}">{{ $childcategory['name'] }}</a> --}}
                                                    <a href="{{route('subcategories.product',['category'=>$category['slug'],'subcategory'=>$childcategory['slug']])}}">
                                                        {{ $childcategory['name'] }}
                                                        @if(!empty($childcategory['children']))
                                                            <span><i class="material-icons dp48">chevron_right</i></span>
                                                        @endif
                                                    </a>
                                                </li>
                                                @if(!empty($childcategory['children']))
                                                <ul class="sub-level">
                                                    <li class="parent-cat-as-heading">{{$childcategory['name']}}</li>
                                                    @foreach($childcategory['children'] as $childcategory2)
                                                        <li class="@php echo ($childcategory2['slug'] == $segment4)?' active':''; @endphp">
                                                            <a href="{{route('sub.subcategories.product',['category'=>$category['slug'],'subcategory'=>$childcategory['slug'],'subsubcategory'=>$childcategory2['slug']])}}">{{ $childcategory2['name'] }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach

                                    {{-- @foreach($categories as $category)
                                    <li class="@php echo ($category['slug'] == $segment2)?' active':''; @endphp"><a href="{{route('categories.product',$category['slug'])}}">{{$category['name']}}</a></li>
                                    @endforeach --}}
                                </ul>
                                <hr class="p-0 mb-10" style="opacity: 0.3; margin: 20px 0px;">
                            </div>
                            <form action="#" class="filter-search-form" method="get">
                                <div class="module-price-filter">
                                    <h3>Price Filter</h3>
                                    <div class="price-slider-wrapper">
                                        <div id="price-slider">
                                            <div class="row price-value">
                                                <input type="text" name="minimum_range" id="minimum_range" class="form-control filter-search-price-range" placeholder="min"  value="" />
                                                <span class="price-divider">to</span>
                                                <input type="text" name="maximum_range" id="maximum_range" class="form-control filter-search-price-range" placeholder="max" value="" />
                                                <span class="price-divider"></span>
                                                <a href="javascript:void(0);"class="waves-effect waves-block waves-light btn green lighten-1 btn-filter-search-price-range filter-search-check-price-range" style="display: none;">Ok </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="p-0 mb-10" style="opacity: 0.3; margin: 40px 0px 20px;">
                                </div>
                                <div class="module-color-filter display-grid">
                                    <h3>Color</h3>
                                    @php
                                    $colorItemArray = array(
                                                    "red" => "Red",
                                                    "white" => "White",
                                                    "blue" => "Blue",
                                                    "green" => "Green",
                                                    "black" => "Black",
                                                    "yellow" => "Yellow",
                                                    "purple" => "Purple",
                                                    "gray" => "Gray",
                                                    "beige" => "Beige",
                                                    "pink" => "Pink",
                                                    "gold" => "Gold",
                                                    "orange" => "Orange",
                                                    "silver" => "Silver",
                                                    "brown" => "Brown",
                                                    "khaki" => "Khaki",
                                                    "ivory" => "Ivory",
                                                    "multi" => "Multi"
                                                );
                                    $i = 1;
                                    foreach($colorItemArray as $key => $value)
                                    {
                                    @endphp
                                    <label class="color-item" style="@php echo($i >= 6)?'display:none':'display:block'; @endphp">
                                        <input type="checkbox" name="color" class="filter-search-check" value="{{$key}}">
                                        <span>{{$value}}</span>
                                    </label>
                                    @if($i == 5) <a href="javascript:void(0);" class="view-more-color-trigger">View More</a> @endif
                                    @php
                                    $i++;
                                    }
                                    @endphp
                                    <a href="javascript:void(0);" class="view-less-color-trigger" style="display: none;">View Less</a>
                                    <hr class="p-0 mb-10" style="opacity: 0.3; margin: 20px 0px;">
                                </div>
                                <div class="module-size-filter display-grid">
                                    <h3>Size</h3>
                                    @php
                                    $sizeItemArray = array(
                                                    "xxs" => "XXS",
                                                    "xs" => "XS",
                                                    "small" => "S",
                                                    "medium" => "M",
                                                    "large" => "L",
                                                    "extra_large" => "XL",
                                                    "xxl" => "XXL",
                                                    "xxxl" => "XXXL",
                                                    "four_xxl" => "4XXL",
                                                    "one_size" => "One Size"
                                                );
                                    $i = 1;
                                    foreach($sizeItemArray as $key => $value)
                                    {
                                    @endphp
                                    <label class="size-item" style="@php echo($i >= 6)?'display:none':'display:block'; @endphp">
                                        <input type="checkbox" name="size" class="filter-search-check" value="{{$key}}">
                                        <span>{{$value}}</span>
                                    </label>
                                    @if($i == 5) <a href="javascript:void(0);" class="view-more-size-trigger">View More</a> @endif
                                    @php
                                    $i++;
                                    }
                                    @endphp
                                    <a href="javascript:void(0);" class="view-less-size-trigger" style="display: none;">View Less</a>
                                    <hr class="p-0 mb-10" style="opacity: 0.3; margin: 20px 0px;">
                                </div>
                                <div class="module-rating-filter display-grid">
                                    <h3>Ratings</h3>
                                    {{-- <form action="#" class="display-grid"> --}}
                                        <label class="rating-item">
                                            <input type="checkbox" name="rating" class="filter-search-check" value="5">
                                            <span>
                                                <i class="material-icons amber-text"> star </i>
                                                <i class="material-icons amber-text"> star </i>
                                                <i class="material-icons amber-text"> star </i>
                                                <i class="material-icons amber-text"> star </i>
                                                <i class="material-icons amber-text"> star </i>
                                            </span>
                                        </label>
                                        <label class="rating-item">
                                            <input type="checkbox" name="rating" class="filter-search-check" value="4">
                                            <span>
                                                <i class="material-icons amber-text"> star </i>
                                                <i class="material-icons amber-text"> star </i>
                                                <i class="material-icons amber-text"> star </i>
                                                <i class="material-icons amber-text"> star </i>
                                            </span>
                                        </label>
                                        <label class="rating-item">
                                            <input type="checkbox" name="rating" class="filter-search-check" value="3">
                                            <span>
                                                <i class="material-icons amber-text" > star </i>
                                                <i class="material-icons amber-text"> star </i>
                                                <i class="material-icons amber-text"> star </i>
                                            </span>
                                        </label>
                                        <label class="rating-item" >
                                            <input type="checkbox" name="rating" class="filter-search-check" value="2">
                                            <span>
                                                <i class="material-icons amber-text"> star </i>
                                                <i class="material-icons amber-text"> star </i>
                                            </span>
                                        </label>
                                        <label class="rating-item">
                                            <input type="checkbox" name="rating" class="filter-search-check" value="1">
                                            <span>
                                                <i class="material-icons amber-text" > star </i>
                                            </span>
                                        </label>
                                    {{-- </form> --}}
                                </div>
                                <input type="hidden" class="sorting_category_id" name="filter_search_category_id" value="{{isset($total_cat_id) ? implode(',',$total_cat_id) : ''}}">
                                {{-- <button type="submit" class="waves-effect waves-block waves-light btn green lighten-1 ">Filter </button> --}}
                            </form>

                        </div>
                        <div class="col m9 content-column">
                            <div class="row show-product-results-wrapper">
                                <div class="col s12 m12 l12 show-product-results-inside-wrapper">
                                    <div class="col s12 m6 l6 show-total-results">
                                        Showing {{($products->currentpage()-1)*$products->perpage()+1}} to {{$products->currentpage()*$products->perpage()}} of  {{$products->total()}} results
                                    </div>
                                    <div class="col s12 m6 l6 product-filters-and-views">
                                        <div class="col s6 m8 l8 sorting-filter">
                                            <select class="select2 browser-default sorting">
                                                <option value="" disabled selected>Select</option>
                                                <option value="name">Sort by Name</option>
                                                <option value="created_at">Sort by Latest</option>
                                            </select>
                                            <input type="hidden" value="{{ $segment2 }}" name="slug">
                                        </div>
                                        <div class="col s12 m4 l4 hide-on-med-and-down grid-list-filter">
                                            <a href="javascript:void(0);" class="btn btn-default btn-grid active">
                                                <i class="material-icons dp48">grid_on</i>
                                            </a>
                                            <a href="javascript:void(0);" class="btn btn-default btn-list">
                                                <i class="material-icons dp48">list</i>
                                            </a>
                                        </div>
                                        <div class="flanel-filter hide-on-large-only">
                                            <a href="javascript:void(0);" class="btn btn-defaultbtn waves-effect waves-light green lighten-1 filter-result-btn" onclick="openSideNavFromLeftFilterResult()">
                                                <i class="fas fa-filter"></i>
                                            </a>
                                            <div id="SideNavFromLeftFilterResult" class="sidenav-left">
                                                <a href="javascript:void(0)" class="sideNavCloseBtn" onclick="closeSideNavFromLeftFilterResult()">&times;</a>

                                                <div class="module-price-filter">
                                                    <h3>Price Filter</h3>
                                                    <div class="price-slider-wrapper">
                                                        <div id="price-slider"></div>
                                                    </div>
                                                    <hr class="p-0 mb-10" style="opacity: 0.3; margin: 40px 0px 20px;">
                                                </div>
                                                <div class="module-color-filter">
                                                    <h3>Color</h3>
                                                    <form action="#" class="display-grid">
                                                        <label class="color-item">
                                                            <input type="checkbox">
                                                            <span>White</span>
                                                        </label>
                                                        <label class="color-item">
                                                            <input type="checkbox">
                                                            <span>Black</span>
                                                        </label>
                                                        <label class="color-item">
                                                            <input type="checkbox">
                                                            <span>Amber</span>
                                                        </label>
                                                        <label class="color-item">
                                                            <input type="checkbox">
                                                            <span>Blue</span>
                                                        </label>
                                                        <label class="color-item">
                                                            <input type="checkbox">
                                                            <span>Green</span>
                                                        </label>
                                                        <label class="color-item">
                                                            <input type="checkbox">
                                                            <span>Pink</span>
                                                        </label>
                                                        <label class="color-item">
                                                            <input type="checkbox">
                                                            <span>Yellow</span>
                                                        </label>
                                                    </form>
                                                    <hr class="p-0 mb-10" style="opacity: 0.3; margin: 20px 0px;">
                                                </div>
                                                <div class="module-size-filter">
                                                    <h3>Size</h3>
                                                    <form action="#" class="display-grid">
                                                        <label class="size-item">
                                                            <input type="checkbox">
                                                            <span>XXXL</span>
                                                        </label>
                                                        <label class="size-item">
                                                            <input type="checkbox">
                                                            <span>XXL</span>
                                                        </label>
                                                        <label class="size-item">
                                                            <input type="checkbox">
                                                            <span>XL</span>
                                                        </label>
                                                        <label class="size-item">
                                                            <input type="checkbox">
                                                            <span>M</span>
                                                        </label>
                                                        <label class="size-item">
                                                            <input type="checkbox">
                                                            <span>L</span>
                                                        </label>
                                                        <label class="size-item">
                                                            <input type="checkbox">
                                                            <span>S</span>
                                                        </label>
                                                    </form>
                                                    <hr class="p-0 mb-10" style="opacity: 0.3; margin: 20px 0px;">
                                                </div>
                                                <div class="module-rating-filter">
                                                    <h3>Ratings</h3>
                                                    <form action="#" class="display-grid">
                                                        <label class="rating-item">
                                                            <input type="checkbox">
                                                            <span>
                                                                <i class="material-icons amber-text"> star </i>
                                                                <i class="material-icons amber-text"> star </i>
                                                                <i class="material-icons amber-text"> star </i>
                                                                <i class="material-icons amber-text"> star </i>
                                                                <i class="material-icons amber-text"> star </i>
                                                            </span>
                                                        </label>
                                                        <label class="rating-item">
                                                            <input type="checkbox">
                                                            <span>
                                                                <i class="material-icons amber-text"> star </i>
                                                                <i class="material-icons amber-text"> star </i>
                                                                <i class="material-icons amber-text"> star </i>
                                                                <i class="material-icons amber-text"> star </i>
                                                            </span>
                                                        </label>
                                                        <label class="rating-item">
                                                            <input type="checkbox">
                                                            <span>
                                                                <i class="material-icons amber-text"> star </i>
                                                                <i class="material-icons amber-text"> star </i>
                                                                <i class="material-icons amber-text"> star </i>
                                                            </span>
                                                        </label>
                                                        <label class="rating-item">
                                                            <input type="checkbox">
                                                            <span>
                                                                <i class="material-icons amber-text"> star </i>
                                                                <i class="material-icons amber-text"> star </i>
                                                            </span>
                                                        </label>
                                                        <label class="rating-item">
                                                            <input type="checkbox">
                                                            <span>
                                                                <i class="material-icons amber-text"> star </i>
                                                            </span>
                                                        </label>
                                                    </form>
                                                </div>
                                                <a href="javascript:void(0);" class="waves-effect waves-block waves-light btn green lighten-1 btn-mobile-flanel-filter">Filter</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prodcuts-list">
                                @include('product._products_list')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    $(document).on("click", "#favorite" , function() {
        //console.log('hi');
        var id = $(this).attr("data-productSku");

        swal({
            title: "Want to add this product into wishlist ?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, add it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                    $.ajax({
                        type:'GET',
                        url: "{{route('add.wishlist')}}",
                        dataType:'json',
                        data:{id :id },
                        success: function(data){
                            swal(data.message);
                        }
                    });
                }
            else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })


    });
  </script>

<script>
    $(document).on("click", "#wishList" , function() {
        console.log('hi');
        var id = $(this).attr("data-productSku");
        swal({
            title: "Want to add this product into wishlist ?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, add it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    type:'GET',
                    url: "{{route('add.wishlist')}}",
                    dataType:'json',
                    data:{id :id },
                    success: function(data){
                        swal(data.message);
                    }
                });
            }
            else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })


    });

  </script>
  <script>

    </script>

@endpush

