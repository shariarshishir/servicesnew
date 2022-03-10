<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
      <img src="{{asset('admin-assets/img/merchantbay_icon_white.png')}}" alt="Merchantbay Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">MerchantBay</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin-assets/img/avatar04.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0);" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ Route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard')? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          {{-- business profile --}}
          <li class="nav-item has-treeview {{ Route::is('admin.business.profile.list.type*')  ? 'menu-open' : ''}}">
            <a href="javascript:void(0);" class="nav-link {{  Route::is('admin.business.profile.list.type*') ? 'active' : ''}}">
                <i class="fa fa-user nav-icon"></i>
                <p>Business Profiles <i class="right fas fa-angle-left"></i></p>
            </a>
                <ul class="nav nav-treeview">
                    @php
                        $getTypeBySegment=  Request::segment(3);
                    @endphp
                    <li class="nav-item">
                        <a href="{{route('admin.business.profile.list.type', 'manufacturer')}}" class="nav-link {{ Route::is('admin.business.profile.list.type', 'manufacturer') && $getTypeBySegment == 'manufacturer' ? 'active' : ''}} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manufacturer</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.business.profile.list.type', 'wholesaler')}}" class="nav-link {{ Route::is('admin.business.profile.list.type', 'wholesaler') && $getTypeBySegment == 'wholesaler' ? 'active' : ''}} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Wholesaler</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.business.profile.list.type', 'design_studio')}}" class="nav-link {{ Route::is('admin.business.profile.list.type', 'design_studio') && $getTypeBySegment == 'design_studio'? 'active' : ''}} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Design Studio</p>
                        </a>
                    </li>
                </ul>
          </li>
        <li class="nav-item">
            <a href="{{ Route('verification.request.index')}}" class="nav-link">
                <i class="fa fa-certificate nav-icon"></i>
                <p>Business Profile Verification Request</p>
            </a>
        </li>          
          {{-- new users registered list --}}
          <li class="nav-item has-treeview {{ Route::is('new.user.request','buyer') || Route::is('new.user.request','supplier')? 'menu-open' : ''}}">
            <a href="javascript:void(0);" class="nav-link  {{Route::is('new.user.request','buyer') || Route::is('new.user.request','supplier')? 'active' : ''}}">
              <i class="nav-icon fa fa-users"></i>
              <p>New User Requests<i class="right fas fa-angle-left"></i></p>
            </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        @php
                            $getTypeBySegment=  Request::segment(5);
                        @endphp
                        <a href="{{route('new.user.request', ['type' => 'buyer'])}}" class="nav-link {{ Route::is('new.user.request','buyer') && $getTypeBySegment == 'buyer' ? 'active' : ''}} ">
                            <i class="fa fa-user nav-icon"></i>
                            <p>Buyer</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('new.user.request', ['type' => 'supplier'])}}" class="nav-link {{ Route::is('new.user.request','supplier') && $getTypeBySegment == 'supplier' ? 'active' : ''}} ">
                            <i class="fa fa-user nav-icon"></i>
                            <p>Supplier</p>
                        </a>
                    </li>
                </ul>
          </li>
            {{--end new users registered list --}}
          <li class="nav-item">
              <a href="{{ Route('product-categories.index')}}" class="nav-link {{ Route::is('product-categories.index')||Route::is('product-categories.create')||Route::is('product-categories.edit')? 'active' : ''}}">
                  <i class="fas fa-network-wired nav-icon"></i>
                  <p>Categories</p>
              </a>
          </li>
          <li class="nav-item" style="display: none;">
            <a href="{{route('vendor.index')}}" class="nav-link {{ Route::is('vendor.show') ||Route::is('vendor.index')? 'active' : ''}} ">
                <i class="fas fa-store nav-icon"></i>
                <p>Stores</p>
            </a>
          </li>
          <li class="nav-item" style="display: none;">
            <a href="{{ Route('vendor.inactive.index')}}" class="nav-link {{ Route::is('vendor.inactive.index')? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Inactive Stores</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ Route('admin.configdashboard')}}" class="nav-link {{ Route::is('admin.configdashboard')? 'active' : ''}}">
              <i class="fas fa-palette nav-icon"></i>
                <p>Shop Configuration</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ Route('admin.orders.index')}}" class="nav-link {{ Route::is('admin.orders.index')? 'active' : ''}}">
              <i class="fas fa-shopping-cart nav-icon"></i>
                <p>Orders</p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ Route::is('query.request.index',1) || Route::is('query.request.index',2)? 'menu-open' : ''}}">
            <a href="javascript:void(0);" class="nav-link {{ Route::is('query.request.index',1) || Route::is('query.request.index',2)? 'active' : ''}}">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>Queries<i class="right fas fa-angle-left"></i></p>
            </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        @php
                            $getTypeBySegment=  Request::segment(4);
                        @endphp
                        <a href="{{route('query.request.index', ['type' => 1])}}" class="nav-link {{ Route::is('query.request.index',1) && $getTypeBySegment == 1 ? 'active' : ''}} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Order Queries</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('query.request.index', ['type' => 2])}}" class="nav-link {{ Route::is('query.request.index',2) && $getTypeBySegment == 2 ? 'active' : ''}} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Order Queries With Modification</p>
                        </a>
                    </li>
                </ul>
          </li>
          {{-- shipping --}}
          <li class="nav-item has-treeview {{ Route::is('uom*') || Route::is('shipping-method*') || Route::is('shipment-type*') ? 'menu-open' : ''}}">
            <a href="javascript:void(0);" class="nav-link {{ Route::is('uom*') || Route::is('shipping-method*') || Route::is('shipment-type*') ? 'active' : ''}}">
                <i class="fas fa-shipping-fast nav-icon"></i>
                <p>Shipping<i class="right fas fa-angle-left"></i></p>
            </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('uom.index')}}" class="nav-link {{ Route::is('uom*')? 'active' : ''}} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>UOM</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('payment-term.index')}}" class="nav-link {{ Route::is('payment-term*') ? 'active' : ''}} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Payment Term</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('shipment-term.index')}}" class="nav-link {{ Route::is('shipment-term*') ? 'active' : ''}} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Shipping Term</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('shipping-method.index')}}" class="nav-link {{ Route::is('shipping-method*') ? 'active' : ''}} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Shipping Method</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('shipment-type.index')}}" class="nav-link {{ Route::is('shipment-type*') ? 'active' : ''}} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Shipping Type</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('merchant-assistances.index')}}" class="nav-link {{ Route::is('merchant-assistances*') ? 'active' : ''}} ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Merchant Assistance</p>
                        </a>
                    </li>
                    
                </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('proforma-terms-and-conditions.index')}}" class="nav-link {{ Route::is('profroma-terms-and-conditions*') ? 'active' : ''}} ">
                <i class="far fa-file nav-icon"></i>
                <p>Proforma terms and conditions</p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="{{route('proforma_invoices.index')}}" class="nav-link {{ Route::is('proforma_invoices*') ? 'active' : ''}} ">
                <i class="far fa-file nav-icon"></i>
                <p>Proforma invoices</p>
            </a>
          </li>          
          <li class="nav-item">
            <a href="{{ Route('blogs.index')}}" class="nav-link {{ Route::is('blogs.index')? 'active' : ''}}">
                <i class="far fa-newspaper nav-icon"></i>
                <p>Blogs</p>
            </a>
          </li>
          {{-- end shipping --}}
          {{-- users --}}
          <li class="nav-item">
            <a href="{{ Route('users.index')}}" class="nav-link {{ Route::is('users.*')? 'active' : ''}}">
                <i class="fa fa-user nav-icon"></i>
                <p>Users</p>
            </a>
          </li>
          {{-- end users --}}
        {{--certificate--}}
        {{-- shipping --}}
        <li class="nav-item">
            <a href="{{ Route('admin.certification.index')}}" class="nav-link {{ Route::is('admin.certification.*')? 'active' : ''}}">
                <i class="fa fa-certificate nav-icon"></i>
                <p>Certification</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ Route('admin.rfq.index')}}" class="nav-link">
                <i class="fas fa-quote-left nav-icon"></i>
                <p>RFQ</p>
            </a>
        </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
