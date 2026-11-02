#!/usr/bin/env python3
# Lab Sheet 5 - Question 7: Write a Python CGI script that reads form input data via cgi module and inserts the submitted data into MySQL.
# NOTE: the cgi module was removed in Python 3.13. Use Python 3.12 or older
# (or `pip install legacy-cgi`) for this lab.
import cgi
import html
import mysql.connector
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

form = cgi.FieldStorage()
name = form.getfirst("name", "").strip()
email = form.getfirst("email", "").strip()
age = form.getfirst("age", "").strip()

print("Content-Type: text/html\n")
print("<html><body>")

if name and email and age.isdigit():
    try:
        conn = mysql.connector.connect(**DB_CONFIG)
        cur = conn.cursor()
        cur.execute("INSERT INTO users (name, email, age) VALUES (%s, %s, %s)", (name, email, int(age)))
        conn.commit()
        print(f"<p style='color:green'>Saved: {html.escape(name)}</p>")
        cur.close(); conn.close()
    except mysql.connector.Error as e:
        print(f"<p style='color:red'>Database error: {html.escape(str(e))}</p>")
else:
    print("""
    <h2>Add User</h2>
    <form method="post" action="">
        Name: <input name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Age: <input type="number" name="age" required><br><br>
        <button type="submit">Submit</button>
    </form>""")
print("</body></html>")
