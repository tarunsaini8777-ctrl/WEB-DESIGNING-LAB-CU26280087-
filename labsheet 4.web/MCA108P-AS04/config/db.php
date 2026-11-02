<?php
// Shared PDO connection used by all experiments.
const DB_HOST = 'localhost';
const DB_NAME = 'college_db';
const DB_USER = 'root';   // change to 'college_app' after Experiment 14
const DB_PASS = '';       // set your MySQL password

function getConnection(): PDO {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    return new PDO($dsn, DB_USER, DB_PASS, $options);
}
