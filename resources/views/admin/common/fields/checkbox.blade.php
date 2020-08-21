<div class="form-group">
    <label class="col-sm-3 control-label">{{ $field['label'] or ''}}</label>
    <div class="col-sm-6">
        <ul style="display: inline-block;list-style-type: none;padding:0; margin:0;">
          @foreach($field['boxes'] as $value => $name)
            <li class="checkbox" style="display: inline-block; min-width: 155px;">
              <label>
                <input type="checkbox" name="{{ $field['name'] or '' }}" value="{{ $value }}" {{ (isset($field['value']) && in_array($value, $field['value'])) ? 'checked' : '' }}> 
                {{ $name }}
              </label>
              <!-- Changed $field from $field['value'] in in_array()  -->
            </li>
          @endforeach
        </ul>
    </div>
    <div class="col-sm-3">
      <small>{{ $field['hint'] or "" }}</small>
  </div>
</div>