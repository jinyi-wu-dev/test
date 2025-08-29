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
    ],

];

