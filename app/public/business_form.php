
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
    <title>Case 6 - Create</title>
    <link rel="stylesheet" href="style/business-form.css">
</head>
<body>
    <h1>New business: </h1>
<!-- Formulär för att skapa businesses, enctype="multipart/form-data" för att ladda upp bilder: -->
    <form action="create_business.php" method="post" enctype="multipart/form-data">
        
        <!-- Namn: -->
        <label for="name">Business name:</label>
        <input type="text" id="name" name="name" class="input-text" required>

        <!-- Address: -->
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" class="input-text" required>

        <!-- Öppettider: -->
        <label for="open_hours">Open hours:</label>
        <input type="text" id="open_hours" name="open_hours" class="input-text" required> 

        <!-- Bild: -->
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" class="input-file" required>

        <!-- kategori: -->
        <label for="category">Category:</label>
        <select id="category" name="category" required>
            
            <?php 
            require("db_connection.php");
            $sql = "SELECT * FROM category";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $categories = $stmt->fetchAll();
            foreach($categories as $category) {
                
                echo 
                "<option class='select-catagory' value=\"{$category['id']}\">{$category['category_name']}</option>";

                
            }
            ?>
        </select>

        <button class="create-button" type="submit">Create</button>


    </form>
</body>

</html>

