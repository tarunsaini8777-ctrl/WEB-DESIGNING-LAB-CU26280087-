# Lab Sheet 5 - Question 8: Implement a Python script to update user profile information in MySQL based on a given user ID.

import mysql.connector
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

user_id = 1
new_name = "Rahul Kumar"
new_email = "rahul.kumar@example.com"
new_age = 24

conn = mysql.connector.connect(**DB_CONFIG)
cursor = conn.cursor()
cursor.execute(
    "UPDATE users SET name = %s, email = %s, age = %s WHERE id = %s",
    (new_name, new_email, new_age, user_id),
)
conn.commit()

if cursor.rowcount:
    print(f"User {user_id} updated successfully.")
else:
    print(f"No user found with ID {user_id}.")

cursor.close()
conn.close()
