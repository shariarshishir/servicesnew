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
                                    <a href="javascript:void(0);" onclick="toggle_visibility('accountRfqDetailesInfoMobile');"><i class="material-icons">keyboard_double_arrow_down</i></a>
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
                                        <img src="{{ Storage::disk('s3')->url('public/account-images/pro-1.png') }}" />
                                        <img src="{{ Storage::disk('s3')->url('public/account-images/pro-2.png') }}" />
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
                                                <img src="./images/account-images/avatar.jpg" alt="avatar" itemprop="img">
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
                                                <img src="./images/account-images/avatar.jpg" alt="avatar" itemprop="img">
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
                                                <img src="./images/account-images/avatar.jpg" alt="avatar" itemprop="img">
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
                                <li class="profile_insight {{ Route::is('new.profile.insights',$alias) ? 'active' : ''}}">
                                    <a href="{{route('new.profile.insights', $alias)}}">
                                        <div class="icon_img">&nbsp;</div>
                                        <h4>Profile Insights</h4>
                                    </a>
                                </li>
                                <li class="profile_home {{ Route::is('new.profile.home',$alias) ? 'active' : ''}}">
                                    <a href="{{route('new.profile.home', $alias)}}">
                                        <div class="icon_img">&nbsp;</div>
                                        <h4>Profile Home</h4>
                                    </a>
                                </li>
                                <li class="profile {{ Route::is('new.profile.edit',$alias) ? 'active' : ''}}">
                                    <a href="{{route('new.profile.edit', $alias)}}">
                                        <div class="icon_img">&nbsp;</div>
                                        <h4>Profile</h4>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col s12 m9 l10">
                        <div class="profile_supplier_account_insight_wrap">
                            <div class="supplier_account_progress">
                                <h4>Profile Progress</h4>
                                <div id="profile-progress-wrapper">
                                    <div class="profile-progressbar-total" style="position: relative; width: 100%; background: #ccc; height: 10px;">
                                        <div class="profile-progress-value" style="width: {{$profileProgressValue}}%; background: #54a958; height: 10px; position: absolute; top: 0px; left: 0px;"></div>
                                    </div>
                                </div>
                                <div class="right-align">{{$profileProgressValue}}% Completed</div>
                            </div>
                            <div class="appearances_wrap center-align">
                                <div class="row">
                                    <div class="col s12 m6">
                                        <div class="search_appearance_box">
                                            <span>67</span> RFQ search appearances
                                        </div>
                                    </div>
                                    <div class="col s12 m6">
                                        <div class="search_appearance_box">
                                            <span>42</span> Times suggested to the buyers
                                        </div>
                                    </div>
                                </div>
                                <div class="center-align">
                                    <a href="javascript:void(0);" class="btn_green btn_know">Know More</a>
                                </div>
                            </div>
                            <div class="supllir_profile_incomplete_field">
                                <p style="font-style: italic;">*Complete your profile with more information to appear in more RFQ searches.</p>
                                
                                <p style="color: red; margin-top: 25px;">You have 6 incomplete fields.</p>
                                <ul>
                                    <li><a href="javascript:void(0);">Company Profile </a></li>
                                    <li><a href="javascript:void(0);">Capacity and Machineries </a></li>
                                    <li><a href="javascript:void(0);">Certifications </a></li>
                                    <li><a href="javascript:void(0);">Main Buyers </a></li>
                                    <li><a href="javascript:void(0);">Export Destinations </a></li>
                                    <li><a href="javascript:void(0);">Business Terms </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection