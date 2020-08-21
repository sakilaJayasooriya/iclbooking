@extends('template')

@section('main')
<div class="container margin-top30">
  <form id="change_pass" class="{{(Auth::guard('users')->user()->password) ? 'show' : 'hide'}}" method='post' action="{{url('users/security')}}">
    <input id="id" name="id" type="hidden" value="33661974">
    <input id="redirect_on_error" name="redirect_on_error" type="hidden" value="/users/security">
    <input id="user_password_ok" name="user[password_ok]" type="hidden" value="true">
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
          <div class="panel-body h5">
            {{trans('messages.account_security.change_password')}}
          </div>
          <div class="panel-footer">
            <div class="panel">
              <div class="panel-body">
                <div class="row">
                  <label class="text-right col-sm-3" for="user_first_name">
                    {{trans('messages.account_security.old_password')}} <span style="color: red !important;">*</span>
                  </label>
                  <div class="col-sm-9 mb20">
                    <input class="form-control" id="old_password" name="old_password" type="password">
                    @if ($errors->has('old_password')) <p class="help-block text-danger">{{ $errors->first('old_password') }}</p> @endif
                  </div>
                </div>

                <div class="row">
                  <label class="text-right col-sm-3" for="user_first_name">
                    {{trans('messages.account_security.new_password')}} <span style="color: red !important;">*</span>
                  </label>
                  <div class="col-sm-9 mb20">
                    <input class="form-control" data-hook="new_password" id="new_password" name="new_password" size="30" type="password">
                    @if ($errors->has('new_password')) <p class="help-block text-danger">{{ $errors->first('new_password') }}</p> @endif
                  </div>
                </div>

                <div class="row">
                  <label class="text-right col-sm-3" for="user_first_name">
                    {{trans('messages.account_security.confirm_pass')}} <span style="color: red !important;">*</span>
                  </label>
                  <div class="col-sm-9 mb20">
                    <input class="form-control" id="user_password_confirmation" name="password_confirmation" size="30" type="password">
                    @if ($errors->has('password_confirmation')) <p class="help-block text-danger">{{ $errors->first('password_confirmation') }}</p> @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <button type="submit" class="btn ex-btn btn-large">
            {{trans('messages.account_security.update_pass')}}
          </button>
        </div>
    </div>
  </form>
</div>
@stop

@section('validation_script')

<script type="text/javascript">

  jQuery.validator.addMethod("notEqual", function(value, element, param) {
   return this.optional(element) || value != $(param).val();
  }, "{{ __('messages.jquery_validation.old_password_different') }}" );

  $(document).ready(function () {

      $('#change_pass').validate({
          rules: {
              old_password: {
                  required: true
              },
              new_password: {
                  required: true,                  
                  minlength: 6,
                  maxlength: 30,
                  notEqual: "#old_password"
              },
              password_confirmation: {
                  required: true,
                  equalTo: "#new_password",
                  notEqual: "#old_password"
              }
          },
          messages: {
            old_password: {
                required:  "{{ __('messages.jquery_validation.required') }}",
              },
            new_password: {
                required:  "{{ __('messages.jquery_validation.required') }}",
                minlength: "{{ __('messages.jquery_validation.minlength6') }}",
                maxlength: "{{ __('messages.jquery_validation.maxlength30') }}",
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