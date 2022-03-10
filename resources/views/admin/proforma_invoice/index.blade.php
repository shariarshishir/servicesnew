@extends('layouts.admin')
@section('content')
!-- Main content -->


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
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                @include('include.admin._message')
                <div class="card">
                    <legend>Proforma invoice List</legend>

                    <div class="no_more_tables">
                        <table class="table table-bordered admin-proforma-table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Invoice Title</th>
                                    <th>Date</th>
                                    <th>Buyer Name</th>
                                    <th>Supplier Name</th>
                                    <th>PI Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proformaInvoices as $key=>$proformaInvoice)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td data-title="proforma_id">
                                            {{$proformaInvoice->proforma_id}}
                                        </td>
                                        <td data-title="proforma_date">
                                            {{$proformaInvoice->proforma_date}}
                                        </td>
                                        <td data-title="buyer_name">
                                            {{$proformaInvoice->buyer->name}}
                                        </td>
                                        <td data-title="supplier_name">
                                            {{$proformaInvoice->businessProfile->user->name}}
                                        </td>
                                        <td data-title="PI_status">
                                            @if($proformaInvoice->status == 1)
                                            <span class="accepted_po">Accepted</span>
                                            @elseif($proformaInvoice->status == 0)
                                            <span class="pending_po">Pending</span>
                                            @else
                                            <span class="rejected_po">Rejected</span>
                                            @endif
                                        </td>
                                        <td data-title="Action" class="text-center">
                                            <a href="{{ route('proforma_invoices.show', $proformaInvoice->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
@push('js')
  <script>
       $('.admin-proforma-table').DataTable();
  </script>
@endpush


