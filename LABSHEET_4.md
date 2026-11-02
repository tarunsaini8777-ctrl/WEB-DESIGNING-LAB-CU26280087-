# MCA108P-AS05: Apache, Python & MySQL

All programs in one file. Copy each block into the file named above it.

**Setup:** Install Python 3.10+, MySQL and Apache, run `pip install -r requirements.txt`, set your MySQL password in `config.py`, then run Experiment 4 and 5 first (they create and fill the `users` table).

## Index

1. [Experiment 1](#experiment-1)
2. [Experiment 2](#experiment-2)
3. [Experiment 3](#experiment-3)
4. [Experiment 4](#experiment-4)
5. [Experiment 5](#experiment-5)
6. [Experiment 6](#experiment-6)
7. [Experiment 7](#experiment-7)
8. [Experiment 8](#experiment-8)
9. [Experiment 9](#experiment-9)
10. [Experiment 10](#experiment-10)
11. [Experiment 11](#experiment-11)
12. [Experiment 12](#experiment-12)
13. [Experiment 13](#experiment-13)
14. [Experiment 14](#experiment-14)
15. [Experiment 15](#experiment-15)
16. [Experiment 16](#experiment-16)
17. [Experiment 17](#experiment-17)
18. [Experiment 18](#experiment-18)
19. [Experiment 19](#experiment-19)
20. [Experiment 20](#experiment-20)
21. [Experiment 21](#experiment-21)

---

## Common Files

**`config.py`**

````python
"""Shared settings. Override with environment variables if needed."""
import os

DB_CONFIG = {
    "host":     os.getenv("DB_HOST", "localhost"),
    "user":     os.getenv("DB_USER", "root"),
    "password": os.getenv("DB_PASS", ""),       # set your MySQL password
    "port":     int(os.getenv("DB_PORT", "3306")),
}
DB_NAME = "python_web_db"
````

**`db.py`**

````python
"""Shared connection helper used by all experiments."""
import mysql.connector
from config import DB_CONFIG, DB_NAME


def get_connection(use_database=True):
    cfg = dict(DB_CONFIG)
    if use_database:
        cfg["database"] = DB_NAME
    return mysql.connector.connect(**cfg)
````

**`requirements.txt`**

````text
mysql-connector-python>=8.0
PyMySQL>=1.1
SQLAlchemy>=2.0
````

**`sql_schema.sql`**

````sql
CREATE DATABASE IF NOT EXISTS python_web_db;
USE python_web_db;
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  age INT,
  department VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
````

---

## Experiment 1

**Aim:** Configure Apache web server to execute Python CGI scripts or WSGI applications (mod_wsgi) and verify with a 'Hello World' Python script.

**`01_apache_python/apache-cgi.conf`**

````apache
# Ubuntu: sudo a2enmod cgi   (XAMPP: LoadModule cgi_module modules/mod_cgi.so)
ScriptAlias /pycgi/ "/var/www/html/MCA108P-AS05/"
<Directory "/var/www/html/MCA108P-AS05/">
    Options +ExecCGI
    AddHandler cgi-script .py
    Require all granted
</Directory>

# ---- mod_wsgi alternative ----
# Ubuntu: sudo apt install libapache2-mod-wsgi-py3 && sudo a2enmod wsgi
# WSGIScriptAlias /hellowsgi /var/www/html/MCA108P-AS05/01_apache_python/hello_wsgi.py
````

**`01_apache_python/hello.py`**

````python
#!/usr/bin/env python3
# CGI Hello World. Windows/XAMPP: change shebang to e.g. #!C:/Python312/python.exe
print("Content-Type: text/html\n")
print("<html><body><h1>Hello World from Python CGI!</h1></body></html>")
````

**`01_apache_python/hello_wsgi.py`**

````python
# WSGI Hello World for mod_wsgi
def application(environ, start_response):
    body = b"<h1>Hello World from Python WSGI!</h1>"
    start_response("200 OK", [("Content-Type", "text/html"),
                              ("Content-Length", str(len(body)))])
    return [body]
````

**`01_apache_python/steps.md`**

````markdown
# Experiment 1
1. Enable mod_cgi (or mod_wsgi) and add `apache-cgi.conf` to your Apache config.
2. `chmod +x hello.py` (Linux).
3. Restart Apache: `sudo systemctl restart apache2`.
4. Open http://localhost/pycgi/01_apache_python/hello.py
5. 500 error? Check `error.log` (shebang path, permissions, missing blank line after headers).
````

---

## Experiment 2

**Aim:** Install Python MySQL connector libraries (mysql-connector-python or PyMySQL) in the local python environment.

**`02_connector_install/install.md`**

````markdown
# Experiment 2: Install MySQL libraries
    pip install mysql-connector-python
    pip install PyMySQL
    pip install -r ../requirements.txt
````

**`02_connector_install/verify_install.py`**

````python
import importlib

for pkg in ("mysql.connector", "pymysql"):
    try:
        mod = importlib.import_module(pkg)
        print(f"[OK] {pkg} version {getattr(mod, '__version__', 'unknown')}")
    except ImportError:
        print(f"[MISSING] {pkg} -> pip install mysql-connector-python PyMySQL")
````

---

## Experiment 3

**Aim:** Write a Python script to connect to a MySQL database server and execute a query returning the database server version.

**`03_server_version/server_version.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
from mysql.connector import Error
from db import get_connection

try:
    conn = get_connection(use_database=False)
    cursor = conn.cursor()
    cursor.execute("SELECT VERSION()")
    print("MySQL Server version:", cursor.fetchone()[0])
except Error as e:
    print("Connection error:", e)
finally:
    if "conn" in locals() and conn.is_connected():
        cursor.close()
        conn.close()
````

---

## Experiment 4

**Aim:** Create a Python script that connects to MySQL and creates a database named python_web_db with a table users.

**`04_create_db_table/create_db_table.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
from mysql.connector import Error
from db import get_connection
from config import DB_NAME

try:
    conn = get_connection(use_database=False)
    cur = conn.cursor()
    cur.execute(f"CREATE DATABASE IF NOT EXISTS {DB_NAME}")
    cur.execute(f"USE {DB_NAME}")
    cur.execute("""
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            age INT,
            department VARCHAR(50),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    """)
    print(f"Database '{DB_NAME}' and table 'users' are ready.")
except Error as e:
    print("Error:", e)
finally:
    if "conn" in locals() and conn.is_connected():
        cur.close()
        conn.close()
````

---

## Experiment 5

**Aim:** Write a Python script to insert multiple user records into the MySQL database using executemany() method.

**`05_insert_many/insert_many.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
from mysql.connector import Error
from db import get_connection

users = [
    ("Amit Sharma",  "amit@example.com",  22, "MCA"),
    ("Priya Singh",  "priya@example.com", 24, "MBA"),
    ("Rahul Verma",  "rahul@example.com", 23, "MCA"),
    ("Neha Gupta",   "neha@example.com",  25, "BCA"),
    ("Karan Mehta",  "karan@example.com", 21, "BCA"),
]

try:
    conn = get_connection()
    cur = conn.cursor()
    sql = "INSERT IGNORE INTO users (name, email, age, department) VALUES (%s, %s, %s, %s)"
    cur.executemany(sql, users)
    conn.commit()
    print(cur.rowcount, "records inserted.")
except Error as e:
    print("Error:", e)
finally:
    if "conn" in locals() and conn.is_connected():
        cur.close()
        conn.close()
````

---

## Experiment 6

**Aim:** Develop a Python script that retrieves all records from the users table and formats them into an HTML response string.

**`06_html_response/users_html.py`**

````python
#!/usr/bin/env python3
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
import html
from db import get_connection


def build_html():
    conn = get_connection()
    cur = conn.cursor()
    cur.execute("SELECT id, name, email, age, department FROM users ORDER BY id")
    rows = cur.fetchall()
    cur.close()
    conn.close()

    out = ["<html><head><style>",
           "table{border-collapse:collapse}th,td{border:1px solid #999;padding:6px 10px}",
           "th{background:#2c3e50;color:#fff}</style></head><body>",
           "<h2>Users</h2><table>",
           "<tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Department</th></tr>"]
    for r in rows:
        out.append("<tr>" + "".join(f"<td>{html.escape(str(c))}</td>" for c in r) + "</tr>")
    out.append("</table></body></html>")
    return "\n".join(out)


if __name__ == "__main__":
    print("Content-Type: text/html\n")
    print(build_html())
````

---

## Experiment 7

**Aim:** Write a Python CGI script that reads form input data via cgi module and inserts the submitted data into MySQL.

**`07_cgi_form/form.html`**

````html
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Add User</title></head>
<body>
<h2>Add User</h2>
<form action="/pycgi/07_cgi_form/save_user.py" method="post">
  Name: <input type="text" name="name" required><br><br>
  Email: <input type="email" name="email" required><br><br>
  Age: <input type="number" name="age"><br><br>
  Department: <input type="text" name="department"><br><br>
  <button type="submit">Save</button>
</form>
</body></html>
````

**`07_cgi_form/save_user.py`**

````python
#!/usr/bin/env python3
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
import html
from db import get_connection

# 'cgi' is deprecated (3.11) and removed in Python 3.13: fall back to a manual parser.
try:
    import cgi
    form = cgi.FieldStorage()
    get = lambda k: form.getvalue(k, "")
except ImportError:
    from urllib.parse import parse_qs
    data = parse_qs(sys.stdin.read(int(os.environ.get("CONTENT_LENGTH") or 0)))
    get = lambda k: data.get(k, [""])[0]

print("Content-Type: text/html\n")

name, email = get("name").strip(), get("email").strip()
age, dept = get("age").strip(), get("department").strip()

if not name or not email:
    print("<p>Name and email are required.</p>")
else:
    try:
        conn = get_connection()
        cur = conn.cursor()
        cur.execute("INSERT INTO users (name, email, age, department) VALUES (%s, %s, %s, %s)",
                    (name, email, int(age) if age.isdigit() else None, dept or None))
        conn.commit()
        print(f"<p>User <b>{html.escape(name)}</b> saved (ID {cur.lastrowid}).</p>")
        cur.close()
        conn.close()
    except Exception as e:
        print(f"<p>Database error: {html.escape(str(e))}</p>")
print('<p><a href="/pycgi/07_cgi_form/../06_html_response/users_html.py">View users</a></p>')
````

---

## Experiment 8

**Aim:** Implement a Python script to update user profile information in MySQL based on a given user ID.

**`08_update/update_user.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
from mysql.connector import Error
from db import get_connection


def update_user(user_id, name=None, email=None, age=None, department=None):
    fields = {"name": name, "email": email, "age": age, "department": department}
    fields = {k: v for k, v in fields.items() if v is not None}
    if not fields:
        return "Nothing to update."
    set_clause = ", ".join(f"{col} = %s" for col in fields)      # column names are fixed above
    params = list(fields.values()) + [user_id]
    try:
        conn = get_connection()
        cur = conn.cursor()
        cur.execute(f"UPDATE users SET {set_clause} WHERE id = %s", params)
        conn.commit()
        return "Profile updated." if cur.rowcount else "No change (ID not found or same data)."
    except Error as e:
        return f"Error: {e}"
    finally:
        if "conn" in locals() and conn.is_connected():
            cur.close()
            conn.close()


if __name__ == "__main__":
    print(update_user(1, email="amit.sharma@example.com", age=23, department="MCA"))
````

---

## Experiment 9

**Aim:** Write a Python script to delete a record from the MySQL database and handle database exceptions using try-except blocks.

**`09_delete/delete_user.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
from mysql.connector import Error, IntegrityError
from db import get_connection


def delete_user(user_id):
    conn = None
    try:
        conn = get_connection()
        cur = conn.cursor()
        cur.execute("DELETE FROM users WHERE id = %s", (user_id,))
        conn.commit()
        print(f"User {user_id} deleted." if cur.rowcount else f"No user with ID {user_id}.")
    except IntegrityError as e:
        conn.rollback()
        print("Integrity error (record is referenced elsewhere):", e)
    except Error as e:
        if conn:
            conn.rollback()
        print("Database error:", e)
    finally:
        if conn and conn.is_connected():
            conn.close()


if __name__ == "__main__":
    uid = input("Enter user ID to delete: ").strip()
    if uid.isdigit():
        delete_user(int(uid))
    else:
        print("Invalid ID.")
````

---

## Experiment 10

**Aim:** Configure Apache .htaccess files and handler directives to execute Python scripts seamlessly within web directories.

**`10_htaccess/.htaccess`**

````apache
# Place in a web directory. Requires AllowOverride All (or FileInfo/Options) for this directory.
Options +ExecCGI
AddHandler cgi-script .py
DirectoryIndex index.py index.html

# Hide Python sources that are not meant to be executed directly
<FilesMatch "^(config|db)\.py$">
    Require all denied
</FilesMatch>
````

**`10_htaccess/index.py`**

````python
#!/usr/bin/env python3
print("Content-Type: text/plain\n")
print(".htaccess handler works: this Python script ran via Apache.")
````

**`10_htaccess/steps.md`**

````markdown
# Experiment 10
1. In the Apache vhost/directory config set `AllowOverride All` for the web folder.
2. Enable CGI: `sudo a2enmod cgi` and restart Apache.
3. `chmod +x index.py`
4. Open the folder URL; `index.py` should run without needing a ScriptAlias.
````

---

## Experiment 11

**Aim:** Write a Python script that connects to MySQL, performs a parameterized query to prevent SQL injection, and returns filtered results.

**`11_parameterized/search_users.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
from mysql.connector import Error
from db import get_connection


def search_users(department, min_age=0):
    conn = get_connection()
    cur = conn.cursor(dictionary=True)
    # Placeholders (%s) keep user input out of the SQL text -> prevents SQL injection
    cur.execute("SELECT id, name, email, age FROM users WHERE department = %s AND age >= %s",
                (department, min_age))
    rows = cur.fetchall()
    cur.close()
    conn.close()
    return rows


if __name__ == "__main__":
    dept = input("Department: ").strip()
    age = input("Minimum age: ").strip()
    try:
        for r in search_users(dept, int(age) if age.isdigit() else 0):
            print(r)
    except Error as e:
        print("Error:", e)
    # Injection attempt such as  MCA' OR '1'='1  is treated as a plain string and matches nothing.
````

---

## Experiment 12

**Aim:** Implement connection pooling in Python for efficient database interaction under high Apache server concurrency.

**`12_pooling/pool_demo.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
import threading
import time
from mysql.connector import pooling
from config import DB_CONFIG, DB_NAME

pool = pooling.MySQLConnectionPool(
    pool_name="web_pool",
    pool_size=5,
    pool_reset_session=True,
    database=DB_NAME,
    **DB_CONFIG,
)


def worker(n):
    conn = pool.get_connection()          # borrow from pool
    try:
        cur = conn.cursor()
        cur.execute("SELECT COUNT(*) FROM users")
        count = cur.fetchone()[0]
        time.sleep(0.2)                   # simulate work
        print(f"Thread {n}: users = {count}")
        cur.close()
    finally:
        conn.close()                      # returns connection to the pool


threads = [threading.Thread(target=worker, args=(i,)) for i in range(15)]
start = time.time()
for t in threads: t.start()
for t in threads: t.join()
print(f"15 requests served using a pool of 5 connections in {time.time() - start:.2f}s")
````

---

## Experiment 13

**Aim:** Write a Python script to log database error messages and access timestamps into a dedicated server log file.

**`13_logging/logged_db.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
import logging
from datetime import datetime
from mysql.connector import Error
from db import get_connection

LOG_FILE = os.path.join(os.path.dirname(os.path.dirname(os.path.abspath(__file__))), "logs", "db_server.log")
os.makedirs(os.path.dirname(LOG_FILE), exist_ok=True)

logging.basicConfig(filename=LOG_FILE, level=logging.INFO,
                    format="%(asctime)s | %(levelname)s | %(message)s")


def run_query(sql, params=None):
    logging.info("ACCESS | query at %s | %s", datetime.now().isoformat(timespec="seconds"), sql)
    try:
        conn = get_connection()
        cur = conn.cursor()
        cur.execute(sql, params or ())
        rows = cur.fetchall()
        cur.close()
        conn.close()
        return rows
    except Error as e:
        logging.error("DB ERROR | code=%s | %s", e.errno, e.msg)
        return None


if __name__ == "__main__":
    print(run_query("SELECT COUNT(*) FROM users"))
    print(run_query("SELECT * FROM table_that_does_not_exist"))   # logs an error
    print("Check", LOG_FILE)
````

---

## Experiment 14

**Aim:** Develop a Python script that reads CSV file data and bulk-inserts rows into a MySQL database table.

**`14_csv_import/import_csv.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
import csv
from mysql.connector import Error
from db import get_connection

csv_path = os.path.join(os.path.dirname(os.path.abspath(__file__)), "users.csv")

with open(csv_path, newline="", encoding="utf-8") as f:
    reader = csv.DictReader(f)
    rows = [(r["name"].strip(), r["email"].strip(),
             int(r["age"]) if r["age"].strip().isdigit() else None,
             r["department"].strip()) for r in reader]

try:
    conn = get_connection()
    cur = conn.cursor()
    cur.executemany("INSERT IGNORE INTO users (name, email, age, department) VALUES (%s, %s, %s, %s)", rows)
    conn.commit()
    print(f"{cur.rowcount} of {len(rows)} rows imported (duplicates skipped).")
except Error as e:
    print("Error:", e)
finally:
    if "conn" in locals() and conn.is_connected():
        cur.close()
        conn.close()
````

**`14_csv_import/users.csv`**

````csv
name,email,age,department
Sonia Kapoor,sonia@example.com,22,MCA
Vikas Rana,vikas@example.com,26,MBA
Anjali Rao,anjali@example.com,23,BCA
Deepak Jain,deepak@example.com,24,MCA
````

---

## Experiment 15

**Aim:** Write a Python script utilizing SQLAlchemy ORM to map Python classes to MySQL database tables.

**`15_sqlalchemy/orm_models.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
from datetime import datetime
from sqlalchemy import create_engine, String, Integer, DateTime, select
from sqlalchemy.orm import DeclarativeBase, Mapped, mapped_column, Session
from config import DB_CONFIG, DB_NAME

# Requires: pip install sqlalchemy pymysql
url = (f"mysql+pymysql://{DB_CONFIG['user']}:{DB_CONFIG['password']}"
       f"@{DB_CONFIG['host']}:{DB_CONFIG['port']}/{DB_NAME}")
engine = create_engine(url, echo=False)


class Base(DeclarativeBase):
    pass


class User(Base):
    __tablename__ = "users"
    id: Mapped[int] = mapped_column(Integer, primary_key=True, autoincrement=True)
    name: Mapped[str] = mapped_column(String(100), nullable=False)
    email: Mapped[str] = mapped_column(String(150), unique=True, nullable=False)
    age: Mapped[int | None] = mapped_column(Integer)
    department: Mapped[str | None] = mapped_column(String(50))
    created_at: Mapped[datetime] = mapped_column(DateTime, default=datetime.now)

    def __repr__(self):
        return f"<User {self.id} {self.name} ({self.email})>"


if __name__ == "__main__":
    Base.metadata.create_all(engine)
    with Session(engine) as session:
        if not session.scalar(select(User).where(User.email == "orm@example.com")):
            session.add(User(name="ORM User", email="orm@example.com", age=27, department="MCA"))
            session.commit()
        for u in session.scalars(select(User).order_by(User.id)):
            print(u)
````

---

## Experiment 16

**Aim:** Test Apache and Python integration by creating a dynamic web endpoint that generates JSON responses from MySQL queries.

**`16_json_endpoint/users_json.py`**

````python
#!/usr/bin/env python3
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
import json
import os
from datetime import datetime
from db import get_connection


def default(o):
    return o.isoformat() if isinstance(o, datetime) else str(o)


print("Content-Type: application/json")
print("Access-Control-Allow-Origin: *\n")

try:
    conn = get_connection()
    cur = conn.cursor(dictionary=True)
    dept = None
    for part in os.environ.get("QUERY_STRING", "").split("&"):       # ?department=MCA
        if part.startswith("department="):
            from urllib.parse import unquote_plus
            dept = unquote_plus(part.split("=", 1)[1])
    if dept:
        cur.execute("SELECT * FROM users WHERE department = %s", (dept,))
    else:
        cur.execute("SELECT * FROM users")
    rows = cur.fetchall()
    print(json.dumps({"status": "ok", "count": len(rows), "data": rows}, default=default, indent=2))
    cur.close()
    conn.close()
except Exception as e:
    print(json.dumps({"status": "error", "message": str(e)}))
````

---

## Experiment 17

**Aim:** Write a Python script to backup a MySQL database schema and data into a .sql file programmatically.

**`17_backup/backup_db.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
from datetime import datetime
from db import get_connection
from config import DB_NAME

backup_dir = os.path.join(os.path.dirname(os.path.dirname(os.path.abspath(__file__))), "backups")
os.makedirs(backup_dir, exist_ok=True)
outfile = os.path.join(backup_dir, f"{DB_NAME}_{datetime.now():%Y%m%d_%H%M%S}.sql")


def sql_value(v):
    if v is None:
        return "NULL"
    if isinstance(v, (int, float)):
        return str(v)
    s = str(v).replace("\\", "\\\\").replace("'", "\\'")
    return f"'{s}'"


conn = get_connection()
cur = conn.cursor()
cur.execute("SHOW TABLES")
tables = [t[0] for t in cur.fetchall()]

with open(outfile, "w", encoding="utf-8") as f:
    f.write(f"-- Backup of {DB_NAME} at {datetime.now()}\n")
    f.write(f"CREATE DATABASE IF NOT EXISTS `{DB_NAME}`;\nUSE `{DB_NAME}`;\n\n")
    for t in tables:
        cur.execute(f"SHOW CREATE TABLE `{t}`")
        f.write(f"DROP TABLE IF EXISTS `{t}`;\n{cur.fetchone()[1]};\n\n")
        cur.execute(f"SELECT * FROM `{t}`")
        for row in cur.fetchall():
            f.write(f"INSERT INTO `{t}` VALUES ({', '.join(sql_value(v) for v in row)});\n")
        f.write("\n")

cur.close()
conn.close()
print("Backup written to", outfile)
# Alternative: subprocess.run(["mysqldump", "-u", "root", "-p", DB_NAME, "--result-file", outfile])
````

---

## Experiment 18

**Aim:** Implement user session handling in a Python web script interacting with MySQL backend storage.

**`18_sessions/dashboard.py`**

````python
#!/usr/bin/env python3
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
import html
from session_utils import get_session_user

user = get_session_user()
if not user:
    print("Status: 302 Found")
    print("Location: login.py\n")
    sys.exit()

print("Content-Type: text/html\n")
print(f"<html><body><h2>Welcome, {html.escape(user)}</h2>"
      "<p>Your session is stored in MySQL.</p><a href='logout.py'>Logout</a></body></html>")
````

**`18_sessions/login.py`**

````python
#!/usr/bin/env python3
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
import html
from urllib.parse import parse_qs
from db import get_connection
from session_utils import verify_password, create_session

message = ""
if os.environ.get("REQUEST_METHOD") == "POST":
    data = parse_qs(sys.stdin.read(int(os.environ.get("CONTENT_LENGTH") or 0)))
    username = data.get("username", [""])[0].strip()
    password = data.get("password", [""])[0]
    conn = get_connection()
    cur = conn.cursor()
    cur.execute("SELECT id, password_hash FROM accounts WHERE username = %s", (username,))
    row = cur.fetchone()
    conn.close()
    if row and verify_password(password, row[1]):
        sid = create_session(row[0])
        print(f"Set-Cookie: sid={sid}; HttpOnly; Path=/; SameSite=Lax")
        print("Status: 302 Found")
        print("Location: dashboard.py\n")
        sys.exit()
    message = "Invalid username or password."

print("Content-Type: text/html\n")
print(f"""<html><body><h2>Login</h2><p>{html.escape(message)}</p>
<form method="post">
Username: <input name="username" required><br><br>
Password: <input type="password" name="password" required><br><br>
<button type="submit">Login</button></form></body></html>""")
````

**`18_sessions/logout.py`**

````python
#!/usr/bin/env python3
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
from session_utils import destroy_session

destroy_session()
print("Set-Cookie: sid=; Max-Age=0; Path=/")
print("Status: 302 Found")
print("Location: login.py\n")
````

**`18_sessions/session_utils.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
import hashlib
import hmac
import os
import secrets
from datetime import datetime, timedelta
from http.cookies import SimpleCookie
from db import get_connection

SESSION_HOURS = 1


def verify_password(password, stored):
    salt, h = stored.split("$")
    check = hashlib.pbkdf2_hmac("sha256", password.encode(), salt.encode(), 200_000).hex()
    return hmac.compare_digest(check, h)


def create_session(account_id):
    sid = secrets.token_hex(32)
    conn = get_connection()
    cur = conn.cursor()
    cur.execute("INSERT INTO sessions (session_id, account_id, expires_at) VALUES (%s, %s, %s)",
                (sid, account_id, datetime.now() + timedelta(hours=SESSION_HOURS)))
    conn.commit()
    conn.close()
    return sid


def get_session_user():
    """Return username for the session cookie in the request, else None."""
    cookie = SimpleCookie(os.environ.get("HTTP_COOKIE", ""))
    if "sid" not in cookie:
        return None
    conn = get_connection()
    cur = conn.cursor()
    cur.execute("""SELECT a.username FROM sessions s JOIN accounts a ON a.id = s.account_id
                   WHERE s.session_id = %s AND s.expires_at > NOW()""", (cookie["sid"].value,))
    row = cur.fetchone()
    conn.close()
    return row[0] if row else None


def destroy_session():
    cookie = SimpleCookie(os.environ.get("HTTP_COOKIE", ""))
    if "sid" in cookie:
        conn = get_connection()
        cur = conn.cursor()
        cur.execute("DELETE FROM sessions WHERE session_id = %s", (cookie["sid"].value,))
        conn.commit()
        conn.close()
````

**`18_sessions/setup_tables.py`**

````python
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
import hashlib
import secrets
from db import get_connection


def hash_password(password, salt=None):
    salt = salt or secrets.token_hex(16)
    h = hashlib.pbkdf2_hmac("sha256", password.encode(), salt.encode(), 200_000).hex()
    return f"{salt}${h}"


if __name__ == "__main__":
    conn = get_connection()
    cur = conn.cursor()
    cur.execute("""CREATE TABLE IF NOT EXISTS accounts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password_hash VARCHAR(200) NOT NULL)""")
    cur.execute("""CREATE TABLE IF NOT EXISTS sessions (
        session_id VARCHAR(64) PRIMARY KEY,
        account_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        expires_at DATETIME NOT NULL,
        FOREIGN KEY (account_id) REFERENCES accounts(id) ON DELETE CASCADE)""")
    cur.execute("INSERT IGNORE INTO accounts (username, password_hash) VALUES (%s, %s)",
                ("admin", hash_password("admin123")))
    conn.commit()
    print("Tables ready. Demo login -> admin / admin123 (change it!)")
    cur.close()
    conn.close()
````

---

## Experiment 19

**Aim:** Write a Python script that verifies and sanitizes incoming web form inputs before executing SQL write operations.

**`19_validation/form.html`**

````html
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Register User</title></head>
<body>
<h2>Register User</h2>
<form action="/pycgi/19_validation/process_form.py" method="post">
  Name: <input name="name"><br><br>
  Email: <input name="email"><br><br>
  Age: <input name="age"><br><br>
  Department: <input name="department"><br><br>
  <button type="submit">Submit</button>
</form>
</body></html>
````

**`19_validation/process_form.py`**

````python
#!/usr/bin/env python3
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
import html
from urllib.parse import parse_qs
from db import get_connection
from validators import validate_user

raw = parse_qs(sys.stdin.read(int(os.environ.get("CONTENT_LENGTH") or 0)))
data = {k: v[0] for k, v in raw.items()}
clean, errors = validate_user(data)

print("Content-Type: text/html\n")
if errors:
    print("<h3>Please fix the following:</h3><ul>")
    for e in errors:
        print(f"<li>{html.escape(e)}</li>")
    print("</ul><a href='form.html'>Back</a>")
else:
    try:
        conn = get_connection()
        cur = conn.cursor()
        cur.execute("INSERT INTO users (name, email, age, department) VALUES (%s, %s, %s, %s)",
                    (clean["name"], clean["email"], clean["age"], clean["department"]))
        conn.commit()
        conn.close()
        print("<h3>Saved successfully.</h3>")
    except Exception as e:
        print(f"<p>Database error: {html.escape(str(e))}</p>")
````

**`19_validation/validators.py`**

````python
import html
import re

EMAIL_RE = re.compile(r"^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$")
NAME_RE = re.compile(r"^[A-Za-z .'-]{2,100}$")
DEPARTMENTS = {"MCA", "MBA", "BCA", "BBA"}


def validate_user(data):
    """Return (clean_data, errors)."""
    errors, clean = [], {}

    name = " ".join(data.get("name", "").split())
    if not NAME_RE.match(name):
        errors.append("Name must be 2-100 letters (spaces, . ' - allowed).")
    clean["name"] = html.escape(name)

    email = data.get("email", "").strip().lower()
    if not EMAIL_RE.match(email) or len(email) > 150:
        errors.append("Invalid email address.")
    clean["email"] = email

    age = data.get("age", "").strip()
    if not age.isdigit() or not (16 <= int(age) <= 100):
        errors.append("Age must be a number between 16 and 100.")
    clean["age"] = int(age) if age.isdigit() else None

    dept = data.get("department", "").strip().upper()
    if dept not in DEPARTMENTS:
        errors.append("Department must be one of: " + ", ".join(sorted(DEPARTMENTS)))
    clean["department"] = dept

    return clean, errors
````

---

## Experiment 20

**Aim:** Configure Python virtual environments (venv) and integrate them with Apache web server deployment settings.

**`20_venv_deployment/apache-wsgi-venv.conf`**

````apache
# Install: sudo apt install libapache2-mod-wsgi-py3 && sudo a2enmod wsgi
<VirtualHost *:80>
    ServerName pyweb.local
    WSGIDaemonProcess pyweb python-home=/var/www/html/MCA108P-AS05/venv \
                      python-path=/var/www/html/MCA108P-AS05
    WSGIProcessGroup pyweb
    WSGIScriptAlias / /var/www/html/MCA108P-AS05/20_venv_deployment/app.wsgi

    <Directory /var/www/html/MCA108P-AS05/20_venv_deployment>
        Require all granted
    </Directory>
    ErrorLog ${APACHE_LOG_DIR}/pyweb-error.log
    CustomLog ${APACHE_LOG_DIR}/pyweb-access.log combined
</VirtualHost>
# Add "127.0.0.1 pyweb.local" to your hosts file, restart Apache, open http://pyweb.local
````

**`20_venv_deployment/app.wsgi`**

````python
# WSGI entry point that activates the project's virtual environment
import os
import sys

PROJECT = "/var/www/html/MCA108P-AS05"
SITE_PACKAGES = os.path.join(PROJECT, "venv", "lib", "python3.12", "site-packages")  # match your Python version

sys.path.insert(0, SITE_PACKAGES)
sys.path.insert(0, PROJECT)

import json
from datetime import datetime
from db import get_connection


def application(environ, start_response):
    conn = get_connection()
    cur = conn.cursor(dictionary=True)
    cur.execute("SELECT id, name, email, department FROM users")
    rows = cur.fetchall()
    conn.close()
    body = json.dumps(rows, default=str).encode()
    start_response("200 OK", [("Content-Type", "application/json"),
                              ("Content-Length", str(len(body)))])
    return [body]
````

**`20_venv_deployment/setup_venv.sh`**

````bash
#!/bin/bash
# Create and prepare a virtual environment for the project
cd "$(dirname "$0")/.."
python3 -m venv venv
source venv/bin/activate            # Windows: venv\Scripts\activate
pip install --upgrade pip
pip install -r requirements.txt
pip freeze > requirements.lock.txt
python 02_connector_install/verify_install.py
echo "venv ready at $(pwd)/venv"
````

---

## Experiment 21

**Aim:** Write a Python script to generate analytical summary reports (counts, averages) from MySQL data for administrative dashboards.

**`21_reports/report.py`**

````python
#!/usr/bin/env python3
import os, sys
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
import html
from db import get_connection


def fetch_report():
    conn = get_connection()
    cur = conn.cursor(dictionary=True)
    cur.execute("SELECT COUNT(*) AS total, ROUND(AVG(age), 1) AS avg_age, "
                "MIN(age) AS min_age, MAX(age) AS max_age FROM users")
    overall = cur.fetchone()
    cur.execute("SELECT COALESCE(department, 'N/A') AS department, COUNT(*) AS cnt, "
                "ROUND(AVG(age), 1) AS avg_age FROM users GROUP BY department ORDER BY cnt DESC")
    by_dept = cur.fetchall()
    cur.execute("SELECT DATE(created_at) AS day, COUNT(*) AS cnt FROM users "
                "GROUP BY DATE(created_at) ORDER BY day DESC LIMIT 7")
    recent = cur.fetchall()
    conn.close()
    return overall, by_dept, recent


def render_html():
    overall, by_dept, recent = fetch_report()
    rows_dept = "".join(f"<tr><td>{html.escape(str(d['department']))}</td><td>{d['cnt']}</td>"
                        f"<td>{d['avg_age']}</td></tr>" for d in by_dept)
    rows_recent = "".join(f"<tr><td>{r['day']}</td><td>{r['cnt']}</td></tr>" for r in recent)
    return f"""<html><head><meta charset="UTF-8"><title>Admin Dashboard</title><style>
body{{font-family:Arial;margin:30px}} .cards{{display:flex;gap:15px;margin-bottom:25px}}
.card{{background:#2c3e50;color:#fff;padding:15px 25px;border-radius:8px}}
.card b{{display:block;font-size:26px}} table{{border-collapse:collapse;margin-bottom:25px}}
th,td{{border:1px solid #ccc;padding:6px 14px}} th{{background:#ecf0f1}}</style></head><body>
<h2>Administrative Summary Report</h2>
<div class="cards">
 <div class="card">Total Users<b>{overall['total']}</b></div>
 <div class="card">Average Age<b>{overall['avg_age']}</b></div>
 <div class="card">Youngest<b>{overall['min_age']}</b></div>
 <div class="card">Oldest<b>{overall['max_age']}</b></div>
</div>
<h3>By Department</h3><table><tr><th>Department</th><th>Users</th><th>Avg Age</th></tr>{rows_dept}</table>
<h3>Registrations (last 7 active days)</h3><table><tr><th>Date</th><th>New Users</th></tr>{rows_recent}</table>
</body></html>"""


if __name__ == "__main__":
    if os.environ.get("GATEWAY_INTERFACE"):          # running under Apache CGI
        print("Content-Type: text/html\n")
        print(render_html())
    else:                                            # command line
        overall, by_dept, _ = fetch_report()
        print("Overall:", overall)
        for d in by_dept:
            print(d)
````

