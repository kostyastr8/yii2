<?php
return [
    'view1' => [
        'type' => 2,
        'description' => 'per_view1',
    ],
    'view2' => [
        'type' => 2,
        'description' => 'per_view2',
    ],
    'view3' => [
        'type' => 2,
        'description' => 'per_view3',
    ],
    'client' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'view3',
        ],
    ],
    'manager' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'view2',
            'client',
        ],
    ],
    'admin' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'view1',
            'client',
            'manager',
        ],
    ],
];
