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
              <li class="breadcrumb-item active">Rfq Details </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content admin_rfq_wrapper">
      <div class="container-fluid">
        <div class="card">
          <div class="row">
              <div class="col-sm-12 col-md-4">
                <legend>Buyer Info</legend>
                <div class="admin_rfq_left">
                    <p><b>Name:</b> {{$rfq->user->name}}</p>
                    <p><b>Email: </b> {{$rfq->user->email}}</p>
                    <p><b>Phone:</b> {{$rfq->user->phone}}</p>
                </div>
              </div>
              <div class="col-sm-12 col-md-8">
                <div class="admin_rfq_right">
                  <legend>Details</legend>
                  <p><b>Title :</b> {{$rfq->title}}</p>
                  <p><b>Category :</b> {{$rfq->category->name}}</p>
                  <p><b>Quantity :</b> {{$rfq->quantity}}</p>
                  <p><b>Unit :</b> {{$rfq->unit}}</p>
                  <p><b>Unit Price :</b> {{$rfq->unit_price}}</p>
                  <p><b>Destination :</b> {{$rfq->destination}}</p>
                  <p><b>Payment Method :</b> {{$rfq->payment_method}}</p>
                  <p><b>Created At :</b> {{\Carbon\Carbon::parse($rfq->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</p>
                  <p><b>Delivery Time :</b> {{\Carbon\Carbon::parse($rfq->delivery_time, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</p>
                  <p><b>Short Description :</b> {{$rfq->short_description}}</p>
                  <p><b>Full Specification :</b> {{$rfq->full_specification}}</p>
                </div>
              </div>
          </div>
        </div>



        <div class="card">
          <div class="row">
            <legend>Replay</legend>

            @foreach ($rfq->bids as $bid)
              <div class="col-md-12">
                  <div class="rfq_replay_box">
                      <div class="row">
                          <div class="col-md-4">
                              <h6>Company Info</h6>
                              <p>Company Name: <b>{{$bid->businessProfile->business_name}}</b></p>
                              <p>Phone : {{$bid->user->phone}}</p>
                              <p>Email: {{$bid->user->email}}</p>
                          </div>
                          <div class="col-md-8">
                              <h6>Replay Details</h6>
                              <p>Offer Price: <b>{{$bid->unit_price}}</b></p>
                              <p>Description : {{$bid->description}}</p>
                          </div>
                      </div>
                  </div>
              </div>
            @endforeach

          </div>
        </div>


        
      </div>
    </section>
</div>

@endsection
