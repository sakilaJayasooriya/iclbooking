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
                <td> <a href="{{ $url.('booking/'.$result['id']) }}" target="_blank">{{trans('messages.email_template.accept/decline')}}</a></td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
@stop