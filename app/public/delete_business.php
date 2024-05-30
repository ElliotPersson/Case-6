<?php
/* Inkluderar db_connection.php */
require("db_connection.php");

/* Kollar så att det är en post metod: */
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $business_id = $_POST["business_id"];


    try {
        
        $sql = "DELETE FROM business WHERE id = :business_id";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':business_id' => $business_id
        ]);

        header("Location: view_business.php");
        exit();
    
    } catch (PDOException $e ) {
        echo "Error: " . $e->getMessage();

    }

} else {
    echo "Invalid request method!";
}



