@extends('layouts.app_createbusinessprofile')

@section('content')
@include('sweet::alert')


<div class="sign-wrap business_sign_wrap">
	<div class="row">
		<div class="col s12 m12 l4 leftbar">
			<div class="logo-wrap">
				<div class="logo-inner">
					<img title="logo" src="{{asset('images/frontendimages/new_layout_images/logo.png')}}">
					<h4>Connect all the stakeholders in one place</h4>
				</div>
			</div>
		</div>
		<div class="col s12 m12 l8 rightbar">
			<div class="signRight-innter business_stepper_wrap">
				<div class="sign-from-wrap">
                    <h3>Creating Business Profile...</h3>
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s4 m4 l4">
                                    <a class="active" href="#business_details_info">
                                        <span class="step_count">1</span> Business Details
                                    </a>
                                </li>
                                <li class="tab col s4 m4 l4">
                                    <a href="#representative_details_info">
                                        <span class="step_count">2</span> Representive Details
                                    </a>
                                </li>
                                <li class="tab col s4 m4 l4">
                                    <a href="#business_profile_info" class="last-step">
                                        <span class="step_count">3</span> Business Profile
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div id="edit_errors"></div>
                        <form id="business_profile_form" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div id="business_details_info" class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <div class="col s12 m4">
                                            <label for="business_name">Name</label>
                                        </div>
                                        <div class="col s12 m8">
                                            <input id="business_name" type="text" class="validate" name="business_name" value="{{old('business_name')}}">
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="col s12 m4">
                                            <label for="location">Location</label>
                                        </div>
                                        <div class="col s12 m8">
                                            <input id="location" type="text" class="validate" name="location" value="{{old('location')}}">
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="col s12 m4">
                                            <label for="business_type">Business Type</label>
                                        </div>
                                        <div class="col s12 m8">
                                            <select id="business_type" class="select2 browser-default select-business-type" name="business_type">
                                                <option value="" disabled selected>Choose your business type</option>
                                                <option value="1" {{old('business_type') == 1 ? 'selected' : ''}}>Manufacturer</option>
                                                <option value="2" {{old('business_type') == 2 ? 'selected' : ''}}>Wholesaler</option>
                                                <option value="3" {{old('business_type') == 3 ? 'selected' : ''}}>Design Studio</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="input-field col s12 number_of_outlets" style="display: none">
                                        <div class="col s12 m4">
                                            <label>&nbsp;</label>
                                        </div>
                                        <div class="col s12 m8">
                                            <div class="row">
                                                <div class="col s12 m5">
                                                    <label for="number_of_outlets">Number Of Outlets</label>
                                                </div>
                                                <div class="col s12 m7">
                                                    <input id="number_of_outlets" type="text" class="validate" name="number_of_outlets" value="{{old('number_of_outlets')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-field col s12 number_of_factories" style=" display:none">
                                        <div class="col s12 m4">
                                            <label>&nbsp;</label>
                                        </div>
                                        <div class="col s12 m8">
                                            <div class="row">
                                                <div class="col s12 m5">
                                                    <label for="number_of_factories">Number Of Factories</label>
                                                </div>
                                                <div class="col s12 m7">
                                                    <input id="number_of_factories" type="text" class="validate" name="number_of_factories"  value="{{old('number_of_factories')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="col s12 m4">
                                            <label for="trade_license">Trade License</label>
                                        </div>
                                        <div class="col s12 m8">
                                            <input id="trade_license" type="text" class="validate" value="{{old('trade_license')}}" name="trade_license">
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="col s12 m4">
                                            <label for="industry_type">Industry Type</label>
                                        </div>
                                        <div class="col s12 m8">
                                            <select id="industry_type" class="select2 browser-default select-industry-type"  name="industry_type" onchange="changecategory(this.value)">
                                                <option value="" disabled selected>Choose your industry type</option>
                                                <option value="apparel" >Apparel</option>
                                                <option value="non-apparel" >Non-Apparel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="input-field col s12 business-category-div" style="display: none">
                                        <div class="col s12 m4">
                                            <label>&nbsp;</label>
                                        </div>
                                        <div class="col s12 m8">
                                            <div class="row">
                                                <div class="col s12 m5">
                                                    <label for="categoryList">Category Type</label>
                                                </div>
                                                <div class="col s12 m7">
                                                    <select  class="select2 browser-default business-category"  name="business_category_id" id="categoryList"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="next next_to_representative_details_info btn waves-effect waves-light green" onclick='$(".tabs").tabs( "select", "representative_details_info" )'>Next</a>
                            </div>
                            <div id="representative_details_info" class="col s12">
                                <div class="representative_box">
                                    <label class="title" for="business_name">Am i the representive of the business?</label>
                                    <label class="radio_box">
                                        <input name="has_representative" type="radio" value="1"  />
                                        <span>Yes</span>
                                    </label>
                                    <label class="radio_box">
                                        <input name="has_representative" type="radio" value="0" checked/>
                                        <span>No</span>
                                    </label>
                                </div>
                                <div class="representive_info">
                                    <div class="input-field col s12">
                                        <div class="row">
                                            <div class="col s12 m4">
                                                <label for="representive_name">Representive Name</label>
                                            </div>
                                            <div class="col s12 m8">
                                                <input id="representive_name" type="text" class="validate" value="{{old('representive_name')}}" name="representive_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="row">
                                            <div class="col s12 m4">
                                                <label for="email">Email Address</label>
                                            </div>
                                            <div class="col s12 m8">
                                                <input id="email" type="text" class="validate" value="{{old('email')}}" name="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="row">
                                            <div class="col s12 m4">
                                                <label for="phone">Contact Number</label>
                                            </div>
                                            <div class="col s12 m8">
                                                <input id="phone" type="text" class="validate" value="{{old('phone')}}" name="phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="row">
                                            <div class="col s12 m4">
                                                <label for="nid_passport">NID/Passport</label>
                                            </div>
                                            <div class="col s12 m8">
                                                <input id="nid_passport" type="text" class="validate" value="{{old('nid_passport')}}" name="nid_passport">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-actions">
                                    <a href="javascript:void(0)" class="previous previous_to_business_details_info btn waves-effect waves-light green" onclick='$(".tabs").tabs( "select", "business_details_info" )'>Back</a>
                                    <a href="javascript:void(0)" class="next next_to_business_profile_info btn waves-effect waves-light green" onclick='$(".tabs").tabs( "select", "business_profile_info" )'>Next</a>
                                </div>   
                               
                            </div>
                            <div id="business_profile_info" class="col s12">
                                <div id="review-profile-data" class="business_steps_content">
                                    <div id="information_message"></div>
                                    <div id="review_name"></div>
                                    <div id="review_location"></div>
                                    <div id="review_business_type"></div>
                                    <div id="review_number_of_factories"></div>
                                    <div id="review_number_of_outlets"></div>
                                    <div id="review_trade_license"></div>
                                    <div id="review_industry_type"></div>
                                    <div id="review_business_category_id"></div>
                                    <div id="review_representative_name"></div>
                                    <div id="review_representatives_email"></div>
                                    <div id="review_representatives_contact"></div>
                                    <div id="review_representative_nidPassport"></div>
                                </div>   

                                <div class="step-actions">
                                    <a href="javascript:void(0)" class="previous previous_to_representative_details_info btn waves-effect waves-light green" onclick='$(".tabs").tabs( "select", "representative_details_info" )'>Back</a>
                                    <button type="submit" class="btn waves-effect waves-light green">Submit <i class="material-icons right">send</i></button>
                                </div>   
                            </div>
                        </form>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@include('business_profile._scripts')
@section('css')
<style>
    .footer_wrap {
        display: none;
    }
</style>
@endsection
