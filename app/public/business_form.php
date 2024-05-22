<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create a new business: </h1>
<!-- Formulär för att skapa businesses, enctype="multipart/form-data" för att ladda upp bilder: -->
    <form action="create_business.php" method="post" enctype="multipart/form-data">
        
        <!-- Namn: -->
        <label for="name">Business name:</label>
        <input type="text" id="name" name="name" required><br>

        <!-- Address: -->
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br>

        <!-- Öppettider: -->
        <label for="open_hours">Open hours:</label>
        <input type="text" id="open_hours" name="open_hours" required> <br>

        <!-- Bild: -->
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>

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
                "<option value=\"{$category['id']}\">{$category['category_name']}</option>";

                
            }
            ?>
        </select>

        <button type="submit">Create</button>


    </form>
</body>

</html>
