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
                                                    <h4>Pending PIs</h4>
                                                </div>
                                                <div class="col s4 right-align">
                                                    <span class="rfqView">36 results</span>
                                                </div>
                                            </div>
                                            <div class="row po_block_wrapper">
                                                <div class="col s12 m6 l4 po_block" data-potitle="Women's Long-Sleeve 100% Cotton Cable Crewneck Sweater 1">
                                                    <div class="profile_account_poinfo_box active">
                                                        <div class="row top_download_bar">
                                                            <div class="col s12 m10">
                                                                <h5>Women's Long-Sleeve 100% Cotton Cable Crewneck Sweater 1</h5>
                                                                <span class="poinfo">03-Apr-2022</span>
                                                            </div>
                                                            <div class="col s12 m2">
                                                                <div class="download_icon">
                                                                    <a href="#"> <img src="{{ Storage::disk('s3')->url('public/account-images/icon-download.png') }}" /></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12">
                                                                <p>Beneficiary <br> <b>Radiant Sweaters Ind. Ltd. </b></p>
                                                            </div>
                                                            <div class="col s6 m6 xl5">
                                                                <p>Quantity <br/> <b>1500 pcs</b></p>
                                                                <p>Unit Price <br/> <b>$7.50 /pc</b></p>
                                                            </div>
                                                            <div class="col s12 m6 l2 proinfo_account_blank">&nbsp;</div>
                                                            <div class="col s6 m6 xl5">
                                                                <p>Shipping Date <br/> <b>10-May-2022</b></p>
                                                                <p>Total Price <br/> <b>$11,250</b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l4 po_block" data-potitle="Women's Long-Sleeve 100% Cotton Cable Crewneck Sweater 2">
                                                    <div class="profile_account_poinfo_box">
                                                        <div class="row top_download_bar">
                                                            <div class="col s12 m10">
                                                                <h5>Women's Long-Sleeve 100% Cotton Cable Crewneck Sweater 2</h5>
                                                                <span class="poinfo">03-Apr-2022</span>
                                                            </div>
                                                            <div class="col s12 m2">
                                                                <div class="download_icon">
                                                                    <a href="#"> <img src="{{ Storage::disk('s3')->url('public/account-images/icon-download.png') }}" /></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12">
                                                                <p>Beneficiary <br> <b>Radiant Sweaters Ind. Ltd. </b></p>
                                                            </div>
                                                            <div class="col s6 m6 xl5">
                                                                <p>Quantity <br/> <b>1500 pcs</b></p>
                                                                <p>Unit Price <br/> <b>$7.50 /pc</b></p>
                                                            </div>
                                                            <div class="col s12 m6 l2 proinfo_account_blank">&nbsp;</div>
                                                            <div class="col s6 m6 xl5">
                                                                <p>Shipping Date <br/> <b>10-May-2022</b></p>
                                                                <p>Total Price <br/> <b>$11,250</b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l4 po_block" data-potitle="Women's Long-Sleeve 100% Cotton Cable Crewneck Sweater 3">
                                                    <div class="profile_account_poinfo_box">
                                                        <div class="row top_download_bar">
                                                            <div class="col s12 m10">
                                                                <h5>Women's Long-Sleeve 100% Cotton Cable Crewneck Sweater 3</h5>
                                                                <span class="poinfo">03-Apr-2022</span>
                                                            </div>
                                                            <div class="col s12 m2">
                                                                <div class="download_icon">
                                                                    <a href="#"> <img src="{{ Storage::disk('s3')->url('public/account-images/icon-download.png') }}" /></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12">
                                                                <p>Beneficiary <br> <b>Radiant Sweaters Ind. Ltd. </b></p>
                                                            </div>
                                                            <div class="col s6 m6 xl5">
                                                                <p>Quantity <br/> <b>1500 pcs</b></p>
                                                                <p>Unit Price <br/> <b>$7.50 /pc</b></p>
                                                            </div>
                                                            <div class="col s12 m6 l2 proinfo_account_blank">&nbsp;</div>
                                                            <div class="col s6 m6 xl5">
                                                                <p>Shipping Date <br/> <b>10-May-2022</b></p>
                                                                <p>Total Price <br/> <b>$11,250</b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l4 po_block" data-potitle="Women's Long-Sleeve 100% Cotton Cable Crewneck Sweater 4">
                                                    <div class="profile_account_poinfo_box">
                                                        <div class="row top_download_bar">
                                                            <div class="col s12 m10">
                                                                <h5>Women's Long-Sleeve 100% Cotton Cable Crewneck Sweater 4</h5>
                                                                <span class="poinfo">03-Apr-2022</span>
                                                            </div>
                                                            <div class="col s2">
                                                                <div class="download_icon">
                                                                    <a href="#"> <img src="{{ Storage::disk('s3')->url('public/account-images/icon-download.png') }}" /></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12">
                                                                <p>Beneficiary <br> <b>Radiant Sweaters Ind. Ltd. </b></p>
                                                            </div>
                                                            <div class="col s6 m6 xl5">
                                                                <p>Quantity <br/> <b>1500 pcs</b></p>
                                                                <p>Unit Price <br/> <b>$7.50 /pc</b></p>
                                                            </div>
                                                            <div class="col s12 m6 l2 proinfo_account_blank">&nbsp;</div>
                                                            <div class="col s6 m6 xl5">
                                                                <p>Shipping Date <br/> <b>10-May-2022</b></p>
                                                                <p>Total Price <br/> <b>$11,250</b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l4 po_block" data-potitle="Lorem ipsum title">
                                                    <div class="profile_account_poinfo_box">
                                                        <div class="row top_download_bar">
                                                            <div class="col s12 m10">
                                                                <h5>Lorem ipsum title</h5>
                                                                <span class="poinfo">03-Apr-2022</span>
                                                            </div>
                                                            <div class="col s2">
                                                                <div class="download_icon">
                                                                    <a href="#"> <img src="{{ Storage::disk('s3')->url('public/account-images/icon-download.png') }}" /></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col s12">
                                                                <p>Beneficiary <br> <b>Radiant Sweaters Ind. Ltd. </b></p>
                                                            </div>
                                                            <div class="col s6 m6 xl5">
                                                                <p>Quantity <br/> <b>1500 pcs</b></p>
                                                                <p>Unit Price <br/> <b>$7.50 /pc</b></p>
                                                            </div>
                                                            <div class="col s12 m6 l2 proinfo_account_blank">&nbsp;</div>
                                                            <div class="col s6 m6 xl5">
                                                                <p>Shipping Date <br/> <b>10-May-2022</b></p>
                                                                <p>Total Price <br/> <b>$11,250</b></p>
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

})
</script>
@endpush