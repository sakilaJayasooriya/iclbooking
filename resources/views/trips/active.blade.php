@extends('template')

@section('main')
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
  <div class="col-md-9 min-height-div">
    @if($pending_trips->count() == 0 && $current_trips->count() == 0 && $upcoming_trips->count() == 0)
    <div class="panel panel-default">
      <div class="panel-heading">{{trans('messages.trips_active.your_trip')}}</div>
      <div class="panel-body">
        <p>{{trans('messages.trips_active.no_current_trip')}}.</p>
        <!--<form method="get" class="row" action="{{ url('/') }}/s" accept-charset="UTF-8"><div style="margin:0;padding:0;display:inline"><input type="hidden" value="✓" name="utf8"></div>
          <div class="col-md-8">
            <input type="text" placeholder="{{ trans('messages.header.where_are_you_going') }}" name="location" id="location-search-google" autocomplete="off" class="form-control">
          </div>
          <div class="col-md-4">
            <button id="submit_location" class="btn btn-primary" type="submit">
              {{ trans('messages.home.search') }}
            </button>
          </div>
        </form>-->
      </div>
    </div>
    @endif
    @if($pending_trips->count() > 0)
    <div class="panel panel-default">
      <div class="panel-heading">{{trans('messages.trips_active.pending_trip')}}</div>
      <div class="panel-body table-responsive">
        <table class="table panel-body panel-light">
          <tbody>
            <tr>
              <th>{{trans('messages.trips_active.status')}}</th>
              <th>{{trans('messages.trips_active.location')}}</th>
              <th>{{trans('messages.trips_active.host')}}</th>
              <th>{{trans('messages.trips_active.date')}}</th>
              <th>{{trans('messages.trips_active.option')}}</th>
            </tr>
            @foreach($pending_trips as $pending_trip)
            <tr>
              <td>
                <span class="label label-orange label-{{ @$pending_trip->label_color }}">
                  {{ @$pending_trip->status }}
                </span>
                <br>
              </td>
              <td>
                <a href="{{ url('/') }}/properties/{{ @$pending_trip->property_id }}">{{ @$pending_trip->properties->name }}</a>
                <br>
                {{ @$pending_trip->properties->property_address->city }}
              </td>
              <td><a href="{{ url('/') }}/users/show/{{ @$pending_trip->host_id }}">{{ @$pending_trip->properties->users->full_name }}</a></td>
              <td>{{ @$pending_trip->date_range }}</td>
              <td>
                <ul class="unstyled list-unstyled">
                  <li class="row-space-1">
                    <!-- <a target="_blank" rel="nofollow" data-method="post" data-confirm="Are you sure that you want to cancel the request? Any money transacted will be refunded." class="button-steel" href="{{ url('/') }}/reservation/cancel?code={{ @$pending_trip->code }}">{{ trans('messages.your_trips.cancel_request') }}</a> -->
                    <a data-rel="{{@$pending_trip->id}}" href="#" class="booking_cancel">{{trans('messages.trips_active.cancel_request')}}</a>
                  </li>
                </ul>
              </td>         
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif
    @if($current_trips->count() > 0)
    <div class="panel panel-default">
      <div class="panel-heading">{{trans('messages.trips_active.current_trip')}}</div>
      <div class="panel-body table-responsive">
        <table class="table panel-body panel-light">
          <tbody>
            <tr>
              <th>{{trans('messages.trips_active.status')}}</th>
              <th>{{trans('messages.trips_active.location')}}</th>
              <th>{{trans('messages.trips_active.host')}}</th>
              <th>{{trans('messages.trips_active.date')}}</th>
              <th>{{trans('messages.trips_active.option')}}</th>
            </tr>
            @foreach($current_trips as $current_trip)
            <tr>
              <td>
                <span class="label label-orange label-{{ @$current_trip->label_color }}">
                  {{ @$current_trip->status }}
                </span>
                <br>
              </td>
              <td>
                <a href="{{ url('/') }}/properties/{{ @$current_trip->property_id }}">{{ @$current_trip->properties->name }}</a>
                <br>
                {{ @$current_trip->properties->property_address->city }}
              </td>
              <td><a href="{{ url('/') }}/users/show/{{ @$current_trip->host_id }}">{{ @$current_trip->properties->users->full_name }}</a></td>
              <td>{{ @$current_trip->date_range }}</td>
              <td>
                <ul class="unstyled list-unstyled">
                  @if(@$current_trip->status != "Cancelled" && @$current_trip->status != "Declined" && @$current_trip->status != "Expired")
                  <li class="row-space-1">
                    <a href="{{ url('/') }}/booking/receipt?code={{ @$current_trip->code }}">{{trans('messages.trips_active.view_receipt')}}</a>
                  </li>
                  <li class="row-space-1">
                    <a data-rel="{{@$current_trip->id}}" href="#" class="booking_cancel">{{trans('messages.booking_my.cancel')}}</a>
                  </li>
                  @endif
                </ul>
              </td>         
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif
    @if($upcoming_trips->count() > 0)
    <div class="panel panel-default">
      <div class="panel-heading">{{trans('messages.trips_active.upcoming_trip')}}</div>
      <div class="panel-body table-responsive">
        <table class="table panel-body panel-light">
          <tbody>
            <tr>
              <th>{{trans('messages.trips_active.status')}}</th>
              <th>{{trans('messages.trips_active.location')}}</th>
              <th>{{trans('messages.trips_active.host')}}</th>
              <th>{{trans('messages.trips_active.date')}}</th>
              <th>{{trans('messages.trips_active.option')}}</th>
            </tr>
            @foreach($upcoming_trips as $upcoming_trip)
            <tr>
              <td>
                <span class="label label-orange label-{{ @$upcoming_trip->label_color }}">
                  {{ @$upcoming_trip->status }}
                </span>
                <br>
              </td>
              <td>
                <a href="{{ url('/') }}/properties/{{ @$upcoming_trip->property_id }}">{{ @$upcoming_trip->properties->name }}</a>
                <br>
                {{ @$upcoming_trip->properties->property_address->city }}
              </td>
              <td><a href="{{ url('/') }}/users/show/{{ @$upcoming_trip->host_id }}">{{ @$upcoming_trip->properties->users->full_name }}</a></td>
              <td>{{ @$upcoming_trip->date_range }}</td>
              <td>
                <ul class="unstyled list-unstyled">
                  @if(@$upcoming_trip->status != "Cancelled")
                  <li class="row-space-1">
                    <a href="{{ url('/') }}/booking/receipt?code={{ @$upcoming_trip->code }}">{{trans('messages.trips_active.view_receipt')}}</a>
                  </li>
                  <li class="row-space-1">
                    <a data-rel="{{ @$upcoming_trip->id }}" href="#" class="booking_cancel">{{trans('messages.booking_my.cancel')}}</a>
                  </li>
                  @endif
                </ul>
              </td>         
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif
  </div>
  @if($upcoming_trips->count() > 0 || $current_trips->count() > 0 || $pending_trips->count() > 0)
  <!-- Modal -->
  <div class="modal" id="cancel-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{trans('messages.trips_active.cancel_booking')}}</h4>
        </div>
        <form id="cancel_trip" accept-charset="UTF-8" action="{{ url('trips/guest_cancel') }}" id="cancel_reservation_form" method="post" name="cancel_reservation_form">
          <div class="modal-body">
              <div id="decline_reason_container">
                <p>
                  {{trans('messages.trips_active.cancel_booking_data')}}
                </p>
                <p>
                  <strong>
                    {{trans('messages.trips_active.response_not_share')}}  <span style="color: red !important;">*</span>
                  </strong>
                </p>
                <div class="select">
                  <select id="cancel_reason" name="cancel_reason" class="form-control" required>
                    <option value="">{{trans('messages.trips_active.why_are_cancel')}}</option>
                    <option value="no_longer_need_accommodations">{{trans('messages.trips_active.need_accommodation')}}</option>
                    <option value="travel_dates_changed">{{trans('messages.trips_active.travel_date_change')}}</option>
                    <option value="made_the_reservation_by_accident">{{trans('messages.trips_active.made_it_accident')}}</option>
                    <option value="I_have_an_extenuating_circumstance">{{trans('messages.trips_active.extenuating_circumstance')}}</option>
                    <option value="my_host_needs_to_cancel">{{trans('messages.trips_active.host_need_cancel')}}</option>
                    <option value="uncomfortable_with_the_host">{{trans('messages.trips_active.uncomfortable_host')}}</option>
                    <option value="place_not_okay">{{trans('messages.trips_active.place_not_expect')}}</option>
                    <option value="other">{{trans('messages.trips_active.other')}}</option>
                  </select>
                </div>

                <div id="cancel_reason_other_div" class="hide row-space-top-2">
                  <label for="cancel_reason_other">
                    {{trans('messages.trips_active.why_are_cancel')}}
                  </label>
                  <textarea class="form-control" id="decline_reason_other" name="decline_reason_other" rows="4"></textarea>
                </div>
              </div>
              <label for="cancel_message" class="row-space-top-2">
                {{trans('messages.trips_active.type_message')}} <span style="color: red !important;">*</span>
              </label>
              <textarea class="form-control" cols="40" id="cancel_message" name="cancel_message" rows="10"></textarea>
              <input type="hidden" name="id" id="booking_id" value="">
          </div>
          <div class="modal-footer">
            <input type="hidden" name="decision" value="decline">
            <!--<button type="submit" type="button" class="btn ex-btn">Cancel My Reservation</button>-->
            <input class="btn ex-btn" id="cancel_submit" name="commit" type="submit" value="{{trans('messages.trips_active.cancel_my_booking')}}">
            <button type="button" class="btn btn-primary" data-dismiss="modal">{{trans('messages.trips_active.close')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endif
</div>
@push('scripts')
<script type="text/javascript">
  $('.booking_cancel').on('click', function(){
    var booking_id = $(this).attr('data-rel');
    $('#booking_id').val(booking_id);
    $('#cancel-modal').modal();
  });
</script>
@endpush
@stop

@section('validation_script')
<script type="text/javascript">
   $(document).ready(function () {

            $('#cancel_trip').validate({
                rules: {
                    cancel_reason: {
                        required: true
                    },
                    cancel_message: {
                        required: true
                    }
                },
                messages: {
                    cancel_reason: {
                      required:  "{{ __('messages.jquery_validation.required') }}",
                    },
                    cancel_message: {
                      required:  "{{ __('messages.jquery_validation.required') }}",
                    }
                }
            });

        });
</script>
@endsection

