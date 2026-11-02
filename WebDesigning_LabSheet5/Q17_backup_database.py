# Lab Sheet 5 - Question 17: Write a Python script to backup a MySQL database schema and data into a .sql file programmatically.

import mysql.connector
from datetime import datetime
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

def sql_value(v):
    if v is None:
        return "NULL"
    if isinstance(v, (int, float)):
        return str(v)
    return "'" + str(v).replace("\\", "\\\\").replace("'", "''") + "'"

conn = mysql.connector.connect(**DB_CONFIG)
cur = conn.cursor()
filename = f"backup_{DB_CONFIG['database']}_{datetime.now():%Y%m%d_%H%M%S}.sql"

with open(filename, "w", encoding="utf-8") as f:
    f.write(f"-- Backup of {DB_CONFIG['database']} on {datetime.now()}\n\n")
    cur.execute("SHOW TABLES")
    tables = [t[0] for t in cur.fetchall()]

    for table in tables:
        cur.execute(f"SHOW CREATE TABLE `{table}`")
        f.write(f"DROP TABLE IF EXISTS `{table}`;\n{cur.fetchone()[1]};\n\n")

        cur.execute(f"SELECT * FROM `{table}`")
        for row in cur.fetchall():
            f.write(f"INSERT INTO `{table}` VALUES ({', '.join(sql_value(v) for v in row)});\n")
        f.write("\n")

print("Backup saved to", filename)
cur.close()
conn.close()

# Alternative: subprocess.run(["mysqldump", "-u", "root", "python_web_db"], stdout=open("backup.sql","w"))
