<?php

$EM_CONF[$_EXTKEY] = [
    'title' => '[ThreeAM] Free Content Mode',
    'description' => 'Adds a custom context menu option to make a page content mode FREE.',
    'category' => 'plugin',
    'author' => 'Mohsin Khan',
    'author_email' => 'mohsin@3am-tech.com',
    'state' => 'stable',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.2',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
