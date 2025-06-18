<?php

return [
    [
        'type'  => 'header',
        'label' => 'ユーザ',
    /*
    ], [
        'type'  => 'item',
        'label' => 'ユーザ登録',
        'route' => 'admin.user.create',
        'icon'  => 'fa-user',
     */
    ], [
        'type'  => 'item',
        'label' => 'ユーザ一覧',
        'route' => 'admin.user.index',
        'icon'  => 'fa-user',
    ], [
        'type'  => 'header',
        'label' => '貸出',
    ], [
        'type'  => 'item',
        'label' => '貸出実績一覧',
        'route' => 'admin.lend.index',
        'icon'  => 'fa-user',
    ], [
        'type'  => 'header',
        'label' => 'マスタ',
    ], [
        'type'  => 'item',
        'label' => 'アイコン一覧',
        'route' => 'admin.icon.index',
        'icon'  => 'fa-user',
    ], [
        'type'  => 'item',
        'label' => 'アイコン登録',
        'route' => 'admin.icon.create',
        'icon'  => 'fa-user',
    ], [
        'type'  => 'item',
        'label' => '特徴・特性一覧',
        'route' => 'admin.feature.index',
        'icon'  => 'fa-user',
    ], [
        'type'  => 'item',
        'label' => '特徴・特性登録',
        'route' => 'admin.feature.create',
        'icon'  => 'fa-user',
    ], [
        'type'  => 'header',
        'label' => '製品',
    ], [
        'type'  => 'item',
        'label' => 'シリーズ一覧',
        'route' => 'admin.series.index',
        'icon'  => 'fa-user',
    ], [
        'type'  => 'item',
        'label' => 'シリーズ登録',
        'route' => 'admin.series.create',
        'icon'  => 'fa-user',
    ], [
        'type'  => 'item',
        'label' => '個別（照明）一覧',
        'route' => 'admin.item.index',
        'param' => ['category'=>'lighting'],
        'icon'  => 'fa-user',
    ], [
        'type'  => 'item',
        'label' => '個別（照明）登録',
        'route' => 'admin.item.create',
        'param' => ['category'=>'lighting'],
        'icon'  => 'fa-user',
    ], [
        'type'  => 'item',
        'label' => '個別（ｺﾝﾄﾛｰﾗ）一覧',
        'route' => 'admin.item.index',
        'param' => ['category'=>'controller'],
        'icon'  => 'fa-user',
    ], [
        'type'  => 'item',
        'label' => '個別（ｺﾝﾄﾛｰﾗ）登録',
        'route' => 'admin.item.create',
        'param' => ['category'=>'controller'],
        'icon'  => 'fa-user',
    ], [
        'type'  => 'item',
        'label' => '個別（ｹｰﾌﾞﾙ）一覧',
        'route' => 'admin.group.index',
        'icon'  => 'fa-user',
    ], [
        'type'  => 'item',
        'label' => '個別（ｹｰﾌﾞﾙ）登録',
        'route' => 'admin.group.create',
        'icon'  => 'fa-user',
    ], [
        'type'  => 'item',
        'label' => '個別（ｵﾌﾟｼｮﾝ）一覧',
        'route' => 'admin.item.index',
        'param' => ['category'=>'option'],
        'icon'  => 'fa-user',
    ], [
        'type'  => 'item',
        'label' => '個別（ｵﾌﾟｼｮﾝ）登録',
        'route' => 'admin.item.create',
        'param' => ['category'=>'option'],
        'icon'  => 'fa-user',
    ], [
        'type'  => 'header',
        'label' => '一括',
    ], [
        'type'  => 'item',
        'label' => 'CSVアップロード',
        'route' => 'admin.csv.index',
        'icon'  => 'fa-user',
    ],
];

