<?php

//Anslutning till databasen:
$server_name = "mysql";
$username_db = "db_user";
$password_db = "db_password";
$db_name = "db_case";

try {
    $conn = new PDO("mysql:host=$server_name;dbname=$db_name", $username_db, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Om databas anslutningen misslyckades:
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}