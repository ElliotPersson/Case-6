<?php

require "db_connection.php";

$sql= "CREATE TABLE IF NOT EXISTS `user` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `user_password` VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL
  );";

$conn->exec($sql);
