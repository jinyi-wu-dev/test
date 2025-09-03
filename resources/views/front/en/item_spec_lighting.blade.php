                        <tr>
                          <th>タイプ</th>
                          <td>{{ $item_lc->type ? $item_lc->type : $item_ja->type }}</td>
                        </tr>
                        <tr>
                          <th>型　式</th>
                          <td>{{ $item->model }}</td>
                        </tr>
                        <tr>
                          <th>品　番</th>
                          <td>{{ $item->product_number }}</td>
                        </tr>
                        <tr>
                          <th>発光色</th>
                          <td>
                            {{ $item_ja->color->label() }}
                            {{ $item_lc->color1 ? $item_lc->color1 : $item_ja->color1 }}
                          </td>
                        </tr>
                        <tr>
                          <th>消費電力</th>
                          <td>{{ $item_lc->power_consumption ? $item_lc->power_consumption : $item_ja->power_consumption }}</td>
                        </tr>
                        <tr>
                          <th>CH数</th>
                          <td>{{ $item_lc->num_of_ch ? $item_lc->num_of_ch : $item_ja->num_of_ch }}</td>
                        </tr>
                        <tr>
                          <th>入 力</th>
                          <td>{{ $item_lc->input ? $item_lc->input : $item_ja->input }}</td>
                        </tr>
                        <tr>
                          <th>使用温度</th>
                          <td>{{ $item->operating_temperature }}</td>
                        </tr>
                        <tr>
                          <th>使用湿度</th>
                          <td>{{ $item->operating_humidity }}</td>
                        </tr>
                        <tr>
                          <th>器具重量</th>
                          <td>{{ $item->weight }}</td>
                        </tr>
                        <tr>
                          <th>適合規格</th>
                          <td>
                            @php
                              $tmp = [];
                              if ($item->is_RoHS)       $tmp[] = 'RoHS';
                              if ($item->is_RoHS2)      $tmp[] = 'RoHS2';
                              if ($item->is_CN_RoHSe1)  $tmp[] = '中国RoHS e-1';
                              if ($item->is_CN_RoHS102) $tmp[] = '中国RoHS 10-2';
                              if ($item->is_CE_IEC)     $tmp[] = 'CE(IEC62471)';
                              if ($item->is_CE_IEC)     $tmp[] = 'CE(EN55011, EN61000-6-2)';
                              if ($item->is_UKCA)       $tmp[] = 'UKCA';
                              if ($item->is_PSE)        $tmp[] = 'PSE';
                            @endphp
                            {!! implode('<br/>', $tmp) !!}
                          </td>
                        </tr>
