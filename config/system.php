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
            '3d_view_stl'       => '3d_view_stl',
            '3d_model_step'     => '3d_model_step',
            'external_view_pdf' => 'external_view_pdf_{language}',
            'external_view_dxf' => 'external_view_dxf_{language}',
        ],
    ],
];

