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
    @include('include.admin._message')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Add Products</h3>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Title: {{$discount->title}}</p>
                            <p>Start Date: {{\Carbon\Carbon::parse($discount->start_date)->isoFormat('MM/DD/YYYY h:mm:ss A')}}</p>
                            <p>End Date: {{\Carbon\Carbon::parse($discount->end_date)->isoFormat('MM/DD/YYYY h:mm:ss A')}}</p>
                        </div>
                        <div class="col-md-6">
                            <p>From MB: {{$discount->from_mb}} %</p>
                            <p>From Seller: {{$discount->from_seller}} %</p>
                            <p>Total Discount: {{$discount->ttl_discount}} %</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.discount.store.products') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="discount_id" value="{{$discount->id}}">
                    <div class="container">
                        <div class="row">
                            <table class="table table-bordered add-products-table">
                                <thead class="cf">
                                    <tr>
                                        <th>Business Profile</th>
                                        <th>Products</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <tr>
                                        <td>
                                            <select class="form-select select-business" data-live-search="true" name="business_id[1][]" required>
                                                <option value="">Select</option>
                                                @foreach ($business_profile  as $id => $name)
                                                    <option value="{{$id}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="selectpicker form-select product-list"  data-live-search="true" name="products_id[1][]" multiple data-actions-box="true" required></select>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn waves-effect waves-light red remove-color-size-block" onclick="remove(this);"><i class="fas fa-minus-circle">Remove</i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="javascript:void(0);" class="btn waves-effect waves-light green add-more-block" onclick="addProducts()"><i class="fas fa-plus-circle"></i> Add More</a>
                        </div>
                      </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
              </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection

@include('admin.discount._scripts')

@push('js')
<script>
    function addProducts()
    {
        let totalChild = $('.add-products-table tbody').children().length;
        totalChild++;
        var html = '<tr>';
        html += '<td><select class="form-select select-business" name="business_id['+totalChild+'][]" data-live-search="true" required><option value="">Select</option>@foreach ($business_profile  as $id => $name)<option value="{{$id}}">{{$name}}</option>@endforeach</select></td>';
        html += '<td><select class="selectpicker form-select product-list"  data-live-search="true" name="products_id['+totalChild+'][]" multiple data-actions-box="true" required></select></td>';
        html += '<td><a href="javascript:void(0);" class="btn waves-effect waves-light red remove-color-size-block" onclick="remove(this)"><i class="fas fa-minus-circle">Remove</i></a></td>';
        html += '</tr>';
        $('.add-products-table tbody').append(html);
    }
    function remove(el)
    {
        $(el).parent().parent().remove();

    }
    //var bid=[];
    $(document).ready(function() {
        $(document).on('change','.select-business', function() {
            var id = $(this).val();
            // if(jQuery.inArray(id, bid) >= 0) {
            //    alert('Business already selected');
            //    return false;
            // }
            // bid.push(id);
            var obj= $(this);
            if(id) {
                var url = '{{ route("get.products.from.business", ["id"]) }}';
                    url = url.replace('id', id);
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        console.log(data)
                        var get=obj.parent().parent().find("td:eq(1)").find('.selectpicker');
                            var options=[];

                            if(data.products.length !== 0){
                                $.each(data.products, function(key, value){
                                    if( value.discount != null  &&  value.discount.discount !== null){
                                        var option='<option value="'+value.id+'" disabled>'+value.name+'(tag with another discount)'?? value.title+'(tag with another discount)'+'</option>';
                                    }else{
                                        var option='<option value="'+value.id+'">'+value.name?? value.title+'</option>';
                                    }
                                    options.push(option);
                                })
                            }else{
                               get.html('');
                            }

                            get.html(options);
                            get.selectpicker('refresh');

                    }
                });
            }else{
                alert('id not found');
            }
        });
    });
</script>
@endpush




