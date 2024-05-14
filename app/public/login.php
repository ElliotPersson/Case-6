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

       $stmt = $conn->prepare("SELECT * FROM user WHERE user_name=:username AND user_password=:password");

       $stmt->bindParam(':username', $username);
       $stmt->bindParam(':password', $password);

       $stmt->execute();

       if ($stmt->rowCount() == 1) {

        $_SESSION['username'] = $username;

        header("Location: home.php");
        exit();

       } else {

        echo "Invalid username or password!";
       }

    } catch(PDOException $e) {

        echo "Error:  " . $e->getMessage();
    }

}