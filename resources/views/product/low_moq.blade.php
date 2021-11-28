@extends('layouts.app_containerless')

@section('content')

    {{-- <div class="mainContainer">
        <div class="container">
            <div class="product_wrapper">
                <div class="product_boxwrap row">
                    <h3>Low Moq Products</h3>
                    <div class="low_moq_products_wrap">
                        @foreach ($products as $product)
                            <div class="col m3 productBox">
                                <p>{{$product->title ?? $product->name }}</p>
                                @if($product->flag == 'shop')
                                    <div class="imgBox">
                                        <img src="{{asset('storage/'.$product->images[0]['image'])}}" alt="">
                                    </div>
                                @elseif($product->flag == 'mb')
                                    @if($product->product_images()->exists())
                                        <div class="imgBox">
                                            <img src="{{asset('storage/'.$product->product_images[0]['product_image'])}}" alt="">
                                        </div>
                                    @endif
                                @endif
                                <p>moq: {{$product->moq}}</p>

                                @if($product->businessProfile()->exists())
                                    <a href="{{route('supplier.profile',$product->business_profile_id)}}">{{ $product->businessProfile->business_name }}</a>
                                    <a href="{{route('mix.product.details',['flag' => $product->flag, 'id' => $product->id])}}">View details</a>
                                @else
                                    <a href="javascript:void(0);">merchantbay demo</a>
                                    <a href="javascript:void(0);">View details</a>
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="mainContainer">
        <div class="container">
            <div class="product_wrapper">
                <div class="product_boxwrap row"  id="low_moq_body">


                </div>
            </div>
        </div>
    </div>
    <div id="pager">
        <ul id="pagination" class="pagination-sm"></ul>
    </div>

@endsection

@push('js')
    <script>
        $(document).ready(function(){
            var $pagination = $('#pagination'),
                totalRecords = 0,
                records = [],
                displayRecords = [],
                recPerPage = 12,
                page = 1,
                totalPages = 0;
                $.ajax({
                    url: '/low-moq-data',
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
                            tr = $('<div class="col m3">');
                            tr.append("<p>" +title+ "</p");
                            tr.append('<img src='+img+'>');
                            tr.append("<p>Moq:" + displayRecords[i].moq  + "</p>");
                            tr.append("<a href="+business_profile_url+">"+displayRecords[i].business_profile.business_name+"</a>")
                            tr.append("<a href="+details_url+">View Details </a>");
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

        });

    </script>
@endpush
