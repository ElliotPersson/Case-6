<?php 

require("db_connection.php");

if (!isset($_GET['id'])) {
    echo "Error: Business ID not provided!";
    exit;
}



$business_id = $_GET['id'];


try { $sql = "SELECT * FROM business WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $business_id]);
    $business = $stmt->fetch();

    if (!$business) {
        echo "Error: Business not found!";
        exit;
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = $_POST['name'];
    $address = $_POST['address'];
    $open_hours = $_POST['open_hours'];
    $category_id = $_POST['category'];
    $image_url = $business['image_url'];
    
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $img_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image!";
            exit;

        }

        if ($_FILES["image"]["size"] > 500000) {
            echo "File is too big!";
            exit;
        }

        if ($img_file_type !== "jpg" && $img_file_type !== "png" && $img_file_type !== "jpeg" && $img_file_type !== "gif") {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed!";
            exit;
        }
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_url = $target_file;
        } else {
            echo "There was an error uploading the file!";
            exit;
        }
    }
    
    try {
        $sql = "UPDATE business 
                SET name = :name, address = :address, open_hours = :open_hours, image_url = :image_url, category_id = :category_id 
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':address' => $address,
            ':open_hours' => $open_hours,
            ':image_url' => $image_url,
            ':category_id' => $category_id,
            ':id' => $business_id
        ]);

        header("Location: view_business.php");
        exit;
    } catch (PDOException $e) {
        echo "Error updating business: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Business</title>
</head>
<body>
    <h1>Edit Business</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Business Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($business['name']) ?>" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?= htmlspecialchars($business['address']) ?>" required><br>

        <label for="open_hours">Open Hours:</label>
        <input type="text" id="open_hours" name="open_hours" value="<?= htmlspecialchars($business['open_hours']) ?>" required><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*"><br>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <?php 
           
            $sql = "SELECT * FROM category";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $categories = $stmt->fetchAll();
            foreach($categories as $category) {
                $selected = $category['id'] == $business['category_id'] ? "selected" : "";
                echo "<option value=\"{$category['id']}\" $selected>{$category['category_name']}</option>";
            }
            ?>
        </select><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>