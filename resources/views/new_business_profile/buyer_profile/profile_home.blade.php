@extends('layouts.app_containerless')
@section('content')

<div class="account_profile_wrapper">
    <div class="account_profile_menu">
        <div class="container">
            
            <div class="profile_account_desktop_menu">
                @include('new_business_profile.buyer_profile.profile_menu')
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
                                    @include('new_business_profile.buyer_profile.profile_menu')
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
                                <li class="profile_insight {{ Route::is('new.buyer.profile.insights',$alias) ? 'active' : ''}}">
                                    <a href="supplier-account-profile-insights.html">
                                        <div class="icon_img">&nbsp;</div>
                                        <h4>Profile Insights</h4>
                                    </a>
                                </li>
                                <li class="profile_home active">
                                    <a href="javascript:void(0);">
                                        <div class="icon_img">&nbsp;</div>
                                        <h4>Profile Home</h4>
                                    </a>
                                </li>
                                <li class="profile">
                                    <a href="supplier-account-profile-page.html">
                                        <div class="icon_img">&nbsp;</div>
                                        <h4>Profile</h4>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col s12 m9 l10">
                        <div class="profile_supplier_account_home_wrap">
                            <h3>About the Company</h3>
                            <div class="contentBox">
                                <div class="company_stuff center-align row">                 
                                <div class="col s4 m3 l2">
                                    <div class="company_stuff_img">
                                        <img src="https://www.merchantbay.com/global/public/images/frontendimages/new_layout_images/workers.png" alt=""> 
                                    </div>
                                    <div class="title">No. of workers</div>
                                    <div class="quantity number_of_worker_value">1200</div>
                                </div>                                                                                
                                <div class="col s4 m3 l2">
                                    <div class="company_stuff_img">
                                        <img src="https://www.merchantbay.com/global/public/images/frontendimages/new_layout_images/human.png" alt=""> 
                                    </div>
                                    <div class="title">No. of female workers</div>
                                    <div class="quantity number_of_female_worker_value">500</div>
                                </div>
                            </div>
                            <!-- company_stuff -->
                            <div class="contentBox">
                                <p itemprop="description">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection