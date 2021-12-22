
@extends('layouts.app_containerless')
@section('content')

    <div class="mainContainer">
        <div class="container">
            <div class="product_wrapper">
                <div class="product_boxwrap">
                    <h3>Search Results</h3>
            
                    @foreach($allItems as $key=>$item)
                    @if($item->flag=="shop")
                    <div class="product-item">
                        <a href="{{ route('mix.product.details', [$item->flag, $item->id]) }}" class="overlay_hover">&nbsp;</a>
                        <div class="product-img">
                            <img src="">
                        </div>
                        <div class="product-short-intro">
                            <h4>name</h4>
                            <div class="details">
                                <p>MO  quoted_printable_decode</p>
                            </div>
                        </div>
                    </div>
                    @elseif($item->flag=="mb")
                    <div class="product-item">
                        <a href="{{ route('mix.product.details', [$item->flag, $item->id]) }}" class="overlay_hover">&nbsp;</a>
                        <div class="product-img">
                            <img src="{{asset('storage').'/'.$item->images[0]->image}}">
                        </div>
                        <div class="product-short-intro">
                            <h4>{{$item->title}}</h4>
                            <div class="details">
                                <p>MOQ: {{$item->title}}</p>
                            </div>
                        </div>
                    </div>
                    @elseif( $item->title && $item->slug )
                    <div class="product-item">
                        <a href="{{route('blogs.details',$blog->slug)}}" class="overlay_hover">&nbsp;</a>
                        <div class="product-img">
                            <img src="'+image+'">
                        </div>                       
                        <div class="product-short-intro">
                            <h4>'+response.data[i].title+'</h4>
                            <div class="details">
                                <p>'+response.data[i].details.substring(0, 100)+'</p>
                            </div>
                        </div>
                    </div>
                    @else
                    
                    <div class="product-item">
                        <a href="{{route('supplier.profile', $item->id)}}" class="overlay_hover">&nbsp;</a>
                        <div class="product-img">
                            <img src="{{ asset('storage/'.$item->feature_image) }}">
                        </div>
                        <div class="product-short-intro">
                            <h4>{{$item->business_name}}</h4>
                            <div class="details">
                                <p>{{$item->industry_type}}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endfor
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
@endpush



