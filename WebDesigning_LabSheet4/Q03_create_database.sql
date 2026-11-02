/* Lab Sheet 4 - Question 3: Install and connect to the MySQL database server via command line or graphical interface (e.g., phpMyAdmin), creating a new database named college_db. */

-- Run in MySQL command line:  mysql -u root -p
-- or paste into the SQL tab of phpMyAdmin (http://localhost/phpmyadmin)

CREATE DATABASE IF NOT EXISTS college_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

SHOW DATABASES;
USE college_db;
SELECT DATABASE();
