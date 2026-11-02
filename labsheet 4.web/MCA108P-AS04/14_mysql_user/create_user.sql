-- Run as root: mysql -u root -p < create_user.sql
CREATE USER IF NOT EXISTS 'college_app'@'localhost' IDENTIFIED BY 'StrongPass@123';
GRANT SELECT, INSERT, UPDATE ON college_db.* TO 'college_app'@'localhost';
FLUSH PRIVILEGES;

SHOW GRANTS FOR 'college_app'@'localhost';

-- Verify: log in as college_app; DELETE or DROP should fail with "command denied".
-- Then set DB_USER = 'college_app' and DB_PASS in config/db.php.
-- (Experiment 9 needs DELETE; grant it temporarily or use root for that script.)
