<?php

return [
    // [
    //     'label' => 'Dashboard',
    //     'link' => '/admin',
    //     'icon' => 'ri-home-4-line',
    //     'permissions' => [],
    // ],
    [
        'label' => 'Event Category',
        'link' => '/admin/categories',
        'icon' => 'ri-stack-fill',
        'permissions' => ['view_event_category'],
        'sublinks' => [
            [
                'label' => 'All Categories',
                'link' => '/admin/event-categories',
                'icon' => 'ri-arrow-right-fill',
                'permissions' => ['view_event_category'],
            ],
            [
                'label' => 'New Category',
                'link' => '/admin/event-categories/create',
                'icon' => 'ri-arrow-right-fill',
                'permissions' => ['create_event_category'],
            ],
        ],
    ],
    [
        'label' => 'Events',
        'link' => '/admin/events',
        'icon' => 'ri-calendar-event-line',
        'permissions' => ['view_event'],
        'sublinks' => [
            [
                'label' => 'All Event',
                'link' => '/admin/events',
                'icon' => 'ri-arrow-right-fill',
                'permissions' => ['view_event'],
            ],
            [
                'label' => 'New Event',
                'link' => '/admin/events/create',
                'icon' => 'ri-arrow-right-fill',
                'permissions' => ['create_event'],
            ],
        ],
    ],
    // [
    //     'label' => 'Tag',
    //     'link' => '/admin/tags',
    //     'icon' => 'ri-price-tag-3-line',
    //     'permissions' => [],
    //     'sublinks' => [
    //         [
    //             'label' => 'All Tag',
    //             'link' => '/admin/tags',
    //             'icon' => 'ri-arrow-right-fill',
    //             'permissions' => [],
    //         ],
    //         [
    //             'label' => 'New Tag',
    //             'link' => '/admin/tags/create',
    //             'icon' => 'ri-arrow-right-fill',
    //             'permissions' => [],
    //         ],
    //     ],
    // ],

];
