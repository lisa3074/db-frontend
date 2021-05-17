<?php

try {
    $sDatabaseUserName = 'postgres';
    $sDatabasePassword = 'DetteEr1Password';
    $sDatabaseConnection = "pgsql:host=localhost dbname=db_exam user=postgres password=DetteEr1Password";
    $aDatabaseOptions = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    
    $db = new PDO($sDatabaseConnection, $sDatabaseUserName, $sDatabasePassword, $aDatabaseOptions);
} catch (PDOException $e) {
    echo '{"status":0,"message":"cannot connect to database"}';
    exit();
}