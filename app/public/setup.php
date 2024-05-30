<?php

require "db_connection.php";

/* Skapar user tabellen om den inte redan finns: */
$sql = "CREATE TABLE IF NOT EXISTS `user` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `user_password` VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL
  );";

$conn->exec($sql);

/* Skapar category tabellen om den inter redan finns: */
$sql = "CREATE TABLE IF NOT EXISTS `category` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_name` VARCHAR(20) COLLATE utf8mb4_general_ci DEFAULT NULL
    );";

$conn->exec($sql);


/* Lägger till kategorierna i category tabellen om de inte redan finns: */
$categories = ['Restaurants', 'Entertainment', 'Technology'];

foreach ($categories as $category) {
    $stmt = $conn->prepare("INSERT INTO `category` (`category_name`)
                            SELECT :category_name WHERE NOT EXISTS (
                                SELECT 1 FROM `category` WHERE `category_name` = :category_name
                            )");
    $stmt->execute(['category_name' => $category]);
}
/* Lägger till business tabellen om den inte redan finns: */
$sql = "CREATE TABLE IF NOT EXISTS `business` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `address` VARCHAR(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `open_hours` VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `image_url` VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `date_updated` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `user_id` INT DEFAULT NULL,
    `category_id` INT DEFAULT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`),
    FOREIGN KEY (`category_id`) REFERENCES `category`(`id`)
)";
$conn->exec($sql);

/* Skickar användaren tillbaka till index.html */
header("Location: index.html");