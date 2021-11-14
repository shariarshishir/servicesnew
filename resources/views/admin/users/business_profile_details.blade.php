@extends('layouts.admin')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Business Profile </li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
				<legend>Business Profile</legend>
                <ul class="nav">
                    <li class="nav-item">
                      <a class="nav-link active" href="#company_overview">Company Overview</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
                <div id="company_overview">
                    <form action="{{route('company.overview.varifie', $business_profile->companyOverview->id)}}" method="post">
                        @csrf
                        <table class="table">
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
                                        <td class="{{$company_overview->name}}_value">{{$company_overview->value}}
                                            <input type="hidden" name="name[{{$company_overview->name}}]" value="{{$company_overview->value}}">
                                        </td>
                                        <td class="{{$company_overview->name}}_status">
                                            <label class="radio-inline">
                                                <input type="radio" name="status[{{$company_overview->name}}]" {{ $company_overview->status == true ? 'checked' : '' }} value="1">verified
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status[{{$company_overview->name}}]" {{ $company_overview->status == false ? 'checked' : '' }} value="0">unverified
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success float-right">submit</button>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

@endsection

