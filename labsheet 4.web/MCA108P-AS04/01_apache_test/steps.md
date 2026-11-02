# Experiment 1: Apache setup
1. Install XAMPP/WAMP (Windows) or `sudo apt install apache2` (Ubuntu).
2. Start Apache (XAMPP Control Panel, or `sudo systemctl start apache2`).
3. Copy `index.html` to the document root (`htdocs` / `/var/www/html`).
4. Open http://localhost and confirm the page loads.
5. Verify config: `apachectl -t` (should print "Syntax OK").
