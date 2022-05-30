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
                            <a onclick="openProfileAccountNav()" href="javascript:void(0);" class="btn-product-sidenav">&nbsp;</a>
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

                <!-- <div id="profileAccountRight">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeProfileAccountNav()"><i class="material-icons">clear</i></a>
                    test
                </div> -->
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
                                <li class="profile_pos_pending {{ Route::is('new.profile.profoma_orders.pending', $alias) ? 'active' : ''}}">
                                    <a href="{{route('new.profile.profoma_orders.pending', $alias)}}">
                                        <div class="icon_img">&nbsp;</div>
                                        <h4>Pending</h4>
                                    </a>
                                </li>
                                <li class="profile_pos_ongoing {{ Route::is('new.profile.profoma_orders.ongoing', $alias) ? 'active' : ''}}">
                                    <a href="{{route('new.profile.profoma_orders.ongoing', $alias)}}">
                                        <div class="icon_img">&nbsp;</div>
                                        <h4>On Going</h4>
                                    </a>
                                </li>
                                <li class="profile_pos_shipped {{ Route::is('new.profile.profoma_orders.shipped', $alias) ? 'active' : ''}}">
                                    <a href="{{route('new.profile.profoma_orders.shipped', $alias)}}">
                                        <div class="icon_img">&nbsp;</div>
                                        <h4>Shipped</h4>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col s12 m9 l10">
                        <div class="profile_account_pos_info">
                            <div class="row">
                                <div class="col s12">
                                    <div class="product_design_wrapper">
                                        <div class="profile_account_searchBar">
                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="profile_account_search">
                                                        <i class="material-icons">search</i>
                                                        <input class="profile_filter_search typeahead" type="text" placeholder="Search Merchant Bay Studio/Raw Material Libraries" />
                                                        <a href="javascript:void(0);" class="reset_po_filter" style="display: none;"><i class="material-icons">restart_alt</i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile_account_poinfo_innerbox">
                                            <div class="row poinfo_account_title_bar">
                                                <div class="col s8">
                                                    @if($status == 0)
                                                        <h4>Pending PIs</h4>
                                                    @elseif($status == 1)
                                                        <h4>Ongoing PIs</h4>
                                                    @else
                                                        <h4>Shipped PIs</h4>
                                                    @endif
                                                </div>
                                                <div class="col s4 right-align">
                                                    <span class="rfqView">{{count($proformas)}} results</span>
                                                </div>
                                            </div>
                                            @foreach($proformas as $proforma)
                                            <div class="row po_block_wrapper">
                                                <div class="col s12 m6 l4 po_block" data-potitle="{{$proforma->proforma_id}}">
                                                    <a href="#po_block_{{$proforma->id}}" class="po_overlay modal-trigger"></a>
                                                    <div class="profile_account_poinfo_box active">
                                                        <div class="row top_download_bar">
                                                            <div class="col s12 m10">
                                                                <h5>{{$proforma->proforma_id}}</h5>
                                                                <span class="poinfo">{{ date('d-m-Y', strtotime($proforma->created_at))}}</span>
                                                            </div>
                                                            <div class="col s12 m2">
                                                                <div class="download_icon">
                                                                    <a href="#"> <img src="{{ Storage::disk('s3')->url('public/account-images/icon-download.png') }}" /></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            @foreach($proforma->performa_items as $item)
                                                            <div class="col s6 m6 xl5">
                                                                <p>Quantity <br/> <b>{{$item->unit}}</b></p>
                                                                <p>Unit Price <br/> <b>{{$item->unit_price}} {{$item->price_unit}}</b></p>
                                                            </div>
                                                            <div class="col s12 m6 l2 proinfo_account_blank">&nbsp;</div>
                                                            <div class="col s6 m6 xl5">
                                                                <p>Shipping Date <br/> <b>{{$proforma->proforma_date}}</b></p>
                                                                <p>Total Price <br/> <b>{{$item->tax_total_price}}</b></p>
                                                            </div>
                                                            @endforeach

                                                        </div>

                                                        <div id="po_block_{{$proforma->id}}" class="po_block_modal modal modal-fixed-footer">
                                                            <div class="modal-content">
                                                                @include('new_business_profile.proforma_orders_modal')
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="po_reject_modal" class="modal modal-fixed-footer">
                                                        <div class="modal-content">
                                                            <legend>PO Id will be dynamic</legend>
                                                            <form action="" method="POST">
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <label for="reject_message_box">Message</label>
                                                                        <textarea id="reject_message_box" name="reject_message_box" class="materialize-textarea"></textarea>
                                                                    </div>
                                                                </div>                                
                                                                <button class="reject_message_submit waves-effect waves-light btn_green" type="button">Submit</button>                                
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:void(0);" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
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
$(document).ready(function(){
    var $input = $(".typeahead");
    $input.typeahead({
        source: [
            "Women's Long-Sleeve 100% Cotton Cable Crewneck Sweater 1",
            "Women's Long-Sleeve 100% Cotton Cable Crewneck Sweater 2",
            "Women's Long-Sleeve 100% Cotton Cable Crewneck Sweater 3",
            "Women's Long-Sleeve 100% Cotton Cable Crewneck Sweater 4",
            "Lorem ipsum title"
        ],
        autoSelect: true
    });
    $input.change(function() {
        var current = $input.typeahead("getActive");
        if (current) {
            // Some item from your model is active!
            if (current.name == $input.val()) {
            // This means the exact match is found. Use toLowerCase() if you want case insensitive match.
            } else {
            // This means it is only a partial match, you can either add a new item
            // or take the active if you don't want new items
            }
        } else {
            // Nothing is active so it is a new value (or maybe empty value)
        }
    });  
    
    $(".profile_filter_search").change(function(){
        var inputText = String($(this).val());
        $(".po_block").each(function() {
            var listFind = String($(this).data("potitle"));
            if (inputText == listFind)
            {
                //$(".rfq_tab_item_box .tablinks").removeClass("active");
                //faqCategory(event, 'faqCategoryAll');
                //$(".triggerEvent").addClass("active");
                $(this).css("display", "block");
                $(".reset_po_filter").show();
                //console.log("Found");
                return;
            }
            else 
            {
                $(this).css("display", "none");
                //console.log("Not Found");
                return;
            }
        });
    });

    $(".reset_po_filter").click(function(){
        $(".profile_filter_search").val("");
        window.location.reload();
    });    

    $(".po_reject_trigger").click(function(){
        $(".po_block_modal").modal("close");
        $(this).closest(".po_block").children("#po_reject_modal").modal("open");
    })    

})
</script>
@endpush