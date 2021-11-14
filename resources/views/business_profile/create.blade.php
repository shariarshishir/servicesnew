@extends('layouts.app')

@section('content')
@include('sweet::alert')


<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s3"><a class="active" href="#test1">Business Details</a></li>
            <li class="tab col s3"><a href="#test2">Representive Details</a></li>
            <li class="tab col s3"><a href="#test3">Business Profile</a></li>
        </ul>
    </div>
    <div id="edit_errors"></div>
    <form id="business_profile_form" method="POST"  enctype="multipart/form-data">
        @csrf
    <div id="test1" class="col s12">
        <div class="row">
               <div class="row">
                    <div class="input-field col s12">
                        <input id="business_name" type="text" class="validate" name="business_name" value="{{old('business_name')}}">
                        <label for="business_name">Business Name</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="location" type="text" class="validate" name="location" value="{{old('location')}}">
                        <label for="location">Location</label>
                    </div>
                    <div class="input-field col s12">
                        <select  class="select2 browser-default select-business-type" name="business_type">
                          <option value="" disabled selected>Choose your business type</option>
                          <option value="1" {{old('business_type') == 1 ? 'selected' : ''}}>Manufacture</option>
                          <option value="2" {{old('business_type') == 2 ? 'selected' : ''}}>Wholesaler</option>
                          <option value="3" {{old('business_type') == 3 ? 'selected' : ''}}>Design Studio</option>
                        </select>
                    </div>
                    <div class="input-field col s6 number_of_outlets" style="display: none">
                        <input id="number_of_outlets" type="text" class="validate" name="number_of_outlets" value="{{old('number_of_outlets')}}">
                        <label for="number_of_outlets">Number Of Outlets</label>
                    </div>
                    <div class="input-field col s6 number_of_factories" style=" display:none">
                        <input id="number_of_factories" type="text" class="validate" name="number_of_factories"  value="{{old('number_of_factories')}}">
                        <label for="number_of_factories">Number Of factories</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="trade_license" type="text" class="validate" value="{{old('trade_license')}}" name="trade_license">
                        <label for="trade_license">Trade License</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="industry_type" type="text" class="validate" name="industry_type" value="{{old('industry_type')}}">
                        <label for="industry_type">Industry Type</label>
                    </div>
               </div>
               <a href="javascript:void(0)" class="next">Next</a>
        </div>
    </div>
    <div id="test2" class="col s12">
        <label for="business_name">am i the representive of the business?</label>
        <p>
            <label>
              <input name="has_representative" type="radio" value="1"  />
              <span>Yes</span>
            </label>
        </p>
        <p>
            <label>
              <input name="has_representative" type="radio" value="0" checked/>
              <span>No</span>
            </label>
        </p>

        <div class="representive_info">
            <div class="input-field col s12">
                <input id="representive_name" type="text" class="validate" value="{{old('representive_name')}}" name="representive_name">
                <label for="representive_name">Representive Name</label>
            </div>
            <div class="input-field col s12">
                <input id="email" type="text" class="validate" value="{{old('email')}}" name="email">
                <label for="email">Email Address</label>
            </div>
            <div class="input-field col s12">
                <input id="phone" type="text" class="validate" value="{{old('phone')}}" name="phone">
                <label for="phone">Contact Number</label>
            </div>
            <div class="input-field col s12">
                <input id="nid_passport" type="text" class="validate" value="{{old('nid_passport')}}" name="nid_passport">
                <label for="nid_passport">NID/Passport</label>
            </div>
        </div>
        <a href="javascript:void(0)">Next</a>
    </div>
    <div id="test3" class="col s12">
        <button type="submit">Submit</button>
    </div>
</div>
</form>
@endsection

@include('business_profile._scripts')
