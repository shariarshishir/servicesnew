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
              <div class="overview_table box_shadow">
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
                  @endif
                  </tbody>
                </table>
              </div>
            </div>


            <div class="col s12 m6">
              <h4>Categories Produced</h4>
              <div class="overview_table box_shadow">
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
                  @endif
                  </tbody>
                </table>
              </div>
            </div>

          </div>
      </div>
      
      <div class="overview_table_wrap machinery_table">
          <h3>Machinery Details</h3>
          <div class="overview_table box_shadow">
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
              @endif
              </tbody>
            </table>
          </div>
      </div>

      <div class="overview_table_wrap">
          <div class="row top_titleWrap">
            <div class="col s6 m6"><h3>Production Flow and Manpower</h3></div>
            <div class="col s6 m6 right-align editBox">
              <button type="button" class="btn_edit btn_green_White" ><span class="material-icons">border_color</span></span> Edit</button>
            </div>
          </div>
          <div class="overview_table box_shadow">
            <table class="production_flow" style="width:100%">
              <tr>
                <th>Knitting</th>
                <td>
                  <table style="width:100%; border: 0px;" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                          <td>No of Jacquard Machines</td>
                          <td>150 pcs</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Manpower</td>
                          <td>200</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Capacity Daily</td>
                          <td>200</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <th>Linking</th>
                <td>
                  <table style="width:100%; border: 0px;" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                          <td>No of Jacquard Machines</td>
                          <td>150 pcs</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Manpower</td>
                          <td>200</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Capacity Daily</td>
                          <td>200</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                    </table>    
                </td>
              </tr>
              <tr>
                <th>Trimming and <br/> Mending</th>
                <td>
                  <table style="width:100%; border: 0px;" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                          <td>No of Jacquard Machines</td>
                          <td>150 pcs</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Manpower</td>
                          <td>200</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Capacity Daily</td>
                          <td>200</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                    </table>    
                </td>
              </tr>
              <tr>
                <th>PQC</th>
                <td>
                  <table style="width:100%; border: 0px;" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                          <td>No of Jacquard Machines</td>
                          <td>150 pcs</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Manpower</td>
                          <td>200</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Capacity Daily</td>
                          <td>200</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                    </table>    
                </td>
              </tr>
              <tr>
                <th>Packaging</th>
                <td>
                  <table style="width:100%; border: 0px;" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                          <td>No of Jacquard Machines</td>
                          <td>150 pcs</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Manpower</td>
                          <td>200</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Capacity Daily</td>
                          <td>200</td>
                          <td>
                            <div class="verified_img">
                              <img class="right-align" src="./images/verified.png" />
                            </div>
                          </td>
                        </tr>
                    </table>    
                </td>
              </tr>
            </table>
          </div>
      </div>
      <div class="certifications">
        <div class="row top_titleWrap upload_delete_wrap">
          <div class="col s6 m6"><h3>Certifications</h3></div>
          <div class="col s6 m6 right-align editBox">
            <button type="button" class="btn_upload btn_green_White" ><span class="material-icons">file_upload</span></span> Upload</button>
            <button type="button" class="btn_delete btn_green_White" ><span><span class="material-icons">delete</span></span> Delete</button>
          </div>
        </div>
        <div class="row">
          <div class="col m3 l3"><img src="./images/accord.png" alt=""></div>
          <div class="col m3 l3"><img src="./images/sedex.png" alt=""></div>
          <div class="col m3 l3"><img src="./images/iso.png" alt=""></div>
          <div class="col m3 l3"><img src="./images/alliance.png" alt=""></div>
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
            <div class="logoBox"><a href="javascript:void(0);"><img src="./images/gemo.png" alt="" /> </a></div>
            <h5>GEMO GMBH</h5>
          </div>
          <div class="col s6 m4 l3">
            <div class="logoBox"><a href="javascript:void(0);"><img src="./images/newyork.png" alt="" /></a> </div>
            <h5>Newyorker Corp.</h5>
          </div>
          <div class="col s6 m4 l3">
            <div class="logoBox"><a href="javascript:void(0);"><img src="./images/marisa.png" alt="" /></a> </div>
            <h5>Marisa Group</h5>
          </div>
          <div class="col s6 m4 l3">
            <div class="logoBox"><a href="javascript:void(0);"><img src="./images/dansk.png" alt="" /></a> </div>
            <h5>Dansk Supermarked</h5>
          </div>
        </div>
        <div class="buyers_logo_wrap row">
          <div class="col s6 m4 l3 center-align">
            <div class="logoBox"><a href="javascript:void(0);"><img src="./images/tally_weijl.png" alt="" /></a> </div>
            <h5>Tally Weijl Fashion</h5>
          </div>
          <div class="col s6 m4 l3">
            <div class="logoBox"><a href="javascript:void(0);"> <img src="./images/takko.png" alt="" /></a> </div>
            <h5>Takko Fashion</h5>
          </div>
          <div class="col s6 m4 l3">
            <div class="logoBox"><a href="javascript:void(0);"> <img src="./images/us_polo_assn.png" alt="" /></a> </div>
            <h5>US Polo Assosiation</h5>
          </div>
          <div class="col s6 m4 l3 center-align">
            <div class="logoBox"><a href="javascript:void(0);"><img src="./images/suzy.png" alt="" /></a> </div>
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
            <div class="flag_img"><img src="./images/germany.png" alt=""> </div>
            <h5>DE: Germany</h5>
          </div>
          <div class="col s6 m4 l2 flagBox">
            <div class="flag_img"><img src="./images/greece_gla.png" alt=""> </div>
            <h5>EL: Grece</h5>
          </div>
          <div class="col s6 m4 l2 flagBox">
            <div class="flag_img"><img src="./images/hungary.png" alt=""> </div>
            <h5>HU: Hungary</h5>
          </div>
          <div class="col s6 m4 l2 flagBox">
            <div class="flag_img"><img src="./images/ireland.png" alt=""> </div>
            <h5>IE: Ireland</h5>
          </div>
          <div class="col s6 m4 l2 flagBox">
            <div class="flag_img"><img src="./images/italy.png" alt=""> </div>
            <h5>IT: Italy</h5>
          </div>
          <div class="col s6 m4 l2 flagBox">
            <div class="flag_img"><img src="./images/latvia.png" alt=""> </div>
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
                    <img class="right-align" src="./images/verified.png" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Order Terms (FOB, CM)</td>
                <td>44 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="./images/verified.png" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Accepted payment Methods (Cash, LC...)</td>
                <td>65 sets</td>
                  <td>
                    <div class="verified_img">
                      <img class="right-align" src="./images/verified.png" />
                    </div>
                  </td>
                </td>
              </tr>
              <tr>
                <td>Nearest Port</td>
                <td>164 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="./images/verified.png" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Incoterms</td>
                <td>20 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="./images/verified.png" />
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
                    <img class="right-align" src="./images/verified.png" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Manpower</td>
                <td>44 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="./images/verified.png" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Sampling lead time (in weeks)</td>
                <td>65 sets</td>
                  <td>
                    <div class="verified_img">
                      <img class="right-align" src="./images/verified.png" />
                    </div>
                  </td>
                </td>
              </tr>
              <tr>
                <td>SMS capacity/Lead Time (in weeks</td>
                <td>164 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="./images/verified.png" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Daily sample capacity</td>
                <td>20 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="./images/verified.png" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Design Studio facility</td>
                <td>20 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="./images/verified.png" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>Design Studio manpower</td>
                <td>20 sets</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="./images/verified.png" />
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
                    <img class="right-align" src="./images/verified.png" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="./images/verified.png" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                  <td>
                    <div class="verified_img">
                      <img class="right-align" src="./images/verified.png" />
                    </div>
                  </td>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="./images/verified.png" />
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
                    <img class="right-align" src="./images/verified.png" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="./images/verified.png" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                  <td>
                    <div class="verified_img">
                      <img class="right-align" src="./images/verified.png" />
                    </div>
                  </td>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
                  <div class="verified_img">
                    <img class="right-align" src="./images/verified.png" />
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
            <div class="imgbox"><img src="./images/bgmea.png" alt="" /></div>
            <p>Bangladesh Garment Manufacturers and Exporters Association (BGMEA)</p>
          </div>
          <div class="col s12 m6 l5 center-align">
            <div class="imgbox"><img src="./images/bkmes.png" alt="" /></div>
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
              <img src="./images/fex.png" alt="" />
            </div>
          </div>
          <div class="col s6 m4 l2 paper_img"><img src="./images/alo.png" alt="" /></div>
          <div class="col s6 m4 l3 paper_img"><img src="./images/dtribune.png" alt="" /></div>
          <div class="col s6 m4 l2 paper_img"><img src="./images/bs.png" alt="" /></div>
          <div class="col s6 m4 l3 paper_img"><img src="./images/dstar.png" alt="" /></div>
        </div>
      </div>

    </div>
          {{-- company overview edit modal --}}
                <div id="company-overview-modal" class="modal">
                    <div class="modal-content">
                      <div class="row">
                          <div id="errors"></div>
                          <form class="col s12" method="post" action="#" id="company-overview-update-form">
                          @csrf
                          <input type="hidden" name="company_overview_id" value="{{$business_profile->companyOverview->id}}">
                              <div class="row">
                                  @foreach (json_decode($business_profile->companyOverview->data) as $company_overview)
                                  <div class="input-field col s6">
                                    <input id="{{$company_overview->name}}" type="text" class="validate" name="name[{{$company_overview->name}}]" value="{{$company_overview->value}}">
                                  <label for="{{$company_overview->name}}">{{str_replace('_', ' ', ucfirst($company_overview->name))}}</label>
                              </div>
                                @endforeach
                          </div>
                            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                              <i class="material-icons right">send</i>
                            </button>
                          </form>
                      </div>
                    </div>
            <div class="modal-footer">
              <a href="#!" class="modal-close waves-effect waves-green btn-flat">close</a>
            </div>
          </div>
          {{-- end company modal --}}


        {{-- Capacity and machineries  modal --}}
        <div id="capacity-and-machineries-modal" class="modal">
            <div class="modal-content">
            <div id="capacity-machineries-errors">
               
            </div>
            
            <form  method="post" action="#" id="capacity-machinaries-form">
                @csrf
                <input type="hidden" name="business_profile_id" value="{{$business_profile->id}}">
                <div class="row">
                    <div class="col s12">
                        <div class="form-group  production-capacity-block">
                            <label>Production Capacity (Annual)</label>
                            <div class="production-capacity-block">
                                <table class="production-capacity-table-block">
                                    <thead>
                                        <tr>
                                            <th>Machine Type</th>
                                            <th>Annual Capacity</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($business_profile->productionCapacities)>0)
                                          @foreach($business_profile->productionCapacities as $productionCapacity)
                                          <tr>
                                            <td><input name="machine_type[]" id="machine_type" type="text" class="form-control "  value="{{$productionCapacity->machine_type}}" ></td>
                                            <td><input name="annual_capacity[]" id="annual_capacity" type="number" class="form-control "  value="{{$productionCapacity->annual_capacity}}" ></td>
                                            <td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeProductionCapacity(this)"><i class="material-icons dp48">remove</i></a></td>
                                          </tr>
                                          @endforeach
                                        @else
                                          <tr>
                                            <td>No data</td>
                                          </tr>
                                        @endif
                                      
                                       
                                    </tbody>
                                </table>
                                <a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addProductionCapacity()"><i class="material-icons dp48">add</i> Add More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12">
                        <div class="form-group  categories-produced-block">
                            <label>Categories Produced</label>
                            <div class="categories-produced-block">
                                <table class="categories-produced-table-block">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Percentage</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($business_profile->categoriesProduceds)>0)
                                          @foreach($business_profile->categoriesProduceds as $categoriesProduced)
                                            <tr>
                                            <td><input name="type[]" id="type" type="text" class="form-control "  value="{{$categoriesProduced->type}}" ></td>
                                              <td><input name="percentage[]" id="percentage" type="number" class="form-control "  value="{{$categoriesProduced->percentage}}" ></td>
                                              <td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeCategoriesProduced(this)"><i class="material-icons dp48">remove</i></a></td>
                                            </tr>
                                          @endforeach
                                        @else
                                          <tr>
                                            <td>No data</td>
                                          </tr>
                                        @endif
                                       
                                    </tbody>
                                </table>
                                <a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addCategoriesProduced()"><i class="material-icons dp48">add</i> Add More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group  machinaries-details-block">
                        <label>machinaries Details</label>
                        <div class="machinaries-details-block">
                            <table class="machinaries-details-table-block">
                                <thead>
                                    <tr>
                                        <th>Machine Name</th>
                                        <th>Quantity</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($business_profile->machineriesDetails)>0)
                                      @foreach($business_profile->machineriesDetails as $machineriesDetail)
                                          <tr>
                                            <td><input name="machine_name[]" id="machine_name" type="text" class="form-control "  value="{{$machineriesDetail->machine_name}}" ></td>
                                            <td><input name="quantity[]" id="quantity" type="number" class="form-control "  value="{{$machineriesDetail->quantity}}" ></td>
                                            <td><a href="javascript:void(0);" class="btn waves-effect waves-light red" onclick="removeMachinariesDetails(this)"><i class="material-icons dp48">remove</i></a></td>
                                        </tr>
                                      @endforeach
                                    @else
                                        <tr>
                                          <td>No data</td>
                                        </tr>
                                    @endif
                                   
                                </tbody>
                            </table>
                            <a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addMachinariesDetails()"><i class="material-icons dp48">add</i> Add More</a>
                        </div>
                    </div>
                </div>

                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
                  
            </form>
                    
                    
            
            <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">close</a>
            </div>
      </div>
      {{-- end capacity and machineries modal --}}


    </div>

    <div id="product" class="col s12">Product</div>


@endsection

@include('business_profile._scripts')
