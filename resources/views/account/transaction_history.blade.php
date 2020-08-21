@extends('template') 
@section('main')
<div class="container margin-top30">
  <input id="id" name="id" type="hidden" value="33661974">
  <input id="redirect_on_error" name="redirect_on_error" type="hidden" value="/users/security?id=33661974">
  <input id="user_password_ok" name="user[password_ok]" type="hidden" value="true">
  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-footer">
        <div class="panel">
  @include('common.sidenav')
        </div>
      </div>
    </div>
  </div>



  <div class="col-md-9">
    <!--Filtering Box Start -->
    <div class="row">
      <div>
        <div class="box">
          <div class="box-body">
            <form class="form-horizontal" enctype='multipart/form-data' action="{{ url('users/transaction-history') }}" method="GET"
              id='filter_form' accept-charset="UTF-8">
              <input class="form-control" id="startfrom" type="hidden" name="from" value="<?= isset($from) ? $from : '' ?>">
              <input class="form-control" id="endto" type="hidden" name="to" value="<?= isset($to) ? $to : '' ?>">
              <div>
                <div class="row">
                  <div class="col-md-10 col-sm-12 col-xs-12">
                    <div class="col-md-5 col-sm-12 col-xs-12">
                      <label>{{trans('messages.filter.date_range')}}</label>
                      <div class="input-group col-md-12 col-sm-12 col-xs-12">
                        <button type="button" class="form-control" id="daterange-btn">
                        <span class="pull-left">
                          <i class="fa fa-calendar"></i> {{trans('messages.filter.pick_date_range')}}
                        </span>
                        <i class="fa fa-caret-down pull-right"></i>
                      </button>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                      <label for="sel1">{{trans('messages.filter.status')}}</label>
                      <select class="form-control select2" name="status" id="status">
                    <option value="" >{{trans('messages.filter.all')}}</option>
                    <option value="Completed" {{ $allstatus == "Completed" ? ' selected="selected"' : '' }}>{{trans('messages.filter.completed')}}</option>
                    <option value="Future" {{ $allstatus == "Future" ? ' selected="selected"' : '' }}>{{trans('messages.filter.future')}}</option>
                  </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4" style="margin-top: 5px;">
                      <br>
                      <button type="submit" name="btn" class="btn ex-btn">{{trans('messages.filter.filter')}}</button>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4" style="margin-top: 5px;">
                      <br>
                      <button type="submit" name="reset_btn" class="btn ex-btn">{{trans('messages.filter.reset')}}</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <br>
    <!--Filtering Box End -->
    <div class="panel panel-default">

      <div class="panel-body h5">
        {{trans('messages.account_transaction.transaction')}}
      </div>
      <div class="panel-footer">
        <div class="panel">
          <div class="panel-body" style="padding: 0px 0px;">
            <div class="row">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>{{trans('messages.account_transaction.date')}}</th>
                      <th>{{trans('messages.account_transaction.type')}}</th>
                      <th>{{trans('messages.account_transaction.detail')}}</th>
                      <th>{{trans('messages.account_transaction.amount')}}</th>
                      <th>{{trans('messages.account_transaction.status')}}</th>
                    </tr>
                  </thead>
                  <tbody id="transaction-table-body">

                  </tbody>
                </table>
              </div>
            </div>
            <div style="float:right">
              <p id="transaction-page-info" class="b-mar-none"></p>
              <ul class="pagination" id="transaction-pagination" style="margin: 5px 0px;">
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@push('scripts')
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ url('public/backend/plugins/daterangepicker/daterangepicker.js') }} "></script>
{{--
<script src="{{ url('public/backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script> --}}
<!-- Date Picker CSS-->
{{--
<link rel="stylesheet" href="{{ url('public/backend/plugins/datepicker/datepicker3.css') }}"> --}}

<link rel="stylesheet" href="{{ url('public/backend/plugins/daterangepicker/daterangepicker.css') }}">
<script type="text/javascript">
  transaction_data_load();
  $(document).on('click', '.transaction-page', function(){
      var page = $(this).attr('data-rel');
      transaction_data_load(page);
  });
  function transaction_data_load(page) {
      var dataURL         = APP_URL + '/users/account_transaction_history?page=' + page;
      var dateFormat      = '{{Session::get('date_format_type')}}';
      var separator       = "{{Session::get('date_separator')}}";
      var dateFormatFinal = dateFormat.split(separator).join("");
      $.ajax({
        url: dataURL,
        data: $('#filter_form').serialize(),
        type: 'post',
        dataType: 'json',
        success: function (result) {
          var transaction      = result.data;
          var transaction_list = '';
          var pagination       = '';
          var transfer         = '';
          if (result.from == null) {
              result.from = 0;
          }
          if (result.to == null) {
              result.to = 0;
           }
           if (result.total == null) {
              result.from = 0;
           }
          for (var key in transaction) {         
            if (transaction.hasOwnProperty(key)) {
              transfer            = transaction[key].status == 'Completed' ? "Transfer to " + transaction[key].account + '<br>' + "<a href='" + APP_URL + '/properties/' + transaction[key].property_id + "' target='_blank'>" + transaction[key].property_name + "</a>" : '';
              var oldDate         = transaction[key].created_at;
              var newDate         = new Date(oldDate.replace(/-/g, "/"));
              var date            = newDate.toISOString().slice(0,10);
              if (dateFormatFinal == 'ddMyyyy') {
                dateFormat          = "DD" + separator + "MMM" + separator + 'YYYY';
              } else if(dateFormatFinal == 'yyyyMdd') {
                dateFormat          = "YYYY" + separator + "MMM" + separator + 'DD';
              } else {
                dateFormat          = dateFormat.toUpperCase();
              }
              date                  = moment(date).format(dateFormat);
              transaction_list += '<tr>'
                                    +'<td>'+ date +'</td>'
                                    +'<td>'+ "Payout" +'</td>'
                                    +'<td>'+ transfer +'</td>'
                                    +'<td><b>'+ transaction[key].currency_code +' '+ transaction[key].amount +'</b></td>'
                                    +'<td>'+ transaction[key].status +'</td>'
                                  +'</tr>';
              
            }
          }
          $('#transaction-table-body').html(transaction_list);
          $('#transaction-page-info').html(result.from + ' – ' + result.to + ' of ' + result.total +' {{trans('messages.account_transaction.transaction')}}');
          var page_show = Math.min(5, result.last_page);
          if(result.prev_page_url != null)
            pagination += '<li><a class="transaction-page" data-rel="1" href="javascript:void(0)"><<</a></li><li><a class="transaction-page" data-rel="' + (result.current_page-1) + '" href="javascript:void(0)">< Prev</a></li>';
          for(var i=1; i <= page_show; i++){
            if(i == result.current_page) pagination += '<li class="active"><a href="javascript:void(0)">' + i + '</a></li>';
            else pagination += '<li><a class="transaction-page" data-rel="'+ i +'" href="javascript:void(0)">'+  i +'</a></li>';
          }
          if(result.next_page_url != null)
            pagination += '<li><a class="transaction-page" data-rel="' + (result.current_page + 1) +'" href="javascript:void(0)">Next ></a></li><li><a class="transaction-page" data-rel="' + result.last_page + '" href="javascript:void(0)">>></a></li>';
          $('#transaction-pagination').html(pagination);
        },
        error: function (request, error) {
          // This callback function will trigger on unsuccessful action
          //show_error_message('Det har oppstått nettverksfeil vennligst prøv igjen');
        },
      });
  }

</script>

@endpush 
@stop 
@section('validation_script')


<script type="text/javascript">
  // Date Time range picker for filter
$(function() {
  // * Set the time range for daterangepicker
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
        var sessionDate      = '{{Session::get('date_format_type')}}';
        var sessionDateFinal = sessionDate.toUpperCase();
        var startDate        = moment(start, 'MMMM D, YYYY').format(sessionDateFinal);
        $('#startfrom').val(startDate);
        var endDate          = moment(end, 'MMMM D, YYYY').format(sessionDateFinal);
        $('#endto').val(endDate);
        $('#daterange-btn span').html(startDate + ' - ' +endDate )
      }
     )

      $(document).ready(function(){
          var startDate = "{!! $from !!}";
          var endDate   = "{!! $to !!}";
          if (startDate == '' && endDate == '') { 
            $('#daterange-btn span').html('<i class="fa fa-calendar"></i> {{trans('messages.filter.pick_date_range')}}');
          } else {
            $('#daterange-btn span').html(startDate + ' - ' + endDate );
        }
      });
});

</script>
@endsection