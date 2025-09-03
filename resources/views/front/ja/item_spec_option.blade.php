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
                          <th>透過率</th>
                          <td>{{ $item_lc->throughput ? $item_lc->throughput : $item_ja->throughput }}</td>
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
