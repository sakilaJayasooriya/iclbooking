@extends('admin.template')
@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Overview & Statisics
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
              <form class="form-horizontal" enctype='multipart/form-data' action="{{ url('admin/overview-stats') }}" method="GET" accept-charset="UTF-8">
                <input class="form-control" id="startfrom" type="hidden" name="from" value="<?= isset($from) ? $from : '' ?>">
                <input class="form-control" id="endto" type="hidden" name="to" value="<?= isset($to) ? $to : '' ?>">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="col-md-3 col-sm-12 col-xs-12">
                        <label>Date Range</label>
                        <div class="input-group  col-xs-12">
                          <button type="button" class="form-control" id="daterange-btn">
                                <span class="pull-left">
                                  <i class="fa fa-calendar"></i>  Pick a date range
                                </span>
                                <i class="fa fa-caret-down pull-right"></i>
                              </button>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-12 col-xs-12">
                        <label>Property</label>
                        <select class="form-control select2" name="property" id="property">
                            <option value="">All</option>
                            @if(!empty($properties))
                              @foreach($properties as $property)

                                    <option value="{{$property->id}}" "{{$property->id == $allproperties ? ' selected="selected"' : ''}}">{{$property->name}}</option>
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
        <div class="col-md-8 col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
               <div id="main" style="width: 100%; min-height: 400px;"></div>
               <br>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <h4>
                Number of Reservations from per Country
              </h4>
              @if($countryCodes != null)
                <table class="scroll wide">
                  @foreach($countryCodes as $countryCode)
                  <tr>
                    <td>
                      {{ $countryCode->value }}
                      @php
                        $percentage = ($countryCode->value/$totalReservations) * 100;
                      @endphp
                       ( {{ round($percentage) }}% )
                    </td>
                  </tr>
                  <tr>
                    <td width="25%">
                      <img src='{{URL::to("/")}}/public/images/flags/flags-medium/{{strtolower($countryCode->code)}}.png' width="35px" height="20px">
                    </td>
                    <td>
                      {{ $countryCode->name }}
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  @endforeach
                </table>
                
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@stop

@section('validate_script')
    <!-- <link href="{{URL::to('/')}}/public/backend/plugins/Flags/flags.min.css" rel=stylesheet type="text/css"> -->
   <script src="{{URL::to('/')}}/public/backend/plugins/ECharts/echarts.min.js"></script>
   <script src="{{URL::to('/')}}/public/backend/plugins/ECharts/echarts-gl.min.js"></script>
   <script src="{{URL::to('/')}}/public/backend/plugins/ECharts/ecStat.min.js"></script>
   <script src="{{URL::to('/')}}/public/backend/plugins/ECharts/dataTool.min.js"></script>
   <script src="{{URL::to('/')}}/public/backend/plugins/ECharts/china.js"></script>
   <script src="{{URL::to('/')}}/public/backend/plugins/ECharts/world.js"></script>
   <script src="{{URL::to('/')}}/public/backend/plugins/ECharts/simplex.js"></script>
   
  <script type="text/javascript">
    // based on prepared DOM, initialize echarts instance
    var myChart = echarts.init(document.getElementById('main'));
    var app = {};
    option = null;

    // specify chart configuration item and data
    option = {
         title: {
              text: "{{ $totalReservations }} Reservations",
              subtext: "Reservation Numbers from \nAll Customers Rigions",
              //sublink: 'http://esa.un.org/wpp/Excel-Data/population.htm',
              left: 'center',
              top: 'top'
          },
          tooltip: {
              trigger: 'item',
              formatter: function (params) {
                  var value = (params.value + '').split('.');
                  /*
                  value = value[0].replace(/(\d{1,3})(?=(?:\d{3})+(?!\d))/g, '$1,')
                          + '.' + value[1];
                  */        
                  if (value[0] == "NaN") {
                    value[0] = 0;
                  } else {
                    value = value[0];
                  }       
                  return params.seriesName + '<br/>' + params.name + ' : ' + value;
              }
          },
          toolbox: {
              show: false,
              orient: 'vertical',
              left: 'right',
              top: 'center',
              feature: {
                  dataView: {
                    show: true,
                    lang: ['Data view', 'Turn Off', 'Refresh'],  
                    title: "View",
                    readOnly: false,
                  },
                  restore: {
                    title: "Restore"
                  },
                  saveAsImage: {
                    title: 'Save'
                  },

              }
          },
          visualMap: {
              min: 0,
              max: 1000000,
              text:['High','Low'],
              realtime: false,
              calculable: true,
              inRange: {
                  color: ['lightskyblue','yellow', 'orangered']
              }
          },
          series: [
              {
                  name: 'Total Reservations',
                  type: 'map',
                  mapType: 'world',
                  roam: true,
                  itemStyle:{
                      emphasis:{label:{show:true}}
                  },
                  data: jQuery.parseJSON('{!! $collections !!}')
              }
          ]
    };

    // use configuration item and data specified to show chart
    if (option && typeof option === "object") {
      myChart.setOption(option, true);
    }

    $(window).on('resize', function(){
        if(myChart != null && myChart != undefined){
            myChart.resize();
        }
    });

  // Select 2 for property search
  $('.select2').select2({
  ajax: {
      url: 'reports/property-search',
      processResults: function (data) {
        console.log(data)
        $('#property').val('DSD');
        return {
          results: data
        };
      }
    }
  });

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
     );

     $(document).ready(function(){
        var startDate = "{!! $from !!}";
        var endDate   = "{!! $to !!}";
        if(startDate=='' && endDate==''){
          $('#daterange-btn span').html('<i class="fa fa-calendar"></i> &nbsp;&nbsp; Pick a date range');
        } else {
          $('#daterange-btn span').html(startDate + ' - ' +endDate );
      }
    });

});
  </script>
@endsection