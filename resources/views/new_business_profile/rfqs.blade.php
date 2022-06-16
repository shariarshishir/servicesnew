@php
    $product_tag = array_key_exists('product_tag', app('request')->input())?app('request')->input('product_tag'): [];
    $start_date = array_key_exists('start_date', app('request')->input())?app('request')->input('start_date'): '';
    $end_date = array_key_exists('end_date', app('request')->input())?app('request')->input('end_date'): '';
@endphp
@extends('layouts.app_containerless')
@section('content')

<div class="account_profile_wrapper">

    <div class="account_profile_menu">
        <div class="container">
            <div class="profile_account_desktop_menu">
                @include('new_business_profile.profile_menu')
            </div>

            <div class="profile_account_mobile_menu" style="display: none;">
                <div class="row">
                    <div class="col s12">
                        <div class="profile_account_rightbar">
                            <a onclick="openProfileAccountNav()" href="javascript:void(0);" class="btn-product-sidenav"><i class="material-icons">filter_alt</i></a>
                        </div>
                    </div>
                    <div class="col s12">
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">menu</i></div>
                                <div class="collapsible-body">
                                    @include('new_business_profile.profile_menu')
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="profileAccountRight">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeProfileAccountNav()"><i class="material-icons">clear</i></a>

                    <div class="new_profile_account_rightsidebar_mobile">
                        <form action="{{route('new.profile.rfqs',$alias)}}">
                            <div class="new_profile_account_filterbar">
                                <h4>Filtered by</h4>
                                <div class="new_profile_account_filterbox">
                                    <label>Product tags</label>
                                    <select class="select2 dropdownOptions mobile-rfq-filter-select"  name="product_tag[]" multiple>
                                        @foreach ($product_tags as $pt)
                                            <option value={{$pt->id}} {{ (in_array($pt->id, $product_tag))?'selected':'' }}>{{$pt->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="account_filter_progress_wrap">
                                    <h4>Lead Time</h4>
                                    <div id="mobile_reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                </div>
                                <input type="hidden" name="start_date" class="mobile_start_date" value="{{$start_date??''}}">
                                <input type="hidden" name="end_date" class="mobile_end_date" value="{{$end_date??''}}">
                                <div class="filter_reset_bottom_bar row">
                                    <div class="left">
                                        <input type="submit" class="btn_green btn_clear mobile-rfq-filter-reset" value="submit" style="display: none;">
                                    </div>
                                    <div class="right">
                                        <a class="btn_green btn_clear mobile-rfq-filter-reset" href="{{route('new.profile.rfqs',$alias)}}" style="display: none;"> Reset </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="profile_account_innerinfo_wrap">
        <div class="container">
            <div class="account_profile_box">
                <div class="row">
                    <div class="col s12 m3 l2">
                        <div class="account_item_menu">
                            <ul>
                                <li class="profile_explore {{ Route::is('new.profile.rfqs', $alias) ? 'active' : ''}}">
                                    <a href="{{route('new.profile.rfqs', $alias)}}">
                                        <div class="icon_img">&nbsp;</div>
                                        <h4>Explore</h4>
                                    </a>
                                </li>
                                <li class="profile_my_rfq {{ Route::is('new.profile.my_rfqs', $alias) ? 'active' : ''}}">
                                    <a href="{{route('new.profile.my_rfqs', $alias)}}">
                                        <div class="icon_img">&nbsp;</div>
                                        <h4>My RFQs</h4>
                                    </a>
                                </li>
                                <li class="profile_my_rfq {{ Route::is('new.profile.my_queries', $alias) ? 'active' : ''}}">
                                    <a href="{{route('new.profile.my_queries', $alias)}}">
                                        <div class="icon_img">&nbsp;</div>
                                        <h4>Queries</h4>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col s12 m9 l10">
                        <div class="profile_account_explore_info">
                            <div class="row">
                                <div class="col s12 m12 l9">
                                    <div class="profile_account_searchBar">
                                        <div class="row">
                                            <div class="col s12 m5 l4">
                                                <a class="modal-trigger open-create-rfq-modal post_new" href="#create-rfq-form">
                                                    <i class="material-icons">add</i><span>Post New</span>
                                                </a>
                                            </div>
                                            <div class="col s12 m7 l8">
                                                <form action="{{route('new.profile.search_rfqs',$alias)}}">
                                                    @csrf
                                                    <div class="profile_account_search">
                                                        <i class="material-icons">search</i>
                                                        <input class="profile_filter_search" type="search" name="search_input" placeholder="Search Merchant Bay Studio/Raw Material Libraries" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product_design_wrapper profile_account_rfqproduct">
                                        <div class="row">
                                        @foreach ($rfqLists as $rfqSentList)
                                            <div class="col s6 m6 l4 product_item_box">
                                                <div class="productBox">
                                                    <div class="inner_productBox">
                                                        <a class="modal-trigger " href="#details-rfq-modal-{{$rfqSentList['id']}}">
                                                            @if(count($rfqSentList['images']) > 0)
                                                                @foreach ($rfqSentList['images'] as  $key => $rfqImage )
                                                                    @if( pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'png' || pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'PNG' || pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'jpeg' || pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'JPEG' || pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'jpg' || pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'JPG')
                                                                    <div class="imgBox rfq_thum_img">
                                                                        <img src="{{ $rfqImage['image'] }}" class="rfqImage" alt="">
                                                                    </div>
                                                                    @break
                                                                    @elseif( pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'pdf' || pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'PDF')
                                                                    <div class="imgBox rfq_thum_img">
                                                                        <img src="https://s3.ap-southeast-1.amazonaws.com/development.service.products/public/frontendimages/new_layout_images/pdf-bg.png" class="rfqFileImage" alt="">
                                                                    </div>
                                                                    @break
                                                                    @elseif( pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'doc' || pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'DOC' ||  pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'docx') || pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'DOCX')
                                                                    <div class="imgBox rfq_thum_img">
                                                                        <img src="https://s3.ap-southeast-1.amazonaws.com/development.service.products/public/frontendimages/new_layout_images/doc-bg.png" class="rfqFileImage" alt="">
                                                                    </div>
                                                                    @break
                                                                    @elseif( pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'xlsx' || pathinfo($rfqImage['image'], PATHINFO_EXTENSION) == 'XLSX' )
                                                                    <div class="imgBox rfq_thum_img">
                                                                        <img src="https://s3.ap-southeast-1.amazonaws.com/development.service.products/public/frontendimages/new_layout_images/excel-bg.png" class="rfqFileImage" alt="">
                                                                    </div>
                                                                    @break
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            <div class="products_inner_textbox">
                                                                <h4><span>{{$rfqSentList['title']}}</span></h4>
                                                                <div class="row">
                                                                    <div class="col s12 m6">
                                                                        <div class="product_moq">
                                                                            Unit Price: <br/> <span>{{$rfqSentList['unit_price']}}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col s12 m6">
                                                                        <div class="pro_leadtime">
                                                                            Lead Time <br/> <span>{{ date('F j, Y',strtotime($rfqSentList['delivery_time'])) }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        @include('new_business_profile.rfq_details_modal')
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m12 l3 new_profile_account_rightsidebar_desktop">
                                    <form action="{{route('new.profile.rfqs',$alias)}}">
                                        <div class="new_profile_account_filterbar">
                                            <h4>Filtered by</h4>
                                            <div class="new_profile_account_filterbox">
                                                <label>Product tags</label>
                                                <select class="select2 dropdownOptions rfq-filter-select"  name="product_tag[]" multiple>
                                                    @foreach ($product_tags as $pt)
                                                        <option value={{$pt->id}} {{ (in_array($pt->id, $product_tag))?'selected':'' }}>{{$pt->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="account_filter_progress_wrap">
                                                <h4>Lead Time</h4>
                                                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                                    <i class="fa fa-calendar"></i>&nbsp;
                                                    <span></span> <i class="fa fa-caret-down"></i>
                                                </div>
                                            </div>
                                            <input type="hidden" name="start_date" class="start_date" value="{{$start_date??''}}">
                                            <input type="hidden" name="end_date" class="end_date" value="{{$end_date??''}}">
                                            <div class="filter_reset_bottom_bar row">
                                                <div class="left">
                                                    <input type="submit" class="btn_green btn_clear rfq-filter-reset" value="submit" style="display: none;">
                                                </div>
                                                <div class="right">
                                                    <a class="btn_green btn_clear rfq-filter-reset" href="{{route('new.profile.rfqs',$alias)}}" style="display: none;"> Reset </a>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('new_business_profile.create_rfq_modal')
@include('new_business_profile.share_modal')
@endsection

@push('js')
<script>
        $('.rfq-filter-select').on('change', function() {
            $('.rfq-filter-reset').show();
        });
        var check_selected_val =  $( ".rfq-filter-select option:selected" ).val();
        if(check_selected_val != undefined){
            $('.rfq-filter-reset').show();
        }


        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

            $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                $('.rfq-filter-reset').show();
                $('.start_date').val(picker.startDate.format('YYYY-MM-DD'));
                $('.end_date').val(picker.endDate.format('YYYY-MM-DD'));

            });


        });



        //mobile view
        $('.mobile-rfq-filter-select').on('change', function() {
            $('.mobile-rfq-filter-reset').show();
        });
        var check_selected_val =  $( ".mobile-rfq-filter-select option:selected" ).val();
        if(check_selected_val != undefined){
            $('.mobile-rfq-filter-reset').show();
        }


        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#mobile_reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#mobile_reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

            $('#mobile_reportrange').on('apply.daterangepicker', function(ev, picker) {
                $('.mobile-rfq-filter-reset').show();
                $('.mobile_start_date').val(picker.startDate.format('YYYY-MM-DD'));
                $('.mobile_end_date').val(picker.endDate.format('YYYY-MM-DD'));

            });


        });



</script>
@endpush
