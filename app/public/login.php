<?php
/* Startar en session: */
session_start();

require_once("db_connection.php");

// Checkar om det är en post metod: 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
// Om det är en post metod:

//Hämtar data från formuläret i HTML filen:
    $username = $_POST["username"];
    $password = $_POST["password"];


    try {

       

    } catch(PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
    }

}