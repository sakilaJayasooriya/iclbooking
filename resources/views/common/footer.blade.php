<div id="sidr" class="sidenav" style="display: none;">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <p>&nbsp;</p>
  @if(\Auth::check())
      <form action="{{ url('search') }}" id="head-form" class="navbar-form navbar-left search-form">
          <div class="form-group sm-dropdown">
            <input type="text" name="location" id="sidenav-search-form" class="form-control" placeholder="{{ trans('messages.header.where_are_you_going') }}" style="width:200px;margin-bottom:1px;">
            <div id="sidenav-search-drop-down" class="sm-dropdown-content">
                <div class="col-md-12" style="padding:0px 5px;">
                    <div class="col-md-4" style="padding:0px 5px;">
                        <label class="nav-label">{{ trans('messages.header.check_in') }}</label>
                        <input type="text" name="checkin" id="sidenav-search-checkin" class="nav-form-control" autocomplete="off" readonly="readonly">
                    </div>
                    <div class="col-md-4" style="padding:0px 5px;">
                        <label class="nav-label">{{ trans('messages.header.check_out') }}</label>
                        <input type="text" name="checkout" id="sidenav-search-checkout" class="nav-form-control" autocomplete="off" readonly="readonly">
                    </div>
                    <div class="col-md-4" style="padding:0px 5px;">
                        <label class="nav-label">{{ trans_choice('messages.header.guest', 2) }}</label>
                        <select class="nav-form-control" id="sidenav-search-guests" name="guests">
                            @for($i=1;$i<=16;$i++)
                              <option value="{{ $i }}"> {{ ($i == '16') ? $i.'+ ' : $i }} </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-12">
                      <button class="btn ex-btn navbar-btn topbar-btn" style="width:100%;" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        {{ trans('messages.header.find_place') }}
                      </button>
                    </div>
                </div>
            </div>
          </div>
      </form>
      <a href="{{ url('dashboard') }}">{{ trans('messages.header.dashboard') }}</a>
      <a href="{{ url('properties') }}">{{ trans_choice('messages.header.your_listing',2) }}</a>
      <a href="{{ url('my_bookings') }}">{{ trans('messages.sidenav.property_booking') }}</a>
      <a href="{{ url('trips/active') }}">{{ trans('messages.sidenav.your_trip') }}</a>
      <a href="{{ url('users/profile') }}">{{ trans('messages.header.edit_profile') }}</a>
      <a href="{{ url('users/account_preferences') }}">{{ trans('messages.header.account') }}</a>
      <a href="{{ url('logout') }}">{{ trans('messages.header.logout') }}</a>
      <a href="{{ url('property/create') }}">{{ trans('messages.header.list_space')}}</a>
  @else
    <a href="{{ url('signup') }}">{{ trans('messages.sign_up.sign_up') }}</a>
    <a href="{{ url('login') }}">{{ trans('messages.header.login') }}</a>
    <a href="{{ url('property/create') }}">{{ trans('messages.header.list_space') }}</a>
  @endif
</div>
<footer class="mg-footer">
  <div class="mg-footer-widget">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6">
          <div class="widget">
          <h2 class="mg-widget-title">{{ trans('messages.static_pages.about') }}</h2>
            <ul class="list-layout">
              @if(isset($footer_first) && isset($footer_firstzzzzzz) )
                @foreach(@$footer_first as $ff)
                  <li><a href="{{ url($ff->url) }}" class="link-contrast">{{ $ff->name }}</a></li>
                @endforeach
              @endif
              <li><a href="{{ url('/how-iclbooking-works') }}" class="link-contrast">{{ trans('messages.static_pages.how_iclbooking_works') }}</a></li>
              <li><a href="{{ url('/terms-conditions') }}" class="link-contrast">{{ trans('messages.static_pages.terms_conditions') }}</a></li>    
            </ul>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="widget">
            <h2 class="mg-widget-title">{{ trans('messages.static_pages.community') }}</h2>
            <ul class="list-layout">
              @if(isset($footer_second) && isset($footer_firstzzzzzz))
                @foreach(@$footer_second as $fs)
                  <li><a href="{{ url($fs->url) }}" class="link-contrast">{{ $fs->name }}</a></li>
                @endforeach
              @endif
              <li><a href="{{ url('/iclbooking-network') }}" class="link-contrast">{{ trans('messages.static_pages.iclbooking_network') }}</a></li>
              <li><a href="{{ url('/invite-friends') }}" class="link-contrast">{{ trans('messages.static_pages.invite_friends') }}</a></li>
              <li><a href="{{ url('/careers') }}" class="link-contrast">{{ trans('messages.static_pages.careers') }}</a></li>
                
            </ul>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="widget">
            <h2 class="mg-widget-title">{{ trans('messages.static_pages.host') }}</h2>
            <ul class="list-layout">
              <li><a href="{{ url('/host-your-home') }}" class="link-contrast">{{ trans('messages.static_pages.host_your_home') }}</a></li>
              <li><a href="{{ url('/host-an-online-experience') }}" class="link-contrast">{{ trans('messages.static_pages.host_an_online_experience') }}</a></li>
              <li><a href="{{ url('/responsible-hosting') }}" class="link-contrast">{{ trans('messages.static_pages.responsible_hosting') }}</a></li>
               
            </ul>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="widget">
            <h2 class="mg-widget-title">{{ trans('messages.static_pages.support') }}</h2>
            <ul class="list-layout">
              <li><a href="{{ url('/updates-for-covid-19') }}" class="link-contrast">{{ trans('messages.static_pages.updates_for_covid_19') }}</a></li>
              <li><a href="{{ url('/help') }}" class="link-contrast">{{ trans('messages.static_pages.help_center') }}</a></li>
              <li><a href="{{ url('/cancellation-options') }}" class="link-contrast">{{ trans('messages.static_pages.cancellation_options') }}</a></li>
              <li><a href="{{ url('/neighborhood-support') }}" class="link-contrast">{{ trans('messages.static_pages.neighborhood_support') }}</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mg-copyright">
    <div class="container">
      <div class="row">
        
        <div class="col-md-7 pt-15">
          <ul class="mg-footer-nav"> 
            <li>Copyright © 2020 {{ config('app.name') }}. All rights reserved.</li>
          </ul>
        </div>
        <div class="col-sm-12 col-md-1 mb0 p-0">
          @if(isset($language))
                <select class="form-control footer-select" aria-labelledby="language-selector-label" id="language_footer" name="language">
                  @foreach($language as $key => $value)
                    <option value="{{$key}}" {{ (Session::get('language') == $key) ? 'selected' : '' }} > {{$value}}</option>
                  @endforeach
                </select>
              @endif
        </div>
        <div class="col-sm-12 col-md-1 mb0 p-0">
          @if(isset($language))
                  <select class="form-control footer-select" aria-labelledby="language-selector-label" id="currency_footer" name="language">
                    @foreach($currency as $key => $value)
                      <option value="{{$key}}" {{ (Session::get('currency') == $key) ? 'selected' : '' }} > {{$value}}</option>
                    @endforeach
                  </select>
                @endif
        </div>
        <div class="col-md-3">
          <ul class="list-layout list-inline pull-right">
              <link href="" itemprop="url">
              <meta content="" itemprop="logo">
              @if(isset($join_us))
                @for($i=0; $i<count($join_us); $i++)
                  <li>
                    <a href="{{ $join_us[$i]->value }}" class="link-contrast footer-icon-container" target="_blank">
                      <i class="fa pad-top-4 fa-{{ str_replace('_','-',$join_us[$i]->name) }}"></i> 
                    </a>        
                  </li>
                @endfor
              @endif    
          </ul>
        </div>
      </div>
      
    </div>
  </div>
</footer>
<div id="alert_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button id="ok_id" type="button" class="btn btn-danger">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>