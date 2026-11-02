# MCA108P – Assignment 04: Apache, PHP & MySQL

PHP + MySQL (PDO) lab programs, one folder per experiment.

## Setup
1. Install XAMPP/WAMP (or Apache + PHP 8 + MySQL on Linux).
2. Copy this folder into `htdocs` (or `/var/www/html`).
3. Run `sql/schema.sql` (creates `college_db` and all tables).
4. Set your MySQL credentials in `config/db.php`.
5. Browse to `http://localhost/MCA108P-AS04/<folder>/<file>.php`.

## Experiments
| # | Folder | Main file |
|---|--------|-----------|
| 1 | 01_apache_test | index.html |
| 2 | 02_phpinfo | phpinfo.php |
| 3 | sql | 03_create_database.sql |
| 4 | 04_pdo_connection | connect.php |
| 5 | 05_create_table | create_table.php |
| 6 | 06_insert | insert_student.php |
| 7 | 07_display | display_students.php |
| 8 | 08_update | update_student.php |
| 9 | 09_delete | delete_student.php?id=1 |
| 10 | 10_virtual_host | httpd-vhosts.conf |
| 11 | 11_server_info | server_info.php |
| 12 | 12_authentication | login.php |
| 13 | 13_file_upload | upload.php |
| 14 | 14_mysql_user | create_user.sql |
| 15 | 15_sessions | login.php |
| 16 | 16_cookies | theme.php |
| 17 | 17_csv_export | export_csv.php |
| 18 | 18_logs | simulate_requests.sh |
| 19 | 19_transactions | transfer.php |
| 20 | 20_extensions | check_extensions.php |
| 21 | 21_password_hash | register.php |

Register a user in Experiment 21 first; Experiments 12 and 15 log in with those users.
