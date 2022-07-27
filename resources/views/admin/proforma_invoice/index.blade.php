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
						<li class="breadcrumb-item active">PI PO list</li>
					</ol>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					@include('include.admin._message')
					<div class="card">
						<legend>Proforma invoice List</legend>

                        <div class="panel panel-default">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <table class="table proforma-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proformaInvoices as $key => $proformaInvoice)
                                        @php  $user_info = getUserInfoById($key); @endphp
                                        <tr data-toggle="collapse" data-target="#user-{{$key}}" class="accordion-toggle parent-row">
                                            <td><button class="btn btn-default btn-xs" style="width: 35px; height: 25px;"><i class="fa fa-angle-down" aria-hidden="true"></i></button></td>
                                            <td>{{ $user_info->name ?? '' }}</td>
                                            <td>{{ $user_info->email ?? '' }}</td>
                                            <td>{{ $user_info->phone ?? '' }}</td>
                                        </tr>
                                        <tr class="hiddenRow-Parent">
                                            <td colspan="12" class="hiddenRow">
                                                <div class="accordian-body collapse" id="user-{{$key}}">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr class="info">
                                                                <th>Proforma ID</th>
                                                                <th>Delivery Date</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($proformaInvoice as $item)
                                                            <tr data-toggle="collapse"  class="accordion-toggle">
                                                                <td>{{$item->proforma_id}}</td>
                                                                <td>{{$item->proforma_date}}</td>
                                                                <td>
                                                                    @if($item->status == 1)
                                                                    <span class="accepted_po" style="color: green;">Accepted</span>
                                                                    @elseif($item->status == 0)
                                                                    <span class="pending_po" style="color: #ffc107;">Pending</span>
                                                                    @else
                                                                    <span class="rejected_po" style="color: red;">Rejected</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('proforma_invoices.show', $item->id) }}" class="btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                    @if($item->status == -1)
                                                                    <a href="{{ route('proforma_invoices.create',['buyerId' => $user_info->id,'rfqId'=>$item->generated_po_from_rfq]) }}" class="btn btn-default btn-sm">Update</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

					</div>
				</div>
			</div>
		</div>
    </section>
</div>

@endsection
