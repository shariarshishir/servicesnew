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
                        <li class="breadcrumb-item active">Rfq </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            {{-- <div class="row" style="padding-bottom: 20px;">
                <div class="col-lg-12">
                    <a href="{{route('vendor.order.create',$vendorId)}}" class="btn btn-success" style="display: none;"><i class="fas fa-plus"></i> Add New order</a>
                </div>
            </div> --}}

            <div class="row admin_order_list_table_wrap">
                <div class="col-md-12">
                    <div class="card">
                        <legend>Rfqs List</legend>
                        <div class="no_more_tables">
                            @if(count($collection)>0)
                            <table class="table table-bordered orders-table">
                                <thead class="cf">
                                    <tr>
                                    <th>Sl No.</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Delivery Time</th>
                                    <th>User Name</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($collection as $key=>$list)
                                        <tr>
                                            <td >{{$key+1}}</td>
                                            <td>{{ucwords($list->title)}}</td>
                                            <td>{{$list->category->name}}</td>
                                            <td>{{$list->quantity}}</td>
                                            <td>{{\Carbon\Carbon::parse($list->delivery_time, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</td>
                                            <td>{{$list->user->name}}</td>
                                            <td>{{\Carbon\Carbon::parse($list->created_at, 'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</td>
                                            <td><a href="{{route('admin.rfq.show', $list->id)}}">Details</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @else
                                <div class="alert alert-info alert-dismissible">
                                    INFO : No rfq available.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

@endsection
@push('js')
  <script>
      $('.orders-table').DataTable();
  </script>
@endpush



