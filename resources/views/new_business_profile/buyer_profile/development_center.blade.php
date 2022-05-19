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
                    <div class="col s12 m12 l9" style="margin: 0 auto; float: none;">
                        Coming Soon.
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection