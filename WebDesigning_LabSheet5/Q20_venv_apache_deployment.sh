# Lab Sheet 5 - Question 20: Configure Python virtual environments (venv) and integrate them with Apache web server deployment settings.

# ---- Create and activate venv ----
python -m venv venv
# Windows:  venv\Scripts\activate
# Linux  :  source venv/bin/activate
pip install mysql-connector-python mod_wsgi
pip freeze > requirements.txt

# ---- Integrate with Apache: Option A - CGI (use venv interpreter in shebang) ----
# First line of every script:
#   Windows: #!C:/xampp/htdocs/pyapp/venv/Scripts/python.exe
#   Linux  : #!/var/www/pyapp/venv/bin/python

# ---- Option B - mod_wsgi using the venv (httpd.conf / site conf) ----
# Get the config lines:  mod_wsgi-express module-config
#
#   LoadModule wsgi_module "<path printed by module-config>"
#   WSGIPythonHome "C:/xampp/htdocs/pyapp/venv"
#
#   <VirtualHost *:80>
#       ServerName pyapp.local
#       WSGIScriptAlias / "C:/xampp/htdocs/pyapp/app.wsgi"
#       WSGIDaemonProcess pyapp python-home="C:/xampp/htdocs/pyapp/venv"
#       WSGIProcessGroup pyapp
#       <Directory "C:/xampp/htdocs/pyapp">
#           Require all granted
#       </Directory>
#   </VirtualHost>
#
# Restart Apache:  httpd -k restart   (Linux: sudo systemctl restart apache2)
# Verify which python is used: print(sys.executable) inside app.wsgi
