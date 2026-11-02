# Lab Sheet 5 - Question 11: Write a Python script that connects to MySQL, performs a parameterized query to prevent SQL injection, and returns filtered results.

import mysql.connector
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

search_name = input("Enter name to search: ")
min_age = 18

conn = mysql.connector.connect(**DB_CONFIG)
cursor = conn.cursor(dictionary=True)

# Placeholders (%s) - never build the query with string concatenation / f-strings
query = "SELECT id, name, email, age FROM users WHERE name LIKE %s AND age >= %s"
cursor.execute(query, (f"%{search_name}%", min_age))

results = cursor.fetchall()
if results:
    for row in results:
        print(row)
else:
    print("No matching records.")

cursor.close()
conn.close()
