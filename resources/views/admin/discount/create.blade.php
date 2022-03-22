@extends('layouts.admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Discount</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">create</h3>
                </div>
                <br>
                <form action="{{ route('admin.discount.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Title</label>
                                <input type="text" name="title" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Start Date</label>
                                <input type="datetime-local" name="start_date" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">End Date </label>
                                <input type="datetime-local" name="end_date" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">From MB %</label>
                                <input type="number" name="from_mb" class="input-persentence" id="from_mb" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">From Seller %</label>
                                <input type="number" name="from_seller" class="input-persentence" id="from_seller" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">TTL Discount %</label>
                                <input type="number" name="ttl_discount" id="ttl_discount"  required readonly>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </section>
</div>
@endsection

@include('admin.discount._scripts')




