<?php
$required = ['mysqli', 'pdo_mysql', 'mbstring', 'curl', 'openssl', 'fileinfo'];
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>PHP Extensions</title>
<style>table{border-collapse:collapse}td,th{border:1px solid #ccc;padding:6px 12px}.ok{color:green}.no{color:red}</style></head>
<body>
<h2>PHP Extension Status</h2>
<table>
<tr><th>Extension</th><th>Status</th></tr>
<?php foreach ($required as $ext): $on = extension_loaded($ext); ?>
<tr><td><?= $ext ?></td><td class="<?= $on ? 'ok' : 'no' ?>"><?= $on ? 'Enabled' : 'Disabled' ?></td></tr>
<?php endforeach; ?>
</table>
<p>Loaded php.ini: <?= php_ini_loaded_file() ?></p>
</body></html>
