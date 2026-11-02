<?php
/**
 * Lab Sheet 4 - Question 4: Write a PHP script to establish a secure database connection to MySQL using PDO (PHP Data Objects) and verify successful connection status.
 */
$host = 'localhost';
$db   = 'college_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
    echo "Connection successful to database: " . $db;
} catch (PDOException $e) {
    error_log($e->getMessage());   // log details, don't expose them to users
    die("Connection failed. Please check your credentials.");
}
