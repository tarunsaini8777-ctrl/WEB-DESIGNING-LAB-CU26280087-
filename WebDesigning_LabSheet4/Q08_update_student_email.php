<?php
/**
 * Lab Sheet 4 - Question 8: Write a PHP script to update an existing student's email address in the database based on their student ID.
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

$id       = 1;
$newEmail = "new.email@example.com";

if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}

$stmt = $pdo->prepare("UPDATE students SET email = :email WHERE id = :id");
$stmt->execute([':email' => $newEmail, ':id' => $id]);

echo $stmt->rowCount() ? "Email updated successfully." : "No student found with ID $id (or email unchanged).";
