<?php

return [
    'title' => '站点设置',

    // 访问权限判断
    'permission' => function () {
        return Auth::user()->hasRole('Founder');
    },

    // 站点配置的表单
    'edit_fields' => [
        'site_name' => [
            'title' => '站点名称',
            'type' => 'text',
            'limit' => 50,
        ],
    ],
];