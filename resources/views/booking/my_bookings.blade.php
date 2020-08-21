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
    <div class="your-listings-flash-container"></div>
    <div class="panel" id="print_area">
      @if(@$bookings->count() == 0 && @$code != 1)
        <div class="panel-body">
          <p>
           {{trans('messages.booking_my.upcoming_booking')}} 
          </p>
          <a href="{{ url('/') }}/my-bookings?all=1">{{trans('messages.booking_my.booking_history')}}</a>
        </div>
      @elseif(@$bookings->count() == 0 && @$code == 1)
        <div class="panel-body">
          <p>
              {{trans('messages.booking_my.no_booking')}}
          </p>
            <a href="{{ url('/') }}/property/create" class="btn btn-special list-your-space-btn" id="list-your-space">{{trans('messages.booking_my.add_list')}}</a>
        </div>
      @else
      <div class="panel-header">
        <div class="row row-table">
          <div class="col-md-6 col-middle">
              {{ (@$code == 1) ? 'All' : 'Upcoming' }} {{trans('messages.booking_my.booking')}}
          </div>
          <div class="col-md-6 col-middle">
            &nbsp;
            <!--<a class="btn pull-right" href="{{ url('/') }}/my_reservations?all={{ $code }}&amp;print={{ $code }}">
              <i class="icon icon-description"></i>
              {{ trans('messages.your_reservations.print_this_page') }}
            </a>-->  
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table style="background-color:white" class="table panel-body space-1">
          <tbody>
            <tr>
              <th width="10%">{{trans('messages.booking_my.status')}}</th>
              <th width="42%">{{trans('messages.booking_my.date_location')}}</th>
              <th width="28%">{{trans('messages.booking_my.guest')}}</th>
              <th width="20%">{{trans('messages.booking_my.detail')}}</th>
            </tr>
            @foreach($bookings as $row)
            <tr data-reservation-id="{{ $row->id }}" class="booking">
              <td>
                <span class="label label-{{ $row->label_color }}">
                  {{ @$row->status }}
                </span>
              </td>
              <td>
                {{ @$row->date_range }}
                <br>
                <a locale="en" href="{{ url('/') }}/properties/{{ @$row->property_id }}">{{ @$row->properties->name }}</a>
                <br>
                    {{ @$row->properties->property_address->address_line_1 }}
                <br>
                    {{ @$row->properties->property_address->city.', '.@$row->properties->property_address->state.' '.@$row->properties->property_address->postal_code }}
                <br>
              </td>
              <td>
                <div class="va-container" style="margin-right: 50px;">
                  <a class="pull-left media-photo media-round r-pad-none" href="{{ url('/') }}/users/show/{{ @$row->users->id }}">
                    <img width="50" height="50" title="{{ @$row->users->first_name }}" src="{{ @$row->users->profile_src }}" alt="{{ @$row->users->first_name }}">
                  </a>      
                  <div class="va-top">
                    <a class="text-normal pad-l-5" href="{{ url('/') }}/users/show/{{ @$row->users->id }}">{{ @$row->users->first_name.' '.@$row->users->last_name }}</a>
                    <br>
                    @if(isset($row->status) && $row->status == 'Accepted')
                      <a href="{{ url('/') }}/messaging/host/{{ @$row->id }}" class="text-normal pad-l-5">
                        <i class="icon icon-envelope"></i>
                       {{trans('messages.booking_my.send_message')}} 
                      </a>
                      <br>
                      <a href="mailto:{{ @$row->users->email }}" class="pad-l-5">
                        {{trans('messages.booking_my.email_contact')}}
                      </a>
                    @endif
                    <br>
                  </div>
                </div>
              </td>
              <td>
                {{ $row->currency->symbol.$row->total }} {{trans('messages.booking_my.total')}}
                <ul class="list-unstyled">
                  @if($row->status == "Accepted")
                  <!-- See Bookings.php 
                    @php
                      // if(!$row->checkout_cross)
                    @endphp  
                  -->
                    @if($row->checkin_cross)
                      <li>
                        <a data-rel="{{@$row->id}}" href="#" id="reservation_cancel">{{trans('messages.booking_my.cancel')}}</a>
                      </li>
                    @endif
                  @endif
                </ul>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @if($code == '0' || $code == '')
        <div class="panel-body">
          <a href="{{ url('/') }}/my-bookings?all=1">{{trans('messages.booking_my.all_booking_history')}}</a>
        </div>
       @else
        <div class="panel-body">
          <a href="{{ url('/') }}/my-bookings?all=0">{{trans('messages.booking_my.upcoming_book')}}</a>
        </div>
       @endif
    @endif
    </div>
  </div>

  <div class="modal" id="cancel-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ trans('messages.modal.cancel_this_booking') }}</h4>
        </div>
        <form accept-charset="UTF-8" action="{{ url('booking/host_cancel') }}" id="cancel_reservation_form" method="post" name="cancel_reservation_form">
          <div class="modal-body">
              <div id="decline_reason_container">
                <p>
                  {{ trans('messages.modal.what_reason_cancelling') }}
                </p>
                <div class="select">
                  <select id="cancel_reason" name="cancel_reason" class="form-control" required>
                    <option value="">{{ trans('messages.modal.why_are_you_cancelling') }}</option>
                    <option value="i_am_uncomfortable_with_guest">{{ trans('messages.modal.i_am_uncomfortable') }}</option>
                    <option value="no_longer_available">{{ trans('messages.modal.place_no_longer_available') }}</option>
                    <option value="offer_a_different_listing">{{ trans('messages.modal.offer_a_different_listing') }}</option>
                    <option value="need_maintenance">{{ trans('messages.modal.need_maintenance') }}</option>
                    <option value="I_have_an_extenuating_circumstance">{{ trans('messages.modal.extenuating_cicumstance') }}</option>
                    <option value="my_guest_needs_to_cancel">{{ trans('messages.modal.guest_needs_cancel') }}</option>
                    <option value="other">{{ trans('messages.modal.other') }}</option></select>
                  </select>
                </div>

                <!--<div id="cancel_reason_other_div" class="hide row-space-top-2">
                  <label for="cancel_reason_other">
                    {{ trans('messages.your_reservations.why_cancel') }}
                  </label>
                  <textarea class="form-control" id="decline_reason_other" name="decline_reason_other" rows="4"></textarea>
                </div>-->
              </div>
              <label for="cancel_message" class="row-space-top-2">
                {{ trans('messages.modal.messsage_guest') }}...
              </label>
              <textarea class="form-control" cols="40" id="cancel_message" name="cancel_message" rows="10"></textarea>
              <input type="hidden" name="id" id="booking_id" value="">
          </div>
          <div class="modal-footer">
            <input type="hidden" name="decision" value="decline">
            <input class="btn ex-btn" id="cancel_submit" name="commit" type="submit" value="{{ trans('messages.trips_active.cancel_my_booking') }}">
            <button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('messages.trips_active.close') }}</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
@push('scripts')
<script type="text/javascript">
  $('#reservation_cancel').on('click', function(){
    var booking_id = $(this).attr('data-rel');
    $('#booking_id').val(booking_id);
    $('#cancel-modal').modal();
  })
</script>
@endpush
@stop