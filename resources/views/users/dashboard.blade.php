@extends('template')

@section('main')
    <div class="container margin-top30">
      <div class="col-md-3">
        <div class="panel panel-default">
          <a href="{{ url('users/show/'.Auth::guard('users')->user()->id) }}" title="{{ trans('messages.dashboard.view_profile') }}">
            <img src="{{@Auth::user()->profile_src}}" class="img-responsive" alt="" width="300" title ="{{Auth::guard('users')->user()->first_name}}">
          </a>
          
          <div class="add-photo"><a href="{{ url('users/profile/media') }}">{{trans('messages.users_dashboard.add_profile_photo')}}</a></div>
          <h2 class="text-center mb20">{{ Auth::guard('users')->user()->first_name }}</h2>
          <div class="text-center mb20">
            <p><a href="{{ url('users/show/'.Auth::guard('users')->user()->id) }}">{{trans('messages.users_dashboard.view_profile')}}</a></p>
            @if((Auth::user()->users_verification->email == 'no') || (Auth::user()->users_verification->facebook == 'no') || (Auth::user()->users_verification->google == 'no'))
            <a href="{{ url('users/edit-verification') }}" class="btn ex-btn">{{trans('messages.users_dashboard.complete_profile')}}</a>
            @else
            <i class="fa fa-check-circle fa-3x text-success" aria-hidden="true"></i>
            @endif
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="panel panel-default">
          <div class="panel-body h4">
           {{trans('messages.users_dashboard.welcome_to')}}  {{ $site_name }}, {{Auth::guard('users')->user()->first_name }}!
          </div>
        </div>   
        <div class="panel panel-default">
          <div class="panel-body h4">
           {{trans('messages.users_dashboard.message')}}  ({{@$all_message->count()}} {{trans('messages.users_dashboard.new')}})
          </div>
          <div class="panel-footer ">
            <ul class="list-layout">
              @foreach(@$all_message as $all)
              <li id="thread_{{ @$all->id }}" class="panel-body thread-read thread">
                <div class="row">
                  <div class="col-md-3">
                    <div class="col-5">          
                      <a href="#"><img height="50" width="50" title="{{ @$all->sender->first_name }}" src="{{ @$all->sender->profile_src }}" alt="{{ @$all->sender->first_name }}"></a>
                    </div>
                    <div class="col-7">
                      {{ @$all->sender->first_name.' '.@$all->bookings->status}}
                      <br>
                      {{ onlyFormat($all->created_time) }}
                    </div>
                  </div>
               {{--    @if(@$all->host_user ==1 && @$all->bookings->status == 'Pending')
                  <a href="{{ url('booking')}}/{{ @$all->booking_id }}">
                  @elseif(@$all->host_user ==1 && @$all->bookings->status != 'Pending')
                  <a class="link-reset text-muted" href="{{ url('messaging/host')}}/{{ $all->booking_id }}">
                  @elseif(@$all->guest_user !=0)
                  <a class="link-reset text-muted" href="{{ url('messaging/guest')}}/{{ $all->booking_id }}">
                  @endif --}}
                     <div class="col-md-7">
                       @if(@$all->bookings->status == 'Pending')
                       <a style="color: black" href="{{ url('booking')}}/{{ $all->booking_id }}"><b>{{ @$all->message }}</b></a><br>
                         <a class="text-muted" href="{{ url('booking')}}/{{ $all->booking_id }}">
                          <span class="street-address">{{ @$all->properties->property_address->address_line_1 }} {{ @$all->properties->property_address->address_line_2 }}</span>, <span class="locality">{{ @$all->properties->property_address->city }}</span>, <span class="region">{{ @$all->properties->property_address->state }}</span>
                        ({{  (date('M d', strtotime( @$all->bookings->start_date))) }}, {{  (date('M d, Y', strtotime( @$all->bookings->end_date))) }})
                      </a> 
                       @else
                       <a style="color: black" href="{{ url('messaging/booking')}}/{{ $all->booking_id }}"><b>{{ @$all->message }}</b></a></br>
                         <a class="text-muted" href="{{ url('messaging/booking')}}/{{ $all->booking_id }}">
                          <span class="street-address">{{ @$all->properties->property_address->address_line_1 }} {{ @$all->properties->property_address->address_line_2 }}</span>, <span class="locality">{{ @$all->properties->property_address->city }}</span>, <span class="region">{{ @$all->properties->property_address->state }}</span>
                        ({{  (date('M d', strtotime( @$all->bookings->start_date))) }}, {{  (date('M d, Y', strtotime( @$all->bookings->end_date))) }})
                      </a> 
                       @endif

                      <br>
                          
                    </div>
                  </a>
                  <div class="col-md-2">
                    <span class="label label-{{ @$all->bookings->label_color }}">{{ $all->bookings->status }}</span>
                    <br>{{ moneyFormat( @$all->bookings->currency->symbol, @$all->bookings->total) }}</span>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="panel-body">
            <a href="{{ url('inbox') }}">{{trans('messages.users_dashboard.all_messages')}}</a>
          </div>
        </div> 
      </div>
    </div>

@stop    