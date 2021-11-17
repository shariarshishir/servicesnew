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

<!-- Content Wrapper. Contains page content -->
@yield('content')
<!-- /.content-wrapper -->

@include('include._footer')

</body>
</html>
