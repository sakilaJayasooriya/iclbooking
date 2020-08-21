@extends('template')

@section('main')
<!-- Modal -->
<div class="modal fade" id="payout_popup1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">{{trans('messages.account_preference.add_payout')}}</h4>
      </div>
      <div class="flash-container" id="popup1_flash-container"></div>
      <form class="modal-add-payout-pref" method="post" id="payout_address">
        <div class="modal-body">
            <div class="panel-body">
              <div class="mb20">
                <label for="payout_info_payout_address1">{{trans('messages.account_preference.address')}}*</label>
                <input type="text" class='form-control' autocomplete="billing address-line1" id="payout_info_payout_address1" name="address1">
              </div>
              <div class="mb20">
                <label for="payout_info_payout_address2">{{trans('messages.account_preference.address_2')}}</label>
                <input type="text" class='form-control' autocomplete="billing address-line2" id="payout_info_payout_address2" name="address2">
              </div>
              <div class="mb20">
                <label for="payout_info_payout_city">{{trans('messages.account_preference.city')}}*</label>
                <input type="text" class='form-control' autocomplete="billing address-level2" id="payout_info_payout_city" name="city">
              </div>
              <div class="mb20">
                <label for="payout_info_payout_state">{{trans('messages.account_preference.state_province')}}</label>
                <input type="text" class='form-control' autocomplete="billing address-level1" id="payout_info_payout_state" name="state">
              </div>
              <div class="mb20">
                <label for="payout_info_payout_zip">{{trans('messages.account_preference.postal_code')}}*</label>
                <input type="text" class='form-control' autocomplete="billing postal-code" id="payout_info_payout_zip" name="postal_code">
              </div>
              <div class="mb20">
                <label for="payout_info_payout_country">{{trans('messages.account_preference.country')}}*</label>
                <div class="select">
                  <select name='country_dropdown' class='form-control' id='payout_info_payout_country'>
                    @foreach($country as $key => $value)
                      <option value="{{$key}}" {{ $key == @$default_country?'selected':''}}>{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <input type="submit" value="Next" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal End -->
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" style="overflow-y:auto;" id="payout_popup2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">{{trans('messages.account_preference.add_payout')}}</h4>
      </div>
      <div class="flash-container" id="popup2_flash-container"> </div>
      <form class="modal-add-payout-pref" method="post" id="payout_method">
        <input type="hidden"   id="payout_info_payout2_address1" value="" name="address1">
        <input type="hidden" id="payout_info_payout2_address2" value="" name="address2">
        <input type="hidden" id="payout_info_payout2_city" value="" name="city">
        <input type="hidden" id="payout_info_payout2_country" value="" name="country">
        <input type="hidden" id="payout_info_payout2_state" value="" name="state">
        <input type="hidden" id="payout_info_payout2_zip" value="" name="postal_code">
        <div class="modal-body table-responsive">
          <div>
            <p>{{trans('messages.account_preference.payment_data_1')}}.</p>
            <p>{{trans('messages.account_preference.send_money')}}</br> {{trans('messages.account_preference.send_money_2')}}</p>
          </div>
          <table id="payout_method_descriptions" class="table table-striped">
            <thead>
              <tr>
                <th></th>
                <th>{{trans('messages.account_preference.payout_method')}}</th>
                <th>{{trans('messages.account_preference.processing_time')}}</th>
                <th>{{trans('messages.account_preference.additional_fee')}}</th>
                <th>{{trans('messages.account_preference.currency')}}</th>
                <th>{{trans('messages.account_preference.datail')}}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input type="radio" value="1" name="payout_method" id="payout2_method">
                </td>
                <td class="type"><label for="payout_method">{{trans('messages.account_preference.paypal')}}</label></td>
                <td>{{trans('messages.account_preference.business_day')}}</td>
                <td>{{trans('messages.account_preference.none')}}</td>
                <td><!-- {{trans('messages.account_preference.eur')}} -->{{ $currency_code->code }}</td>
                <td>{{trans('messages.account_preference.business_day_data')}}</td>
              </tr>
              <!-- <tr>
                <td>
                  <button type="submit" class="btn ex-btn btn-large">
                    {{trans('messages.account_preference.save')}}
                  </button>
                </td>
              </tr> -->
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn ex-btn btn-large">
            {{trans('messages.account_preference.save')}}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal End -->
<!-- Modal -->
<div class="modal fade" id="payout_popup3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">{{trans('messages.account_preference.add_payout')}}</h4>
      </div>
      <div class="flash-container" id="popup3_flash-container"> </div>
      <form method="post" id="payout_paypal" action="{{ url('users/account-preferences') }}" accept-charset="UTF-8">
        <input type="hidden" id="payout_info_payout3_address1" value="" name="address1">
        <input type="hidden" id="payout_info_payout3_address2" value="" name="address2">
        <input type="hidden" id="payout_info_payout3_city" value="" name="city">
        <input type="hidden" id="payout_info_payout3_country" value="" name="country">
        <input type="hidden" id="payout_info_payout3_state" value="" name="state">
        <input type="hidden" id="payout_info_payout3_zip" value="" name="postal_code">
        <input type="hidden" id="payout3_method" value="" name="payout_method">
        <div class="modal-body">
         {{trans('messages.account_preference.paypal_email_id')}} 
          <input type="email" name="account" id="paypal_email" class='form-control' required>
        </div>
        <div class="modal-footer">
          <input type="submit" value="Submit" id="modal-paypal-submit" class="btn ex-btn">
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal End -->
<div class="container margin-top30">
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
      <div class="panel panel-default">
        <div class="panel-body h5">
          {{trans('messages.account_preference.account_method')}}
        </div>
        <div class="panel-footer">
          <div class="panel">
            <div class="panel-body">
              <div class="row">
                  <p>
                   {{trans('messages.account_preference.account_method_data')}} 
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped" id="payout_methods">
                      @if(count($payouts))
                      <thead>
                        <tr class="text-truncate">
                          <th>{{trans('messages.account_preference.method')}}</th>
                          <th>{{trans('messages.account_preference.detail')}}</th>
                          <th>{{trans('messages.account_preference.status')}}</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($payouts as $row)
                          <tr>
                            <td>
                             {{trans('messages.account_preference.paypal')}} 
                              @if($row->selected == 'Yes')
                              <span class="label label-info">{{trans('messages.account_preference.default')}}</span>
                              @endif
                            </td>
                            <td>
                              {{ $row->account }} ({{ $row->currency_code }})
                            </td>
                            <td>
                                {{trans('messages.account_preference.ready')}}
                            </td>
                            <td class="payout-options">
                            @if($row->default != 'yes')
                            <div class="dropdown">
                              <a class="dropdown-toggle" href="#" data-toggle="dropdown">{{trans('messages.account_preference.option')}}
                              <span class="caret"></span></a>
                              <ul class="dropdown-menu" style="background-color:white !important;">
                                <li><a href="{{ url('/') }}/users/account_delete/{{ $row->id }}">{{trans('messages.account_preference.remove')}}</a></li>
                                <li><a href="{{ url('/') }}/users/account_default/{{ $row->id }}">{{trans('messages.account_preference.set_default')}}</a></li>
                              </ul>
                            </div>
                            @endif        
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                      @endif
                        <tfoot>
                          <tr id="add_payout_method_section">
                            <td colspan="4" style="height: 80px">
                                <a id="add-payout-method-button" class="btn ex-btn" href="javascript:void(0);" data-toggle="modal" data-target="#payout_popup1">
                                 {{trans('messages.account_preference.add_payout')}}
                                </a>
                              <span class="text-muted">
                                &nbsp;
                               {{trans('messages.account_preference.deposit_paypal')}} 
                              </span>
                            </td>
                          </tr>
                        </tfoot>
                        <br>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('validation_script')

<script type="text/javascript">
    
  jQuery.validator.addMethod("laxEmail", function(value, element) {
      return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
      }, "{{ __('messages.jquery_validation.email') }}" );

  $(document).ready(function () {

      $('#payout_paypal').validate({
        rules: {
            account: {
              required: true,
              laxEmail: true,
            },

          },
        messages: {
             account: {
                required:  "{{ __('messages.jquery_validation.required') }}",
                maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
                email: "{{ __('messages.jquery_validation.email') }}",
              },
          }
      });

      $('#payout_address').validate({
          rules: {
              address1: {
                  required: true
              },
              city: {
                  required: true
              },
              postal_code: {
                  required: true
              }
          },
          messages: {
            address1: {
                required:  "{{ __('messages.jquery_validation.required') }}",
              },
            city: {
                required:  "{{ __('messages.jquery_validation.required') }}",
              },
            postal_code: {
                required:  "{{ __('messages.jquery_validation.required') }}",
              },
          }
      });

      $(document).on('submit','#payout_method', function (event){
        event.preventDefault();

      
        var method = $('input[name=payout_method]:checked').val();
        if(typeof method === "undefined" || method == ''){
          $('#popup2_flash-container').html('<div class="alert alert-error alert-error alert-header">'+"{{ __('messages.jquery_validation.choose_payout_method') }}"+'</div>');
        } else {
            var address_1 = $('#payout_info_payout2_address1').val();
            var address_2 = $('#payout_info_payout2_address2').val();
            var city      = $('#payout_info_payout2_city').val();
            var state     = $('#payout_info_payout2_state').val();
            var zip       = $('#payout_info_payout2_zip').val();
            var country   = $('#payout_info_payout2_country').val();

            $('#payout_info_payout3_address1').val(address_1);
            $('#payout_info_payout3_address2').val(address_2);
            $('#payout_info_payout3_city').val(city);
            $('#payout_info_payout3_state').val(state);
            $('#payout_info_payout3_zip').val(zip);
            $('#payout_info_payout3_country').val(country);
    
    
            $('#payout3_method').val(method);
            $("#payout_popup2").modal('toggle');
            $('#payout_popup3').modal('toggle');
        }
      });


  });
</script>

@endsection