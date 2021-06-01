<?php

include "config.php";
include "DB.php";

try {
    $DB = new DB();
}
catch (Exception $exception)
{
    exit;
}

$userData = [
    'ip_address' => getIpAddress(),
    'user_agent' => $_SERVER["HTTP_USER_AGENT"],
    'view_date' => date("Y-m-d H:i:s"),
    'page_url' => getPageUrl()
];

$DB->updateOrCreate($userData);

$name = "./image.png";
$fp = fopen($name, 'rb');

header("Content-Type: image/png");
header("Content-Length: " . filesize($name));

fpassthru($fp);
