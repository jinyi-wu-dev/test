@php
  $form_value = isset($form_value) ? $form_value : 1;
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
  <div
    class="custom-control
      @if(isset($switch) && $switch) custom-switch @else custom-checkbox @endif
    "
    style="
      @if(isset($inline) && $inline) display:inline; @endif
    "
    >
    @if(isset($empty_value) && $empty_value)
      <input type="hidden" name="{{ $name }}" value="0">
    @endif
    <input type="checkbox"
      class="
        custom-control-input
        {{ isset($type) ? 'custom-control-input-'.$type : ''}}
      "
      id="{{ $id ?? $name }}"
      name="{{ $name }}"
      value="{{ $form_value }}"
      @if($data_value==$form_value || (isset($checked) && $checked)) checked @endif
    >
    <label class="custom-control-label" for="{{ $id ?? $name }}">{{ $label ?? '' }}</label>
  </div>
</div>
