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
  <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-heading">
        {{ trans('messages.profile.current_verifications') }}
      </div>
      <div class="panel-body">
        <ul class="list-layout edit-verifications-list">
          <?php 
          //dd(Auth::user()->users_verification);
          ?>
          @if((Auth::user()->users_verification->email == 'no') && (Auth::user()->users_verification->facebook == 'no') && (Auth::user()->users_verification->google == 'no'))
          <div class="alert alert-success" role="alert">
            No Verification Available
          </div>
          @else
            @if(Auth::user()->users_verification->email == 'yes')
            <li class="edit-verifications-list-item">
              <h4>{{ trans('messages.users_dashboard.email_address') }}</h4>
              <p class="description">{{ trans('messages.profile.you_have_confirmed_email') }} <b>{{ Auth::user()->email }}</b>.  {{ trans('messages.profile.email_verified') }}
              </p>
            </li>
            @endif
            @if(Auth::user()->users_verification->facebook == 'yes')
            <li class="edit-verifications-list-item">
              <h4>Facebook</h4>
              <div class="row">
                <div class="col-md-9">
                  <p class="description">
                    {{ trans('messages.profile.facebook_verification') }}
                  </p>
                </div>
                <div class="col-md-3">
                  <div class="disconnect-button-container">
                    <a href="{{ url('facebookDisconnect') }}" class="btn btn-primary btn-block" data-method="post" rel="nofollow">{{ trans('messages.profile.disconnect') }}</a>
                  </div>
                </div>
              </div>
            </li>
            @endif
            @if(Auth::user()->users_verification->google == 'yes')
            <li class="edit-verifications-list-item">
              <h4>Google</h4>
              <div class="row">
                <div class="col-md-9">
                  <p class="description">
                    {{ trans('messages.profile.google_verification', ['site_name'=>$site_name]) }}
                  </p>
                </div>
                <div class="col-md-3">
                  <div class="disconnect-button-container">
                    <a href="{{ url('googleDisconnect') }}" class="btn btn-warning btn-block" data-method="post" rel="nofollow">{{ trans('messages.profile.disconnect') }}</a>
                  </div>
                </div>
              </div>
            </li>
            @endif
          @endif
          </ul>
        </div>
      </div>
      @if(!(Auth::user()->users_verification->email == 'yes' && Auth::user()->users_verification->facebook == 'yes' && Auth::user()->users_verification->google == 'yes'))
        <div class="panel panel-default">
          <div class="panel-heading">
            {{ trans('messages.profile.add_more_verifications') }}
          </div>
          <div class="panel-body">
            <ul class="list-layout">
              @if(Auth::user()->users_verification->email == 'no')
              <li class="email">
                <h4>
                {{ trans('messages.login.email') }}
                </h4>
                <div class="row">
                  <div class="col-md-9">
                    <p class="description">
                      {{ trans('messages.profile.email_verification') }} <b>{{ Auth::user()->email }}</b>.
                    </p>
                  </div>
                  <div class="col-md-3">
                    <div class="connect-button">
                      <a href="{{ url('users/new_email_confirm?redirect=verification') }}" class="btn btn-info btn-block">{{ trans('messages.profile.connect') }}</a>
                    </div>
                  </div>
                </div>
              </li>
              @endif
              @if(Auth::user()->users_verification->facebook == 'no')
              <li class="facebook">
                <h4>
                Facebook
                </h4>
                <div class="row">
                  <div class="col-md-9">
                    <p class="description">
                      {{ trans('messages.profile.facebook_verification') }}
                    </p>
                  </div>
                  <div class="col-md-3">
                    <div class="connect-button">
                      <a href="{{ url('facebookLoginVerification') }}" class="btn btn-primary btn-block">{{ trans('messages.profile.connect') }}</a>
                    </div>
                  </div>
                </div>
              </li>
              @endif
              @if(Auth::user()->users_verification->google == 'no')
              <li class="google">
                <h4>
                Google
                </h4>
                <div class="row">
                  <div class="col-md-9">
                    <p class="description">
                      {{ trans('messages.profile.google_verification', ['site_name'=>$site_name]) }}
                    </p>
                  </div>
                  <div class="col-md-3">
                    <div class="connect-button">
                      <a class="btn btn-warning btn-block" href="{{URL::to('googleLoginVerification')}}">
                        {{ trans('messages.profile.connect') }}
                      </a>
                    </div>
                  </div>
                </div>
              </li>
              @endif
            </ul>
          </div>
        </div>
      @endif
    </div>
  </div>
  @stop