<ul>
    <li><a class="{{ Route::is('new.profile.buyer.index',$alias) ? 'active' : ''}}" href="{{route('new.profile.buyer.index',$alias)}}">General Info</a></li>
    <li><a class="{{ Route::is('new.profile.buyer.rfqs',$alias) ? 'active' : ''}}" href="{{route('new.profile.buyer.rfqs',$alias)}}">RFQs</a></li>
    <li><a class="{{ Route::is('new.profile.buyer.profoma_orders.pending',$alias) ? 'active' : ''}}" href="{{route('new.profile.buyer.profoma_orders.pending',$alias)}}">POs</a></li>
    <li><a class="{{ Route::is('new.profile.buyer.development_center',$alias) ? 'active' : ''}}" href="{{route('new.profile.buyer.development_center',$alias)}}">Development Center</a></li>
    <li><a class="{{ Route::is('new.profile.buyer.order_management',$alias) ? 'active' : ''}}" href="{{route('new.profile.buyer.order_management',$alias)}}">Order Management</a></li>
</ul>
