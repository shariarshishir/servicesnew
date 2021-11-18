@extends('layouts.app')

@section('content')
@include('sweet::alert')
<div class="row"> 
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s3"><a href="#test1">Home</a></li>
            <li class="tab col s3"><a class="active" href="#test2">Profile</a></li>
            <li class="tab col s3"><a href="#product">Product</a></li>
        </ul>
    </div>
    <div id="test1" class="col s12">Test 1</div>
    <div id="test2" class="tabcontent">
      <!-- company overview block -->
      <div class="overview_table_wrap">
          <div class="row top_titleWrap">
              <div class="col s6 m6">
                <h3>Company Overview</h3>
              </div>
              <div class="col s6 m6 right-align editBox">
                <button data-target="company-overview-modal" type="button" class="btn_edit btn_green_White modal-trigger" ><span class="material-icons">border_color</span></span> Edit</button>
              </div>
          </div>
          <div class="overview_table box_shadow">
            <table>
              <tbody>
                
                    @foreach (json_decode($business_profile->companyOverview->data) as $company_overview)
                      <tr>
                          <td>{{str_replace('_', ' ', ucfirst($company_overview->name))}}</td>
                          <td class="{{$company_overview->name}}_value">{{$company_overview->value}}</td>
                          <td class="{{$company_overview->name}}_status">{{$company_overview->status}}</td>
                      </tr>
                    @endforeach
              
              </tbody>
            </table>
          </div>
      </div>

      <!-- capacity and machineries block -->
      <div class="overview_table_wrap capacity_machineries">
          <div class="row top_titleWrap">
            <div class="col s6 m6"><h3>Capacity and Machineries</h3></div>
            <div class="col s6 m6 right-align editBox">
                <button type="button" data-target="capacity-and-machineries-modal" class="btn_edit btn_green_White modal-trigger"><span class="material-icons">border_color</span></span> Edit</button>
            </div>
          </div>
          <div class="row capacity_table">

            <div class="col s12 m6">
              <h4>Production Capacity (Annual)</h4>
              <div class="production-capacity-table-wrapper box_shadow">
                <table class="production-capacity-table">
                  <thead>
                    <tr>
                      <th>Machine Type</th>
                      <th>Annual Capacity</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody class="production-capacity-table-body">
                  @if(count($business_profile->productionCapacities)>0)
                    @foreach($business_profile->productionCapacities as $productionCapacity)
                    <tr>
                      <td>{{$productionCapacity->machine_type}}</td>
                      <td>{{$productionCapacity->annual_capacity}}</td>
                      <td>{{$productionCapacity->status}}</td>
                    </tr>
                    @endforeach
                  @else
                      <tr>
                        <td>No data</td>
                      </tr>
                  @endif
                  </tbody>
                </table>
              </div>
            </div>


            <div class="col s12 m6">
              <h4>Categories Produced</h4>
              <div class="categories-produced-table-wrapper box_shadow">
                <table class="categories-produced-table">
                    <thead>
                        <tr>
                        <th>Type</th>
                        <th>Percentage</th>
                        <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="categories-produced-table-body">
                        @if(count($business_profile->categoriesProduceds)>0)
                        @foreach($business_profile->categoriesProduceds as $categoriesProduced)
                        <tr>
                        <td>{{$categoriesProduced->type}}</td>
                        <td>{{$categoriesProduced->percentage}}</td>
                        <td>{{$categoriesProduced->status}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                        <td>No data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
              </div>
            </div>

          </div>
      </div>
      
        <div class="overview_table_wrap machinery_table">
            <h3>Machinery Details</h3>
            <div class="machinaries-details-table-wrapper box_shadow">
                <table class="machinaries-details-table">
                    <thead>
                        <tr>
                            <th>Machine Name</th>
                            <th>Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="machinaries-details-table-body">
                        @if(count($business_profile->machineriesDetails)>0)
                        @foreach($business_profile->machineriesDetails as $machineriesDetail)
                        <tr>
                            <td>{{$machineriesDetail->machine_name}}</td>
                            <td>{{$machineriesDetail->quantity}}</td>
                            <td>{{$machineriesDetail->status}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>No data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

      <div class="overview_table_wrap">
          <div class="row top_titleWrap">
            <div class="col s6 m6"><h3>Production Flow and Manpower</h3></div>
            <div class="col s6 m6 right-align editBox">
              <button type="button" data-target="production-flow-and-manpower-modal" class="btn_edit btn_green_White modal-trigger" ><span class="material-icons">border_color</span></span> Edit</button>
            </div>
          </div>
          <div class="production-flow-and-manpower-table-wrapper box_shadow">
            <table class="production-flow-and-manpower-table" style="width:100%">
                <tbody class="production-flow-and-manpower-table-body">
                    <!-- Html will comes from script -->

                @if(count($business_profile->productionFlowAndManpowers)>0)
                    @foreach($business_profile->productionFlowAndManpowers as $productionFlowAndManpower)
                    <tr>
                        <th>{{$productionFlowAndManpower->production_type}}</th>
                        <td>
                            <table style="width:100%; border: 0px;" border="0" cellpadding="0" cellspacing="0">
                            @foreach(json_decode($productionFlowAndManpower->flow_and_manpower) as $flowAndManpower)
                            <tr>
                                <td>{{$flowAndManpower->name}}</td>
                                <td>{{$flowAndManpower->value}}</td>
                                <td>{{$flowAndManpower->status}}</td>
                            </tr>
                            @endforeach
                            </table>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                  <td>No data</td>
                </tr>
                @endif
                </tbody>
            </table>
          </div>
      </div>
      <div class="certifications">
        <div class="row top_titleWrap upload_delete_wrap">
          <div class="col s6 m6"><h3>Certifications</h3></div>
          <div class="col s6 m6 right-align editBox">
            <button type="button" data-target="certification-upload-form-modal" class="btn_upload btn_green_White modal-trigger" ><span class="material-icons">file_upload</span></span> Upload</button>
            <button type="button" class="btn_delete btn_green_White" ><span><span class="material-icons">delete</span></span> Delete</button>
          </div>
        </div>
        <div class="row">
          <div class="col m3 l3"><img src="{{asset('images/frontendimages/new_layout_images/accord.png')}}" alt=""></div>
          <div class="col m3 l3"><img src="{{asset('images/frontendimages/new_layout_images/sedex.png')}}" alt=""></div>
          <div class="col m3 l3"><img src="{{asset('images/frontendimages/new_layout_images/iso.png')}}" alt=""></div>
          <div class="col m3 l3"><img src="{{asset('images/frontendimages/new_layout_images/alliance.png')}}" alt=""></div>
        </div>
      </div>
      <div class="main_buyers_wrap">
        <div class="row top_titleWrap upload_delete_wrap">
          <div class="col s6 m6"><h3>Main Buyers</h3></div>
          <div class="col s6 m6 right-align editBox">
            <button type="button" class="btn_upload btn_green_White" ><span class="material-icons">file_upload</span></span> Upload</button>
            <button type="button" class="btn_delete btn_green_White" ><span><span class="material-icons">delete</span></span> Delete</button>
          </div>
        </div>
        <div class="buyers_logo_wrap row">
          <div class="col s6 m4 l3">
            <div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/gemo.png')}}" alt="" /> </a></div>
            <h5>GEMO GMBH</h5>
          </div>
          <div class="col s6 m4 l3">
            <div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/newyork.png')}}" alt="" /></a> </div>
            <h5>Newyorker Corp.</h5>
          </div>
          <div class="col s6 m4 l3">
            <div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/marisa.png')}}" alt="" /></a> </div>
            <h5>Marisa Group</h5>
          </div>
          <div class="col s6 m4 l3">
            <div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/dansk.png')}}" alt="" /></a> </div>
            <h5>Dansk Supermarked</h5>
          </div>
        </div>
        <div class="buyers_logo_wrap row">
          <div class="col s6 m4 l3 center-align">
            <div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/tally_weijl.png')}}" alt="" /></a> </div>
            <h5>Tally Weijl Fashion</h5>
          </div>
          <div class="col s6 m4 l3">
            <div class="logoBox"><a href="javascript:void(0);"> <img src="{{asset('images/frontendimages/new_layout_images/takko.png')}}" alt="" /></a> </div>
            <h5>Takko Fashion</h5>
          </div>
          <div class="col s6 m4 l3">
            <div class="logoBox"><a href="javascript:void(0);"> <img src="{{asset('images/frontendimages/new_layout_images/us_polo_assn.png')}}" alt="" /></a> </div>
            <h5>US Polo Assosiation</h5>
          </div>
          <div class="col s6 m4 l3 center-align">
            <div class="logoBox"><a href="javascript:void(0);"><img src="{{asset('images/frontendimages/new_layout_images/suzy.png')}}" alt="" /></a> </div>
            <h5>Suzy Shier</h5>
          </div>
        </div>
      </div>
      <div class="export_destination_wrap">
        <div class="row top_titleWrap upload_delete_wrap">
          <div class="col s6 m6"><h3>Export Destinations</h3></div>
          <div class="col s6 m6 right-align editBox">
            <button type="button" class="btn_upload btn_green_White" ><span class="material-icons">file_upload</span></span> Upload</button>
            <button type="button" class="btn_delete btn_green_White" ><span><span class="material-icons">delete</span></span> Delete</button>
          </div>
        </div>
        <div class="row flag_wrap center-align">
          <div class="col s6 m4 l2 flagBox">
            <div class="flag_img"><img src="{{asset('images/frontendimages/new_layout_images/germany.png')}}" alt=""> </div>
            <h5>DE: Germany</h5>
          </div>
          <div class="col s6 m4 l2 flagBox">
            <div class="flag_img"><img src="{{asset('images/frontendimages/new_layout_images/greece_gla.png')}}" alt=""> </div>
            <h5>EL: Grece</h5>
          </div>
          <div class="col s6 m4 l2 flagBox">
            <div class="flag_img"><img src="{{asset('images/frontendimages/new_layout_images/hungary.png')}}" alt=""> </div>
            <h5>HU: Hungary</h5>
          </div>
          <div class="col s6 m4 l2 flagBox">
            <div class="flag_img"><img src="{{asset('images/frontendimages/new_layout_images/ireland.png')}}" alt=""> </div>
            <h5>IE: Ireland</h5>
          </div>
          <div class="col s6 m4 l2 flagBox">
            <div class="flag_img"><img src="{{asset('images/frontendimages/new_layout_images/italy.png')}}" alt=""> </div>
            <h5>IT: Italy</h5>
          </div>
          <div class="col s6 m4 l2 flagBox">
            <div class="flag_img"><img src="{{asset('images/frontendimages/new_layout_images/latvia.png')}}" alt=""> </div>
            <h5>LV: Latvia</h5>
          </div>
        </div>
      </div>

      <div class="overview_table_wrap overview_table_alignLeft">
        <div class="row top_titleWrap">
          <div class="col s6 m6"><h3>Business Terms</h3></div>
          <div class="col s6 m6 right-align editBox">
            <button type="button" class="btn_edit btn_green_White" ><span class="material-icons">border_color</span></span> Edit</button>
          </div>
        </div>
        <div class="overview_table box_shadow">
          <table>
            <tbody>
              <tr>
                <td>Average Lead Time</td>
                <td>12 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Order Terms (FOB, CM)</td>
                <td>44 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Accepted payment Methods (Cash, LC...)</td>
                <td>65 sets</td>
                  <td>
                    <div class="verified_img">
                      <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                    </div>
                  </td>
                </td>
              </tr>
              <tr>
                <td>Nearest Port</td>
                <td>164 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Incoterms</td>
                <td>20 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="overview_table_wrap overview_table_alignLeft">
        <div class="row top_titleWrap">
          <div class="col s6 m6"><h3>Sampling and R&D</h3></div>
          <div class="col s6 m6 right-align editBox">
            <button type="button" class="btn_edit btn_green_White" ><span class="material-icons">border_color</span></span> Edit</button>
          </div>
        </div>
        <div class="overview_table box_shadow">
          <table>
            <tbody>
              <tr>
                <td>Sampling facility space</td>
                <td>12 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Manpower</td>
                <td>44 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Sampling lead time (in weeks)</td>
                <td>65 sets</td>
                  <td>
                    <div class="verified_img">
                      <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                    </div>
                  </td>
                </td>
              </tr>
              <tr>
                <td>SMS capacity/Lead Time (in weeks</td>
                <td>164 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Daily sample capacity</td>
                <td>20 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Design Studio facility</td>
                <td>20 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Design Studio manpower</td>
                <td>20 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="overview_table_wrap blank_overview_table_">
        <div class="row top_titleWrap">
          <div class="col s6 m6"><h3>Special customization ability</h3></div>
          <div class="col s6 m6 right-align editBox">
            <button type="button" class="btn_edit btn_green_White" ><span class="material-icons">border_color</span></span> Edit</button>
          </div>
        </div>
        <div class="overview_table box_shadow">
          <table>
            <tbody>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                  <td>
                    <div class="verified_img">
                      <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                    </div>
                  </td>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="worker_welfare_wrap">
        <div class="row worker_welfare_box">
          <h3>Worker welfare and CSR</h3>
          <div class="col s12 m6 l7">
            <div class="welfare_box row">
              <span class="title col s8 m6 l6">Healthcare Facility</span>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group1" type="radio" checked="">
                <span>Yes</span>
              </label>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group1" type="radio">
                <span>No</span>
              </label>
            </div>
            <div class="welfare_box row">
              <span class="title col s8 m6 l6">On sight Doctor</span>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group2" type="radio" checked="">
                <span>Yes</span>
              </label>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group2" type="radio">
                <span>No</span>
              </label>
            </div>
            <div class="welfare_box row">
              <span class="title col s8 m6 l6 ">On sight Day Care</span>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group3" type="radio" checked="">
                <span>Yes</span>
              </label>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group3" type="radio">
                <span>No</span>
              </label>
            </div>
          </div>
          <div class="col s12 m6 l5">
            <div class="welfare_box row">
              <span class="title col s8 m6 l6">Playground</span>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group4" type="radio" checked="">
                <span>Yes</span>
              </label>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group4" type="radio">
                <span>No</span>
              </label>
            </div>
            <div class="welfare_box row">
              <span class="title col s8 m6 l6">Maternity Leave</span>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group5" type="radio" checked="">
                <span>Yes</span>
              </label>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group5" type="radio">
                <span>No</span>
              </label>
            </div>
            <div class="welfare_box row">
              <span class="title col s8 m6 l6">Social work</span>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group6" type="radio" checked="">
                <span>Yes</span>
              </label>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group6" type="radio">
                <span>No</span>
              </label>
            </div>
          </div>
        </div>
        <div class="row worker_welfare_box">
          <h3>Security and others</h3>
          <div class="col s12 m6 l7">
            <div class="welfare_box row">
              <span class="title col s8 m6 l6">Fire Exit</span>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group7" type="radio" checked="">
                <span>Yes</span>
              </label>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group7" type="radio">
                <span>No</span>
              </label>
            </div>
            <div class="welfare_box row">
              <span class="title col s8 m6 l6">On sight Fire Hydrant</span>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group8" type="radio" checked="">
                <span>Yes</span>
              </label>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group8" type="radio">
                <span>No</span>
              </label>
            </div>
            <div class="welfare_box row">
              <span class="title col s8 m6 l6">Onsight water source</span>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group9" type="radio" checked="">
                <span>Yes</span>
              </label>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group9" type="radio">
                <span>No</span>
              </label>
            </div>
          </div>
          <div class="col s12 m6 l5">
            <div class="welfare_box row">
              <span class="title col s8 m6 l6">Other protocols</span>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group10" type="radio" checked="">
                <span>Yes</span>
              </label>
              <label class="radio_box col s2 m2 l2">
                <input class="with-gap" name="group10" type="radio">
                <span>No</span>
              </label>
            </div>
          </div>
        </div>
      </div>

      <div class="overview_table_wrap blank_overview_table_">
        <div class="row top_titleWrap">
          <div class="col s6 m6"><h3>Sustainability commitments</h3></div>
          <div class="col s6 m6 right-align editBox">
            <button type="button" class="btn_edit btn_green_White" ><span class="material-icons">border_color</span></span> Edit</button>
          </div>
        </div>
        <div class="overview_table box_shadow">
          <table>
            <tbody>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                  <td>
                    <div class="verified_img">
                      <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                    </div>
                  </td>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="{{asset('images/frontendimages/new_layout_images/verified.png')}}" />
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="membership_wrap">
        <div class="row top_titleWrap upload_delete_wrap">
          <div class="col s6 m6"><h3>Association memberships</h3></div>
          <div class="col s6 m6 right-align editBox">
            <button type="button" class="btn_upload btn_green_White"><span class="material-icons">file_upload</span></span> Upload</button>
            <button type="button" class="btn_delete btn_green_White"><span><span class="material-icons">delete</span></span> Delete</button>
          </div>
        </div>
        <div class="row membership_textBox">
          <div class="col s12 m6 l5 center-align">
            <div class="imgbox"><img src="{{asset('images/frontendimages/new_layout_images/bgmea.png')}}" alt="" /></div>
            <p>Bangladesh Garment Manufacturers and Exporters Association (BGMEA)</p>
          </div>
          <div class="col s12 m6 l5 center-align">
            <div class="imgbox"><img src="{{asset('images/frontendimages/new_layout_images/bkmes.png')}}" alt="" /></div>
            <p>Bangladesh Knitwear Manufacturers and Exporters Association (BKMEA)</p>
          </div>
        </div>
      </div>

      <div class="pr_highlights_wrap">
        <div class="row top_titleWrap upload_delete_wrap">
          <div class="col s6 m6"><h3>PR Highlights</h3></div>
          <div class="col s6 m6 right-align editBox">
            <button type="button" class="btn_upload btn_green_White" ><span class="material-icons">file_upload</span></span> Upload</button>
            <button type="button" class="btn_delete btn_green_White" ><span><span class="material-icons">delete</span></span> Delete</button>
          </div>
        </div>
        <div class="row">
          <div class="col s6 m4 l2 ">
            <div class="paper_img">
              <img src="{{asset('images/frontendimages/new_layout_images/fex.png')}}" alt="" />
            </div>
          </div>
          <div class="col s6 m4 l2 paper_img"><img src="{{asset('images/frontendimages/new_layout_images/alo.png')}}" alt="" /></div>
          <div class="col s6 m4 l3 paper_img"><img src="{{asset('images/frontendimages/new_layout_images/dtribune.png')}}" alt="" /></div>
          <div class="col s6 m4 l2 paper_img"><img src="{{asset('images/frontendimages/new_layout_images/bs.png')}}" alt="" /></div>
          <div class="col s6 m4 l3 paper_img"><img src="{{asset('images/frontendimages/new_layout_images/dstar.png')}}" alt="" /></div>
        </div>
      </div>

    </div>
         

    </div>

    <div id="product" class="col s12">
            <div class="col m12 add-new-product-button">
                <a href="javascript:void(0);" class="modal-trigger tooltipped product-add-modal-trigger btn waves-effect waves-light green" data-position="top" data-tooltip="add new product">
                    <i class="material-icons dp48">add</i> Add New product
                </a>
            </div>
            <div id="manufacture_edit_errors"></div>
            <div class="manufacture-product-table-data">
                 @include('business_profile._product_table_data')
            </div>
    </div>
    
    @include('business_profile._edit_company_overview_modal')
    @include('business_profile._edit_capacity_and_machineries_modal')
    @include('business_profile._edit_production_flow_and_manpower_modal')
    @include('business_profile._add_product_modal')
    @include('business_profile._edit_product_modal')
@endsection

@include('business_profile._scripts')
