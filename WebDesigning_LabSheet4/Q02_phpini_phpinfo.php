<?php
/**
 * Lab Sheet 4 - Question 2: Configure the php.ini file to enable error reporting (display_errors = On) and verify settings using a phpinfo() script.
 */
// Save as phpinfo.php in the document root and open http://localhost/phpinfo.php
//
// php.ini changes (XAMPP: C:\xampp\php\php.ini | Linux: /etc/php/<ver>/apache2/php.ini):
//     display_errors = On
//     error_reporting = E_ALL
//     log_errors = On
// Restart Apache after editing.

ini_set('display_errors', '1');   // runtime check (php.ini value is the permanent setting)
error_reporting(E_ALL);

echo "<h3>display_errors = " . ini_get('display_errors') . "</h3>";
echo "<h3>error_reporting = " . ini_get('error_reporting') . "</h3>";
echo "<h3>Loaded php.ini: " . php_ini_loaded_file() . "</h3>";

phpinfo();
