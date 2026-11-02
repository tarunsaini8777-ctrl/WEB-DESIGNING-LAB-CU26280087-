-- Experiment 3: create database
CREATE DATABASE IF NOT EXISTS college_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE college_db;

-- Experiment 5: students table
CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  enrollment_date DATE NOT NULL
);

-- Experiments 12, 15, 21: users table
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- Experiment 19: accounts table
CREATE TABLE IF NOT EXISTS accounts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  holder VARCHAR(100) NOT NULL,
  balance DECIMAL(10,2) NOT NULL DEFAULT 0
);
CREATE TABLE IF NOT EXISTS transfer_log (
  id INT AUTO_INCREMENT PRIMARY KEY,
  from_id INT, to_id INT, amount DECIMAL(10,2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
