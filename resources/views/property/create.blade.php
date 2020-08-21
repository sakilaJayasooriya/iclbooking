@extends('template')

@section('main')
<div class="container margin-top30">
      
      <div class="middle-div">
        <h3 class="text-center">{{trans('messages.property.list_space')}}</h3>
        <p class="text-center">{{ $site_name }} {{trans('messages.property.property_title')}}.</p>
          <form id="list_space" method="post" action="{{url('property/create')}}" id="lys_form" accept-charset='UTF-8'>  
            <input type="hidden" name='street_number' id='street_number'>
            <input type="hidden" name='route' id='route'>
            <input type="hidden" name='postal_code' id='postal_code'>
            <input type="hidden" name='city' id='city'>
            <input type="hidden" name='state' id='state'>
            <input type="hidden" name='country' id='country'>
            <input type="hidden" name='latitude' id='latitude'>
            <input type="hidden" name='longitude' id='longitude'>
            <div class="form-group">
              <label for="exampleInputEmail1">{{trans('messages.property.home_type')}}</label>
              <select name="property_type_id" class="form-control">
                @foreach($property_type as $key => $value)
                  <option data-icon-class="icon-star-alt"  value="{{ $key }}">
                    {{ $value }}
                  </option>
                @endforeach
              </select>
              @if ($errors->has('property_type_id')) <p class="error-tag">{{ $errors->first('property_type_id') }}</p> @endif
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">{{trans('messages.property.room_type')}}</label>
              <select name="space_type" class="form-control">
                @foreach($space_type as $key => $value)
                  <option data-icon-class="icon-star-alt" value="{{ $key }}">
                    {{ $value }}
                  </option>
                @endforeach
              </select>
              @if ($errors->has('space_type')) <p class="error-tag">{{ $errors->first('space_type') }}</p> @endif
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">{{trans('messages.property.accommodate')}}</label>
              <select name="accommodates" class="form-control">
                @for($i=1;$i<=16;$i++)
                  <option class="accommodates" data-accommodates="{{ $i }}" value="{{ $i }}">
                    {{ $i }}
                  </option>
                @endfor
              </select>
              @if ($errors->has('accommodates')) <p class="error-tag">{{ $errors->first('accommodates') }}</p> @endif
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">{{trans('messages.property.city')}} <span style="color: red !important;">*</span></label>
              <input type="text" class="form-control" id="map_address" name="map_address" placeholder="">
              @if ($errors->has('map_address')) <p class="error-tag">{{ $errors->first('map_address') }}</p> @endif
              <div id="us3"></div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn ex-btn">{{trans('messages.property.continue')}}</button>
            </div>    
          </form>
      </div>  
      
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
     
        if (typeof(addressComponents.city)!== 'undefined') {
          $('#city').val(addressComponents.city);
        } else {
          $('#city').val(addressComponents.stateOrProvince); 
        }
        $('#state').val(addressComponents.stateOrProvince);
        $('#postal_code').val(addressComponents.postalCode);
        $('#country').val(addressComponents.country);
        if ( typeof(addressComponents.city) !== 'undefined' && addressComponents.country !== 'undefined' && typeof(addressComponents.city) !== null && addressComponents.country !== null && typeof(addressComponents.city) !== '' && addressComponents.country !== '') {
          $('#map_address').val(addressComponents.city + ',' + addressComponents.country_fullname);
        } else {
         if (addressComponents.stateOrProvince != '' && addressComponents.country_fullname != '') {
          $('#map_address').val(addressComponents.stateOrProvince + ',' + addressComponents.country_fullname);
        }
      }

    }
  

    $('#us3').locationpicker({
        location: {
            latitude: 0,
            longitude: 0
        },
        radius: 0,
        addressFormat: "",
        inputBinding: {
            latitudeInput: $('#latitude'),
            longitudeInput: $('#longitude'),
            locationNameInput: $('#map_address')
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

            $('#list_space').validate({
                rules: {
                    property_type_id: {
                        required: true
                    },
                    space_type: {
                        required: true
                    },
                    accommodates: {
                        required: true
                    },
                    map_address: {
                        required: true
                    }
                },
                messages: {
                  property_type_id: {
                      required:  "{{ __('messages.jquery_validation.required') }}",
                    },
                  space_type: {
                      required: "{{ __('messages.jquery_validation.required') }}",
                  },
                  accommodates: {
                      required:  "{{ __('messages.jquery_validation.required') }}",
                    },
                  map_address: {
                      required:  "{{ __('messages.jquery_validation.required') }}",
                    },
                }

            });

        });
</script>
@endsection