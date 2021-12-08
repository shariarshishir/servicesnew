<!DOCTYPE html>
<html lang="en">
<head>
@include('include._head')
</head>
<body>
{{-- For loader --}}
<div class="overlay"></div>
<div id="loadingProgressContainer" style="display: none;">
    <div id="loadingProgressElement">
        <img src="{{asset('images/frontendimages/ajax-loader-bar.gif')}}" width="150" height="150" alt="Loading">
        <div class="loading-message">Loading...</div>
    </div>
</div>
{{-- end loader --}}
<!-- Header -->
@include('include._header')
<!-- /.Header -->

<!-- Content Wrapper. Contains page content -->
<div id="main">
  <div class="row">
      @yield('content')
  </div>
</div>
<!-- /.content-wrapper -->

<!-- Header -->
@include('include._footer')
@yield('style')
<!-- /.Header -->
</body>
</html>
