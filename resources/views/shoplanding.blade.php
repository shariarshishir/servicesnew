
@extends('layouts.app_containerless')

@section('content')
    <section class="landing_page_wrapper">
        <!-- New Landing design start -->
        <div class="landing_intro_wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m6 ">
                <div class="home_intro_left">
                  <h1>Find your next Apparel Manufacturing Partner</h1>
                  <p>Join the tech enabled fashion sourcing platform to connect <br/>
                    directly with fashion manufacturers and <br/>
                    wholesalers in BANGLADESH</p>
                  <div class="banner_search">
                    <div class="module-search">
                      <select id="searchOption" class="select2 browser-default select-search-type">
                          <option value="product" name="search_key" >Products</option>
                          <option value="vendor"  name="search_key" >Stores</option>
                      </select>
                      <form name="system_search" action="" id="system_search" method="get">
                          <input type="text" placeholder="Search anything here..." value="" class="search_input"  name="search_input"/>
                          <input type="hidden" name="search_type" class="search_type" value="" />
                          <button class="btn waves-effect waves-light green darken-1 search-btn" type="submit" ><i class="material-icons dp48">search</i></button>
                      </form>
                    </div>
                  </div>
                  <div class="landing_intro_button_box">
                    <a class="btn_howWrok btn_border_black" href=""><i class="material-icons"> play_circle_outline </i> How we work</a>
                    <a class="btn_green btn_talk" href="javascript:void(0);">Talk to us <i class="material-icons"> east </i></a>
                  </div>
                </div>
              </div>
              <div class="col s12 m6 ">
                <div class="home_intro_right">
                  <img alt="" src="{{asset('images/frontendimages/new-home/home-intro.png')}}" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="landing_provide_wrap">
          <div class="container">
            <h2>Values we provide...</h2>
            <div class="row">
              <div class="col s12 m12 l2">&nbsp;</div>
              <div class="col s12 m6 l4">
                <div class="provide_items_box provide_left">
                  <h3><span>For Buyers</span></h3>
                  <ul>
                    <li><a href="javascript:void(0);">Find vetted manufacturers</a></li>
                    <li><a href="javascript:void(0);">Find manufacturers for low MOQ</a></li>
                    <li><a href="javascript:void(0);">Source textiles and accessories</a></li>
                    <li><a href="javascript:void(0);">Source with shortest lead time</a></li>
                    <li><a href="javascript:void(0);">Manage orders with transparency</a></li>
                  </ul>
                </div>
              </div>
              <div class="col s12 m6 l4">
                <div class="provide_items_box">
                  <h3><span>For Suppliers</span></h3>
                  <ul>
                    <li><a href="javascript:void(0);">Create and promote your Digital Presence</a></li>
                    <li><a href="javascript:void(0);">Create your Digital Product Library</a></li>
                    <li><a href="javascript:void(0);">Source raw materials at best deal</a></li>
                    <li><a href="javascript:void(0);">Be data driven with Smart BI Tools</a></li>
                    <li><a href="javascript:void(0);">Manage orders with efficiency</a></li>
                  </ul>
                </div>
              </div>
              <div class="col s12 m12 l2">&nbsp;</div>
            </div>
            <div class="center-align provide_btn_wrap">
              <a href="#" class="btn_green">Sign up</a>
            </div>
          </div>
        </div>

        <div class="landing_spotlight_wrap">
          <div class="container">
            <div id="alphaTextile">
              <div class="spotlight_box"><img src="{{asset('images/frontendimages/new-home/Spotlight.png')}}" alt="" /></div>
              <div class="right-align sayel_group_logo_box">
                <a href="javascript:void(0);" ><img src="./images/sayem-group.png" alt="" /> </a>
              </div>
              <div class="spotlight_inner_info">
                <h3>Alpha Textile</h3>
                <h5>In Speed We believe</h5>
                <p><span style="font-weight: 600;">Sayem Fashions LTD. & Radiant Sweater Ind. Ltd</span> are two units of manufacturing within <span style="font-weight: 600;">Sayem Group</span>, <br/>
                  aspiring for complete customer satisfaction owing to the high quality Sweater at competitive <br/>
                  prices with an on-schedule delivery and perfection in service. It firmly believes that <br/>
                  the satisfaction of the valued customers is the focal point of its business.</p>
              </div>
              <div class="right-align">
                <a href="javascript:void(0);" class="btn_green landing_view_profile" >View Profile</a>
              </div>
            </div>
            <div id="carolinaGarments">
              <div class="spotlight_box"><img src="./images/Spotlight.png" alt="" /></div>
              <div class="right-align sayel_group_logo_box">
                <a href="javascript:void(0);" ><img src="./images/sayem-group.png" alt="" /> </a>
              </div>
              <div class="spotlight_inner_info">
                <h3>Carolina Garments</h3>
                <h5>In Speed We believe</h5>
                <p><span style="font-weight: 600;">Sayem Fashions LTD. & Radiant Sweater Ind. Ltd</span> are two units of manufacturing within <span style="font-weight: 600;">Sayem Group</span>, <br/>
                  aspiring for complete customer satisfaction owing to the high quality Sweater at competitive <br/>
                  prices with an on-schedule delivery and perfection in service. It firmly believes that <br/>
                  the satisfaction of the valued customers is the focal point of its business.</p>
              </div>
              <div class="right-align">
                <a href="javascript:void(0);" class="btn_green landing_view_profile" >View Profile</a>
              </div>
            </div>
            <div id="sayemFashions">
              <div class="spotlight_box"><img src="./images/Spotlight.png" alt="" /></div>
              <div class="right-align sayel_group_logo_box">
                <a href="javascript:void(0);" ><img src="./images/sayem-group.png" alt="" /> </a>
              </div>
              <div class="spotlight_inner_info">
                <h3>Sayem Group</h3>
                <h5>In Speed We believe</h5>
                <p><span style="font-weight: 600;">Sayem Fashions LTD. & Radiant Sweater Ind. Ltd</span> are two units of manufacturing within <span style="font-weight: 600;">Sayem Group</span>, <br/>
                  aspiring for complete customer satisfaction owing to the high quality Sweater at competitive <br/>
                  prices with an on-schedule delivery and perfection in service. It firmly believes that <br/>
                  the satisfaction of the valued customers is the focal point of its business.</p>
              </div>
              <div class="right-align">
                <a href="javascript:void(0);" class="btn_green landing_view_profile" >View Profile</a>
              </div>
            </div>
            <div id="radiantSweaters">
              <div class="spotlight_box"><img src="./images/Spotlight.png" alt="" /></div>
              <div class="right-align sayel_group_logo_box">
                <a href="javascript:void(0);" ><img src="./images/sayem-group.png" alt="" /> </a>
              </div>
              <div class="spotlight_inner_info">
                <h3>Radiant Sweaters</h3>
                <h5>In Speed We believe</h5>
                <p><span style="font-weight: 600;">Sayem Fashions LTD. & Radiant Sweater Ind. Ltd</span> are two units of manufacturing within <span style="font-weight: 600;">Sayem Group</span>, <br/>
                  aspiring for complete customer satisfaction owing to the high quality Sweater at competitive <br/>
                  prices with an on-schedule delivery and perfection in service. It firmly believes that <br/>
                  the satisfaction of the valued customers is the focal point of its business.</p>
              </div>
              <div class="right-align">
                <a href="javascript:void(0);" class="btn_green landing_view_profile" >View Profile</a>
              </div>
            </div>
            <div id="fatahFabrics">
              <div class="spotlight_box"><img src="./images/Spotlight.png" alt="" /></div>
              <div class="right-align sayel_group_logo_box">
                <a href="javascript:void(0);" ><img src="./images/sayem-group.png" alt="" /> </a>
              </div>
              <div class="spotlight_inner_info">
                <h3>Fatah Fabrics</h3>
                <h5>In Speed We believe</h5>
                <p><span style="font-weight: 600;">Sayem Fashions LTD. & Radiant Sweater Ind. Ltd</span> are two units of manufacturing within <span style="font-weight: 600;">Sayem Group</span>, <br/>
                  aspiring for complete customer satisfaction owing to the high quality Sweater at competitive <br/>
                  prices with an on-schedule delivery and perfection in service. It firmly believes that <br/>
                  the satisfaction of the valued customers is the focal point of its business.</p>
              </div>
              <div class="right-align">
                <a href="javascript:void(0);" class="btn_green landing_view_profile" >View Profile</a>
              </div>
            </div>
          </div>
        </div>

        <div class="landing_nav_wrap">
          <div class="container">
            <div class="landing_tab_menu">
              <ul class="tabs">
                <li class="tab"><a href="#alphaTextile">Alpha Textile</a></li>
                <li class="tab"><a href="#carolinaGarments">Carolina Garments Corp.</a></li>
                <li class="tab"><a href="#sayemFashions">Sayem Fashions Ltd.</a></li>
                <li class="tab"><a href="#radiantSweaters">Radiant Sweaters</a></li>
                <li class="tab"><a href="#fatahFabrics">Fatah Fabrics</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="landing_sourcing_wrap">
          <div class="container">
            <div class="row">
              <div class="col s12 m6">
                <div class="sourcing_info_box">
                  <h1><span> Bring the <span style="font-weight: 600;">Sourcing</span> <br/>
                    in your <span style="font-weight: 600;">Pocket</span></h1>
                    <p>Everything you need for your Apparel Business.</p>
                    <p><span style="font-weight: 600;">Yarn, Fabrics, Trims, Accessories, Garments </span> <br/> and many more....</p>
                </div>
                <div class="sourcing_apps_box">
                  <h3>Download the App</h3>
                  <div class="apps_wrap">
                    <a href="javascript:void(0);"><img src="./images/app-store.png" alt="" /> </a>
                    <a href="javascript:void(0);"><img src="./images/google-play.png" alt="" /> </a>
                  </div>
                </div>
              </div>
              <div class="col s12 m6">
                <div class="sourcing_img_box">
                  <img alt="" src="./images/sourcing-img.jpg" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="landing_tools_wrap">
          <div class="container">
            <div class="row">
              <div class="col s12 m6">
                <div class="landing_tools_img">
                  <img src="./images/tools-img.png" alt="" />
                </div>
              </div>
              <div class="col s12 m6">
                <div class="landing_tools_infobox">
                  <h1>Increase your <span style="font-weight: 600;">Efficiency</span> <br/> with <span style="font-weight: 600;">Smart BI Tools</span></h1>
                  <p>Subscribe to the Smart Order Management Dashboard and different tools offered by Merchant Bay to make your operation data driven and transparent.</p>
                
                  <div class="tools_button_box">
                    <a href="javascript:void(0);" class="btn_border_black">Explore MB Smart Tools</a>
                    <button class="btn_green request_demo">Request a Demo</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="landing_request_wrap">
          <div class="container">
            <div class="request_innter_box center-align">
              <h1>Want to get started real quick?</h1>
              <h5>Submit a request for quotation enjoy sourcing <br/> from Bangladesh like never before</h5>
              <div class="landing_request_img">
                <img alt="" src="./images/landing-rfq.png" />
              </div>
              <div class="request_button_box center-align">
                <a href="javascript:void(0);" class="btn_border_black">Submit RFQ</a>
                <a class="btn_green btn_talk" href="">Talk to us <i class="material-icons"> east </i></a>
              </div>
            </div>
          </div>
        </div>
        <!-- New Landing design end -->
    </section>
@endsection