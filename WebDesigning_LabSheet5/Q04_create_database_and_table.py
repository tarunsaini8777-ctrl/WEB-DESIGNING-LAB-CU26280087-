# Lab Sheet 5 - Question 4: Create a Python script that connects to MySQL and creates a database named python_web_db with a table users.

import mysql.connector

conn = mysql.connector.connect(host="localhost", user="root", password="")
cursor = conn.cursor()

cursor.execute("CREATE DATABASE IF NOT EXISTS python_web_db")
cursor.execute("USE python_web_db")
cursor.execute("""
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        age INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
""")
print("Database 'python_web_db' and table 'users' created.")

cursor.close()
conn.close()
