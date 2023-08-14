<?php

return [
    [
        'label' => 'Dashboard',
        'link' => '/admin',
        'icon' => 'ri-home-4-line',
        'permissions' => [],
    ],
    [
        'label' => 'Event Category',
        'link' => '/admin/categories',
        'icon' => 'ri-stack-fill',
        'permissions' => [],
        'sublinks' => [
            [
                'label' => 'All Categories',
                'link' => '/admin/categories',
                'icon' => 'ri-arrow-right-fill',
                'permissions' => [],
            ],
            [
                'label' => 'New Category',
                'link' => '/admin/categories/create',
                'icon' => 'ri-arrow-right-fill',
                'permissions' => [],
            ],
        ],
    ],
    [
        'label' => 'Events',
        'link' => '/admin/events',
        'icon' => 'ri-calendar-event-line',
        'permissions' => [],
        'sublinks' => [
            [
                'label' => 'All Event',
                'link' => '/admin/events',
                'icon' => 'ri-arrow-right-fill',
                'permissions' => [],
            ],
            [
                'label' => 'New Tag',
                'link' => '/admin/events/create',
                'icon' => 'ri-arrow-right-fill',
                'permissions' => [],
            ],
        ],
    ],
    [
        'label' => 'Tag',
        'link' => '/admin/tags',
        'icon' => 'ri-price-tag-3-line',
        'permissions' => [],
        'sublinks' => [
            [
                'label' => 'All Tag',
                'link' => '/admin/tags',
                'icon' => 'ri-arrow-right-fill',
                'permissions' => [],
            ],
            [
                'label' => 'New Tag',
                'link' => '/admin/tags/create',
                'icon' => 'ri-arrow-right-fill',
                'permissions' => [],
            ],
        ],
    ],

    // [
    // 	'label'       => 'Media',
    // 	'link'        => '/admin/media',
    // 	'icon'        => 'ri-folder-2-line',
    // 	'permissions' => []
    // ],

];
