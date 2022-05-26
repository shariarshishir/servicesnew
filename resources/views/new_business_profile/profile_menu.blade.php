<ul>
    <li><a class="{{ Route::is('new.profile.index',$alias) ? 'active' : ''}}" href="{{route('new.profile.index',$alias)}}">General Info</a></li>
    <li><a class="active" href="{{ Route::is('new.profile',$alias) ? 'active' : ''}}">Profile</a></li>
    <li><a class="{{ Route::is('new.profile.products',$alias) ? 'active' : ''}}" href="{{ route('new.profile.products',$alias)}}">Products</a></li>
    <li><a class="{{ Route::is('new.profile.rfqs',$alias) ? 'active' : ''}}" href="{{route('new.profile.rfqs',$alias)}}">RFQs</a></li>
    <li><a class="{{ Route::is('new.profile.profoma_orders.pending',$alias) ? 'active' : ''}}" href="{{route('new.profile.profoma_orders.pending',$alias)}}">POs</a></li>
    <li><a class="{{ Route::is('new.profile.development_center',$alias) ? 'active' : ''}}" href="{{route('new.profile.development_center',$alias)}}">Development Center</a></li>
    <li><a class="{{ Route::is('new.profile.order_management',$alias) ? 'active' : ''}}" href="{{route('new.profile.order_management',$alias)}}">Order Management</a></li>
</ul>
