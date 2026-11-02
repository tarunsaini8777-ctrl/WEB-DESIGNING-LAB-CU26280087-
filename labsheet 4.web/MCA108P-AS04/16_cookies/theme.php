<?php
$allowed = ['light', 'dark', 'blue'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && in_array($_POST['theme'] ?? '', $allowed, true)) {
    setcookie('theme', $_POST['theme'], [
        'expires'  => time() + 60 * 60 * 24 * 30,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    header('Location: theme.php'); // reload so the cookie is readable
    exit;
}

$theme = in_array($_COOKIE['theme'] ?? '', $allowed, true) ? $_COOKIE['theme'] : 'light';
$colors = ['light' => ['#ffffff', '#222'], 'dark' => ['#1e1e1e', '#f1f1f1'], 'blue' => ['#d6e9ff', '#0b2a4a']];
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Theme Preference</title>
<style>body{background:<?= $colors[$theme][0] ?>;color:<?= $colors[$theme][1] ?>;font-family:Arial;padding:30px}</style>
</head>
<body>
<h2>Current theme: <?= htmlspecialchars($theme) ?></h2>
<form method="post">
  <select name="theme">
    <?php foreach ($allowed as $t): ?>
      <option value="<?= $t ?>" <?= $t === $theme ? 'selected' : '' ?>><?= ucfirst($t) ?></option>
    <?php endforeach; ?>
  </select>
  <button type="submit">Save preference</button>
</form>
</body></html>
