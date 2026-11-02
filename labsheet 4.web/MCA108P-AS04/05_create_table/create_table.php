<?php
require __DIR__ . '/../config/db.php';

try {
    $pdo = getConnection();
    $sql = "CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(150) NOT NULL UNIQUE,
        enrollment_date DATE NOT NULL
    )";
    $pdo->exec($sql);
    echo "Table 'students' created successfully.";
} catch (PDOException $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
