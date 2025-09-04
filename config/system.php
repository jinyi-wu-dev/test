<?php

return [
    'language' => [
        'default' => 'ja',
        'list' => ['ja', 'en'],
    ],

    'messages' => [
        'create_succeeded'  => 'ID: %s を追加しました。',
        'update_succeeded'  => 'ID: %s を更新しました。',
        'delete_succeeded'  => 'ID: %s を削除しました。',
    ],

    'pagination' => [
        'num_of_item'       => 10,
    ],

    'string' => [
        'valid'     => '○',
        'invalid'   => '',
        'exist'     => '○',
        'not_exist' => '-',
    ],

    'news' => [
        'target_terms'  => ['LED'],
        'num_of_top'    => 5,
        'num_of_news'   => 20,
        'link_url'      => 'https://leimac.co.jp/news/',
    ],

    'common_columns' => [
        'series' => [
            'model',
        ],
        'lighting' => [
            'color',
        ],
        'controller' => [
        ],
        'cable' => [
        ],
        'option' => [
        ],
    ],

    'csv' => [
        'series' => [
            'identifier'    => '[series]',
            'filename'      => sprintf('leimac_series_%s.csv', date('Ymd')),
        ],
        'lighting' => [
            'identifier'    => '[led]',
            'filename'      => sprintf('leimac_led_%s.csv', date('Ymd')),
        ],
        'controller' => [
            'identifier'    => '[controller]',
            'filename'      => sprintf('leimac_controller_%s.csv', date('Ymd')),
        ],
        'cable' => [
            'identifier'    => '[cable]',
            'filename'      => sprintf('leimac_cable_%s.csv', date('Ymd')),
        ],
        'option' => [
            'identifier'    => '[option]',
            'filename'      => sprintf('leimac_option_%s.csv', date('Ymd')),
        ],

        'enums' => [
            'category' => [
                'lighting'      => '照明',
                'controller'    => 'コントローラー',
                'cable'         => 'ケーブル',
                'option'        => 'オプション',
            ],
            'genre' => [
                'lt_line'           => 'ライン照明',
                'lt_ring'           => 'リング照明',
                'lt_transmission'   => 'バー照明',
                'lt_flatsurface'    => '透過・面照明',
                'lt_dome'           => 'ドーム照明',
                'lt_coaxial_spot'   => '同軸・スポット照明',
                'lt_other'          => 'その他照明',
                'cr_ac_input'       => 'AC入力コントローラ',
                'cr_dc_input'       => 'DC入力コントローラ',
                'cr_poe_input'      => 'PoE入力コントローラ',
                'cr_ex_and_sp'      => '専用/特殊コントローラ',
                'cb_lighting'       => '照明用ケーブル',
                'cb_external'       => '外部制御用ケーブル',
                'op_lighting'       => '照明用オプション',
                'op_other'          => 'その他オプション',
            ],
            'color' => [
                'white'         => '白',
                'blue'          => '青',
                'green'         => '緑',
                'yellow'        => '黄',
                'red'           => '赤',
                'ir_u1000'      => 'IR1000未満',
                'ir_o1000'      => 'IR1000以上',
                'uv_u280'       => 'UV280未満',
                'uv_o280'       => 'UV280以上',
                'full_color'    => 'フルカラー',
                'multi_color'   => 'マルチカラー',
            ],
            'dimmable_control' => [
                'pwm'               => 'PWM方式',
                'variable_current'  => '電流可変方式',
                'variable_voltage'  => '電圧可変方式',
                'overdrive'         => 'オーバードライブ',
            ],
        ],
    ],

    'file' => [
        'public_storage'        => 'storage',

        'icon' => [
            /* storage/icons/1/ */
            'directory'     => 'icons',
            'image'         => 'image',
        ],
        'feature' => [
            /* EX: storage/feature/1/image_jp */
            'directory'     => 'feature',
            'image'         => 'image_{language}',
        ],
        'series' => [
            /* EX: storage/series/1/ */
            'directory'     => 'series',
            'image'         => 'image',
            'pamphlet'      => 'pamphlet',
            'catalogue'     => 'catalogue',
            'manual'        => 'manual',
        ],
        'item' => [
            /* ex: storage/models/1/ */
            'directory'         => 'items',
            '3d_model_stl'      => '3d_model_stl',
            '3d_model_step'     => '3d_model_step',
            'external_view_pdf' => 'external_view_pdf_{language}',
            'external_view_dxf' => 'external_view_dxf_{language}',
        ],
        'group' => [
            /* ex: storage/models/1/ */
            'directory'         => 'groups',
            '3d_model_stl'      => '3d_model_stl',
            '3d_model_step'     => '3d_model_step',
            'external_view_pdf' => 'external_view_pdf_{language}',
            'external_view_dxf' => 'external_view_dxf_{language}',
        ],
    ],

];

