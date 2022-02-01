
@extends('layouts.app_containerless')
@section('content')

    <div class="mainContainer">
        <div class="container">
            <div class="product_wrapper">
                <div class="product_boxwrap">
                    <h3>Ready to ship Products</h3>
                    @include('product._products_list')
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



