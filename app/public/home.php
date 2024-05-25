<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case 6 - Home</title>
    <link rel="stylesheet" href="style/home.css">
</head>
<body>
<div class="container">
     
    <h1 class="title">Welcome</h1>
    <h1 class="title-2"> <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <nav class="nav">
        <a href="business_form.php" class="nav-link">Create businesses</a><br>
        <a href="view_business.php" class="nav-link-view">View businesses</a>
        <a href="logout.php" class="nav-link">Logout</a>
    </nav>
    </div>
</body>
</html>