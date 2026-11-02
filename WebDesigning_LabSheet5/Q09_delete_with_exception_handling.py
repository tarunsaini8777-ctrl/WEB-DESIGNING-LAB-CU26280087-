# Lab Sheet 5 - Question 9: Write a Python script to delete a record from the MySQL database and handle database exceptions using try-except blocks.

import mysql.connector
from mysql.connector import Error
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

user_id = 3
conn = None

try:
    conn = mysql.connector.connect(**DB_CONFIG)
    cursor = conn.cursor()
    cursor.execute("DELETE FROM users WHERE id = %s", (user_id,))
    conn.commit()
    print(f"User {user_id} deleted." if cursor.rowcount else f"No user with ID {user_id}.")
except Error as e:
    print("Database error:", e)
    if conn:
        conn.rollback()
finally:
    if conn and conn.is_connected():
        cursor.close()
        conn.close()
        print("Connection closed.")
