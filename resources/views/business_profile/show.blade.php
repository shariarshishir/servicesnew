@extends('layouts.app')

@section('content')
@include('sweet::alert')


<div class="row">
    <div class="row">
        <div class="col s12">
          <ul class="tabs">
            <li class="tab col s3"><a href="#test1">Home</a></li>
            <li class="tab col s3"><a class="active" href="#test2">Profile</a></li>
            <li class="tab col s3"><a href="#test3">Product</a></li>
          </ul>
        </div>
        <div id="test1" class="col s12">Test 1</div>
        <div id="test2" class="col s12">
            <a class="waves-effect waves-light btn modal-trigger" href="#company_overview_modal">edit</a>
            <table>
                <thead>
                  <tr>
                      <th>Name</th>
                      <th>Value</th>
                      <th>Status</th>
                  </tr>
                </thead>

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
            {{-- company overview edit modal --}}
            <div id="company_overview_modal" class="modal">
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

        </div>
        <div id="test3" class="col s12">Test 3</div>
    </div>

</div>

@endsection

@include('business_profile._scripts')
