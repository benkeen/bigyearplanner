<?php

$dbh = "";

function connect()
{
    global $dbh;

    $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    );
    $hostname = "localhost";
    $db_name = "bigyearplanner";
    $port = "";
    $username = "root";
    $password = "root";

    try {
        $dsn = sprintf("mysql:host=%s;port=%s;dbname=%s;charset=utf8", $hostname, $port, $db_name);
        $dbh = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        print_r($e->getMessage());
        exit;
    }
}
