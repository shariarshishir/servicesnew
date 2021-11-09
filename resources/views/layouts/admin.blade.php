<!DOCTYPE html>
<html>
<head>
  @include('include.admin._head')
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
    @include('include.admin._header')
    
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('include.admin._leftsidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->
 
   @include('include.admin._footer')
</div>
<!-- ./wrapper -->
 

@include('include.admin._javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  @if(Session::has('success'))
      toastr.success("{{Session::get('success')}}");
  @endif

  @if(Session::has('error'))
      toastr.error("{{Session::get('error')}}");
  @endif

  @if(Session::has('info'))
      toastr.info("{{ Session::get('info') }}");
  @endif

  @if(Session::has('warning'))
  
      toastr.warning("{{ Session::get('warning') }}");
  @endif
</script>
</body>
</html>
