<?php
/**
 * Lab Sheet 4 - Question 19: Write a PHP script implementing transaction management (beginTransaction(), commit(), rollBack()) in MySQL PDO for secure multi-table operations.
 */
// Extra table for the demo:
// CREATE TABLE enrollment_log (
//   id INT AUTO_INCREMENT PRIMARY KEY,
//   student_id INT NOT NULL,
//   action VARCHAR(100),
//   logged_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//   FOREIGN KEY (student_id) REFERENCES students(id)
// ) ENGINE=InnoDB;   -- InnoDB is required for transactions
$host = 'localhost';
$db   = 'college_db';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

try {
    $pdo->beginTransaction();

    // Operation 1: insert student
    $stmt = $pdo->prepare("INSERT INTO students (name, email, enrollment_date) VALUES (?, ?, CURDATE())");
    $stmt->execute(['Anita Verma', 'anita' . rand(1, 9999) . '@example.com']);
    $studentId = $pdo->lastInsertId();

    // Operation 2: log it in a second table
    $stmt = $pdo->prepare("INSERT INTO enrollment_log (student_id, action) VALUES (?, ?)");
    $stmt->execute([$studentId, 'Student enrolled']);

    $pdo->commit();
    echo "Transaction committed. Student ID: $studentId";
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();   // undo both inserts
    }
    echo "Transaction failed and rolled back: " . htmlspecialchars($e->getMessage());
}
