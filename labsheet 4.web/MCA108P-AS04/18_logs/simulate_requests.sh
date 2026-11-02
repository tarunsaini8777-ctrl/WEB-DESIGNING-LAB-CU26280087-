#!/bin/bash
# Sends test requests so access.log and error.log get entries.
BASE="http://localhost/MCA108P-AS04"
for i in {1..20}; do curl -s -o /dev/null "$BASE/11_server_info/server_info.php"; done
curl -s -o /dev/null "$BASE/does_not_exist.php"            # 404 -> access.log
curl -s -o /dev/null "$BASE/18_logs/trigger_error.php"     # PHP error -> error.log

# Optional load test (Apache Bench):
# ab -n 200 -c 10 "$BASE/11_server_info/server_info.php"

# View logs (Ubuntu paths; XAMPP: C:\xampp\apache\logs\):
tail -n 20 /var/log/apache2/access.log
tail -n 20 /var/log/apache2/error.log
