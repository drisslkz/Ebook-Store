<?php

$dsn = "mysql:host=localhost;dbname=shop_db";
$username = "(set-your-root)";
$password = "(set-your-password)";

try {
   $conn = new PDO($dsn, $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   die("Connection failed: " . $e->getMessage());
}

?>
