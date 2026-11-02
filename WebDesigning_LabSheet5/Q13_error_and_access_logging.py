# Lab Sheet 5 - Question 13: Write a Python script to log database error messages and access timestamps into a dedicated server log file.

import logging
from datetime import datetime
import mysql.connector
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

logging.basicConfig(
    filename="db_server.log",
    level=logging.INFO,
    format="%(asctime)s [%(levelname)s] %(message)s",
)

logging.info("Script accessed at %s", datetime.now().strftime("%Y-%m-%d %H:%M:%S"))

try:
    conn = mysql.connector.connect(**DB_CONFIG)
    cur = conn.cursor()
    cur.execute("SELECT * FROM non_existing_table")      # deliberate error to test logging
    cur.fetchall()
except mysql.connector.Error as e:
    logging.error("Database error: %s", e)
    print("An error occurred. Check db_server.log")
else:
    logging.info("Query executed successfully")
finally:
    try:
        cur.close(); conn.close()
    except Exception:
        pass
