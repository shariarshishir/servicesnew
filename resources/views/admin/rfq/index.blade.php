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
                    <div class="rfq_order_list_top">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <h3>Rfq</h3>
                                <div class="select_show">
                                    <label>Show</label>
                                    <select>
                                        <option>10</option>
                                        <option>20</option>
                                        <option>30</option>
                                    </select>
                                    <label>Entries</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="rfq_order_list_search">
                                    <label>Search</label>
                                    <input placeholder="Search" type="text" />
                                </div>
                            </div>
                        </div>      
                    </div>
                    <div class="no_more_tables">
                        <table class="table table-bordered orders-table data-table">
                            <thead class="cf">
                                <tr>
                                    <th width="2%">Sl</th>
                                    <th width="5%">Date</th>
                                    <th width="25%">RFQ Title</th>
                                    <th width="5%">Category</th>
                                    <th width="5%">Quantity</th>
                                    <th width="5%">Target price</th>
                                    <th width="5%">Delivery Date</th>
                                    <th width="5%" style="text-align: center;">Status</th>
                                    <th width="5%" style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="cf">
                                @foreach($rfqs as $key=>$rfq)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ \Carbon\Carbon::parse($rfq['created_at'])->isoFormat('MMMM Do YYYY')}}</td>
                                    <td><a href="{{route('admin.rfq.show', $rfq['id'])}}">{{$rfq['title']}}</a></td>
                                    <td>{{$rfq['category'][0]['name']}}</td>
                                    <td>{{$rfq['quantity']}}</td>
                                    <td>$ {{$rfq['unit_price']}}</td>
                                    <td>{{ \Carbon\Carbon::parse($rfq['delivery_time'])->isoFormat('MMMM Do YYYY')}}</td>
                                    <td style="text-align: center;">
                                        <span style="@php echo($rfq['status'] == 'pending')? 'color:red':'color:green'; @endphp">
                                        @php echo($rfq['status'] == 'pending')? '<i class="fa fa-times"></i>':'<i class="fa fa-check"></i>'; @endphp
                                        </span>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="{{route('admin.rfq.show', $rfq['id'])}}" class="show-rfq-details-trigger"><i class="fa fa-eye"></i></a>
                                        <a href="javascript:void(0);" class="remove-rfq-trigger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

@endsection
@push('js')
  <script>

    //    $(function () {
    //     var table = $('.data-table').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         order: [['6', 'desc']],
    //         ajax: "{{ route('admin.rfq.index') }}",
    //         columns: [
    //             {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
    //             {data: 'title', name: 'title'},
    //             {data: 'category_id', name: 'category_id'},
    //             {data: 'quantity', name: 'quantity'},
    //             {data: 'delivery_time', name: 'delivery_time'},
    //             {data: 'created_by', name: 'created_by'},
    //             {data: 'created_at', name: 'created_at'},
    //             {data: 'status', name: 'status'},
    //             {data: 'details', name: 'details',  orderable: false, searchable: false},
    //         ]
    //     });
    // });

  </script>
@endpush



