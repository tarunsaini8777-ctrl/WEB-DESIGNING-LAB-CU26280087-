<?php
require __DIR__ . '/../config/db.php';

try {
    $pdo = getConnection();
    echo "Connected successfully to '" . DB_NAME . "'.<br>";
    echo "Server version: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
} catch (PDOException $e) {
    error_log($e->getMessage());
    echo "Connection failed. Check credentials in config/db.php.";
}
