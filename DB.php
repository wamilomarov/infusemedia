<?php

class DB
{
    public $connection;

    public function __construct()
    {
        $host = config("db.host");
        $db = config("db.database");
        $user = config("db.user");
        $password = config("db.password");
        $dsn = "mysql:host=$host;dbname=$db";
        $this->connection = new PDO($dsn, $user, $password);
    }
}
