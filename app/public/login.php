<?php

/* Startar en session: */
session_start();

/* Inkluderar db_connection.php som innehåller logiken för databas uppkoppling: */
require("db_connection.php");

/* Kollar om det är en post metod: */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* Tar användarnamnet och lösenordet från formuläret och lägger det i variabler: */
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        /* Väljer alla kolumner från user tabellen där user_name kolumnen matchar med användarnamnet: */
        $sql = "SELECT * FROM user WHERE user_name = :username";
        
        /* förbereder sql innan den körs för säkerhet: */
        $stmt = $conn->prepare($sql);

        $stmt->execute([':username' => $username]);

        /* Kollar om användaren finns i databasen: */
        if ($stmt->rowCount() == 1) {
            
            /* Fetchar all information om användaren och lägger den i $user: */
            $user = $stmt->fetch();

            /* Kollar om lösenordet matchar: */
            $password_match = password_verify($password, $user['user_password']);
            
            if ($password_match) {

                /* Lägger användarens id och användarnamn i variabler: */
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['user_name'];

                /* Skickas till home.php */
                header("Location: home.php");
                exit();
            
                /* Om det inte matchar: */
            } else {
                echo "Wrong password!";
                exit;
            }
        } else {
            echo "<div class='error-message'>That user doesnt exist!</div>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<h1>Invalid request method!</h1>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/login-error.css">
</head>
<body>
    <div class="container">
    <a href="index.html" id="try-again-login">Try again</a>
    <a href="register.php" id="create-account-register">Register</a>
    </div>
</body>
</html>
