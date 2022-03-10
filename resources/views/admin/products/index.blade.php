@extends('layouts.admin')
@section('content')
@php
    $product_category_request = array_key_exists('product_category', app('request')->input())?app('request')->input('product_category'): '';
    $factory_category_request = array_key_exists('factory_category', app('request')->input())?app('request')->input('factory_category'): '';
    $status = array_key_exists('status', app('request')->input())?app('request')->input('status'): '';
    $business_profile_request = array_key_exists('business_profile', app('request')->input())?app('request')->input('business_profile'): '';
    $priority= array_key_exists('priority', app('request')->input())?app('request')->input('priority'): '';
    $product_name = array_key_exists('product_name', app('request')->input())?app('request')->input('product_name'): '';
    $date = array_key_exists('datefilter', app('request')->input())?app('request')->input('datefilter'): '';
@endphp

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <legend>Products</legend>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
				    <legend>all products list</legend>
                    <form action="{{route('admin.products.index')}}" method="GET" id="product_filter_form">
                    <div class="filter">
                        <div class="row">
                            <div class="row-md-3">
                                <select class="form-select" name="product_category" id="product_category" >
                                    <option value="" selected>Product Category</option>
                                    @foreach ($product_category as $pro_cat)
                                        <option value="{{$pro_cat->id}}" {{$pro_cat->id == $product_category_request ? 'selected' : '' }}>{{$pro_cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row-md-3">
                                <select class="form-select" name="factory_category" id="factory_category">
                                    <option value="">Factory Category</option>
                                    @foreach ($factory_category as $factory_cat)
                                        <option value="{{$factory_cat->id}}" {{$factory_cat->id == $factory_category_request ? 'selected' : '' }}>{{$factory_cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row-md-3">
                                <select class="form-select" name="status" id="status">
                                    <option value="">Status</option>
                                    <option value="1" {{$status == 1 ? 'selected' : ''}}>Published </option>
                                    <option value="0" {{isset($status) && $status == 0 ? 'selected' : ''}}>Unpublished</option>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row-md-3">
                                <input type="text" name="datefilter" value="{{$date}}" placeholder="Uploaded Date between"/>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row-md-3">
                                <select class="form-select" name="business_profile" id="business_profile">
                                    <option value="">Business Profile</option>
                                    @foreach ($business_profile as  $key => $profile)
                                        <option value="{{$key}}" {{$key == $business_profile_request ? 'selected' : ''}}>{{$profile}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row-md-3">
                                <select class="form-select" name="priority" id="priority">
                                    <option value="">Priority</option>
                                    <option value="1" {{$priority == 1 ? 'selected' : ''}}>High</option>
                                    <option value="2" {{$priority == 2 ? 'selected' : ''}}>Medium</option>
                                    <option value="3" {{$priority == 3 ? 'selected' : ''}}>Low</option>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row-md-3">
                                <input type="text" name="product_name" placeholder="enter product name" value="{{$product_name}}">
                                <button type="submit" onclick="this.form.submit();">search</button>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('admin.products.index')}}" class="btn btn-primary btn-sm">Reset</a>
                </form>

                @if(count($products)>0)
                <div class="no_more_tables">
                      <table class="table table-bordered users-table data-table" >
                          <thead class="cf">
                                  <tr>
                                      <th>Products Name</th>
                                      <th>Business Name</th>
                                      <th>Category</th>
                                      <th>Uploaded Date</th>
                                      <th>Details</th>
                                  </tr>
                          </thead>

                          <tbody>
                            @foreach($products as $list)
                                <tr>
                                    <td>{{$list->flag == 'shop' ? $list->name : $list->title}}</td>
                                    <td>{{$list->businessProfile->business_name}}</td>
                                    <td>{{$list->category? $list->category->name : ''}}</td>
                                    <td>{{\Carbon\Carbon::parse($list->created_at)->isoFormat('MMMM Do YYYY')}}</td>
                                    <td><a href="{{route('admin.products.show', ['flag' => $list->flag, 'id' => $list->id])}}">Details</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>

                @else
                    <div class="alert alert-info alert-dismissible">
                        INFO : No products available.
                    </div>
                @endif
                Showing {{($products->currentpage()-1)*$products->perpage()+1}} to {{$products->currentpage()*$products->perpage()}} of  {{$products->total()}} results
                {{ $products->appends(request()->query())->links() }}
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
      $(document).on('change', '#product_category, #factory_category, #status, #business_profile, #priority', function(){
                this.form.submit();
      });


    $(function() {

        $('input[name="datefilter"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            $('#product_filter_form').submit()
        });
        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });


    });

  </script>
@endpush
