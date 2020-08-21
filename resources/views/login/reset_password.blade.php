@extends('template')
@section('main')
  <div class="container margin-top30">
    <div class="col-md-4 col-center">
      <div class="panel panel-default">
        <div class="panel-body h4">{{trans('messages.forgot_pass.reset_password')}}</div>
        <div class="panel">
          <div class="panel-body">
            <form method="post" action="{{url('users/reset_password')}}" id='password-form' class='signup-form login-form' accept-charset='UTF-8'>  
              <input id="id" name="id" type="hidden" value="{{ $result->id }}">
              <input id="token" name="token" type="hidden" value="{{ $token }}">
              <div class="col-sm-12 mb20">
                <input type="password" class="form-control" id='new_password' name="password" placeholder = "{{trans('messages.forgot_pass.new_pass')}}">
                @if ($errors->has('password')) <p class="error-tag">{{ $errors->first('password') }}</p> @endif
              </div>
              <div class="col-sm-12 mb20">
                <input type="password" class="form-control" id='password_confirmation' name="password_confirmation" placeholder = "{{trans('messages.forgot_pass.confirm_pass')}}">
                @if ($errors->has('password_confirmation')) <p class="error-tag">{{ $errors->first('password_confirmation') }}</p> @endif
              </div>

              <div class="col-sm-12">
                <button class="btn ex-btn" type="submit">
                  {{trans('messages.forgot_pass.reset_pass')}}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('validation_script')

<script type="text/javascript">

  $(document).ready(function () {
     $('#password-form').validate({
        rules: {
          password: {
            required: true,
            minlength: 6,
          },
          password_confirmation: {
            required: true,
            minlength: 6,
            equalTo: "#new_password"
          }
        },
        messages: {
            password: {
                required:  "{{ __('messages.jquery_validation.required') }}",
                minlength: "{{ __('messages.jquery_validation.minlength6') }}",
              },
            password_confirmation: {
                required:  "{{ __('messages.jquery_validation.required') }}",
                minlength: "{{ __('messages.jquery_validation.minlength6') }}",
                equalTo:   "{{ __('messages.jquery_validation.equalTo') }}",
            }
          }
     });
  });

</script>

@endsection