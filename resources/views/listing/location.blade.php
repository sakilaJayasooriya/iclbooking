@extends('template')

@section('main')
  <div class="container margin-top40 mb30">
    @include('listing.sidebar')
    <form id="lis_location" method="post" action="{{url('listing/'.$result->id.'/'.$step)}}" class='signup-form login-form' accept-charset='UTF-8'>
      <div class="col-md-9">
        <input type="hidden" name='latitude' id='latitude'>
        <input type="hidden" name='longitude' id='longitude'>
        <div class="row">
          <div class="col-md-8 col-xs-12 mb20">
            <label class="label-large">{{trans('messages.listing_location.country')}} <span style="color: red !important;">*</span></label>
            <select id="basics-select-bed_type" name="country" class="form-control" id='country'>
                @foreach($country as $key => $value)
                  <option value="{{ $key }}" {{ ($key == @$result->property_address->country) ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('country') }}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 col-xs-12 mb20">
            <label class="label-large">{{trans('messages.listing_location.address_line_1')}} <span style="color: red !important;">*</span></label>
            <input type="text" name="address_line_1" id="address_line_1" value="{{ @$result->property_address->address_line_1  }}" class="form-control" placeholder="House name/number + street/road">
            <span class="text-danger">{{ $errors->first('address_line_1') }}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 col-xs-12 mb20">
            <div id="map_view" style="width:100%; height:400px;"></div>
          </div>
          <div class="col-md-8 col-xs-12 mb20">
            <p>You can move the pointer to set the correct map position</p>
            <span class="text-danger">{{ $errors->first('latitude') }}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 col-xs-12 mb20">
            <label class="label-large">{{trans('messages.listing_location.address_line_2')}}</label>
            <input type="text" name="address_line_2" id="address_line_2" value="{{ @$result->property_address->address_line_2  }}" class="form-control" placeholder="Apt., suite, building access code">
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 col-xs-12 mb20">
            <label class="label-large">{{trans('messages.listing_location.city_town_district')}} <span style="color: red !important;">*</span></label>
            <input type="text" name="city" id="city" value="{{ @$result->property_address->city  }}" class="form-control">
            <span class="text-danger">{{ $errors->first('city') }}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 col-xs-12 mb20">
            <label class="label-large">{{trans('messages.listing_location.state_province')}} <span style="color: red !important;">*</span></label>
            <input type="text" name="state" id="state" value="{{ @$result->property_address->state  }}" class="form-control">
            <span class="text-danger">{{ $errors->first('state') }}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 col-xs-12 mb20">
            <label class="label-large">{{trans('messages.listing_location.zip_postal_code')}}</label>
            <input type="text" name="postal_code" id="postal_code" value="{{ @$result->property_address->postal_code }}" class="form-control">
            <span class="text-danger">{{ $errors->first('postal_code') }}</span>
          </div>
        </div>

        <div class="row mrg-top-25">
          <div class="col-md-6  col-xs-6 text-left">
              <a data-prevent-default="" href="{{ url('listing/'.$result->id.'/description') }}" class="btn btn-large btn-primary">{{trans('messages.listing_description.back')}}</a>
          </div>
          <div class="col-md-6  col-xs-6 text-right">
            <button type="submit" class="btn btn-large btn-primary next-section-button">
             {{trans('messages.listing_basic.next')}} 
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
@push('scripts')
  <script type="text/javascript">
    function updateControls(addressComponents) {
        $('#street_number').val(addressComponents.streetNumber);
        $('#route').val(addressComponents.streetName);
        $('#city').val(addressComponents.city);
        $('#state').val(addressComponents.stateOrProvince);
        $('#postal_code').val(addressComponents.postalCode);
        $('#country').val(addressComponents.country);
    }

    $('#map_view').locationpicker({
        location: {
            latitude: {{$result->property_address->latitude != ''? $result->property_address->latitude:0 }},
            longitude: {{$result->property_address->longitude != ''? $result->property_address->longitude:0 }}
        },
        radius: 0,
        addressFormat: "",
        inputBinding: {
            latitudeInput: $('#latitude'),
            longitudeInput: $('#longitude'),
            locationNameInput: $('#address_line_1')
        },
        enableAutocomplete: true,
        onchanged: function (currentLocation, radius, isMarkerDropped) {
            var addressComponents = $(this).locationpicker('map').location.addressComponents;
            updateControls(addressComponents);
        },
        oninitialized: function (component) {
            var addressComponents = $(component).locationpicker('map').location.addressComponents;
            updateControls(addressComponents);
        }
    });
  </script>
@endpush
@stop

@section('validation_script')

<script type="text/javascript">
  $(document).ready(function () {

      $('#lis_location').validate({
          rules: {
              address_line_1: {
                  required: true,
                  maxlength: 255
              },
              address_line_2: {
                  maxlength: 255
              },
              city: {
                  required: true
              },
              state: {
                  required: true
              }
          },
          messages: {
              address_line_1: {
                  required:  "{{ __('messages.jquery_validation.required') }}",
                  maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
                },
              address_line_2: {
                  required:  "{{ __('messages.jquery_validation.required') }}",
                  maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
                },
              city: {
                  required: "{{ __('messages.jquery_validation.required') }}",
              },
              state: {
                  required: "{{ __('messages.jquery_validation.required') }}",
              }
          }

      });

  });
</script>

@endsection