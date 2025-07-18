                    <tr>
                      <td>
                        <a href="{{ route('admin.item.edit', $item->id) }}">{{ $item->id }}</a>
                        <input type="hidden" name="ids[]" value="{{ $item->id }}">
                      </td>
                      <td class="CDT-series_category">
                        {{ $item->series->category->label() }}
                      </td>
                      <td class="CDT-series_genre">
                        {{ $item->series->genre->label() }}
                      </td>
                      <td class="CDT-series_name">
                        {{ $item->series->japanese_detail->name ?? '' }}
                      </td>
                      <td class="CDT-series_model">
                        {{ $item->series->japanese_detail->model ?? '' }}
                      </td>
                      <td class="CDT-model">
                        {{ $item->model }}
                      </td>
                      <td class="CDT-image">
                        @if ($item->series->hasFile('image'))
                        <img src="{{ $item->series->fileUrl('image') }}?v={{ uniqid() }}" class="list-image">
                        @endif
                      </td>
                      <td class="CDT-is_new">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_new_ids[]',
                          'id'          => 'is_new-'.$item->id,
                          'value'       => $item->is_new ? $item->id : '',
                          'form_value'  => $item->id,
                        ])
                      </td>
                      <td class="CDT-is_end">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_end_ids[]',
                          'id'          => 'is_end-'.$item->id,
                          'value'       => $item->is_end ? $item->id : '',
                          'form_value'  => $item->id,
                        ])
                      </td>
                      <td class="CDT-is_publish">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_publish_ids[]',
                          'id'          => 'is_publish-'.$item->id,
                          'value'       => $item->is_publish ? $item->id : '',
                          'form_value'  => $item->id,
                        ])
                      </td>
                      <td class="CDT-is_lend">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_lend_ids[]',
                          'id'          => 'is_lend-'.$item->id,
                          'value'       => $item->is_lend ? $item->id : '',
                          'form_value'  => $item->id,
                        ])
                      </td>
                      <td class="CDT-product_number">
                        {{ $item->product_number }}
                      </td>
                      <td class="CDT-operating_temperature">
                        {{ $item->operating_temperature }}
                      </td>
                      <td class="CDT-operating_humidity">
                        {{ $item->operating_humidity }}
                      </td>
                      <td class="CDT-weight">
                        {{ $item->weight }}
                      </td>
                      <td class="CDT-is_RoHS">
                        @if ($item->is_RoHS) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_RoHS2">
                        @if ($item->is_RoHS2) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_CN_RoHSe1">
                        @if ($item->is_CN_RoHSe1) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_CN_RoHS102">
                        @if ($item->is_CN_RoHS102) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_CE_IEC">
                        @if ($item->is_CE_IEC) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_CE_EN">
                        @if ($item->is_CE_EN) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_UKCA">
                        @if ($item->is_UKCA) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-is_PSE">
                        @if ($item->is_PSE) {{ config('system.string.valid') }} @else {{ config('system.string.invalid') }} @endif
                      </td>
                      <td class="CDT-description1">
                        {{ $item->description1 }}
                      </td>
                      <td class="CDT-description2">
                        {{ $item->description2 }}
                      </td>
                      <td class="CDT-description3">
                        {{ $item->description3 }}
                      </td>
                      <td class="CDT-description4">
                        {{ $item->description4 }}
                      </td>
                      <td class="CDT-description5">
                        {{ $item->description5 }}
                      </td>
                      <td class="CDT-exterior_image">
                        @if ($item->hasFile('exterior_image')) {{ config('system.string.exixts') }} @else {{ config('system.string.not_exist') }} @endif
                      </td>
                      <td class="CDT-exterior_pdf">
                        @if ($item->hasFile('exterior_pdf')) {{ config('system.string.exixts') }} @else {{ config('system.string.not_exist') }} @endif
                      </td>
                      <td class="CDT-exterior_dxf">
                        @if ($item->hasFile('exterior_dxf')) {{ config('system.string.exixts') }} @else {{ config('system.string.not_exist') }} @endif
                      </td>
                      <td class="CDT-model_stl">
                        @if ($item->hasFile('model_stl')) {{ config('system.string.exixts') }} @else {{ config('system.string.not_exist') }} @endif
                      </td>
                      <td class="CDT-model_step">
                        @if ($item->hasFile('model_step')) {{ config('system.string.exixts') }} @else {{ config('system.string.not_exist') }} @endif
                      </td>
                      <td class="CDT-note">
                        {{ $item->note }}
                      </td>
                      <td class="CDT-memo">
                        {{ $item->memo }}
                      </td>
                      <td class="CDT-delete">
                        @include('admin.parts.custom_checkbox', [
                          'name'        => 'removes[]',
                          'id'          => 'removes-'.$item->id,
                          'form_value'  => $item->id,
                          'type'        => 'danger',
                        ])
                      </td>
                    </tr>
