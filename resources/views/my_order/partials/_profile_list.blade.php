@section('css')
<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }
    .preview {
        overflow: hidden;
        width: 160px !important;
        height: 68px !important;
        margin: 10px;
        border: 1px solid red;
    }
    .modal-lg{
        max-width: 1000px !important;
    }
</style>
@endsection

<div class="col s12 profile-menu-list">
    <ul class=" z-depth-1 profile-tabs">
        <li class="profile-item-tab col m2  orders-tab"><a class="{{ Route::is('myorder') ? 'active' : ''}}" href="{{route('myorder')}}">Orders</a></li>
        <li class="profile-item-tab col m2  orders-modification-tab"><a class="{{ Route::is('ord.mod.req.index') ? 'active' : ''}}" href="{{route('ord.mod.req.index')}}"><span class="orderModificationCount"></span>  Requested For Msodification</a></li>
        <li class="profile-item-tab col m2  orders-tab"><a class="{{ Route::is('user.order.query.index') ? 'active' : ''}}" href="{{route('user.order.query.index')}}"><span class="orderQueryProcessedCount"></span> Orders Query</a></li>
        <li class="profile-item-tab col m2  reviews-tab"><a class="{{ Route::is('vendor.review.index') ? 'active' : ''}}" href="{{route('vendor.review.index')}}">Reviews</a></li>
    </ul>
</div>

