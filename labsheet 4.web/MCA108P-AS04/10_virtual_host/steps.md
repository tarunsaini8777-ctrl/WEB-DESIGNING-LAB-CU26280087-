# Experiment 10: Virtual host
1. Add the block from `httpd-vhosts.conf` to your Apache vhosts file.
2. Edit the hosts file (as Administrator/root) and add:
   `127.0.0.1   collegeweb.local`
   - Windows: `C:\Windows\System32\drivers\etc\hosts`
   - Linux/macOS: `/etc/hosts`
3. Test config and restart Apache (`apachectl -t`, then restart).
4. Browse to http://collegeweb.local
