<?php
// Task 5: registration with password hashing
$pageTitle = 'Register';
require 'includes/header.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = post('name'); $email = strtolower(post('email')); $pw = $_POST['password'] ?? ''; $conf = $_POST['confirm'] ?? '';
    if (mb_strlen($name) < 2) $errors[] = 'Name must be at least 2 characters.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Enter a valid email.';
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $pw)) $errors[] = 'Password needs 8+ characters with a letter and a number.';
    if ($pw !== $conf) $errors[] = 'Passwords do not match.';
    if (!$errors) {
        $ex = db()->prepare('SELECT 1 FROM users WHERE email=?'); $ex->execute([$email]);
        if ($ex->fetch()) $errors[] = 'That email is already registered.';
        else {
            db()->prepare('INSERT INTO users (name,email,password_hash) VALUES (?,?,?)')
                ->execute([$name, $email, password_hash($pw, PASSWORD_DEFAULT)]);
            flash('Account created. Please log in.');
            redirect('login.php');
        }
    }
}
?>
<div class="row justify-content-center"><div class="col-md-5">
<h2>Create account</h2>
<?php foreach ($errors as $er): ?><div class="alert alert-danger py-2"><?= e($er) ?></div><?php endforeach; ?>
<form method="post" data-validate="register" novalidate><?= csrf_field() ?>
  <div class="mb-3"><label class="form-label">Name</label><input name="name" class="form-control" value="<?= e($_POST['name'] ?? '') ?>"></div>
  <div class="mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control" value="<?= e($_POST['email'] ?? '') ?>"></div>
  <div class="mb-3"><label class="form-label">Password</label><input name="password" type="password" class="form-control"></div>
  <div class="mb-3"><label class="form-label">Confirm password</label><input name="confirm" type="password" class="form-control"></div>
  <button class="btn btn-primary w-100">Register</button>
</form></div></div>
<?php require 'includes/footer.php'; ?>
