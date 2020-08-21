@extends('template')

@section('main')
  <div class="container margin-top40 mb30">
    @include('listing.sidebar')
    <form method="post" action="{{url('listing/'.$result->id.'/'.$step)}}" class='signup-form login-form' accept-charset='UTF-8'>
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-8">
            <h4>{{trans('messages.listing_description.trip')}}</h4>
            <label class="label-large">{{trans('messages.listing_description.about_place')}}</label>
            <textarea class="form-control" name="about_place" rows="4" placeholder="">{{ @$result->property_description->about_place }}</textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <label class="label-large">{{trans('messages.listing_description.great_place')}}</label>
            <textarea class="form-control" name="place_is_great_for" rows="4" placeholder="">{{ @$result->property_description->place_is_great_for }}</textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <label class="label-large">{{trans('messages.listing_description.guest_access')}}</label>
            <textarea class="form-control" name="guest_can_access" rows="4" placeholder="">{{ @$result->property_description->guest_can_access }}</textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <label class="label-large">{{trans('messages.listing_description.guest_interaction')}}</label>
            <textarea class="form-control" name="interaction_guests" rows="4" placeholder="">{{ @$result->property_description->interaction_guests }}</textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <label class="label-large">{{trans('messages.listing_description.thing_note')}}</label>
            <textarea class="form-control" name="other" rows="4" placeholder="">{{ @$result->property_description->other }}</textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8">
            <h4>{{trans('messages.listing_description.neighborhood')}}</h4>
            <label class="label-large">{{trans('messages.listing_description.overview')}}</label>
            <textarea class="form-control" name="about_neighborhood" rows="4" placeholder="">{{ @$result->property_description->about_neighborhood }}</textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <label class="label-large">{{trans('messages.listing_description.getting_around')}}</label>
            <textarea class="form-control" name="get_around" rows="4" placeholder="">{{ @$result->property_description->get_around }}</textarea>
          </div>
        </div>
        
        <div class="row mrg-top-25">
          <div class="col-md-6 text-left">
              <a data-prevent-default="" href="{{ url('listing/'.$result->id.'/description') }}" class="btn btn-large btn-primary">{{trans('messages.listing_description.back')}}</a>
          </div>
          <div class="col-md-6 text-right">
            <button type="submit" class="btn btn-large btn-primary next-section-button">
             {{trans('messages.listing_basic.next')}} 
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
@stop