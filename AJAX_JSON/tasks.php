<?php

$tasks = [
    [
        'id' => 1,
        'description' => 'Complete project documentation',
        'priority' => 'High'
    ],
    [
        'id' => 2,
        'description' => 'Review pull requests',
        'priority' => 'Medium'
    ],
    [
        'id' => 3,
        'description' => 'Update dependencies',
        'priority' => 'Low'
    ],
    [
        'id' => 4,
        'description' => 'Fix critical bug in authentication',
        'priority' => 'High'
    ],
    [
        'id' => 5,
        'description' => 'Refactor database queries',
        'priority' => 'Medium'
    ],
    [
        'id' => 6,
        'description' => 'Write unit tests',
        'priority' => 'High'
    ],
    [
        'id' => 7,
        'description' => 'Update README file',
        'priority' => 'Low'
    ],
    [
        'id' => 8,
        'description' => 'Scan Vulnerabilities',
        'priority' => 'Medium'
    ],
    [
        'id' => 9,
        'description' => 'Schedule team meeting',
        'priority' => 'Medium'
    ]
];


header('Content-Type: application/json');


header('Access-Control-Allow-Origin: *');


echo json_encode($tasks);
?>
