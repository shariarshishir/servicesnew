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
            <div class="row admin_order_list_table_wrap">
                <div class="col-md-12">
                    <div class="card">
                        <legend>Rfqs List</legend>
                        <div class="no_more_tables">
                            <table class="table table-bordered orders-table data-table">
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
                            </table>
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
       $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            order: [['6', 'desc']],
            ajax: "{{ route('admin.rfq.index') }}",
            columns: [
                {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'title', name: 'title'},
                {data: 'category', name: 'category', orderable: false},
                {data: 'quantity', name: 'quantity'},
                {data: 'delivery_time', name: 'delivery_time'},
                {data: 'created_by', name: 'created_by'},
                {data: 'created_at', name: 'created_at'},
                {data: 'details', name: 'details',  orderable: false, searchable: false},
            ]
        });
    });
  </script>
@endpush



