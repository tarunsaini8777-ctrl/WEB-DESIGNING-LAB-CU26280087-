<?php
/**
 * Lab Sheet 4 - Question 17: Write a PHP script that exports MySQL database table data into a downloadable CSV file format.
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

$stmt = $pdo->query("SELECT id, name, email, enrollment_date FROM students");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="students_' . date('Ymd') . '.csv"');

$out = fopen('php://output', 'w');
fputcsv($out, ['ID', 'Name', 'Email', 'Enrollment Date']);   // header row

while ($row = $stmt->fetch()) {
    fputcsv($out, $row);
}
fclose($out);
exit;
