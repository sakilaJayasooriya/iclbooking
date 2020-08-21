@extends('template')

@section('main')
  <div class="container margin-top40 mb30">
      @include('listing.sidebar')
      <form id="amenities_id" method="post" action="{{url('listing/'.$result->id.'/'.$step)}}" class='signup-form login-form' accept-charset='UTF-8'>
      <div class="col-md-9">
        @foreach($amenities_type as $row_type)
        <div class="row">
            <h4>{{ $row_type->name }}
                @if($row_type->name == 'Common Amenities')
                  <span style="color: red !important;">*</span>
                  <span id="at_least_one"><br></span>
                @endif
            </h4>
            @if($row_type->description != '')
                <p class="text-muted">{{ $row_type->description }}</p>
            @endif
            <div class="col-md-6">
                <ul class="list-unstyled">
                    @foreach($amenities as $amenity)
                      @if($amenity->type_id == $row_type->id)
                      <li>
                        <span>&nbsp;&nbsp;</span>
                        <label class="label-large label-inline amenity-label">
                        <input type="checkbox" value="{{ $amenity->id }}" name="amenities[]" data-saving="{{ $row_type->id }}" {{ in_array($amenity->id, $property_amenities) ? 'checked' : '' }}>
                        <span>{{ $amenity->title }}</span>
                        </label>
                        <span>&nbsp;</span>

                        @if($amenity->description != '')
                        <span data-toggle="tooltip" class="icon" title="{{ $amenity->description }}"></span>
                        @endif
                      </li>
                      @endif
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
        <div class="row mrg-top-25">
          <div class="col-md-6  col-xs-6 text-left">
              <a data-prevent-default="" href="{{ url('listing/'.$result->id.'/location') }}" class="btn btn-large btn-primary">{{trans('messages.listing_description.back')}}</a>
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
@stop

@section('validation_script')

<script type="text/javascript">
  $(document).ready(function () {

      $('#amenities_id').validate({
          rules: {
              'amenities[]': {
                  required: true,
              }
          },
          messages: {
              'amenities[]': {
                  required: "{{ __('messages.jquery_validation.required') }}",
              }
          },
          
          groups: {
            amenities: "amenities[]"
          },
          errorPlacement: function(error, element) {
            if (element.attr("name") == "amenities[]") {
              error.insertAfter("#at_least_one");
            } else {
              error.insertAfter(element);
            }
          },


      });

  });
</script>

@endsection