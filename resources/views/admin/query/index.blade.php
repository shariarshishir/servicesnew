
@extends('layouts.admin')
@section('content')
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		@if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
		<!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <legend>Query List</legend>
                            @if(count($collection)>0)
                            <table class="table table-bordered query-table">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Requested User</th>
                                        <th>Product Name</th>
                                        <th>Store Name</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($collection as $key=>$list)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $list->user->name }}</td>
                                            <td>{{ $list->product->name}}</td>
                                            <td>{{ $list->businessProfile->business_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($list->created_at)->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</td>
                                            <td>
                                                @switch($list->state)
                                                    @case(1)
                                                    <span class="text-danger">Pending</span>
                                                        @break
                                                    @case(2)
                                                        <span class="text-info">Processed</span>
                                                        @break
                                                    @case(3)
                                                        <span class="text-success">Ordered</span>
                                                            @break
                                                    @case(4)
                                                        Cancel
                                                        @break
                                                    @default

                                                @endswitch
                                            </td>
                                            <td>
                                                <a href="{{ route('query.show', $list->id) }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> view
                                                </a>

                                                &nbsp; | &nbsp;
                                                <a href="{{ route('query.edit', $list->id) }}">
                                                    <i class="fas fa-plus-circle"></i>
                                                    Create/Update
                                                </a>

                                                {{-- <a href="{{ route('query.request.edit', $list->id) }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> view
                                                </a>
                                                @if ($list->type == config('constants.order_query_type.order_query_with_modification'))
                                                &nbsp; | &nbsp;
                                                <a href="{{ route('query.modification.request.edit', $list->id) }}">
                                                    <i class="fas fa-plus-circle"></i>
                                                    Create/Update Order
                                                </a>
                                                @endif --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @else
                                <div class="card-alert card cyan">
                                    <div class="card-content white-text">
                                        <p>INFO : No Query available.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@push('js')
  <script>
      $('.query-table').DataTable();
  </script>
@endpush

