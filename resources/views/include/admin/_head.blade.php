<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MerchantBay Shop | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin-assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin-assets/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin-assets/css/admin_style.css')}}">
  <!-- Google Font: Source Sans Pro -->

  <link rel="stylesheet" href="{{asset('admin-assets/css/image-uploader.min.css')}}">
  {{-- Select 2 --}}
  <link rel="stylesheet" href="{{asset('admin-assets/css/select2.min.css')}}">
  {{-- datatable --}}
  <link rel="stylesheet" href="{{ asset('admin-assets/css/datatables.min.css') }}">

  <style>
    .image-uploader .uploaded .uploaded-image .delete-image {
        position: absolute !important;
    }
 </style>

  @yield('css')
