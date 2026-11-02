/* Lab Sheet 4 - Question 14: Configure MySQL user privileges by creating a dedicated database user with restricted permissions (SELECT, INSERT, UPDATE) for the web application. */

-- Run as root in MySQL / phpMyAdmin SQL tab

CREATE USER 'college_app'@'localhost' IDENTIFIED BY 'StrongP@ssw0rd!';

GRANT SELECT, INSERT, UPDATE ON college_db.* TO 'college_app'@'localhost';

FLUSH PRIVILEGES;

-- Verify
SHOW GRANTS FOR 'college_app'@'localhost';

-- Test: login as the new user (mysql -u college_app -p)
--   INSERT / UPDATE / SELECT  -> allowed
--   DELETE / DROP             -> ERROR 1142 (command denied)

-- To remove later:
-- DROP USER 'college_app'@'localhost';
