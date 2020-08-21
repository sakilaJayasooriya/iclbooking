<?php //echo "<pre>";print_r($booking);//exit;?>
@extends('template')

@section('main')
<div class="container">
  <div class="panel-body">
     <h6>{{ $booking->receipt_date }}</h6>
     <h6>Receipt # {{ $booking->id }}</h6>
  </div>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="col-md-12 l-pad-none margin-bottom30">
        <div class="col-md-11 l-pad-none">
          <div class="rptTitle" style="font-size: 26px !important">{{trans('messages.trips_receipt.customer_receipt')}}</div>
          <h6 class="margin-top20">{{trans('messages.trips_receipt.confirmation_code')}}</h6>
          <h5><strong>{{ $booking->code }}</strong></h5>
        </div>
        <div class="col-md-1 print-div">
          <a href="#" onclick="print_receipt()" class="btn ex-btn navbar-btn topbar-btn">{{trans('messages.trips_receipt.receipt')}}</a>
        </div>
      </div>

      <div class="margin-top30 row rpt">
        <div class="col-md-3 col-sm-3 col-xs-12">
          <h4><strong>{{trans('messages.trips_receipt.name')}}</strong></h4>
          <h5 class="margin-top20">{{ $booking->users->full_name }}</h5>
          <h4 class="margin-top20"><strong>{{trans('messages.trips_receipt.accommodatoin_address')}}</strong></h4>
          <h5 class="margin-top20"><p class="text-lead">
              <strong>{{ @$booking->properties->name }}</strong>
            </p>
              <p class="text-lead">{{ @$booking->properties->property_address->address_line_1 }}<br>{{ @$booking->properties->property_address->city }}, {{ @$booking->properties->property_address->state }} {{ @$booking->properties->property_address->postal_code }}<br>{{ @$booking->properties->property_address->country_name }}<br></h5>

        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <h4><strong>{{trans('messages.trips_receipt.travel_destination')}}</strong></h4>
          <h5 class="margin-top20">{{ @$booking->properties->property_address->city }}</h5>
          <h4 class="margin-top20"><strong>{{trans('messages.trips_receipt.accommodation_host')}}</strong></h4>
          <h5 class="margin-top20">{{ @$booking->properties->users->full_name }}</h5>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <h4><strong>{{trans('messages.trips_receipt.duration')}}</strong></h4>
          <h5 class="margin-top20">{{ $booking->total_night }} {{trans('messages.trips_receipt.night')}}</h5>
          <h4 class="margin-top20"><strong>{{trans('messages.trips_receipt.check_in')}}</strong></h4>
          <h5 class="margin-top20">{{ $booking->startdate_dmy }}<br>{{trans('messages.trips_receipt.flexible_check_time')}}</h5>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <h4><strong>{{trans('messages.trips_receipt.accommodation_type')}}</strong></h4>
          <h5 class="margin-top20">{{ @$booking->properties->property_type_name }}</h5>
          <h4 class="margin-top20"><strong>{{trans('messages.trips_receipt.check_out')}}</strong></h4>
          <h5 class="margin-top20">{{ $booking->enddate_dmy }}<br>{{trans('messages.trips_receipt.flexible_check_out')}}</h5>
        </div>
      </div>
      <div class="rptTitle margin-top30">{{trans('messages.trips_receipt.booking_charge')}}</div>
      <div class="clearfix"></div>
      <div class="table-responsive margin-top20">
        <table class="table table-bordered rpt">
          <tr>
            <td class=""><strong>{{ $booking->currency->symbol.$booking->per_night }} x {{ $booking->total_night }} {{trans('messages.trips_receipt.night')}}</strong></td>
            <td class="">{{ $booking->currency->symbol.$booking->per_night * $booking->total_night }}</td>
          </tr>
          @if($booking->guest_charge)
          <tr>
            <td class=""><strong>{{trans('messages.trips_receipt.additional_guest_fee')}}</strong></td>
            <td class="">{{ $booking->currency->symbol.$booking->guest_charge }}</td>
          </tr>
          @endif
          @if($booking->cleaning_charge)
          <tr>
            <td class=""><strong>{{trans('messages.trips_receipt.cleaning_fee')}}</strong></td>
            <td class="">{{ $booking->currency->symbol.$booking->cleaning_charge }}</td>
          </tr>
          @endif
          @if($booking->security_money)
          <tr>
            <td class=""><strong>{{trans('messages.trips_receipt.security_fee')}}</strong></td>
            <td class="">{{ $booking->currency->symbol.$booking->security_money }}</td>
          </tr>
          @endif
          <tr>
            <td class=""><strong>{{ $site_name }} {{trans('messages.trips_receipt.service_fee')}}</strong></td>
            <td class="">{{ $booking->currency->symbol.$booking->service_charge }}</td>
          </tr>
          <tr>
            <td class=""><strong>{{trans('messages.trips_receipt.total')}}</strong></td>
            <td class="">{{ $booking->currency->symbol.$booking->total }}</td>
          </tr>
        </table>
      </div>
      <div class="table-responsive margin-top10 rpt">
        <table class="table table-bordered">
        <tr>
          <td class=""><strong>{{trans('messages.trips_receipt.payment_received')}}:{{ $booking->receipt_date }}</strong></td>
          <td class="">{{ $booking->currency->symbol.$booking->total }}</td>
        </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="panel-body">
   <!--<p>{{trans('messages.trips_receipt.receipt_data')}}</p>-->
  </div>
</div>

<script>
function print_receipt()
{
  window.print();
}
</script>
@stop