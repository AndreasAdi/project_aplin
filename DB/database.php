<?php
$dsn = "mysql:host=localhost;dbname=bioskopid;port=3306;charset=utf8mb4";
$user = "root"; // Ini default di xampp, kalau nanti deploy tergantung server kalian!
$pass = ""; // User root di xampp tidak punya password
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $db = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
    // Tanda panah pada PHP sama dengan tanda titik pada Java/C# dll
    echo $e->getMessage();
}
