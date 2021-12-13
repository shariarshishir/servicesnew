@extends('layouts.app')
@section('content')
<section class="content">
    <div class="container-fluid">
       @if(count($wishListItems) > 0)
            <div class="row wishlist_products_wrap">
                <div class="col-md-12">
                    <div class="card card-with-padding">
                        <legend>Wish List</legend>
                        @foreach($wishListItems as $item)
                        <div class="cart-wrapper-{{$item->id}} wishlist-product">
                            <div class="row">
                                <div class="col s12 m12">
                                    <div class="content row">
                                        <div class="product_img col s12 m5 l3">
                                            @foreach($item->product->images as $key=>$image)
                                                @if($key==0)
                                                    <img src="{{URL::asset('storage/'.$image->image)}}" class="responsive-img" alt="" />
                                                @endif
                                            @endforeach
                                        </div>

                                        <div class="product_short_details col s12 m7 l9">

                                            <div class="product-title">{{$item->product->name}}</div>

                                            <div class="product_price">
                                                @php
                                                    $count= count(json_decode($item->product->attribute));
                                                    $count = $count-2;
                                                @endphp
                                                @foreach (json_decode($item->product->attribute) as $k => $v)
                                                    @if($k == 0 && $v[2] == 'Negotiable')
                                                    <span class="price_negotiable">{{ 'Negotiable' }}</span>
                                                    @endif
                                                    @if($loop->last && $v[2] != 'Negotiable')
                                                        ${{ $v[2] }} {{-- $ is the value for price unite --}}
                                                    @endif
                                                    @if($loop->last && $v[2] == 'Negotiable')
                                                        @foreach (json_decode($item->product->attribute) as $k => $v)
                                                                @if($k == $count)
                                                                    ${{ $v[2]  }} {{ 'Negotiable' }} {{-- $ is the value for price unite --}}
                                                                @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach                                                    
                                            </div>

                                            <div class="product_info_short_details">
                                                {!! $item->product->description !!}
                                            </div>

                                            <div class="wishlist_more_details">
                                                <span class="btn_view_wishlist">
                                                    <a href="{{route('productdetails',$item->product->sku)}}" class="product-more-details">View Details</a>
                                                </span>
                                                <span class="btn_remove">
                                                    <a href="javascript:void(0);" data-wishListItemId="{{$item->id}}" class="deleteWishListItem "> <i class="material-icons dp48">delete_outline</i> <span>Remove </span></a>
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="row wishlist_products_wrap">
                <div class="card card-with-padding">
                    <div class="card-alert card cyan">
                        <div class="card-content white-text">
                            <p>INFO : Your wishlist is empty</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

@push('js')

<script>
    $(document).on("click", ".deleteWishListItem" , function() {
        var id = $(this).attr("data-wishListItemId");
        var obj= $(this);
        swal({
            title: "Want to delete this product from ?",
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    type:'GET',
                    url: "{{route('wishlist.item.delete')}}",
                    dataType:'json',
                    data:{id :id },
                    success: function(data){
                        swal(data.message);
                        obj.parent().parent().remove();
                        window.location.reload();
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

@endpush
