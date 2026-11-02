# Lab Sheet 5 - Question 2: Install Python MySQL connector libraries (mysql-connector-python or PyMySQL) in the local python environment.

# Install from terminal / command prompt:
#     pip install mysql-connector-python
#     pip install PyMySQL
#     pip list | findstr -i mysql        (Linux: pip list | grep -i mysql)
#
# Verify installation by running this script:

try:
    import mysql.connector
    print("mysql-connector-python version:", mysql.connector.__version__)
except ImportError:
    print("mysql-connector-python NOT installed")

try:
    import pymysql
    print("PyMySQL version:", pymysql.__version__)
except ImportError:
    print("PyMySQL NOT installed")
