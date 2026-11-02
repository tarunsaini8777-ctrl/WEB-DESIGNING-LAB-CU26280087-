# Lab Sheet 5 - Question 14: Develop a Python script that reads CSV file data and bulk-inserts rows into a MySQL database table.

import csv
import mysql.connector
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

# users.csv format (with header):
# name,email,age
# Ravi,ravi@example.com,22
# Sita,sita@example.com,21

rows = []
with open("users.csv", newline="", encoding="utf-8") as f:
    reader = csv.DictReader(f)
    for r in reader:
        rows.append((r["name"].strip(), r["email"].strip(), int(r["age"])))

conn = mysql.connector.connect(**DB_CONFIG)
cursor = conn.cursor()
cursor.executemany(
    "INSERT IGNORE INTO users (name, email, age) VALUES (%s, %s, %s)", rows
)
conn.commit()
print(f"{cursor.rowcount} rows inserted out of {len(rows)} in CSV.")

cursor.close()
conn.close()
