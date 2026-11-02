<?php
// Usage: delete_student.php?id=3
require __DIR__ . '/../config/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("Invalid or missing 'id' parameter.");
}

try {
    $stmt = getConnection()->prepare("DELETE FROM students WHERE id = :id");
    $stmt->execute([':id' => $id]);
    echo $stmt->rowCount() ? "Student $id deleted." : "No student found with ID $id.";
} catch (PDOException $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
// Note: deleting via GET is for lab demonstration only; use POST + CSRF tokens in production.
