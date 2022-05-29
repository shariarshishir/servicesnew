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
                        <div class="new_profile_account_myrfq_details">
                            <div class="new_profile_myrfq_details_topbox">
                                <h6>RFQ ID <span>785672990</span></h6>
                                <h5>Women's Long-Sleeve 100% Cotton Cable Crewn with emb log</h5>
                                <span class="posted_time">Posted 3m ago</span>

                                <div class="center-align btn_accountrfq_info">
                                    <a href="#" onclick="toggle_visibility('accountRfqDetailesInfoMobile');"><i class="material-icons">keyboard_double_arrow_down</i></a>
                                </div>
                                <div id="accountRfqDetailesInfoMobile" class="account_rfqDetailes_infoWrap" style="display: none;">
                                    <div class="row">
                                        <div class="col s6 m6 l5">
                                            <p>Quantity <br/> <b>15000 pcs</b></p>
                                            <p>Target Price <br/> <b>$7.50 /pc</b></p>
                                        </div>
                                        <div class="col s6 m6 l2 proinfo_account_blank">&nbsp;</div>
                                        <div class="col s6 m6 l5">
                                            <p>Deliver in <br/> <b>18 days</b></p>
                                            <p>Deliver to <br/> <b>London</b></p>
                                        </div>
                                    </div>
                                    <div class="account_rfqDetailes_imgWrap">
                                        <h6>Attachments</h6>
                                        <img src="./images/account-images/pro-1.png" />
                                        <img src="./images/account-images/pro-2.png" />
                                    </div>
                                </div>
                            </div>
                            <div class="rfq_review_results_wrap">
                                <div class="rfq_review_results_nav">
                                    <ul>
                                        <li><a href="buyer-account-profile-my-rfq-message.html">Messages</a></li>
                                        <li class="active"><a href="buyer-account-profile-my-rfq.html">Quotations</a></li>
                                    </ul>
                                </div>
                                <div class="rfq_review_results_box">
                                    <div class="row">
                                        <div class="col s12 xl2 rfq_review_result_leftBox">
                                            <span class="new_rfq_avatar">
                                                <img src="{{ Storage::disk('s3')->url('public/account-images/avatar.jpg') }}" alt="avatar" itemprop="img">
                                            </span>
                                        </div>
                                        <div class="col s12 xl5 rfq_review_result_midBox">
                                            <div class="new_rfq_review">
                                                <h6>Zex Fashions BD</h6>
                                                <p>Offer Price: <span>$1000</span> </p>
                                                <button class="btn_green">Ask for PI</button>
                                            </div>
                                        </div>
                                        <div class="col s12 xl5 rfq_review_result_rightBox">
                                            <div class="new_rfq_review">
                                                <span class="rfqEatting"><i class="material-icons">star_border</i> <i class="material-icons">star_border</i> <i class="material-icons">star_border</i> <i class="material-icons">star_border</i></span>
                                                <span class="rqf_verified"><img src="./images/account-images/rfq-verified.png" alt=""> Verified</span>
                                                <button class="btn_green">Issue PO</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rfq_review_results_box">
                                    <div class="row">
                                        <div class="col s12 xl2 rfq_review_result_leftBox">
                                            <span class="new_rfq_avatar">
                                                <img src="{{ Storage::disk('s3')->url('public/account-images/avatar.jpg') }}" alt="avatar" itemprop="img">
                                            </span>
                                        </div>
                                        <div class="col s12 xl5 rfq_review_result_midBox">
                                            <div class="new_rfq_review">
                                                <h6>Zex Fashions BD</h6>
                                                <p>Offer Price: <span>$1000</span> </p>
                                                <button class="btn_green">Ask for PI</button>
                                            </div>
                                        </div>
                                        <div class="col s12 xl5 rfq_review_result_rightBox">
                                            <div class="new_rfq_review">
                                                <span class="rfqEatting"><i class="material-icons">star_border</i> <i class="material-icons">star_border</i> <i class="material-icons">star_border</i> <i class="material-icons">star_border</i></span>
                                                <span class="rqf_verified"><img src="./images/account-images/rfq-verified.png" alt=""> Verified</span>
                                                <button class="btn_green">Issue PO</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rfq_review_results_box">
                                    <div class="row">
                                        <div class="col s12 xl2 rfq_review_result_leftBox">
                                            <span class="new_rfq_avatar">
                                                <img src="{{ Storage::disk('s3')->url('public/account-images/avatar.jpg') }}" alt="avatar" itemprop="img">
                                            </span>
                                        </div>
                                        <div class="col s12 xl5 rfq_review_result_midBox">
                                            <div class="new_rfq_review">
                                                <h6>Zex Fashions BD</h6>
                                                <p>Offer Price: <span>$1000</span> </p>
                                                <button class="btn_green">Ask for PI</button>
                                            </div>
                                        </div>
                                        <div class="col s12 xl5 rfq_review_result_rightBox">
                                            <div class="new_rfq_review">
                                                <span class="rfqEatting"><i class="material-icons">star_border</i> <i class="material-icons">star_border</i> <i class="material-icons">star_border</i> <i class="material-icons">star_border</i></span>
                                                <span class="rqf_verified"><img src="./images/account-images/rfq-verified.png" alt=""> Verified</span>
                                                <button class="btn_green">Issue PO</button>
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
                            </ul>
                        </div>
                    </div>
                    <div class="col s12 m9 l10">

                        <div class="profile_account_myrfq_info">
                            <div class="row">
                                <div class="col s12 m12 l7">
                                    <div class="product_design_wrapper">
                                        <div class="profile_account_searchBar">
                                            <div class="row">
                                                <div class="col s12 m5 l4">
                                                    <a class="modal-trigger post_new" href="#profileAccountPostNew">
                                                        <i class="material-icons">add</i><span>Post New</span>
                                                    </a>
                                                </div>
                                                <div class="col s12 m7 l8">
                                                    <div class="profile_account_search">
                                                        <i class="material-icons">search</i>
                                                        <input class="profile_filter_search" type="search" placeholder="Search Merchant Bay Studio/Raw Material Libraries" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile_account_myrfq_innerbox">

                                            <div class="row rfq_account_title_bar">
                                                <div class="col s8">
                                                    <h4>My RFQs</h4>
                                                </div>
                                                <div class="col s4 right-align">
                                                    <span class="rfqView">36 results</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <div class="profile_account_myrfq_box active">
                                                        <h5>Women's Long-Sleeve 100% Cotton Cable Crewn with emb log</h5>
                                                        <span class="posted_time">Posted 3m ago</span>
                                                        <div class="row">
                                                            <div class="col s6 m6 l5">
                                                                <p>Quantity <br/> <b>15000 pcs</b></p>
                                                                <p>Target Price <br/> <b>$7.50 /pc</b></p>
                                                            </div>
                                                            <div class="col s6 m6 l2 proinfo_account_blank">&nbsp;</div>
                                                            <div class="col s6 m6 l5">
                                                                <p>Deliver in <br/> <b>18 days</b></p>
                                                                <p>Deliver to <br/> <b>London</b></p>
                                                            </div>
                                                        </div>
                                                        <div class="account_rfq_btn_wrap" >
                                                            <div class="rfq_btn_box">
                                                                <button class="btn_white rfq_btn">Quotations</button>
                                                                <span>0</span>
                                                            </div>
                                                            <div class="rfq_btn_box">
                                                                <button class="btn_white rfq_btn">Messages</button>
                                                                <span>0</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="profile_account_myrfq_box">
                                                        <h5>Women's Long-Sleeve 100% Cotton Cable Crewn with emb log</h5>
                                                        <span class="posted_time">Posted 3m ago</span>
                                                        <div class="row">
                                                            <div class="col s6 m6 l5">
                                                                <p>Quantity <br/> <b>15000 pcs</b></p>
                                                                <p>Target Price <br/> <b>$7.50 /pc</b></p>
                                                            </div>
                                                            <div class="col s6 m6 l2 proinfo_account_blank">&nbsp;</div>
                                                            <div class="col s6 m6 l5">
                                                                <p>Deliver in <br/> <b>18 days</b></p>
                                                                <p>Deliver to <br/> <b>London</b></p>
                                                            </div>
                                                        </div>
                                                        <div class="account_rfq_btn_wrap" >
                                                            <div class="rfq_btn_box">
                                                                <button class="btn_white rfq_btn">Quotations</button>
                                                                <span>0</span>
                                                            </div>
                                                            <div class="rfq_btn_box">
                                                                <button class="btn_white rfq_btn">Messages</button>
                                                                <span>0</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6">
                                                    <div class="profile_account_myrfq_box">
                                                        <h5>Women's Long-Sleeve 100% Cotton Cable Crewn with emb log</h5>
                                                        <span class="posted_time">Posted 3m ago</span>
                                                        <div class="row">
                                                            <div class="col s6 m6 l5">
                                                                <p>Quantity <br/> <b>15000 pcs</b></p>
                                                                <p>Target Price <br/> <b>$7.50 /pc</b></p>
                                                            </div>
                                                            <div class="col s6 m6 l2 proinfo_account_blank">&nbsp;</div>
                                                            <div class="col s6 m6 l5">
                                                                <p>Deliver in <br/> <b>18 days</b></p>
                                                                <p>Deliver to <br/> <b>London</b></p>
                                                            </div>
                                                        </div>
                                                        <div class="account_rfq_btn_wrap" >
                                                            <div class="rfq_btn_box">
                                                                <button class="btn_white rfq_btn">Quotations</button>
                                                                <span>0</span>
                                                            </div>
                                                            <div class="rfq_btn_box">
                                                                <button class="btn_white rfq_btn">Messages</button>
                                                                <span>0</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m12 l5 new_profile_account_rightsidebar_desktop">
                                    <div class="new_profile_account_myrfq_details">
                                        <div class="new_profile_myrfq_details_topbox">
                                            <h6>RFQ ID <span>785672990</span></h6>
                                            <h5>Women's Long-Sleeve 100% Cotton Cable Crewn with emb log</h5>
                                            <span class="posted_time">Posted 3m ago</span>

                                            <div class="center-align btn_accountrfq_info">
                                                <a href="#" onclick="toggle_visibility('accountRfqDetailesInfo');"><i class="material-icons">keyboard_double_arrow_down</i></a>
                                            </div>
                                            <div id="accountRfqDetailesInfo" class="account_rfqDetailes_infoWrap" style="display: none;">
                                                <div class="row">
                                                    <div class="col s6 m6 l5">
                                                        <p>Quantity <br/> <b>15000 pcs</b></p>
                                                        <p>Target Price <br/> <b>$7.50 /pc</b></p>
                                                    </div>
                                                    <div class="col s6 m6 l2 proinfo_account_blank">&nbsp;</div>
                                                    <div class="col s6 m6 l5">
                                                        <p>Deliver in <br/> <b>18 days</b></p>
                                                        <p>Deliver to <br/> <b>London</b></p>
                                                    </div>
                                                </div>
                                                <div class="account_rfqDetailes_imgWrap">
                                                    <h6>Attachments</h6>
                                                    <img src="./images/account-images/pro-1.png" />
                                                    <img src="./images/account-images/pro-2.png" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rfq_review_results_wrap">
                                            <div class="rfq_review_results_nav">
                                                <ul>
                                                    <li><a href="javascript:void(0);">Messages</a></li>
                                                    <li class="active"><a href="javascript:void(0);">Quotations</a></li>
                                                </ul>
                                            </div>
                                            <div class="rfq_review_results_box">
                                                <div class="row">
                                                    <div class="col s12 xl2 rfq_review_result_leftBox">
                                                        <span class="new_rfq_avatar">
                                                            <img src="{{ Storage::disk('s3')->url('public/account-images/avatar.jpg') }}" alt="avatar" itemprop="img">
                                                        </span>
                                                    </div>
                                                    <div class="col s12 xl5 rfq_review_result_midBox">
                                                        <div class="new_rfq_review">
                                                            <h6>Zex Fashions BD</h6>
                                                            <p>Offer Price: <span>$1000</span> </p>
                                                            <button class="btn_green">Ask for PI</button>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 xl5 rfq_review_result_rightBox">
                                                        <div class="new_rfq_review">
                                                            <span class="rfqEatting"><i class="material-icons">star_border</i> <i class="material-icons">star_border</i> <i class="material-icons">star_border</i> <i class="material-icons">star_border</i></span>
                                                            <span class="rqf_verified"><img src="./images/account-images/rfq-verified.png" alt=""> Verified</span>
                                                            <button class="btn_green">Issue PO</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rfq_review_results_box">
                                                <div class="row">
                                                    <div class="col s12 xl2 rfq_review_result_leftBox">
                                                        <span class="new_rfq_avatar">
                                                            <img src="{{ Storage::disk('s3')->url('public/account-images/avatar.jpg') }}" alt="avatar" itemprop="img">
                                                        </span>
                                                    </div>
                                                    <div class="col s12 xl5 rfq_review_result_midtBox">
                                                        <div class="new_rfq_review">
                                                            <h6>Zex Fashions BD</h6>
                                                            <p>Offer Price: <span>$1000</span> </p>
                                                            <button class="btn_green">Ask for PI</button>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 xl5 rfq_review_result_rightBox">
                                                        <div class="new_rfq_review">
                                                            <span class="rfqEatting"><i class="material-icons">star_border</i> <i class="material-icons">star_border</i> <i class="material-icons">star_border</i> <i class="material-icons">star_border</i></span>
                                                            <span class="rqf_verified"><img src="./images/account-images/rfq-verified.png" alt=""> Verified</span>
                                                            <button class="btn_green">Issue PO</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rfq_review_results_box">
                                                <div class="row">
                                                    <div class="col s12 xl2 rfq_review_result_leftBox">
                                                        <span class="new_rfq_avatar">
                                                            <img src="{{ Storage::disk('s3')->url('public/account-images/avatar.jpg') }}" alt="avatar" itemprop="img">
                                                        </span>
                                                    </div>
                                                    <div class="col s12 xl5 rfq_review_result_midBox">
                                                        <div class="new_rfq_review">
                                                            <h6>Zex Fashions BD</h6>
                                                            <p>Offer Price: <span>$1000</span> </p>
                                                            <button class="btn_green">Ask for PI</button>
                                                        </div>
                                                    </div>
                                                    <div class="col s12 xl5 rfq_review_result_rightBox">
                                                        <div class="new_rfq_review">
                                                            <span class="rfqEatting"><i class="material-icons">star_border</i> <i class="material-icons">star_border</i> <i class="material-icons">star_border</i> <i class="material-icons">star_border</i></span>
                                                            <span class="rqf_verified"><img src="./images/account-images/rfq-verified.png" alt=""> Verified</span>
                                                            <button class="btn_green">Issue PO</button>
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
