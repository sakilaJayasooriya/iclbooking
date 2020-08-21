<div class="form-group">
  @if(isset($field['hint']) && $field['hint'] == 'Enter new password only. Leave blank to use existing password.')
  <label for="inputEmail3" class="col-sm-3 control-label">{{ $field['label'] or ''}}</label>
  @else
  <label for="inputEmail3" class="col-sm-3 control-label">{{ $field['label'] or ''}} <span style="color: red !important;">*</span></label>
  @endif
  <div class="col-sm-6">
    <input type="password" name="{{ $field['name'] or ''}}" class="form-control {{ $field['class'] or ''}}" id="{{ $field['id'] or $field['name'] }}" value="{{ $_POST[$field['name']] or @$field['value']}}" placeholder="{{ $field['label'] }}" {{ isset($field['readonly']) && $field['readonly']=='true'?'readonly':'' }}>
    <span class="text-danger">{{ $errors->first($field['name']) }}</span>
  </div>
  <div class="col-sm-3">
    <small>{{ $field['hint'] or "" }}</small>
  </div>
</div>