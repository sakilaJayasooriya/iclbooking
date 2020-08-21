@extends('template')

@section('main')
  <div class="container margin-top40 mb30">
      @include('listing.sidebar')
      <form method="post" id="list_des" action="{{url('listing/'.$result->id.'/'.$step)}}" class='signup-form login-form' accept-charset='UTF-8'>
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-8  col-sm-12 mb20">
              <label class="label-large">{{trans('messages.listing_description.listing_name')}} <span style="color: red !important;">*</span></label>
              <input type="text" name="name" class="form-control" value="{{ $description->properties->name }}" placeholder="" maxlength="100">
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8 col-sm-12 mb20">
              <label class="label-large">{{trans('messages.listing_description.summary')}} <span style="color: red !important;">*</span></label>
              <textarea class="form-control" name="summary" rows="6" placeholder="" maxlength="500" ng-model="summary">{{ $description->summary }}</textarea>
              <span class="text-danger">{{ $errors->first('summary') }}</span>
            </div>
          </div>
          <p class="row-space-top-6 not-post-listed">
            {{trans('messages.listing_description.add_more')}} <a href="{{ url('listing/'.$result->id.'/details') }}" id="js-write-more">{{trans('messages.listing_description.detail')}}</a> {{trans('messages.listing_description.detail_data')}}.
          </p>
          <div class="row mrg-top-25">
            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                <a data-prevent-default="" href="{{ url('listing/'.$result->id.'/basics') }}" class="btn btn-large btn-primary">{{trans('messages.listing_description.back')}}</a>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
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

      $('#list_des').validate({
          rules: {
              name: {
                  required: true
              },
              summary: {
                  required: true,
                  maxlength: 500
              }
          },
          messages: {
              name: {
                  required: "{{ __('messages.jquery_validation.required') }}",
              },
              summary: {
                  required:  "{{ __('messages.jquery_validation.required') }}",
                  maxlength: "{{ __('messages.jquery_validation.maxlength500') }}",
              } 
          }
      });

  });
</script>

@endsection