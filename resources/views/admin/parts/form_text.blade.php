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
  @if (isset($label))
  <label for="{{ $name }}">{{ $label }}</label>
  @endif
  <input type="text" class="form-control @error($name) is-invalid @enderror"
    id="{{ $name }}"
    name="{{ $name }}"
    placeholder="{{ $placeholder ?? '' }}"
    value="{{ $v }}"
    @if(isset($disabled) && $disabled) disabled @endif
  >
  <div class="invalid-feedback">
    @error($name)
      {{ $message }}
    @enderror
  </div>
</div>
