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
              <li class="breadcrumb-item active">Discount</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 certification_list_wrap">
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-lg-12">
                        <a href="{{Route('admin.discount.create')}}">Offer Discount</a>
                    </div>
                </div>
                @include('include.admin._message')
                <div class="card">
                    <legend>Discounts List</legend>
                    <div class="">
                      <table class="table table-bordered certification_table">
                          <thead class="cf">
                              <tr>
                                  <th>SN</th>
                                  <th>Title</th>
                                  <th>Start Date</th>
                                  <th>End Date</th>
                                  <th>Product Seller</th>
                                  <th>TTL Discount</th>
                                  <th>From MB</th>
                                  <th>From Seller</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($collection as $list)
                                  <tr>
                                      <td >{{$loop->iteration}}</td>
                                      <td>{{$list->title}}</td>
                                      <td >{{ \Carbon\Carbon::parse($list->start_date)->isoFormat('MM/DD/YYYY h:mm:ss A')}}</td>
                                      <td >{{ \Carbon\Carbon::parse($list->end_date)->isoFormat('MM/DD/YYYY h:mm:ss A')}}</td>
                                      <td >
                                          @if($list->business_profile_id)
                                            @foreach ($list->business_profile_id as $id)
                                                @php $b =businessProfileInfo($id) ;@endphp
                                                {{$b->business_name}},
                                            @endforeach
                                          @endif
                                      </td>
                                      <td >{{$list->ttl_discount}}</td>
                                      <td >{{$list->from_mb}}</td>
                                      <td >{{$list->from_seller}}</td>
                                      <td >
                                          <a href="{{route('admin.discount.edit', $list->id)}}" class="btn btn-primary">edit</a>
                                          {{-- <form action="{{route('admin.discount.destroy',[$list->id])}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-primary" onclick="return confirm('are you sure?');">Delete</button>
                                           </form> --}}
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                    </div>

                </div>
                <div>
                    {{ $collection->links() }}
                </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection

@include('admin.discount._scripts')


