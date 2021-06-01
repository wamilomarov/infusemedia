<?php

$config = [
    'db' => [
        'host' => '127.0.0.1',
        'port' => '3306',
        'user' => 'root',
        'password' => '',
        'database' => 'infusemedia',
    ]
];

function config($key){
    $keys = explode('.', $key);
    global $config;
    $data = $config;
    foreach ($keys as $key) {
        if (isset($data[$key]))
        {
            $data = $data[$key];
        }
        else
        {
            return null;
        }
    }
    return $data;
}
