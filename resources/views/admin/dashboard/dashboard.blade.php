
@extends('layouts.admin')
@section('content')
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<!-- Main content -->
		<section class="content">
			<div class="card">
				<legend>Dashboard</legend>
				<div class="alert alert-info alert-dismissible">
                  <h5><i class="fas fa-bullhorn"></i> MERCHANTBAY SHOP</h5>
                  Welcome to Merchatbay Shop.
                </div>

				<div id="dashborad-panel" class="clearfix">

					<div style="text-align:center;margin:0;">
						<div class="icon" title="Vendors">
							<a href="{{route('vendor.index')}}">
								<i class="fas fa-store"></i>
								<span>Stores</span>
							</a>
						</div>
					</div>
					<div style="text-align:center;margin:0;">
						<div class="icon" title="Categories">
							<a href="{{ Route('product-categories.index')}}">
								<i class="fas fa-network-wired"></i>
								<span>Categories</span>
							</a>
						</div>
					</div>

				</div>



			</div>
		</section>
		<!-- /.content -->
	</div>
  @endsection
