# Lab Sheet 5 - Question 5: Write a Python script to insert multiple user records into the MySQL database using executemany() method.

import mysql.connector
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

users = [
    ("Rahul Sharma", "rahul@example.com", 22),
    ("Priya Singh", "priya@example.com", 21),
    ("Amit Verma", "amit@example.com", 23),
    ("Neha Gupta", "neha@example.com", 22),
]

conn = mysql.connector.connect(**DB_CONFIG)
cursor = conn.cursor()
cursor.executemany("INSERT INTO users (name, email, age) VALUES (%s, %s, %s)", users)
conn.commit()
print(cursor.rowcount, "records inserted.")

cursor.close()
conn.close()
