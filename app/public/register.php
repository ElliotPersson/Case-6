<?php

require("db_connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        
        $sql = "SELECT * FROM user WHERE user_name = :username";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':username' => $username
        ]);

        $user = $stmt->fetch();

        

        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        

        $sql = "INSERT INTO user (user_name, user_password) VALUES (:username, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => $password_hashed
        ]);


        
        header("Location: index.html");
        exit();
    } catch (PDOException $e) {

        /* Om användaren redan finns i databasen */
        if($e->getCode() == "23000") {
            
            
            echo "That user already exists!";

        } else {

            echo "Error: " . $e->getMessage();
        }


    }
}

