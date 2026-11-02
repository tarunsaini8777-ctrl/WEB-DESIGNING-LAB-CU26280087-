<?php
/**
 * Lab Sheet 4 - Question 20: Configure PHP extensions (such as mysqli, pdo_mysql, mbstring, curl) in php.ini and verify their active status.
 */
// php.ini - remove the leading ';' to enable, then restart Apache:
//   extension=mysqli
//   extension=pdo_mysql
//   extension=mbstring
//   extension=curl
// (Linux: sudo apt install php-mysql php-mbstring php-curl)

$extensions = ['mysqli', 'pdo_mysql', 'mbstring', 'curl'];
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>PHP Extensions</title>
<style>
 body{font-family:Arial;margin:30px}
 table{border-collapse:collapse}
 td,th{border:1px solid #ccc;padding:8px 16px}
 th{background:#34495e;color:#fff}
 .on{color:green;font-weight:bold} .off{color:red;font-weight:bold}
</style></head>
<body>
<h2>PHP Extension Status</h2>
<table>
<tr><th>Extension</th><th>Status</th></tr>
<?php foreach ($extensions as $ext): $ok = extension_loaded($ext); ?>
<tr><td><?= $ext ?></td><td class="<?= $ok ? 'on' : 'off' ?>"><?= $ok ? 'Enabled' : 'Disabled' ?></td></tr>
<?php endforeach; ?>
</table>
<p>Loaded php.ini: <?= php_ini_loaded_file() ?></p>
</body></html>
