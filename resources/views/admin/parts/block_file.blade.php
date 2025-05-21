<div class="form-group">
  <label for="{{ $name }}">{{ $label }}</label>
  @if(isset($image_path))
  <div class="text-center">
    <img src="{{ $image_path }}{{ isset($no_cache)&&$no_cache ? '?v='.uniqid() : ''}}">
  </div>
  @endif
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="{{ $name }}" name="{{ $name }}">
    <label class="custom-file-label" for="{{ $name }}">{{ isset($file_label) ? $file_label : "選択..." }}</label>
  </div>
</div>
