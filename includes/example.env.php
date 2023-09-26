<?php
return (object)[
    'ip'        => $_SERVER['REMOTE_ADDR'],
    'debugIPs'  => ['192.168.0.1'],
    'serverIPs' => ['192.168.0.1'],
    'debugMode' => true,
    'connects'  => [
        'conName' => (object)[
            'host' => 'localhost',
            'name' => 'dbName',
            'user' => 'root',
            'pass' => ''
        ]
    ],

    'clientDomains' => [
        'clientName' => 'example.com'
    ],

    'debugOnlyFolders' => [
        'test',
    ],

    'timeZone' => 3
];