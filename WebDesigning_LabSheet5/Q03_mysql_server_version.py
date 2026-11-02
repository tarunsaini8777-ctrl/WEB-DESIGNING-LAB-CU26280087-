# Lab Sheet 5 - Question 3: Write a Python script to connect to a MySQL database server and execute a query returning the database server version.

import mysql.connector

conn = mysql.connector.connect(host="localhost", user="root", password="")
cursor = conn.cursor()
cursor.execute("SELECT VERSION()")
version = cursor.fetchone()
print("MySQL server version:", version[0])

cursor.close()
conn.close()
