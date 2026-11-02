<?php
/**
 * Lab Sheet 4 - Question 11: Write a PHP script that checks Apache server environment variables and server software details using $_SERVER superglobal.
 */
$info = [
    'Server Software' => $_SERVER['SERVER_SOFTWARE'] ?? 'N/A',
    'Server Name'     => $_SERVER['SERVER_NAME'] ?? 'N/A',
    'Server Address'  => $_SERVER['SERVER_ADDR'] ?? 'N/A',
    'Server Port'     => $_SERVER['SERVER_PORT'] ?? 'N/A',
    'Document Root'   => $_SERVER['DOCUMENT_ROOT'] ?? 'N/A',
    'Script Filename' => $_SERVER['SCRIPT_FILENAME'] ?? 'N/A',
    'Request Method'  => $_SERVER['REQUEST_METHOD'] ?? 'N/A',
    'Request URI'     => $_SERVER['REQUEST_URI'] ?? 'N/A',
    'Client IP'       => $_SERVER['REMOTE_ADDR'] ?? 'N/A',
    'User Agent'      => $_SERVER['HTTP_USER_AGENT'] ?? 'N/A',
    'Protocol'        => $_SERVER['SERVER_PROTOCOL'] ?? 'N/A',
    'PHP Version'     => phpversion(),
    'PHP SAPI'        => php_sapi_name(),
];
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Server Info</title>
<style>
 body{font-family:Arial;margin:30px}
 table{border-collapse:collapse;width:80%}
 td,th{border:1px solid #ccc;padding:8px;text-align:left}
 th{background:#34495e;color:#fff}
</style></head>
<body>
<h2>Apache / Server Environment</h2>
<table>
<tr><th>Variable</th><th>Value</th></tr>
<?php foreach ($info as $k => $v): ?>
<tr><td><?= $k ?></td><td><?= htmlspecialchars($v) ?></td></tr>
<?php endforeach; ?>
</table>
</body></html>
