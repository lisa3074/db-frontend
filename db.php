<?php

try {
    $sDatabaseUserName = 'postgres';
    $sDatabasePassword = 'YOUR_PASSWORD';
    $sDatabaseConnection = "pgsql:host=localhost dbname=YOUR_DB user=postgres password=YOUR_PASSWORD";
    $aDatabaseOptions = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    
    $db = new PDO($sDatabaseConnection, $sDatabaseUserName, $sDatabasePassword, $aDatabaseOptions);
} catch (PDOException $e) {
    echo '{"status":0,"message":"cannot connect to database"}';
    exit();
}