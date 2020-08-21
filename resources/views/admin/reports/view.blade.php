@extends('admin.template')

@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reports
        <small>Control panel</small>
      </h1>
      @include('admin.common.breadcrumb')
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Reports Management</h3>
              <!--<div style="float:right;"><a class="btn btn-success" href="{{ url('admin/display_photos') }}">Add Photos</a></div>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! $dataTable->table() !!}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@push('scripts')
<script type="text/javascript">
  $(document).on('change', '.report_status', function(){
    var dataURL = APP_URL+'/admin/reports/status_change';
    var report_id = $(this).attr('data-rel');
    var status = $(this).val();
    $.ajax({
        url: dataURL,
        data: {'report_id': report_id, 'status': status},
        type: 'post',
        async: true,
        dataType: 'json',
        success: function (result) {
          //console.log(result.success);
          if(result.success){

          }
        },
        error: function (request, error) {
          
        }
    });
  });
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{url('public/js/buttons.server-side.js')}}"></script>
<script src="{{ url('public/backend/dist/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
{!! $dataTable->scripts() !!}
@endpush