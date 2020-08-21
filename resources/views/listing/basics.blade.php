@extends('template')

@section('main')
  <div class="container margin-top40 mb30">
     @include('listing.sidebar')
      <form method="post" action="{{url('listing/'.$result->id.'/'.$step)}}" class='signup-form login-form' accept-charset='UTF-8'>
        <div class="col-md-9">
          <div class="row">
            <h4>{{trans('messages.listing_basic.room_bed')}}</h4>
            <div class="col-md-4 col-sm-12 mb20">
              <label class="label-large">{{trans('messages.listing_basic.bedroom')}}</label>
              <select name="bedrooms" id="basics-select-bedrooms" data-saving="basics1" class="form-control">
                  @for($i=1;$i<=10;$i++)
                    <option value="{{ $i }}" {{ ($i == $result->bedrooms) ? 'selected' : '' }}>
                    {{ $i}}
                    </option>
                  @endfor 
              </select>
            </div>
            <div class="col-md-4 col-sm-12 mb20">
              <label class="label-large">{{trans('messages.listing_basic.bed')}}</label>
              <select name="beds" id="basics-select-beds" data-saving="basics1" class="form-control">
                @for($i=1;$i<=16;$i++)
                  <option value="{{ $i }}" {{ ($i == $result->beds) ? 'selected' : '' }}>
                  {{ ($i == '16') ? $i.'+' : $i }}
                  </option>
                @endfor 
              </select>
            </div>
            <div class="col-md-4 col-sm-12 mb20">
              <label class="label-large">{{trans('messages.listing_basic.bathroom')}}</label>
              <select name="bathrooms" id="basics-select-bathrooms" data-saving="basics1" class="form-control">
                  @for($i=0.5;$i<=8;$i+=0.5)
                    <option class="bathrooms" value="{{ $i }}" {{ ($i == $result->bathrooms) ? 'selected' : '' }}>
                    {{ ($i == '8') ? $i.'+' : $i }}
                    </option>
                  @endfor
              </select>
            </div>
            <div class="col-md-4 col-sm-12 mb20">
              <label class="label-large">{{trans('messages.listing_basic.bed_type')}}</label>
              <select id="basics-select-bed_type" name="bed_type" data-saving="basics1" class="form-control">
                  @foreach($bed_type as $key => $value)
                    <option value="{{ $key }}" {{ ($key == $result->bed_type) ? 'selected' : '' }}>{{ $value }}</option>
                  @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <h4>{{trans('messages.listing_basic.listing')}}</h4>
            <div class="col-md-4 col-sm-12 mb20">
              <label class="label-large">{{trans('messages.listing_basic.property_type')}}</label>
              <select id="basics-select-bed_type" name="property_type" data-saving="basics1" class="form-control">
                  @foreach($property_type as $key => $value)
                    <option value="{{ $key }}" {{ ($key == $result->property_type) ? 'selected' : '' }}>{{ $value }}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-md-4 col-sm-12 mb20">
              <label class="label-large">{{trans('messages.listing_basic.room_type')}}</label>
              <select id="basics-select-bed_type" name="space_type" data-saving="basics1" class="form-control">
                  @foreach($space_type as $key => $value)
                    <option value="{{ $key }}" {{ ($key == $result->space_type) ? 'selected' : '' }}>{{ $value }}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-md-4 col-sm-12 mb20">
              <label class="label-large">{{trans('messages.listing_basic.accommodate')}}</label>
              <select name="accommodates" id="basics-select-accommodates" class="form-control">
                  @for($i=1;$i<=16;$i++)
                    <option class="accommodates" value="{{ $i }}" {{ ($i == $result->accommodates) ? 'selected' : '' }}>
                    {{ ($i == '16') ? $i.'+' : $i }}
                    </option>
                  @endfor
              </select>
            </div>
          </div>
          <div class="row mrg-top-25">
            <div class="col-md-6 text-left">
              
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