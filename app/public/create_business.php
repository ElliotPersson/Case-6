<?php
require("db_connection.php");

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST["name"];
    $address = $_POST["address"];
    $open_hours = $_POST["open_hours"];
    $category_id = $_POST["category"];

   
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    
    $img_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit;
    }


  
    if ($_FILES["image"]["size"] > 500000) {
        echo "File is too large.";
        exit;
    }

    
    if ($img_file_type !== "jpg" && $img_file_type !== "png" && $img_file_type !== "jpeg" && $img_file_type !== "gif") {
        echo "Only JPG, JPEG, PNG or GIF files are allowed!";
        exit;
    }

    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_url = $target_file;

        
        $sql = "INSERT INTO business (name, address, open_hours, image_url, date_updated, user_id, category_id)
                VALUES (:name, :address, :open_hours, :image_url, NOW(), :user_id, :category_id)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':address' => $address,
            ':open_hours' => $open_hours,
            ':image_url' => $image_url,
            ':user_id' => $_SESSION['user_id'],
            ':category_id' => $category_id
        ]);

        echo "<h1>Business created successfully!</h1>";
        echo "<a href='view_business.php'>View all businesses here</a>";
    } else {
        echo "There was an error uploading the file.";
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
    <title>Business created</title>
    <link rel="stylesheet" href="style/create-business.css">
</head>
<body>
    
</body>
</html>

