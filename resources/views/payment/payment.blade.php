<?php //echo "<pre>";print_r($price_list);?>
@extends('template')

@section('main')
<div class="container margin-top30 mb30">
  <form action="{{ url('payments/create_booking') }}" method="post" id="checkout-form">
    <div class="col-md-8 col-sm-8 col-xs-12 mb10" style="background-color:#f3f3f3;">
      <input name="property_id" type="hidden" value="{{ $property_id }}">
      <input name="checkin" type="hidden" value="{{ $checkin }}">
      <input name="checkout" type="hidden" value="{{ $checkout }}">
      <input name="number_of_guests" type="hidden" value="{{ $number_of_guests }}">
      <input name="nights" type="hidden" value="{{ $nights }}">
      <input name="currency" type="hidden" value="{{ $result->property_price->code }}">

      <div class="h2 mb25">{{trans('messages.payment.payment')}}</div>
      <div class="form-group">
        <div class="col-sm-12">
          <label for="exampleInputEmail1">{{trans('messages.payment.country')}}</label>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-5">
          <select name="payment_country" id="country-select" data-saving="basics1" class="form-control mb20">
            @foreach($country as $key => $value)
              <option value="{{ $key }}" {{ ($key == @$default_country) ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <div class="col-sm-12">
          <label for="exampleInputEmail1">{{trans('messages.payment.payment_type')}}</label>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-5">
          <select name="payment_method" class="form-control mb20" id="payment-method-select">
          @if($paypal_status->value == 1)
            <option value="paypal" data-payment-type="payment-method" data-cc-type="visa" data-cc-name="" data-cc-expire="">
             {{trans('messages.payment.paypal')}} 
            </option>
          @endif
          @if($stripe_status->value == 1)  
            <option value="stripe" data-payment-type="payment-method" data-cc-type="visa" data-cc-name="" data-cc-expire="">
              {{trans('messages.payment.stripe')}}
            </option>
          @else
            <option value="">
              {{trans('messages.payment.disable')}}
            </option>
          @endif 
          </select>
        </div>
      </div>
      <div class="clearfix"></div>
      <hr/>
      <div class="clearfix"></div>
      <div class="form-group paypal-div mb20">
        <div class="row col-md-12">
          <div class="col-md-12" id='paypal-text'>
            {{trans('messages.payment.redirect_to_paypal')}}
          </div>
        </div>
      </div>
      <hr/>
      <div class="information">
       <div class="col-md-12">
         <div class="col-md-2 col-sm-3 col-xs-12">
          <div class="media-photo-badge text-center">
            <a href="{{ url('users/show/'.Auth::user()->id) }}"><img alt="User Profile Image" class="" src="{{ Auth::user()->profile_src }}" title="{{Auth::user()->first_name}}"></a>
          </div>
         </div>
         <div class="col-md-10 col-sm-9 col-xs-12">
          <textarea name="message_to_host" placeholder="Message your host..." class="form-control mb20" rows="5"></textarea>
         </div>
       </div>
       
       <div class="clearfix"></div>
       <div class="col-md-10 col-sm-9 col-xs-12">
        <button id="payment-form-submit" type="submit" class="btn ex-btn">
            {{($booking_type == 'instant') ? 'Book Now' : 'Continue'}}
        </button>
      </div>
       </div>
    </div>
  </form>
  <div class="col-md-4 col-sm-4 col-xs-12 mb10">
    <img src="{{@$result->cover_photo}}" alt="{{$result->name}}" style="width:100%; height:180px;">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="extra-sizefont"><strong>{{ $result->name }}</strong></div>
        <div class="h6">{{ $result->property_address->city }}, {{ $result->property_address->state }}, {{ $result->property_address->country_name }}</div>
        <hr/>
        <div class="h6"><strong>{{ $result->property_type_name }}</strong> {{trans('messages.payment.for')}} <strong>{{ $number_of_guests }} {{trans('messages.payment.guest')}}</strong> </div>
        <div class="h6"><strong>{{ date('D, M d, Y', strtotime($checkin)) }}</strong> to <strong>{{ date('D, M d, Y', strtotime($checkout)) }}</strong></div>
        <hr/>

        <div class="">
          <div class="side_tt">{{trans('messages.payment.night')}}</div>
          <div class="side_tt">{{ $nights }}</div>
        </div>
        <div class="clearfix"></div>
        <hr/>
        <div class="exfont">
          <div class="side_tt">{{moneyFormat($result->property_price->currency->symbol, $price_list->property_price )}} x {{ $nights }} {{trans('messages.payment.nights')}}</div>
          <div class="side_tt text-right">{{moneyFormat($result->property_price->currency->symbol, $price_list->total_night_price )}}</div>
        </div>
        @if($price_list->service_fee)
        <div class="exfont">
          <div class="side_tt">{{trans('messages.payment.service_fee')}}</div>
          <div class="side_tt text-right">{{moneyFormat($result->property_price->currency->symbol, $price_list->service_fee )}}</div>
        </div>

        @endif
        @if($price_list->additional_guest)
        <div class="exfont">
          <div class="side_tt">{{trans('messages.payment.additional_guest_fee')}}</div>
          <div class="side_tt text-right">{{ moneyFormat($result->property_price->currency->symbol, $price_list->additional_guest )}}</div>
        </div>
        @endif
        @if($price_list->security_fee)
        <div class="exfont">
          <div class="side_tt">{{trans('messages.payment.security_deposit')}}</div>
          <div class="side_tt text-right">{{ moneyFormat($result->property_price->currency->symbol,  $price_list->security_fee )}}</div>
        </div>
        @endif
        @if($price_list->cleaning_fee)
        <div class="exfont">
          <div class="side_tt">{{trans('messages.payment.cleaning_fee')}}</div>
          <div class="side_tt text-right">{{ moneyFormat($result->property_price->currency->symbol, $price_list->cleaning_fee )}}</div>
        </div>
        @endif
        <div class="clearfix"></div>
        <hr/>
        <div class="ex-pop mb20">
          <div class="side_tt"><strong>{{trans('messages.payment.total')}}</strong></div>
          <div class="side_tt text-right"><strong>{{ moneyFormat($result->property_price->currency->symbol, $price_list->total )}}</strong></div>
          <div class="clearfix"></div>
        </div>
        <p class="exfont">
          <small>
            {{trans('messages.payment.paying_in')}}
            <strong><span id="payment-currency">{{moneyFormat($currencyDefault->org_symbol,$currencyDefault->code)}}</span></strong>.
            {{trans('messages.payment.your_total_charge')}}
            <strong><span id="payment-total-charge">{{ moneyFormat($currencyDefault->org_symbol, $price_eur) }}</span></strong>.
            {{trans('messages.payment.exchange_rate_booking')}} {{$currencyDefault->org_symbol}} 1 to {{ moneyFormat($result->property_price->currency->org_symbol, $price_rate )}} {{ $result->property_price->currency_code }} (your host's listing currency).
          </small>
        </p>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script type="text/javascript">
$('#payment-method-select').on('change', function(){
  var payment = $(this).val();
  if(payment == 'stripe'){
    $('.cc-div').addClass('display-off');
    $('.paypal-div').addClass('display-off');
  }else {
    $('#paypal-text').html('You will be redirected to PayPal.');
    $('.cc-div').addClass('display-off');
    $('.paypal-div').removeClass('display-off');
  }
});

$('#country-select').on('change', function() {
  var country = $(this).find('option:selected').text();
  //country_ar = {{$country}};
  $('#country-name-set').html(country);
})
</script>
@endpush 
@stop