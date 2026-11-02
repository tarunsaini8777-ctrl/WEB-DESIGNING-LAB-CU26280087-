#!/usr/bin/env python3
# Lab Sheet 5 - Question 18: Implement user session handling in a Python web script interacting with MySQL backend storage.
# Sessions stored in MySQL. Run once:
#   CREATE TABLE sessions (
#       session_id VARCHAR(64) PRIMARY KEY,
#       user_id INT NOT NULL,
#       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
#       expires_at DATETIME NOT NULL
#   );
#   ALTER TABLE users ADD COLUMN password VARCHAR(255);   -- store hashed passwords
#
# Python 3.12 or older (cgi module). Usage: session.py?action=login|profile|logout
import cgi, os, secrets, html, hashlib
from http import cookies
from datetime import datetime, timedelta
import mysql.connector
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

conn = mysql.connector.connect(**DB_CONFIG)
cur = conn.cursor(dictionary=True)
form = cgi.FieldStorage()
action = form.getfirst("action", "profile")

cookie = cookies.SimpleCookie(os.environ.get("HTTP_COOKIE", ""))
sid = cookie["sid"].value if "sid" in cookie else None
set_cookie = ""
body = ""

def current_user():
    if not sid:
        return None
    cur.execute("""SELECT u.id, u.name FROM sessions s JOIN users u ON u.id = s.user_id
                   WHERE s.session_id = %s AND s.expires_at > NOW()""", (sid,))
    return cur.fetchone()

if action == "login" and os.environ.get("REQUEST_METHOD") == "POST":
    email = form.getfirst("email", "")
    pwd = hashlib.sha256(form.getfirst("password", "").encode()).hexdigest()  # demo; use bcrypt in production
    cur.execute("SELECT id, name FROM users WHERE email=%s AND password=%s", (email, pwd))
    user = cur.fetchone()
    if user:
        new_sid = secrets.token_hex(32)
        cur.execute("INSERT INTO sessions (session_id, user_id, expires_at) VALUES (%s,%s,%s)",
                    (new_sid, user["id"], datetime.now() + timedelta(hours=1)))
        conn.commit()
        set_cookie = f"Set-Cookie: sid={new_sid}; HttpOnly; Path=/; Max-Age=3600\n"
        body = f"<p>Logged in as {html.escape(user['name'])}. <a href='?action=profile'>Profile</a></p>"
    else:
        body = "<p style='color:red'>Invalid credentials</p>"
elif action == "logout":
    if sid:
        cur.execute("DELETE FROM sessions WHERE session_id=%s", (sid,))
        conn.commit()
    set_cookie = "Set-Cookie: sid=; Path=/; Max-Age=0\n"
    body = "<p>Logged out.</p>"
else:
    user = current_user()
    if user:
        body = f"<h2>Welcome, {html.escape(user['name'])}</h2><a href='?action=logout'>Logout</a>"
    else:
        body = """<h2>Login</h2><form method="post" action="?action=login">
        <input name="email" placeholder="Email"><input type="password" name="password" placeholder="Password">
        <button>Login</button></form>"""

print("Content-Type: text/html")
print(set_cookie, end="")
print("\n<html><body>" + body + "</body></html>")
cur.close(); conn.close()
