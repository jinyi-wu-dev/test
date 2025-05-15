@php
  $v = '';
  if (old($name)) {
    $v = old($name);
  } else if (isset($value)) {
    $v = $value;
  } else if (isset($valiable) && isset(${$valiable})) {
    $v = ${$valiable}->{$name};
  }
@endphp
<div class="form-group" style="display: inline; margin-right: 30px;">
  <div class="custom-control custom-checkbox" style="display: inline">
    <input type="checkbox" class="custom-control-input" id="{{ $id ?? '' }}" name="{{ $name }}" value="1" @if($v) checked @endif>
    <label class="custom-control-label" for="{{ $name }}">{{ $label }}</label>
  </div>
</div>
