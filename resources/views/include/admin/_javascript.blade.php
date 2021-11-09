<!-- jQuery -->
<script src="{{asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin-assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script type="text/javascript">
  $.widget.bridge('uibutton', $.ui.button)
</script>
{{-- select 2 --}}
<script src="{{asset('admin-assets/js/select2.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
{{-- popper.min.js --}}
<script src="{{asset('admin-assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin-assets/js/adminlte.min.js')}}"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
{{-- datatable --}}
<script src="{{ asset('admin-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
  tinymce.init({
      selector:'textarea.description',
      width: 1010,
      height: 100
  });
  //tooltip
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

<script src="{{asset('admin-assets/js/admin.main.js')}}"></script>
<script type="text/javascript" src="{{asset('admin-assets/js/image-uploader.min.js')}}"></script>
<script type="text/javascript">
    $('#image').change(function(){

    let reader = new FileReader();
    reader.onload = (e) => {
      $('#preview-image').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);

   });
  </script>
</div>
</div>
@yield('js')
@stack('js')
