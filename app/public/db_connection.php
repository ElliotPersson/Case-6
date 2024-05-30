<?php

//Konfigurerar databas anslutning:
$server_name = "mysql";
$username_db = "db_user";
$password_db = "db_password";
$db_name = "db_case";

try {
    
    /* Skapar PDO objekt med variablerna: */
    $conn = new PDO("mysql:host=$server_name;dbname=$db_name", $username_db, $password_db);
    
    /* Hanterar fel med PDOExeption: */
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
} catch(PDOException $e) {

    /* Om databas uppkopplingen misslyckades:  */
    echo "Connection failed: " . $e->getMessage();
}
