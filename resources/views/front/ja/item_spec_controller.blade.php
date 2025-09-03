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
                          <th>調光制御</th>
                          <td>{{ $item_ja->dimmable_control->label() }}
                          </td>
                        </tr>
                        <tr>
                          <th>合計容量</th>
                          <td>{{ $item_lc->total_capacity ? $item_lc->total_capacity : $item_ja->total_capacity }}</td>
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
                          <th>出 力</th>
                          <td>{{ $item_lc->output ? $item_lc->output : $item_ja->output }}</td>
                        </tr>
                        <tr>
                          <th>外部ON/OFF制御</th>
                          <td>@if ($item_ja->is_external_switch) ○ @else ✕ @endif</td>
                        </tr>
                        <tr>
                          <th>外部調光制御</th>
                          <td>
                            @php
                              $tmp = [];
                              if ($item_ja->is_ethernet)        $tmp[] = 'LAN通信';
                              if ($item_ja->is_8bit_parallel)   $tmp[] = '8bitパラレル通信';
                              if ($item_ja->is_10bit_parallel)  $tmp[] = '10bitパラレル通信';
                              if ($item_ja->is_rs232c)          $tmp[] = 'RS-232C通信';
                              if ($item_ja->is_analog)          $tmp[] = 'アナログ0-5v通信';
                            @endphp
                            {!! implode('<br/>', $tmp) !!}
                          </td>
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
