# Web Designing - Lab Sheet 4 (MCA108P)

One file per question (Apache, PHP, MySQL). Each file starts with its question as a comment.

- `Q01_apache_test_page.html` - Q1: Configure and verify the Apache web server installation locally, ensuring the default test page (index.php or index.html) loads correctly on http://localhost.
- `Q02_phpini_phpinfo.php` - Q2: Configure the php.ini file to enable error reporting (display_errors = On) and verify settings using a phpinfo() script.
- `Q03_create_database.sql` - Q3: Install and connect to the MySQL database server via command line or graphical interface (e.g., phpMyAdmin), creating a new database named college_db.
- `Q04_pdo_connection.php` - Q4: Write a PHP script to establish a secure database connection to MySQL using PDO (PHP Data Objects) and verify successful connection status.
- `Q05_create_students_table.php` - Q5: Create a MySQL database table named students with columns (id, name, email, enrollment_date) using SQL queries executed via PHP script.
- `Q06_insert_student.php` - Q6: Write a PHP script to insert a new student record into the students table using prepared statements to prevent SQL injection.
- `Q07_display_students.php` - Q7: Develop a PHP script to retrieve and display all records from the students table inside a styled HTML table.
- `Q08_update_student_email.php` - Q8: Write a PHP script to update an existing student's email address in the database based on their student ID.
- `Q09_delete_student.php` - Q9: Implement a PHP script to delete a specific student record from the database using a URL parameter (GET request).
- `Q10_apache_virtual_host.conf` - Q10: Configure Apache virtual hosts (httpd-vhosts.conf) to host a local development project directory under a custom domain name (e.g., http://collegeweb.local).
- `Q11_server_variables.php` - Q11: Write a PHP script that checks Apache server environment variables and server software details using $_SERVER superglobal.
- `Q12_user_authentication.php` - Q12: Implement user authentication in PHP by verifying submitted username and password against stored MySQL database records.
- `Q13_file_upload.php` - Q13: Write a PHP script that handles file uploads ($_FILES), validates file size and extension, and stores images in an Apache server directory.
- `Q14_mysql_user_privileges.sql` - Q14: Configure MySQL user privileges by creating a dedicated database user with restricted permissions (SELECT, INSERT, UPDATE) for the web application.
- `Q15_session_management.php` - Q15: Write a PHP script demonstrating session management (session_start(), $_SESSION) to maintain user login state across multiple pages.
- `Q16_cookie_management.php` - Q16: Implement cookie management in PHP (setcookie()) to store and retrieve user preferences like theme color.
- `Q17_export_csv.php` - Q17: Write a PHP script that exports MySQL database table data into a downloadable CSV file format.
- `Q18_apache_logs_test.sh` - Q18: Test Apache server performance and error logging by examining error.log and access.log files during simulated requests.
- `Q19_pdo_transaction.php` - Q19: Write a PHP script implementing transaction management (beginTransaction(), commit(), rollBack()) in MySQL PDO for secure multi-table operations.
- `Q20_php_extensions.php` - Q20: Configure PHP extensions (such as mysqli, pdo_mysql, mbstring, curl) in php.ini and verify their active status.
- `Q21_password_hashing.php` - Q21: Write a PHP script utilizing password_hash() and password_verify() to securely store and authenticate hashed user passwords in MySQL.

Place PHP files in `htdocs` (XAMPP) and open via `http://localhost/<file>`. Create `college_db` first (Q03).
