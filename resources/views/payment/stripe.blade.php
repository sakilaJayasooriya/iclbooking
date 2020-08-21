@extends('template')

@section('main')
<div class="container margin-top30 mb30">
  <div class="col-md-8 col-sm-8 col-xs-12 mb10" style="background-color:#f3f3f3;min-height:500px;">
    <div class="h2 mb25">Stripe Payment</div>
    <form action="{{URL::to('payments/stripe-request')}}" method="post" id="payment-form">
      <div class="form-row">
        <label for="card-element">
          {{trans('messages.payment_stripe.credit_debit_card')}}
        </label>
        <div id="card-element">
          <!-- a Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors -->
        <div id="card-errors" role="alert"></div>
      </div>

      <button class="btn ex-btn" style="margin-top:10px;">{{trans('messages.payment_stripe.submit_payment')}}</button>
    </form>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12 mb10">
      <img src="{{@$result->cover_photo}}" alt="{{$result->name}}" style="width:100%; height:180px;">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="extra-sizefont"><strong>{{ $result->name }}</strong></div>
          <div class="h6">{{ $result->property_address->city }}, {{ $result->property_address->state }}, {{ $result->property_address->country_name }}</div>
          <hr/>
          <div class="h6"><strong>{{ $result->room_type_name }}</strong>{{trans('messages.payment.for')}}  <strong>{{ $number_of_guests }} {{trans('messages.payment.guest')}}</strong> </div>
          <div class="h6"><strong>{{ date('D, M d, Y', strtotime($checkin)) }}</strong> to <strong>{{ date('D, M d, Y', strtotime($checkout)) }}</strong></div>
          <hr/>
          <div class="">
            <div class="side_tt">{{trans('messages.payment.cancel_policy')}}</div>
            <div class="side_tt"><a href="{{ url('home/cancellation_policies#').strtolower($result->cancel_policy) }}">{{ $result->cancellation }}</a></div>
          </div>
          <div class="">
            <div class="side_tt">{{trans('messages.payment.house_rule')}}</div>
            <div class="side_tt"><a href="#house-rules-agreement">{{trans('messages.payment.read_policy')}}</a></div>
          </div>
          <div class="">
            <div class="side_tt">{{trans('messages.payment.night')}}</div>
            <div class="side_tt">{{ $nights }}</div>
          </div>
          <div class="clearfix"></div>
          <hr/>
          <div class="exfont">
            <div class="side_tt">{{ moneyFormat($result->property_price->currency->symbol, $price_list->property_price )}} x {{ $nights }} {{trans('messages.payment.nights')}}</div>
            <div class="side_tt text-right">{{ moneyFormat($result->property_price->currency->symbol, $price_list->total_night_price )}}</div>
          </div>
          @if($price_list->service_fee)
          <div class="exfont">
            <div class="side_tt">{{trans('messages.payment.service_fee')}}</div>
            <div class="side_tt text-right">{{ moneyFormat($result->property_price->currency->symbol, $price_list->service_fee )}}</div>
          </div>
          @endif
          @if($price_list->additional_guest)
          <div class="exfont">
            <div class="side_tt">{{trans('messages.payment.additional_guest_fee')}}</div>
            <div class="side_tt text-right">{{ moneyFormat($result->property_price->currency->symbol,  $price_list->additional_guest )}}</div>
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
            <div class="side_tt text-right">{{ moneyFormat($result->property_price->currency->symbol,  $price_list->cleaning_fee )}}</div>
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
              <strong><span id="payment-currency">{{ moneyFormat($currencyDefault->org_symbol, $currencyDefault->code)}}</span></strong>.
              {{trans('messages.payment.your_total_charge')}}
              <strong><span id="payment-total-charge">{{ moneyFormat($currencyDefault->org_symbol, $price_eur )}}</span></strong>.
              {{trans('messages.payment.exchange_rate_booking')}} {{$currencyDefault->org_symbol}} 1 to {{ moneyFormat($result->property_price->currency->org_symbol, $price_rate )}} {{ $result->property_price->currency_code }} (your host's listing currency).
            </small>
          </p>
        </div>
      </div>
  </div>
</div>
@push('scripts')
<script>

  $(document).ready(function() {
   $(document).on('submit', 'form', function() {
     $('button').attr('disabled', 'disabled');
   });
 });
</script>
<script type="text/javascript">
      // Create a Stripe client
      var stripe = Stripe('{{$publishable}}');

      // Create an instance of Elements
      var elements = stripe.elements();

      // Custom styling can be passed to options when creating an Element.
      // (Note that this demo uses a wider set of styles than the guide below.)
      var style = {
        base: {
          color: '#32325d',
          lineHeight: '24px',
          fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
          fontSmoothing: 'antialiased',
          fontSize: '16px',
          '::placeholder': {
            color: '#aab7c4'
          }
        },
        invalid: {
          color: '#fa755a',
          iconColor: '#fa755a'
        }
      };

      // Create an instance of the card Element
      var card = elements.create('card', {style: style});

      // Add an instance of the card Element into the `card-element` <div>
      card.mount('#card-element');

      // Handle real-time validation errors from the card Element.
      card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
          displayError.textContent = event.error.message;
        } else {
          displayError.textContent = '';
        }
      });

      // Handle form submission
      var form = document.getElementById('payment-form');
      form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
          if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
          } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
          }
        });
      });

      function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
      }
    </script>
@endpush 
@stop