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

function config($key)
{
    $keys = explode('.', $key);
    global $config;
    $data = $config;
    foreach ($keys as $key) {
        if (isset($data[$key])) {
            $data = $data[$key];
        } else {
            return null;
        }
    }
    return $data;
}

function getIpAddress()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getPageUrl()
{
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
