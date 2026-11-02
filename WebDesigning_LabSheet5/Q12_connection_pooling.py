# Lab Sheet 5 - Question 12: Implement connection pooling in Python for efficient database interaction under high Apache server concurrency.

import threading
from mysql.connector import pooling
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

pool = pooling.MySQLConnectionPool(
    pool_name="web_pool",
    pool_size=5,          # keep <= MySQL max_connections / number of Apache workers
    pool_reset_session=True,
    **DB_CONFIG,
)

def worker(n):
    conn = pool.get_connection()        # borrow from pool
    try:
        cur = conn.cursor()
        cur.execute("SELECT COUNT(*) FROM users")
        print(f"Request {n}: users = {cur.fetchone()[0]}")
        cur.close()
    finally:
        conn.close()                    # returns connection to the pool (doesn't close it)

# Simulate concurrent requests
threads = [threading.Thread(target=worker, args=(i,)) for i in range(1, 11)]
for t in threads: t.start()
for t in threads: t.join()
