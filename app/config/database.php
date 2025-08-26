<?php
$host     = "localhost";
$port     = "8889";        // default MySQL = 3306
$username = "root";
$password = "root";
$database = "cars-rent";

try {
    $db = new PDO("mysql:host=$host;port=$port;dbname=$database;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
