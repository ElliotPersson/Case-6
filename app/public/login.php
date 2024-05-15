<?php


// Inkluderar filen db_connection.php
require("db_connection.php");

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

       //Skickar användaren till home.php:
        header("Location: home.php");
        exit();

       } else {
        
        //Medelande för fel användarnamn eller lösenord:
        echo "<div class='error-message'>Invalid username or password!</div>";
       }    

    } catch(PDOException $e) {

        echo "Error:  " . $e->getMessage();
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/login-error.css">
</head>
<body>

<a href="index.html">Try again</a>
<a href="">Create an account</a>


</body>
</html>
