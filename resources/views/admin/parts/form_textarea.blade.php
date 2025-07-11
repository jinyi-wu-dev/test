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
  <label for="{{ $name }}">{{ $label }}</label>
  <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">{{ $v }}</textarea>
  <div class="invalid-feedback">
    @error($name)
      {{ $message }}
    @enderror
  </div>
</div>
