<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
      <img src="{{asset('admin-assets/img/merchantbay_icon_white.png')}}" alt="Merchantbay Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">MerchantBay Shop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin-assets/img/avatar04.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0);" class="d-block">Super User</a>
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
          <li class="nav-item">
              <a href="{{ Route('product-categories.index')}}" class="nav-link {{ Route::is('product-categories.index')||Route::is('product-categories.create')||Route::is('product-categories.edit')? 'active' : ''}}">
                  <i class="fas fa-network-wired nav-icon"></i>
                  <p>Categories</p>
              </a>
          </li>
          <li class="nav-item">
            <a href="{{route('vendor.index')}}" class="nav-link {{ Route::is('vendor.show') ||Route::is('vendor.index')? 'active' : ''}} ">
                <i class="fas fa-store nav-icon"></i>
                <p>Stores</p>
            </a>
          </li>
          <li class="nav-item">
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
                <i class="fas fa-shipping-fast"></i>
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
                </ul>
          </li>
          {{-- end shipping --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
