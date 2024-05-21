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

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(); 

           
            $password_match = password_verify($password, $user['user_password']);
            if (!$password_match) {
                echo "Password doesn't match";
                exit;
            }

            
            session_start();
            $_SESSION['user_id'] = $user['id'];

           
            header("Location: home.php");
            exit();
        } else {
            
            echo "<div class='error-message'>Invalid username or password!</div>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method!";
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
    <a href="index.html">Try again</a>
    <a href="register.php">Create an account</a>
</body>

</html>
