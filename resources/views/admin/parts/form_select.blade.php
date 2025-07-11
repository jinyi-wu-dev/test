@php
  $v = '';
  if (old($name)) {
    $v = old($name);
  } else if (isset($value)) {
    $v = $value;
  } else if (isset($valiable) && isset(${$valiable})) {
    $v = ${$valiable}->{$name}->value ?? ${$valiable}->{$name};
  }
@endphp
<div class="form-group">
  @if(isset($label))
  <label for="{{ $name }}">{{ $label }}</label>
  @endif
  <select class="form-control @error($name) is-invalid @enderror "
    id="{{ $name }}"
    name="{{ $name }}"
    @if(isset($disabled) && $disabled) disabled @endif
  >
    @if(isset($empty) && $empty)
      <option value=""></option>
    @endif
    @foreach ($options as $key => $label)
      <option value="{{ $key }}"
        @if($key==$v) selected @endif
      >
        {{ $label }}
      </option>
    @endforeach 
  </select>
  <div class="invalid-feedback">
    @error($name)
      {{ $message }}
    @enderror
  </div>
</div>
