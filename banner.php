<?php

include "config.php";
include "DB.php";

try {
    $DB = new DB();
    if ($DB)
    {
        echo "Database connection is successful";
    }
}
catch (Exception $exception)
{
    echo "Could not connect to database";
    exit;
}


