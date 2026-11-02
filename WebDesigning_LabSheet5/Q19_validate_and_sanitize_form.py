#!/usr/bin/env python3
# Lab Sheet 5 - Question 19: Write a Python script that verifies and sanitizes incoming web form inputs before executing SQL write operations.
# Python 3.12 or older (cgi module)
import cgi, html, re
import mysql.connector
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "python_web_db",
}

EMAIL_RE = re.compile(r"^[\w.+-]+@[\w-]+\.[\w.-]+$")

def validate(name, email, age):
    errors = []
    if not (2 <= len(name) <= 100):
        errors.append("Name must be 2-100 characters.")
    if not re.fullmatch(r"[A-Za-z .'-]+", name):
        errors.append("Name contains invalid characters.")
    if not EMAIL_RE.match(email):
        errors.append("Invalid email address.")
    if not age.isdigit() or not (1 <= int(age) <= 120):
        errors.append("Age must be a number between 1 and 120.")
    return errors

form = cgi.FieldStorage()
name = " ".join(form.getfirst("name", "").split())      # trim + collapse whitespace
email = form.getfirst("email", "").strip().lower()
age = form.getfirst("age", "").strip()

print("Content-Type: text/html\n")
print("<html><body>")

if form.getfirst("name") is None:
    print("""<h2>Register</h2><form method="post">
    Name: <input name="name"><br>Email: <input name="email"><br>Age: <input name="age"><br>
    <button>Submit</button></form>""")
else:
    errors = validate(name, email, age)
    if errors:
        print("<ul style='color:red'>" + "".join(f"<li>{html.escape(e)}</li>" for e in errors) + "</ul>")
    else:
        try:
            conn = mysql.connector.connect(**DB_CONFIG)
            cur = conn.cursor()
            cur.execute("INSERT INTO users (name, email, age) VALUES (%s,%s,%s)", (name, email, int(age)))
            conn.commit()
            print(f"<p style='color:green'>Saved {html.escape(name)} successfully.</p>")
            cur.close(); conn.close()
        except mysql.connector.Error as e:
            print("<p style='color:red'>Could not save record (duplicate email?).</p>")
print("</body></html>")
