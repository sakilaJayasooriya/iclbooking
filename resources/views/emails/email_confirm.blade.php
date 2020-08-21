@extends('emails.template')

@section('emails.main')
<h3 style="text-align:center;font-weight: bold;">{{ $site_name }}</h3>
<p>Hi {{ @$first_name }},</p>
<p>
	@if($type == 'register')
		Welcome to {{$site_name}}!
	@elseif($type == 'change')
		Please click the link below to complete the process of changing your email address
	@else
		Please Confirm your email address:
	@endif
</p>
<table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
  <tbody>
    <tr>
      <td align="center">
        <table border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td> <a href="{{ $url.('users/confirm_email?code='.$token) }}" target="_blank">Confirm Email</a> </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>
@stop

