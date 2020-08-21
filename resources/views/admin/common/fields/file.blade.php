<div class="form-group">
@if($field['label'] == 'Image')
  <label for="inputEmail3" class="col-sm-3 control-label">{{ $field['label'] or ''}} <span style="color: red !important;">*</span></label>
@else
  <label for="inputEmail3" class="col-sm-3 control-label">{{ $field['label'] or ''}}</label>
@endif
  <div class="col-sm-6">
    <input type="file" name="{{ $field['name'] or '' }}" class="form-control {{ $field['class'] or ''}}" id="{{ $field['id'] or $field['name'] }}" value="{{ isset($_POST[$field['name']])?@$_POST[$field['name']]:@$field['value'] }}" placeholder="{{ @$field['label'] }}" {{ isset($field['readonly']) && $field['readonly']=='true'?'readonly':'' }}>
    <span class="text-danger">{{ $errors->first($field['name']) }}</span>
    {!! isset($field['image'])?'<br><img style="max-width:150px;padding-top:0px;" src="'.$field['image'].'">':'' !!}
    {{-- 'custom_span' is for removing logo --}}
    {!! isset($field['custom_span'])?'<span  name="mySpan" class="remove_logo_preview" id="mySpan"></span>':'' !!}
    {{-- 'custom_company_logo' contains the image name that
    is saved in Database as company logo --}}
    {!! isset($field['custom_company_logo'])?'<input id="hidden_company_logo" name="hidden_company_logo" data-rel="'.$field['custom_company_logo'].'" type="hidden" >':'' !!}
    {{-- 'custom_span2' is for removing favicon --}}
    {!! isset($field['custom_span2'])?'<span  name="mySpan2" class="remove_favicon_preview" id="mySpan2"></span>':'' !!}
    {{-- 'custom_company_favicon' contains the favicon name that
    is saved in Database as company favicon --}}
    {!! isset($field['custom_company_favicon'])?'<input id="hidden_company_favicon" name="hidden_company_favicon" data-rel="'.$field['custom_company_favicon'].'" type="hidden" >':'' !!}

    
    
  </div>
  <div class="col-sm-3">
    <small>{{ $field['hint'] or "" }}</small>
  </div>
</div>