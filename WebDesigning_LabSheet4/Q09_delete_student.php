<?php
/**
 * Lab Sheet 4 - Question 9: Implement a PHP script to delete a specific student record from the database using a URL parameter (GET request).
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

// Usage: delete_student.php?id=3
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    die("Invalid or missing student ID.");
}

$stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
$stmt->execute([':id' => $id]);

echo $stmt->rowCount() ? "Student ID $id deleted." : "No student found with ID $id.";
