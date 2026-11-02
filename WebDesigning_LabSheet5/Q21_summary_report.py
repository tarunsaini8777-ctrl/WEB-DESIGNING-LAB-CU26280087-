# Lab Sheet 5 - Question 21: Write a Python script to generate analytical summary reports (counts, averages) from MySQL data for administrative dashboards.

import mysql.connector
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

conn = mysql.connector.connect(**DB_CONFIG)
cur = conn.cursor(dictionary=True)

cur.execute("""
    SELECT COUNT(*) AS total_users,
           ROUND(AVG(age), 2) AS average_age,
           MIN(age) AS youngest,
           MAX(age) AS oldest
    FROM users
""")
summary = cur.fetchone()

cur.execute("""
    SELECT age, COUNT(*) AS count FROM users
    GROUP BY age ORDER BY count DESC LIMIT 5
""")
by_age = cur.fetchall()

cur.execute("""
    SELECT DATE(created_at) AS day, COUNT(*) AS signups FROM users
    GROUP BY DATE(created_at) ORDER BY day DESC LIMIT 7
""")
daily = cur.fetchall()

print("===== USER SUMMARY REPORT =====")
print(f"Total users  : {summary['total_users']}")
print(f"Average age  : {summary['average_age']}")
print(f"Youngest     : {summary['youngest']}   Oldest: {summary['oldest']}")
print("\nTop ages:")
for r in by_age:
    print(f"  Age {r['age']}: {r['count']} user(s)")
print("\nSignups (last 7 days with data):")
for r in daily:
    print(f"  {r['day']}: {r['signups']}")

cur.close()
conn.close()
