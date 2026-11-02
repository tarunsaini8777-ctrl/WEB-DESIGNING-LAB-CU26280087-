#!/usr/bin/env python3
# Lab Sheet 5 - Question 1: Configure Apache web server to execute Python CGI scripts or WSGI applications (mod_wsgi) and verify with a 'Hello World' Python script.
# Save as hello.py in cgi-bin (XAMPP: C:/xampp/cgi-bin | Linux: /usr/lib/cgi-bin)
# Open: http://localhost/cgi-bin/hello.py
#
# ---- Apache configuration (httpd.conf) ----
#   LoadModule cgi_module modules/mod_cgi.so          (Linux: sudo a2enmod cgi)
#   ScriptAlias /cgi-bin/ "C:/xampp/cgi-bin/"
#   <Directory "C:/xampp/cgi-bin">
#       AllowOverride None
#       Options +ExecCGI
#       AddHandler cgi-script .py
#       Require all granted
#   </Directory>
# Windows: first line must point to Python, e.g. #!C:/Python311/python.exe
# Linux:   chmod +x hello.py
#
# ---- Alternative: mod_wsgi ----
#   pip install mod_wsgi ; mod_wsgi-express module-config  (paste output into httpd.conf)
#   WSGIScriptAlias /app "C:/xampp/htdocs/app/app.wsgi"
#   app.wsgi:
#       def application(environ, start_response):
#           start_response("200 OK", [("Content-Type", "text/plain")])
#           return [b"Hello World from mod_wsgi"]

print("Content-Type: text/html\n")
print("<html><body><h1>Hello World from Python CGI!</h1></body></html>")
