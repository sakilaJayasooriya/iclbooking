@extends('emails.template')

@section('emails.main')
<?=$content?>
<table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
  <tbody>
    <tr>
      <td align="center">
        <table border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td> <a href="{{ $url.('users/confirm_email?code='.$token) }}" target="_blank">{{trans('messages.email_template.confirm_email')}}</a> </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>
@stop
