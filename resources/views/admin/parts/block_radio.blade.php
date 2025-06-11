@php
  $data_value = '';
  if (old($name)) {
    $data_value = old($name);
  } else if (isset($value)) {
    $data_value = $value;
  } else if (isset($valiable) && isset(${$valiable})) {
    $data_value = ${$valiable}->{$name};
  }
@endphp

<div class="form-group"
  style=" @if(isset($inline) && $inline) display: inline; @endif "
>
  <label for="{{ $name }}">{{ $label }}</label>
  @if(isset($empty_value) && $empty_value)
    <input type="hidden" name="{{ $name }}" value="0">
  @endif
  @foreach($list as $key => $label)
  <div class="form-check">
    <input type="radio"
      class="
        form-check-input
        {{ isset($type) ? 'custom-control-input-'.$type : ''}}
      "
      id="{{ $name }}_{{ $key }}"
      name="{{ $name }}"
      value="{{ $key }}"
      @if($data_value==$key || (isset($checked) && $checked)) checked @endif
    >
    <label class="form-check-label" for="{{ $name }}_{{ $key }}">{{ $label ?? '' }}</label>
  </div>
  @endforeach
</div>
