<?php
/**
 * Lab Sheet 4 - Question 6: Write a PHP script to insert a new student record into the students table using prepared statements to prevent SQL injection.
 */
$host = 'localhost';
$db   = 'college_db';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

$name  = "Rahul Sharma";
$email = "rahul@example.com";
$date  = date('Y-m-d');

$stmt = $pdo->prepare("INSERT INTO students (name, email, enrollment_date) VALUES (:name, :email, :date)");
$stmt->execute([
    ':name'  => $name,
    ':email' => $email,
    ':date'  => $date,
]);

echo "Student inserted with ID: " . $pdo->lastInsertId();
