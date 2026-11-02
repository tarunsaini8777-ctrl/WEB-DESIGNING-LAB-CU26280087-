#!/usr/bin/env python3
# Lab Sheet 5 - Question 6: Develop a Python script that retrieves all records from the users table and formats them into an HTML response string.
import html
import mysql.connector
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

conn = mysql.connector.connect(**DB_CONFIG)
cursor = conn.cursor()
cursor.execute("SELECT id, name, email, age FROM users ORDER BY id")
rows = cursor.fetchall()
cursor.close()
conn.close()

html_out = """<html><head><title>Users</title>
<style>
 body{font-family:Arial;margin:30px}
 table{border-collapse:collapse;width:80%}
 th,td{border:1px solid #ccc;padding:8px;text-align:left}
 th{background:#2c3e50;color:#fff}
 tr:nth-child(even){background:#f2f2f2}
</style></head><body>
<h2>User Records</h2>
<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th></tr>"""

for r in rows:
    html_out += "<tr>" + "".join(f"<td>{html.escape(str(c))}</td>" for c in r) + "</tr>"
html_out += "</table></body></html>"

print("Content-Type: text/html\n")   # CGI header (remove if running from terminal)
print(html_out)
