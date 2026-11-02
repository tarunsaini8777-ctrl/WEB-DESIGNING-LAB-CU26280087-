<?php
/**
 * Lab Sheet 4 - Question 16: Implement cookie management in PHP (setcookie()) to store and retrieve user preferences like theme color.
 */
$allowed = ['light' => '#ffffff', 'dark' => '#222222', 'blue' => '#d6eaff'];

// Save preference (must run before any output)
if (isset($_POST['theme']) && isset($allowed[$_POST['theme']])) {
    setcookie('theme', $_POST['theme'], [
        'expires'  => time() + 30 * 24 * 60 * 60,   // 30 days
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    header('Location: ' . $_SERVER['PHP_SELF']);    // reload so cookie is readable
    exit;
}

// Retrieve preference
$theme = $_COOKIE['theme'] ?? 'light';
if (!isset($allowed[$theme])) $theme = 'light';
$color = $allowed[$theme];
$text  = $theme === 'dark' ? '#fff' : '#000';
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Theme Cookie</title>
<style>body{font-family:Arial;padding:30px;background:<?= $color ?>;color:<?= $text ?>}</style>
</head>
<body>
<h2>Current theme: <?= htmlspecialchars($theme) ?></h2>
<form method="post">
  <select name="theme">
    <?php foreach ($allowed as $name => $c): ?>
      <option value="<?= $name ?>" <?= $name === $theme ? 'selected' : '' ?>><?= ucfirst($name) ?></option>
    <?php endforeach; ?>
  </select>
  <button type="submit">Save</button>
</form>
</body></html>
