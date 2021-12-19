@extends('layouts.app_containerless')

@section('content')

    {{-- <div class="mainContainer">
        <div class="container">
            <div class="product_wrapper">
                <div class="product_boxwrap">
                    <h3>Low Moq Products</h3>
                    <div class="low_moq_products_wrap row">
                        @foreach ($products as $product)
                            <div class="col m3 productBox">

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

                                <h4>{{$product->title ?? $product->name }}</h4>
                                <div class="moqBox">MOQ: {{$product->moq}}</div>

                                <div class="moq_view_details">
                                    @if($product->businessProfile()->exists())
                                        <a class="moq_buss_name moq_left left" href="{{route('supplier.profile',$product->business_profile_id)}}">{{ $product->businessProfile->business_name }}</a>
                                        <a class="moq_view moq_right right" href="{{route('mix.product.details',['flag' => $product->flag, 'id' => $product->id])}}">View details</a>
                                    @else
                                        <a class="moq_demo moq_left left" href="javascript:void(0);">merchantbay demo</a>
                                        <a class="moq_view moq_right right" href="javascript:void(0);">View details</a>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @if(count($low_moq_lists)>0)
    <div class="mainContainer">
        <div class="container">
            <div class="product_wrapper">
                <div class="low_moq_products_wrap product_boxwrap row"  id="low_moq_body">
                @foreach ($low_moq_lists  as $list )
                    @php
                        if($list->flag == 'shop'){
                            $title=$list->name;
                            $img= asset('storage').'/'.$list->images[0]->image;
                        }else{
                            $title=$list->title;
                            $img= asset('storage/').'/'.$list->product_images[0]->product_image;
                        }
                    @endphp

                    <div class="col m3 productBox">
                        <div class="imgBox"><a href="{{ route("mix.product.details", [$list->flag, $list->id]) }}"><img src="{{$img}}"></a></div>
                        <h4>{{$title}}</h4>
                        <div class="moqBox">{{$list->moq}}</div>
                        <div class="moq_view_details">
                            <a class="moq_buss_name moq_left left" href="{{ route("supplier.profile",$list->businessProfile->id) }}">{{$list->businessProfile->business_name}}</a>
                            <a class="moq_view moq_right right" href="{{ route("mix.product.details", [$list->flag, $list->id]) }}">View Details </a>
                        </div>
                    </div>

                @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="pagination-block-wrapper">
        <div class="col s12 center">
            {!! $low_moq_lists->links() !!}
        </div>
    </div>
    @else
        <div class="card-alert card cyan">
            <div class="card-content white-text">
                <p>INFO : No products available.</p>
            </div>
        </div>
    @endif

@endsection

@push('js')
    <script>
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
