<?php
$keys = ['SERVER_SOFTWARE','SERVER_NAME','SERVER_ADDR','SERVER_PORT','SERVER_PROTOCOL',
         'DOCUMENT_ROOT','SCRIPT_FILENAME','REMOTE_ADDR','REQUEST_METHOD',
         'REQUEST_URI','HTTP_HOST','HTTP_USER_AGENT'];
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Server Info</title>
<style>table{border-collapse:collapse}td,th{border:1px solid #ccc;padding:6px 10px}</style></head>
<body>
<h2>Apache / PHP Environment</h2>
<table>
<tr><th>Variable</th><th>Value</th></tr>
<?php foreach ($keys as $k): ?>
<tr><td><?= $k ?></td><td><?= htmlspecialchars($_SERVER[$k] ?? 'N/A') ?></td></tr>
<?php endforeach; ?>
<tr><td>PHP Version</td><td><?= PHP_VERSION ?></td></tr>
<tr><td>Server API</td><td><?= php_sapi_name() ?></td></tr>
</table>
</body></html>
