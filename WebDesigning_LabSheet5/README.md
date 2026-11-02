# Web Designing - Lab Sheet 5 (MCA108P) - Apache + Python + MySQL

One file per question; each starts with its question as a comment.

- `Q01_apache_python_cgi.py` - Q1: Configure Apache web server to execute Python CGI scripts or WSGI applications (mod_wsgi) and verify with a 'Hello World' Python script.
- `Q02_install_mysql_connector.py` - Q2: Install Python MySQL connector libraries (mysql-connector-python or PyMySQL) in the local python environment.
- `Q03_mysql_server_version.py` - Q3: Write a Python script to connect to a MySQL database server and execute a query returning the database server version.
- `Q04_create_database_and_table.py` - Q4: Create a Python script that connects to MySQL and creates a database named python_web_db with a table users.
- `Q05_insert_many_users.py` - Q5: Write a Python script to insert multiple user records into the MySQL database using executemany() method.
- `Q06_retrieve_users_html.py` - Q6: Develop a Python script that retrieves all records from the users table and formats them into an HTML response string.
- `Q07_cgi_form_insert.py` - Q7: Write a Python CGI script that reads form input data via cgi module and inserts the submitted data into MySQL.
- `Q08_update_user_profile.py` - Q8: Implement a Python script to update user profile information in MySQL based on a given user ID.
- `Q09_delete_with_exception_handling.py` - Q9: Write a Python script to delete a record from the MySQL database and handle database exceptions using try-except blocks.
- `Q10_apache_htaccess_python.htaccess` - Q10: Configure Apache .htaccess files and handler directives to execute Python scripts seamlessly within web directories.
- `Q11_parameterized_query.py` - Q11: Write a Python script that connects to MySQL, performs a parameterized query to prevent SQL injection, and returns filtered results.
- `Q12_connection_pooling.py` - Q12: Implement connection pooling in Python for efficient database interaction under high Apache server concurrency.
- `Q13_error_and_access_logging.py` - Q13: Write a Python script to log database error messages and access timestamps into a dedicated server log file.
- `Q14_csv_bulk_insert.py` - Q14: Develop a Python script that reads CSV file data and bulk-inserts rows into a MySQL database table.
- `Q15_sqlalchemy_orm.py` - Q15: Write a Python script utilizing SQLAlchemy ORM to map Python classes to MySQL database tables.
- `Q16_json_endpoint.py` - Q16: Test Apache and Python integration by creating a dynamic web endpoint that generates JSON responses from MySQL queries.
- `Q17_backup_database.py` - Q17: Write a Python script to backup a MySQL database schema and data into a .sql file programmatically.
- `Q18_session_handling.py` - Q18: Implement user session handling in a Python web script interacting with MySQL backend storage.
- `Q19_validate_and_sanitize_form.py` - Q19: Write a Python script that verifies and sanitizes incoming web form inputs before executing SQL write operations.
- `Q20_venv_apache_deployment.sh` - Q20: Configure Python virtual environments (venv) and integrate them with Apache web server deployment settings.
- `Q21_summary_report.py` - Q21: Write a Python script to generate analytical summary reports (counts, averages) from MySQL data for administrative dashboards.

Setup: `pip install mysql-connector-python sqlalchemy pymysql`. Run Q04 first to create `python_web_db`/`users`. CGI scripts (Q06, Q07, Q16, Q18, Q19) go in Apache `cgi-bin`. The `cgi` module needs Python 3.12 or older.
