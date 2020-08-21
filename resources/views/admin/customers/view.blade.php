@extends('admin.template')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Customers
    <small>Control panel</small>
    </h1>
    @include('admin.common.breadcrumb')
  </section>
  <!-- Main content -->
  <section class="content">
    <!--Filtering Box Start -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <form class="form-horizontal" enctype='multipart/form-data' action="{{ url('admin/customers') }}" method="GET" accept-charset="UTF-8">
              <input class="form-control" id="startfrom" type="hidden" name="from" value="<?= isset($from) ? $from : '' ?>">
              <input class="form-control" id="endto" type="hidden" name="to" value="<?= isset($to) ? $to : '' ?>">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="col-md-3 col-sm-12 col-xs-12">
                        <label>Date Range</label>
                        <div class="input-group col-xs-12">
                          <button type="button" class="form-control" id="daterange-btn">
                          <span class="pull-left">
                            <i class="fa fa-calendar"></i>  Pick a date range
                          </span>
                          <i class="fa fa-caret-down pull-right"></i>
                          </button>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-12 col-xs-12">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                          <option value="" >All</option>
                          <option value="Active" {{ $allstatus == "Active" ? ' selected="selected"' : '' }}>Active</option>
                          <option value="Inactive" {{ $allstatus == "Inactive" ? ' selected="selected"' : '' }}>Inactive</option>
                        </select>
                      </div>
                       <div class="col-md-3 col-sm-12 col-xs-12">
                      <label>Customer</label>
                      <select class="form-control select2" name="customer" id="customer">
                          <option value="">All</option>
                          @if(!empty($customers))
                            @foreach($customers as $customer)
                                  <option value="{{$customer->id}}" "{{ $customer->id == $allcustomers ? ' selected="selected"' : ''}}">{{$customer->first_name." ".$customer->last_name}}</option>
                            @endforeach
                          @endif
                        </select>
                    </div>
                      <div class="col-md-1 col-sm-2 col-xs-4" style="margin-top: 5px">
                        <br>
                        <button type="submit" name="btn" class="btn btn-primary btn-flat">Filter</button>
                      </div>
                      <div class="col-md-1 col-sm-2 col-xs-4" style="margin-top: 5px">
                        <br>
                        <button type="submit" name="reset_btn" class="btn btn-primary btn-flat">Reset</button>
                      </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--Filtering Box End -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Customers Management</h3>
            @if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'add_customer'))
            <div style="float:right;"><a class="btn btn-success" href="{{ url('admin/add-customer') }}">Add Customer</a></div>
            @endif
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <div class="table-responsive">
                  {!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive', 'width' => '100%', 'cellspacing' => '0']) !!}
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@push('scripts')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{url('public/js/buttons.server-side.js')}}"></script>
<script src="{{ url('public/backend/dist/js/jquery.dataTables.min.js') }}" type="text/javascript"></script> --}}
<script src="{{ asset('public/backend/plugins/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/backend/plugins/Responsive-2.2.2/js/dataTables.responsive.min.js') }}"></script>
{!! $dataTable->scripts() !!}
@endpush

@section('validate_script')
<script type="text/javascript">

  $('.select2').select2({
  // minimumInputLength: 3,
  ajax: {
      url: 'bookings/customer_search',
      processResults: function (data) {
        $('#customer').val('DSD');
        return {
          results: data
        };
      }
    }

  });

  // Date Time range picker for filter
$(function() {
  if ("{!! $from !!}") {
        var startDate = moment("{!! $from !!}");
        var endDate   = moment("{!! $to !!}");
      } else {
        var startDate = moment().subtract(29, 'days');
        var endDate   = moment();
      }

      $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: startDate,
        endDate  : endDate
      },
      function (start, end) {
        var sessionDate      = "{{Session::get('date_format_type')}}";

        var sessionDateFinal = sessionDate.toUpperCase();
        var startDate        = moment(start, 'MMMM D, YYYY').format(sessionDateFinal);
        $('#startfrom').val(startDate);
        var endDate          = moment(end, 'MMMM D, YYYY').format(sessionDateFinal);
        $('#endto').val(endDate);
        $('#daterange-btn span').html(startDate + ' - ' +endDate )
      }
     )

      $(document).ready(function(){
        $('#dataTableBuilder_length').after('<div id="exportArea" class="col-md-4 col-sm-4 "><div class="row" style="margin-top:-2px"><div class="btn-group" style="margin:0px 0px 0px 5px"><button type="button" class="form-control dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" style="width:80px">Export</button><ul class="dropdown-menu" style="min-width:120px"><li><a href="" title="CSV" id="csv">CSV</a></li><li><a href="" title="PDF" id="pdf">PDF</a></li></ul></div><div class="btn btn-group" style="margin:0px 0px 0px -15px"><a href="" id="tablereload" class="form-control"><span><i class="fa fa-refresh"></i></span></a></div></div></div>');

        var startDate = "{!! $from !!}";
        var endDate   = "{!! $to !!}";
        if(startDate=='' && endDate==''){

          $('#daterange-btn span').html('<i class="fa fa-calendar"></i> &nbsp;&nbsp; Pick a date range');
        } else {
        $('#daterange-btn span').html(startDate + ' - ' +endDate );
          
        }
      });
      //csv convert
      $(document).on("click", "#csv", function(event){
        event.preventDefault();
        var status = $('#status').val();
        var customer = $('#customer').val();
        var to = $('#endto').val();
        var from = $('#startfrom').val();
        window.location = "customer/customer_list_csv?to="+to+"&from="+from+"&status="+status+"&customer="+customer;
      });
      //pdf convert
      $(document).on("click", "#pdf", function(event){
        event.preventDefault();
        var status = $('#status').val();
        var customer = $('#customer').val();
        var to = $('#endto').val();
        var from = $('#startfrom').val();
        window.location = "customer/customer_list_pdf?to="+to+"&from="+from+"&status="+status+"&customer="+customer;
        
    });
    //reload Datatable
    $(document).on("click", "#tablereload", function(event){
      event.preventDefault();
      $("#dataTableBuilder").DataTable().ajax.reload();
    });
});
</script>
@endsection