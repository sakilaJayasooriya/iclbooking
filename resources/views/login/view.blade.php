@extends('template')

@section('main')
  <div class="container margin-top30">
    <div class="col-md-4 col-center">
      <div class="panel panel-default">
        <div class="panel">
          <div class="panel-body">
            <a href="{{URL::to('facebookLogin')}}" class="btn btn-facebook" style="padding: 8px 8px !important;">
              <div class="responsive-content" style="font-size: 13px !important"><i class="fa fa-facebook pad-r-3"></i>{{trans('messages.sign_up.sign_up_with_facebook')}}</div>
            </a>
            <!--<div class="clearfix"></div>-->
            <a href="{{URL::to('googleLogin')}}" class="btn btn-google" style="padding: 8px 8px !important;">
              <div class="responsive-content" style="font-size: 13px !important">
                <i class="fa fa-google-plus pad-r-4"></i>
                {{trans('messages.sign_up.sign_up_with_google')}}
              </div>
            </a>
            
            <div class="col-md-12 cls-or" style="margin-top:10px;">
              <label>{{trans('messages.login.or')}}</label>
            </div>
              <form id="login_form" method="post" action="{{url('authenticate')}}" class='signup-form login-form' accept-charset='UTF-8'>  
                <div class="form-group col-sm-12" style="padding-right: 0px !important;padding-left: 0px !important">
                  @if ($errors->has('email')) <p class="error-tag">{{ $errors->first('email') }}</p> @endif
                  <input type="text" class="form-control" name="email" placeholder = "{{trans('messages.login.email')}}">
                </div>
                <div class="form-group col-sm-12" style="padding-right: 0px !important;padding-left: 0px !important">
                  @if ($errors->has('password')) <p class="error-tag">{{ $errors->first('password') }}</p> @endif
                  <input type="password" class="form-control" name="password" placeholder = "{{trans('messages.login.password')}}">
                </div>
                <div class="form-group col-sm-12" style="padding-right: 0px !important;padding-left: 0px !important">
                  <div class="col-sm-6 txt-left l-pad-none">
                    <input type="checkbox" class='remember_me' id="remember_me2" name="remember_me" value="1">
                     {{trans('messages.login.remember_me')}}
                  </div>
                  <div class="col-sm-6 txt-right r-pad-none">
                    <a href="{{URL::to('/')}}/forgot_password" class="forgot-password pull-right">{{trans('messages.login.forgot_pwd')}}</a>
                  </div>
                </div>
              <div class="col-sm-12 mrg-top-25" style="padding-right: 0px !important;padding-left: 0px !important">
                <input type="submit" class="btn ex-btn btn-block btn-large" value="{{trans('messages.login.login')}}" id='user-login-btn'>
              </div>
            </form>
              <div class="col-sm-12 mrg-top-25" style="text-align:center;padding-right: 0px !important;padding-left: 0px !important;word-spacing: 0px !important">
               {{trans('messages.login.do_not_have_an_account')}} 
                <a href="{{URL::to('/')}}/signup" class="link-to-signup-in-login">
                  {{trans('messages.sign_up.sign_up')}}
                </a>
              </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>

@stop

@section('validation_script')
<script type="text/javascript">

    jQuery.validator.addMethod("laxEmail", function(value, element) {
          // allow any non-whitespace characters as the host part
          return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
    }, "{{ __('messages.jquery_validation.email') }}" );

   $(document).ready(function () {

            $('#login_form').validate({
                rules: {
                    email: {
                        required: true,
                        maxlength: 255,
                        laxEmail: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                  email: {
                      required:  "{{ __('messages.jquery_validation.required') }}",
                      maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
                    },
                  password: {
                      required: "{{ __('messages.jquery_validation.required') }}",
                  }
                }
            });

        });
</script>
@endsection