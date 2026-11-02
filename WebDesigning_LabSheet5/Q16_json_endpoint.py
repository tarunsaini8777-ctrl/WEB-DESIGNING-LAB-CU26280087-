#!/usr/bin/env python3
# Lab Sheet 5 - Question 16: Test Apache and Python integration by creating a dynamic web endpoint that generates JSON responses from MySQL queries.
# Open: http://localhost/cgi-bin/users_json.py
import json
import mysql.connector
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

try:
    conn = mysql.connector.connect(**DB_CONFIG)
    cur = conn.cursor(dictionary=True)
    cur.execute("SELECT id, name, email, age FROM users")
    data = {"status": "success", "count": 0, "users": cur.fetchall()}
    data["count"] = len(data["users"])
    cur.close(); conn.close()
except mysql.connector.Error as e:
    data = {"status": "error", "message": str(e)}

print("Content-Type: application/json\n")
print(json.dumps(data, indent=2, default=str))
