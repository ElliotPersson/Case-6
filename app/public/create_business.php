<?php
/* Inkluderar db_connection.php filen: */
require("db_connection.php");

/* Startar session: */
session_start();

/* Om det är en post metod: */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /* Tar datan från formuläret och lägger in i variabler:  */
    $name = $_POST["name"];
    $address = $_POST["address"];
    $open_hours = $_POST["open_hours"];
    $category_id = $_POST["category"];

    /* Sätter en variabel till mappen img för att flytta bilder senare: */
    $target_dir =  "img/";

    /* Skapar variabel som inehåller vägen till mappen img i kombination med namnet på bilden: */
    $target_file = $target_dir . basename($_FILES["image"]["name"]);



    /* Gör så att man kan använda små och stora bokstäver på extensions, jpeg eller JPEG: */
    $img_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

/* Kollar om filen är en bild: */
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "The file is not an image!";

        exit;
    }


/* Kollar så att bilden inte är större än 500kb:  */
    if ($_FILES["image"]["size"] > 500000) {
        echo "The file is too large!";
        exit;
    }

/* Fel medelande om bilden inte är en jpg, jpeg, png eller gif:  */
    if ($img_file_type !== "jpg" && $img_file_type !== "jpeg" && $img_file_type !== "png" && $img_file_type !== "gif") {
        echo "Only jpg, jpeg, png or gif files are allowed!";
        exit;
    }

/* Flyttar bilden: */
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
        echo "There was an error uploading the file!";
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