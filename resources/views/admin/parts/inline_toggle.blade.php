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
<div class="form-group">
  <div class="custom-control custom-switch">
    <input type="checkbox" class="custom-control-input" id="{{ $name }}" name="{{ $name }}" value="1" @if($v) checked @endif>
    <label class="custom-control-label" for="{{ $name }}">{{ $label }}</label>
  </div>
</div>
