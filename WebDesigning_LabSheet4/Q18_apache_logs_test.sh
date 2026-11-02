# Lab Sheet 4 - Question 18: Test Apache server performance and error logging by examining error.log and access.log files during simulated requests.

# ---- Q18: Apache logs & simple performance test ----
# Log locations
#   XAMPP : C:\xampp\apache\logs\access.log , error.log
#   Linux : /var/log/apache2/access.log , error.log

# 1. Watch logs live (Linux / Git Bash)
tail -f /var/log/apache2/access.log
tail -f /var/log/apache2/error.log

# 2. Simulate requests
curl -I http://localhost/                      # 200 OK  -> appears in access.log
curl -I http://localhost/not-found.php         # 404     -> access.log + error.log
curl -s -o /dev/null -w "Time: %{time_total}s\n" http://localhost/

# 3. Load test with ApacheBench (ships with Apache / apache2-utils)
ab -n 200 -c 10 http://localhost/index.php
#   Check: Requests per second, Time per request, Failed requests

# 4. Analyse access.log
grep " 404 " access.log | wc -l                          # count 404 errors
awk '{print $1}' access.log | sort | uniq -c | sort -rn  # hits per IP

# 5. Generate a PHP error for error.log (create err.php):
#    <?php echo $undefinedVar; include('missing.php'); ?>
#    then open http://localhost/err.php and view error.log

# Sample access.log line:
# 127.0.0.1 - - [02/Nov/2026:10:15:32 +0530] "GET /index.php HTTP/1.1" 200 1234
