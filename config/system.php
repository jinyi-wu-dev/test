<?php

return [
    'messages' => [
        'create_succeeded'  => 'ID: %s を追加しました。',
        'update_succeeded'  => 'ID: %s を更新しました。',
        'delete_succeeded'  => 'ID: %s を削除しました。',
    ],

    'pagination' => [
        'num_of_item'       => 100,
    ],

    'public_storage'        => 'storage',

    'icon' => [
        /* storage/icons/1/ */
        'directory'         => 'icons',
        'image_file'        => 'image',
    ],
    
    'feature' => [
        /* EX: storage/feature/1/image_jp */
        'directory'         => 'feature',
        'image_file'        => 'image_%s',
    ],
    
    'series' => [
        /* EX: storage/series/1/ */
        'directory'         => 'series',
        'image_file'        => 'image',
        'pamphlet_file'     => 'pamphlet',
        'catalogue_file'    => 'catalogue',
        'manual_file'       => 'manual',
    ],

    'model' => [
        /* ex: storage/models/1/ */
        'directory'         => 'models',
        'external_view_pdf' => 'external_view_pdf',
        'external_view_dxf' => 'external_view_dxf',
        '3d_model_step'     => '3d_model_step',
    ],
];

