                    <tr>
                      <th>ID</th>
                      <th class="CDT-series_category">品目タイプ</th>
                      <th class="CDT-series_genre">ジャンル</th>
                      <th class="CDT-series_name">シリーズ名称</th>
                      <th class="CDT-series_model">シリーズ型式</th>
                      <th class="CDT-model">型式</th>
                      <th class="CDT-image">画像</th>
                      <th class="CDT-is_new">NEW</th>
                      <th class="CDT-is_end">生産終了</th>
                      <th class="CDT-is_publish">公開</th>
                      <th class="CDT-is_lend">貸出</th>
                      <th class="CDT-product_number">品番</th>
                      <th class="CDT-operating_temperature">使用温度</th>
                      <th class="CDT-operating_humidity">使用湿度</th>
                      <th class="CDT-weight">器具重量</th>
                      <th class="CDT-is_RoHS">RoHS</th>
                      <th class="CDT-is_RoHS2">RoHS2</th>
                      <th class="CDT-is_CN_RoHSe1">中国RoHSe1</th>
                      <th class="CDT-is_CN_RoHS102">中国RoHS10-2</th>
                      <th class="CDT-is_CE_IEC">CE(IEC)</th>
                      <th class="CDT-is_CE_EN">CE(EN)</th>
                      <th class="CDT-is_UKCA">UKCA</th>
                      <th class="CDT-is_PSE">菱PSE</th>


                      <th class="CDT-description1">欄外記述1</th>
                      <th class="CDT-description2">欄外記述2</th>
                      <th class="CDT-description3">欄外記述3</th>
                      <th class="CDT-description4">欄外記述4</th>
                      <th class="CDT-description5">欄外記述5</th>
                      <th class="CDT-exterior_image">外観図(画像)</th>
                      <th class="CDT-exterior_pdf">外観図(PDF)</th>
                      <th class="CDT-exterior_dxf">外観図(DXF)</th>
                      <th class="CDT-model_stl">モデル(STL)</th>
                      <th class="CDT-model_step">モデル(STEP)</th>
                      <th class="CDT-note">注意書き</th>
                      <th class="CDT-memo">メモ欄</th>
                      <th class="CDT-delete">削除</th>
                    </tr>
                    <tr>
                      <th></th>
                      <th class="CDT-series_category"></th>
                      <th class="CDT-series_genre"></th>
                      <th class="CDT-series_name"></th>
                      <th class="CDT-series_model"></th>
                      <th class="CDT-model"></th>
                      <th class="CDT-image">
                        <input type="range" class="custom-range" value="20">
                      </th>
                      <th class="CDT-is_new">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_new_all',
                        ])
                      </th>
                      <th class="CDT-is_end">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_end_all',
                        ])
                      </th>
                      <th class="CDT-is_publish">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_publish_all',
                        ])
                      </th>
                      <th class="CDT-is_lend">
                        @include('admin.parts.custom_checkbox', [
                          'switch'      => true,
                          'name'        => 'is_lend_all',
                        ])
                      </th>
                      <th class="CDT-product_number"></th>
                      <th class="CDT-operating_temperature"></th>
                      <th class="CDT-operating_humidity"></th>
                      <th class="CDT-weight"></th>
                      <th class="CDT-is_RoHS"></th>
                      <th class="CDT-is_RoHS2"></th>
                      <th class="CDT-is_CN_RoHSe1"></th>
                      <th class="CDT-is_CN_RoHS102"></th>
                      <th class="CDT-is_CE_IEC"></th>
                      <th class="CDT-is_CE_EN"></th>
                      <th class="CDT-is_UKCA"></th>
                      <th class="CDT-is_PSE"></th>

                      
                      <th class="CDT-description1"></th>
                      <th class="CDT-description2"></th>
                      <th class="CDT-description3"></th>
                      <th class="CDT-description4"></th>
                      <th class="CDT-description5"></th>
                      <th class="CDT-exterior_image"></th>
                      <th class="CDT-exterior_pdf"></th>
                      <th class="CDT-exterior_dxf"></th>
                      <th class="CDT-model_stl"></th>
                      <th class="CDT-model_step"></th>
                      <th class="CDT-note"></th>
                      <th class="CDT-memo"></th>
                      <th class="CDT-delete">
                        @include('admin.parts.custom_checkbox', [
                          'name'        => 'is_delete_all',
                          'type'        => 'danger',
                        ])
                      </th>
                    </tr>
