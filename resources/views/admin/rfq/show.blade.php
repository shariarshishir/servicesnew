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
    <section class="content">
      <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
				        <legend>Buyer Info</legend>
                        <div class="col-md-6">
                            <p>Name: {{$rfq->user->name}}</p>
                            <p>Email: {{$rfq->user->email}}</p>
                            <p>Phone: {{$rfq->user->phone}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <legend>Details</legend>
                        <p>Title : {{$rfq->title}}</p>
                        <p>Category : {{$rfq->category->name}}</p>
                        <p>Quantity : {{$rfq->quantity}}</p>
                        <p>Unit : {{$rfq->unit}}</p>
                        <p>Unit Price : {{$rfq->unit_price}}</p>
                        <p>Destination : {{$rfq->destination}}</p>
                        <p>Payment Method : {{$rfq->payment_method}}</p>
                        <p>Created At : {{\Carbon\Carbon::parse($rfq->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</p>
                        <p>Delivery Time : {{\Carbon\Carbon::parse($rfq->delivery_time, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</p>
                        <p>Short Description : {{$rfq->short_description}}</p>
                        <p>Full Specification : {{$rfq->full_specification}}</p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <legend>Replay</legend>
                        @foreach ($rfq->bids as $bid)
                        <div class="row">
                                <div class="col-md-6">
                                    <h6>Company Info</h6>
                                    <p>Company Name: {{$bid->businessProfile->business_name}}</p>
                                    <p>Phone : {{$bid->user->phone}}</p>
                                    <p>Email: {{$bid->user->email}}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6>Replay Details</h6>
                                    <p>Offer Price: {{$bid->unit_price}}</p>
                                    <p>Description : {!!$bid->description!!}</p>
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
      </div>
    </section>
</div>

@endsection
