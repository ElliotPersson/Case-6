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
    <title>Document</title>
    <link rel="stylesheet" href="style/view-business.css">
    <script src="confirmDelete.js"></script>
</head>
<body>
    <h1>List of businesses:</h1>
    <?php
    require("db_connection.php");

    $sql = "SELECT business.*, category.category_name, user.user_name AS owner_name 
    FROM business
    JOIN category ON business.category_id = category.id
    JOIN user ON business.user_id = user.id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $businesses =$stmt->fetchAll();

    foreach($businesses as $business) {
        echo "<div class = 'business'>";

        echo "<img src='{$business['image_url']}' alt='{$business['name']}'>";
        echo "<strong>Name:</strong> {$business['name']}";
        echo "<strong>Address:</strong> {$business['address']}";
        echo "<strong>Open Hours:</strong> {$business['open_hours']}";
        echo "<strong>Category:</strong> {$business['category_name']}";
        echo "<strong>Owner:</strong> {$business['owner_name']}";

        if ($_SESSION['user_id'] == $business['user_id']) {
            echo "<form action='delete_business.php' method='post' onsubmit='return confirmDelete()'>";
            echo "<input type='hidden' name='business_id' value='{$business['id']}'> ";
            echo "<button type='submit'>Delete</button>";
            echo "</form>";
    
            
            echo "<a href='edit_business.php?id={$business['id']}'>Edit</a>";   
        }

       

        echo "</div>";

    }
    ?>
    
</body>
</html>