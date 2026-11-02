<?php
// Task 5: login with password_verify + session fixation protection + basic throttling
$pageTitle = 'Login';
require 'includes/header.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(post('email')); $pw = $_POST['password'] ?? '';
    $_SESSION['fails'] = $_SESSION['fails'] ?? 0;
    if ($_SESSION['fails'] >= 5 && time() < ($_SESSION['lock'] ?? 0)) {
        $error = 'Too many attempts. Try again in a minute.';
    } else {
        $st = db()->prepare('SELECT * FROM users WHERE email=?'); $st->execute([$email]); $u = $st->fetch();
        if ($u && password_verify($pw, $u['password_hash'])) {
            session_regenerate_id(true);                       // prevent session fixation
            if (password_needs_rehash($u['password_hash'], PASSWORD_DEFAULT))
                db()->prepare('UPDATE users SET password_hash=? WHERE id=?')->execute([password_hash($pw, PASSWORD_DEFAULT), $u['id']]);
            $_SESSION['user'] = ['id' => (int)$u['id'], 'name' => $u['name'], 'email' => $u['email'], 'role' => $u['role']];
            $_SESSION['fails'] = 0;
            $to = $_SESSION['after_login'] ?? 'index.php'; unset($_SESSION['after_login']);
            flash('Welcome back, ' . $u['name'] . '!');
            redirect($to);
        }
        $_SESSION['fails']++; if ($_SESSION['fails'] >= 5) $_SESSION['lock'] = time() + 60;
        $error = 'Invalid email or password.';
    }
}
?>
<div class="row justify-content-center"><div class="col-md-5">
<h2>Login</h2>
<?php if ($error): ?><div class="alert alert-danger py-2"><?= e($error) ?></div><?php endif; ?>
<form method="post" data-validate="login" novalidate><?= csrf_field() ?>
  <div class="mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control" value="<?= e($_POST['email'] ?? '') ?>"></div>
  <div class="mb-3"><label class="form-label">Password</label><input name="password" type="password" class="form-control"></div>
  <button class="btn btn-primary w-100">Login</button>
</form>
<p class="mt-3 text-center">No account? <a href="register.php">Register</a></p>
</div></div>
<?php require 'includes/footer.php'; ?>
