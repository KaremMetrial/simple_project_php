<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "auth_sys";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
}
