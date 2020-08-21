<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script> 
var APP_URL = "{{(url('/'))}}"; 
</script>
<!-- jQuery 2.2.3 -->
<script src="{{URL::to('/')}}/public/backend/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- jQuery validation -->
<script src="{{URL::to('/')}}/public/backend/plugins/jQuery/jquery.validate.min.js"></script>
<!-- jQuery validation -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{URL::to('/')}}/public/backend/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ @$map_key }}&sensor=false&libraries=places'></script>
 
  <script src="{{ url('public/front/js/locationpicker.jquery.min.js') }}"></script>
  <script src="{{ url('public/front/js/bootbox.min.js') }}"></script>
<!-- admin js -->
<script src="{{URL::to('/')}}/public/backend/dist/js/admin.js"></script>
<!-- backend js -->
<script src="{{URL::to('/')}}/public/backend/js/backend.js"></script>
<!-- CK Editor -->
{{-- <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
 --}}{{-- <script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script> --}}
<!-- <script src="{{URL::to('/')}}/public/backend/js/ckeditor.js"></script> -->
@stack('scripts')
<!-- Morris.js charts -->
@if(Route::current()->uri() == 'admin/dashboard')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{URL::to('/')}}/public/backend/plugins/morris/morris.min.js"></script>
<script src="{{ url('public/backend/dist/js/dashboard.js') }}"></script>
<script src="{{ url('public/backend/plugins/chartjs/Chart.min.js') }}"></script> -->
@endif
<!-- Sparkline -->
<script src="{{URL::to('/')}}/public/backend/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="{{URL::to('/')}}/public/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{URL::to('/')}}/public/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{URL::to('/')}}/public/backend/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{URL::to('/')}}/public/backend/plugins/daterangepicker/daterangepicker.js"></script>
<script src="{{URL::to('/')}}/public/backend/plugins/datepicker/bootstrap-datepicker.js"></script> 
<!-- Bootstrap WYSIHTML5 -->
<script src="{{URL::to('/')}}/public/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="{{URL::to('/')}}/public/backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{URL::to('/')}}/public/backend/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{URL::to('/')}}/public/backend/dist/js/app.min.js"></script>
<!--Select2-->
<script src="{{URL::to('/')}}/public/backend/plugins/select2/select2.full.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
@if(Route::current()->uri() == 'admin/dashboard')
<script src="{{URL::to('/')}}/public/backend/dist/js/pages/dashboard.js"></script>
@endif
<!-- AdminLTE for demo purposes -->
<script src="{{URL::to('/')}}/public/backend/dist/js/demo.js"></script>
<script src="{{URL::to('/')}}/public/backend/dist/js/custom.js"></script>
</body>
</html>
