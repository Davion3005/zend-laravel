<?php

return [
    'url' => [
        'prefix_admin' => 'admin',
        'prefix_slider' => 'slider',
        'prefix_news' => 'news',
    ],
    'format' => [
        'long_time' => 'H:m:s d/m/Y',
        'short_time' => 'd/m/Y',
    ],
    'template' => [
        'status' => [
            'default' => ['name' => 'Undefined', 'class' => 'btn-danger'],
            'all' => ['name' => 'All', 'class' => 'btn-primary'],
            'active' => ['name' => 'Active', 'class' => 'btn-success'],
            'inactive' => ['name' => 'Inactive', 'class' => 'btn-info'],
        ],
        'search' => [
            'all' => ['name' => 'Search by All'],
            'id' => ['name' => 'Search by ID'],
            'name' => ['name' => 'Search by Name'],
            'username' => ['name' => 'Search by Username'],
            'fullname' => ['name' => 'Search by Full name'],
            'email' => ['name' => 'Search by Email'],
            'description' => ['name' => 'Search by Description'],
            'link' => ['name' => 'Search by Link'],
            'content' => ['name' => 'Search by Content'],
        ],
        'button' => [

            'edit' => [
                'class' => 'btn-success',
                'title' => 'Edit',
                'icon' => 'fa-pencil',
                'route-name' => '/form',
            ],
            'delete' => [
                'class' => 'btn-danger',
                'title' => 'Delete',
                'icon' => 'fa-trash',
                'route-name' => '/delete',
            ],
            'info' => [
                'class' => 'btn-info',
                'title' => 'View',
                'icon' => 'fa-info-circle',
                'route-name' => '/delete',
            ],
        ],
    ],
    'config' => [
        'search' => [
            'default' => ['all', 'id', 'fullname'],
            'slider' => ['all', 'id'],
        ],
        'button' => [
            'default' => ['edit', 'delete'],
            'slider' => ['edit', 'delete'],
        ],
    ],

];
