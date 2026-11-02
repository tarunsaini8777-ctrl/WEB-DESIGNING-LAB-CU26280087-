# MCA108P-AS09: PHP + MySQL Web Application

All programs in one file. Copy each block into the file named above it (keep the folder structure).

**Setup:**
1. Install XAMPP/WAMP and put the folder `MCA108P-AS09` in `htdocs`.
2. Run `sql/schema.sql` and then `sql/seed.sql` in phpMyAdmin.
3. Set your MySQL password in `config/db.php` and open `db_test.php` to check the connection.
4. Register an account on `register.php`, then log in.

> `includes/functions.php` (Exp 16), `includes/auth.php` (Exp 5), `includes/remember.php` (Exp 17) and the Common Files below are used by every page, so create them first.

## Project Structure

````text
MCA108P-AS09/
|-- config/db.php
|-- includes/  functions, auth, remember, header, footer, pagination,
|              product_filter, product_sort, upload (.php)
|-- api/suggest.php        js/confirm.js  js/suggest.js        css/style.css
|-- sql/       schema.sql, seed.sql
|-- uploads/products/      (product photos, .htaccess blocks script execution)
|-- index, register, login, logout, dashboard, products, product_add, product_edit,
|   product_delete, cart, checkout, injection_demo, xss_demo, db_test (.php)
````

## Index

1. [Experiment 1](#experiment-1)
2. [Experiment 2](#experiment-2)
3. [Experiment 3](#experiment-3)
4. [Experiment 4](#experiment-4)
5. [Experiment 5](#experiment-5)
6. [Experiment 6](#experiment-6)
7. [Experiment 7](#experiment-7)
8. [Experiment 8](#experiment-8)
9. [Experiment 9](#experiment-9)
10. [Experiment 10](#experiment-10)
11. [Experiment 11](#experiment-11)
12. [Experiment 12](#experiment-12)
13. [Experiment 13](#experiment-13)
14. [Experiment 14](#experiment-14)
15. [Experiment 15](#experiment-15)
16. [Experiment 16](#experiment-16)
17. [Experiment 17](#experiment-17)
18. [Experiment 18](#experiment-18)
19. [Experiment 19](#experiment-19)
20. [Experiment 20](#experiment-20)

---

## Common Files

**`includes/header.php`**

````php
<?php
require_once __DIR__ . '/auth.php';
$pageTitle = $pageTitle ?? 'WebApp';
$flash = get_flash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($pageTitle) ?> | WebApp</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container header-row">
    <a class="brand" href="index.php">&#128230; WebApp</a>
    <nav class="main-nav">
      <a href="products.php">Products</a>
      <?php if (is_logged_in()): ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="product_add.php">Add Product</a>
      <?php endif; ?>
      <a href="cart.php">Cart (<?= cart_count() ?>)</a>
      <?php if (is_logged_in()): ?>
        <form method="post" action="logout.php" class="logout-form">
          <?= csrf_field() ?>
          <button type="submit" class="link-btn">Logout (<?= e($_SESSION['user_name']) ?>)</button>
        </form>
      <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
<main class="container">
<?php if ($flash): ?>
  <div class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['msg']) ?></div>
<?php endif; ?>
````

**`includes/footer.php`**

````php
</main>
<footer class="site-footer">
  <div class="container"><p>&copy; <?= date('Y') ?> WebApp &middot; MCA108P Assignment 09</p></div>
</footer>
<script src="js/confirm.js"></script>
<script src="js/suggest.js"></script>
</body>
</html>
````

**`index.php`**

````php
<?php
require_once 'includes/auth.php';
redirect(is_logged_in() ? 'dashboard.php' : 'products.php');
````

**`css/style.css`**

````css
:root { --primary: #2c3e50; --accent: #e67e22; --light: #f4f6f8; --danger: #e74c3c; --success: #27ae60; }
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: "Segoe UI", Arial, sans-serif; background: var(--light); color: #2d3436; line-height: 1.55; display: flex; flex-direction: column; min-height: 100vh; }
a { color: var(--primary); }
.container { width: 100%; max-width: 1100px; margin: 0 auto; padding: 0 18px; }
main.container { flex: 1; padding-top: 25px; padding-bottom: 40px; }
h1, h2 { color: var(--primary); margin-bottom: 12px; }
.muted { color: #636e72; margin-bottom: 15px; }
code { background: #eef1f3; padding: 1px 6px; border-radius: 4px; }

.site-header { background: var(--primary); padding: 12px 0; }
.header-row { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 10px; }
.brand { color: #fff; font-weight: bold; font-size: 1.4rem; text-decoration: none; }
.main-nav { display: flex; flex-wrap: wrap; gap: 16px; align-items: center; }
.main-nav a, .link-btn { color: #ecf0f1; text-decoration: none; background: none; border: none; font: inherit; cursor: pointer; }
.main-nav a:hover, .link-btn:hover { color: var(--accent); }
.logout-form { display: inline; }

.alert { padding: 12px 16px; border-radius: 5px; margin-bottom: 18px; }
.alert-success { background: #d4efdf; color: #1e8449; }
.alert-danger { background: #fadbd8; color: #922b21; }
.alert-info { background: #d6eaf8; color: #1b4f72; }

.btn { display: inline-block; background: var(--primary); color: #fff; border: none; padding: 9px 18px; border-radius: 5px; cursor: pointer; text-decoration: none; font-size: 0.95rem; }
.btn:hover { background: #1a252f; color: #fff; }
.btn-accent { background: var(--accent); } .btn-danger { background: var(--danger); } .btn-small { padding: 5px 11px; font-size: 0.85rem; }

.panel { background: #fff; padding: 22px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); margin-bottom: 22px; }
.form-narrow { max-width: 460px; margin: 20px auto; }
label { display: block; font-weight: 600; margin: 12px 0 4px; }
label.check { font-weight: normal; display: flex; gap: 8px; align-items: center; }
input[type=text], input[type=email], input[type=password], input[type=number], input[type=search], select, textarea, input[type=file] {
  width: 100%; padding: 9px 11px; border: 2px solid #ccd1d4; border-radius: 5px; font: inherit; }
input:focus, select:focus, textarea:focus { outline: none; border-color: var(--primary); }
.output-box { background: #eafaf1; border: 1px solid var(--success); padding: 10px; border-radius: 5px; word-break: break-all; }

.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; background: #fff; }
th, td { padding: 10px 12px; border-bottom: 1px solid #e5e8ea; text-align: left; vertical-align: middle; }
th { background: var(--primary); color: #fff; white-space: nowrap; }
th a { color: #fff; text-decoration: none; }
tr:hover td { background: #f8fafb; }
.thumb { width: 52px; height: 52px; object-fit: cover; border-radius: 6px; background: #dfe6e9; }
.thumb-empty { display: inline-flex; width: 52px; height: 52px; align-items: center; justify-content: center; background: #dfe6e9; border-radius: 6px; color: #636e72; }
.inline-form { display: inline-flex; gap: 6px; align-items: center; }
.inline-form input[type=number] { width: 70px; padding: 5px; }
.actions { display: flex; gap: 6px; flex-wrap: wrap; align-items: center; }

.filters { display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end; margin-bottom: 18px; }
.filters > div { flex: 1 1 140px; position: relative; }
.filters label { margin-top: 0; }

.suggestions { position: absolute; z-index: 20; top: 100%; left: 0; right: 0; background: #fff; border: 1px solid #ccd1d4; border-radius: 0 0 6px 6px; list-style: none; box-shadow: 0 6px 14px rgba(0,0,0,0.12); max-height: 240px; overflow-y: auto; }
.suggestions li { padding: 9px 12px; cursor: pointer; }
.suggestions li:hover, .suggestions li.active { background: #eaf0f6; }

.pagination { display: flex; flex-wrap: wrap; gap: 6px; justify-content: center; margin-top: 22px; }
.pagination a, .pagination span { padding: 7px 13px; background: #fff; border: 1px solid #dcdfe3; border-radius: 4px; text-decoration: none; }
.pagination .active { background: var(--primary); color: #fff; border-color: var(--primary); }
.pagination .disabled { color: #b2bec3; }

.stats { display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 22px; }
.stat { flex: 1 1 170px; background: var(--primary); color: #fff; padding: 18px; border-radius: 8px; }
.stat b { display: block; font-size: 1.6rem; color: #f1c40f; }
.site-footer { background: var(--primary); color: #bdc3c7; text-align: center; padding: 16px 0; }
````

---

## Experiment 1

**Aim:** Design a MySQL database named webapp_db with users, products, and orders tables, defining primary keys, foreign keys, and appropriate data types.

**`sql/schema.sql`**

````sql
CREATE DATABASE IF NOT EXISTS webapp_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE webapp_db;

CREATE TABLE IF NOT EXISTS users (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(100)  NOT NULL,
  email      VARCHAR(150)  NOT NULL UNIQUE,
  password   VARCHAR(255)  NOT NULL,                 -- password_hash() output
  created_at TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS products (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(150)  NOT NULL,
  category    VARCHAR(60)   NOT NULL,
  description TEXT,
  price       DECIMAL(10,2) NOT NULL CHECK (price >= 0),
  stock       INT UNSIGNED  NOT NULL DEFAULT 0,
  image       VARCHAR(255)  DEFAULT NULL,            -- stored file name only
  created_at  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_category (category),
  INDEX idx_name (name)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS orders (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id    INT UNSIGNED  NOT NULL,
  total      DECIMAL(10,2) NOT NULL,
  status     ENUM('Pending','Paid','Shipped') NOT NULL DEFAULT 'Pending',
  created_at TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- items of each order (needed to store the cart contents, Experiment 19)
CREATE TABLE IF NOT EXISTS order_items (
  id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  order_id     INT UNSIGNED  NOT NULL,
  product_id   INT UNSIGNED  NULL,
  product_name VARCHAR(150)  NOT NULL,               -- snapshot, survives product deletion
  quantity     INT UNSIGNED  NOT NULL,
  price        DECIMAL(10,2) NOT NULL,
  CONSTRAINT fk_items_order   FOREIGN KEY (order_id)   REFERENCES orders(id)   ON DELETE CASCADE,
  CONSTRAINT fk_items_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- "Remember me" tokens (Experiment 17): only a hash of the secret is stored
CREATE TABLE IF NOT EXISTS remember_tokens (
  id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id        INT UNSIGNED NOT NULL,
  selector       CHAR(18)     NOT NULL UNIQUE,
  validator_hash CHAR(64)     NOT NULL,
  expires_at     DATETIME     NOT NULL,
  CONSTRAINT fk_tokens_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;
````

**`sql/seed.sql`**

````sql
USE webapp_db;
INSERT INTO products (name, category, description, price, stock) VALUES
('Wireless Mouse',        'Electronics', 'Ergonomic 2.4 GHz wireless mouse.',            599.00, 40),
('Mechanical Keyboard',   'Electronics', 'Blue switch keyboard with backlight.',        2499.00, 15),
('USB-C Charger 65W',     'Electronics', 'Fast charger for laptops and phones.',        1299.00, 25),
('Bluetooth Speaker',     'Electronics', 'Portable waterproof speaker.',                1799.00, 12),
('Clean Code',            'Books',       'A handbook of agile software craftsmanship.',  899.00, 20),
('Let Us C',              'Books',       'Learn C programming step by step.',            450.00, 35),
('The Pragmatic Programmer','Books',     'Your journey to mastery.',                     999.00, 10),
('Cotton T-Shirt',        'Clothing',    '100% cotton, regular fit.',                    399.00, 60),
('Denim Jacket',          'Clothing',    'Classic blue denim jacket.',                  1999.00, 8),
('Running Shoes',         'Clothing',    'Lightweight shoes for daily running.',        2999.00, 18),
('Desk Lamp',             'Home',        'LED lamp with adjustable brightness.',         799.00, 22),
('Steel Water Bottle',    'Home',        '1 litre insulated bottle.',                    549.00, 50);
````

---

## Experiment 2

**Aim:** Create a PHP database connection file using mysqli (or PDO) with proper error handling, and include it across multiple pages using require_once.

**`config/db.php`**

````php
<?php
// Database connection (PDO). Include everywhere with:  require_once __DIR__ . '/config/db.php';
// require_once guarantees the file is loaded only once per request, even if several files include it.
const DB_HOST = 'localhost';
const DB_NAME = 'webapp_db';
const DB_USER = 'root';
const DB_PASS = '';           // set your MySQL password

function getConnection(): PDO {
    static $pdo = null;                         // one shared connection per request
    if ($pdo !== null) {
        return $pdo;
    }

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,   // throw exceptions on SQL errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,                    // real server-side prepared statements
    ];
    // block "stacked queries" (a second statement hidden in injected input) when supported
    if (defined('PDO::MYSQL_ATTR_MULTI_STATEMENTS')) {
        $options[PDO::MYSQL_ATTR_MULTI_STATEMENTS] = false;
    }

    try {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        error_log('DB connection failed: ' . $e->getMessage());     // details go to the log, not the browser
        http_response_code(500);
        die('Sorry, the service is temporarily unavailable. Please try again later.');
    }
    return $pdo;
}

/* ---- Equivalent using mysqli (alternative) ----
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    die('Database unavailable.');
}
*/
````

**`db_test.php`**

````php
<?php
// Open in the browser to test the connection. Files can include the same config many times safely.
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/db.php';      // ignored: already included

$pdo = getConnection();
$version = $pdo->query('SELECT VERSION()')->fetchColumn();
$tables  = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>DB Test</title></head>
<body style="font-family:Arial;margin:30px">
  <h2>Connected to <?= htmlspecialchars(DB_NAME) ?></h2>
  <p>MySQL version: <?= htmlspecialchars($version) ?></p>
  <p>Tables: <?= htmlspecialchars(implode(', ', $tables)) ?></p>
</body></html>
````

---

## Experiment 3

**Aim:** Build a user registration page with server-side validation and store passwords securely using password_hash().

**`register.php`**

````php
<?php
$pageTitle = 'Register';
require_once 'includes/auth.php';
if (is_logged_in()) {
    redirect('dashboard.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $name     = trim(strip_tags($_POST['name'] ?? ''));
    $email    = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    // ---- server-side validation ----
    if (mb_strlen($name) < 2 || mb_strlen($name) > 100)  $errors[] = 'Name must be between 2 and 100 characters.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))      $errors[] = 'Enter a valid email address.';
    if (strlen($password) < 8)                           $errors[] = 'Password must be at least 8 characters.';
    if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/\d/', $password)) {
        $errors[] = 'Password needs an uppercase letter, a lowercase letter and a number.';
    }
    if ($password !== $confirm)                          $errors[] = 'Passwords do not match.';

    if (!$errors) {
        $pdo = getConnection();
        $check = $pdo->prepare('SELECT id FROM users WHERE email = :email');
        $check->execute([':email' => $email]);

        if ($check->fetch()) {
            $errors[] = 'An account with this email already exists.';
        } else {
            // never store the plain password: password_hash() adds a random salt and uses bcrypt/argon2
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:n, :e, :p)')
                ->execute([':n' => $name, ':e' => $email, ':p' => $hash]);
            set_flash('Registration successful! Please log in.');
            redirect('login.php');
        }
    }
}
require_once 'includes/header.php';
?>
<div class="panel form-narrow">
  <h1>Create an account</h1>
  <?php foreach ($errors as $err): ?><div class="alert alert-danger"><?= e($err) ?></div><?php endforeach; ?>
  <form method="post" novalidate>
    <?= csrf_field() ?>
    <label for="name">Full name</label>
    <input type="text" id="name" name="name" value="<?= old('name') ?>" required>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= old('email') ?>" required>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
    <label for="confirm_password">Confirm password</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    <br><button class="btn" type="submit">Register</button>
  </form>
  <p>Already registered? <a href="login.php">Log in</a></p>
</div>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 4

**Aim:** Implement a login page that verifies credentials using password_verify() and starts a user session with session_start().

**`login.php`**

````php
<?php
$pageTitle = 'Login';
require_once 'includes/auth.php';
if (is_logged_in()) {
    redirect('dashboard.php');
}

$error = '';
$email = '';

// only allow redirecting back to simple local pages, e.g. "cart.php"
$next = $_GET['next'] ?? $_POST['next'] ?? '';
if (!preg_match('/^[a-z_]+\.php$/', $next)) {
    $next = 'dashboard.php';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $email    = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    $stmt = getConnection()->prepare('SELECT id, name, password FROM users WHERE email = :email');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);                         // new session ID after login (stops session fixation)
        $_SESSION['user_id']   = (int)$user['id'];
        $_SESSION['user_name'] = $user['name'];

        // personalised message: remember when the user was here last (plain, non-sensitive cookie)
        $_SESSION['previous_login'] = $_COOKIE['last_login'] ?? null;
        setcookie('last_login', date('d M Y, h:i A'), [
            'expires' => time() + 60 * 60 * 24 * 365, 'path' => '/', 'httponly' => true, 'samesite' => 'Lax',
        ]);

        if (!empty($_POST['remember'])) {
            remember_set((int)$user['id']);                  // "Remember Me" checkbox (Experiment 17)
        }
        redirect($next);
    }
    $error = 'Invalid email or password.';    // same message for both cases: do not reveal which was wrong
}
require_once 'includes/header.php';
?>
<div class="panel form-narrow">
  <h1>Login</h1>
  <?php if (!empty($_COOKIE['last_login']) && !$error): ?>
    <p class="muted">Welcome back! You last logged in on <?= e($_COOKIE['last_login']) ?>.</p>
  <?php endif; ?>
  <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
  <form method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="next" value="<?= e($next) ?>">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= e($email) ?>" required>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
    <label class="check"><input type="checkbox" name="remember" value="1"> Remember me for 30 days</label>
    <br><button class="btn" type="submit">Login</button>
  </form>
  <p>New here? <a href="register.php">Create an account</a></p>
</div>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 5

**Aim:** Create a protected dashboard page that redirects unauthenticated visitors to the login page using session checks.

**`includes/auth.php`**

````php
<?php
// Include this first on every page: starts the session, restores "remember me" logins
// and provides the login check used to protect pages.
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/remember.php';
remember_autologin();

function is_logged_in(): bool {
    return isset($_SESSION['user_id']);
}

/** Put at the top of any protected page: sends visitors who are not logged in to the login page. */
function require_login(): void {
    if (!is_logged_in()) {
        set_flash('Please log in to access that page.', 'danger');
        redirect('login.php?next=' . urlencode(basename($_SERVER['PHP_SELF'])));
    }
}
````

**`dashboard.php`**

````php
<?php
$pageTitle = 'Dashboard';
require_once 'includes/auth.php';
require_login();                       // redirects to login.php when there is no session

$pdo = getConnection();

$stats = $pdo->prepare('SELECT COUNT(*) AS orders, COALESCE(SUM(total), 0) AS spent FROM orders WHERE user_id = :u');
$stats->execute([':u' => $_SESSION['user_id']]);
$stats = $stats->fetch();
$productCount = (int)$pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();

$recent = $pdo->prepare('SELECT id, total, status, created_at FROM orders WHERE user_id = :u ORDER BY created_at DESC LIMIT 5');
$recent->execute([':u' => $_SESSION['user_id']]);
$recent = $recent->fetchAll();

require_once 'includes/header.php';
?>
<h1>Welcome back, <?= e($_SESSION['user_name']) ?>!</h1>
<?php if (!empty($_SESSION['previous_login'])): ?>
  <p class="muted">Your previous visit was on <?= e($_SESSION['previous_login']) ?>.</p>
<?php else: ?>
  <p class="muted">This is your first visit. Enjoy exploring!</p>
<?php endif; ?>

<div class="stats">
  <div class="stat">Products<b><?= $productCount ?></b></div>
  <div class="stat">Your orders<b><?= (int)$stats['orders'] ?></b></div>
  <div class="stat">Total spent<b>&#8377;<?= number_format((float)$stats['spent'], 2) ?></b></div>
  <div class="stat">Cart items<b><?= cart_count() ?></b></div>
</div>

<div class="panel">
  <h2>Recent orders</h2>
  <?php if (!$recent): ?>
    <p>No orders yet. <a href="products.php">Browse products</a></p>
  <?php else: ?>
    <div class="table-wrap"><table>
      <tr><th>Order</th><th>Date</th><th>Total</th><th>Status</th></tr>
      <?php foreach ($recent as $o): ?>
        <tr><td>#<?= (int)$o['id'] ?></td><td><?= e(date('d M Y, h:i A', strtotime($o['created_at']))) ?></td>
            <td>&#8377;<?= number_format((float)$o['total'], 2) ?></td><td><?= e($o['status']) ?></td></tr>
      <?php endforeach; ?>
    </table></div>
  <?php endif; ?>
</div>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 6

**Aim:** Implement a secure logout script that destroys the session, clears session variables, and removes the session cookie.

**`logout.php`**

````php
<?php
require_once 'includes/auth.php';

// logout must be a POST request with a valid token (a plain link could be triggered by another website)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('dashboard.php');
}
csrf_check();

remember_forget();                   // delete the "remember me" token and cookie

$_SESSION = [];                      // 1. clear all session variables

if (ini_get('session.use_cookies')) {   // 2. remove the session cookie from the browser
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}

session_destroy();                   // 3. destroy the session data on the server

session_start();                     // fresh session only to show a message
set_flash('You have been logged out.');
redirect('login.php');
````

---

## Experiment 7

**Aim:** Write PHP code to insert new product records into the database using prepared statements with bound parameters.

**`product_add.php`**

````php
<?php
$pageTitle = 'Add Product';
require_once 'includes/auth.php';
require_once 'includes/upload.php';
require_login();

$errors = [];
$old = ['name' => '', 'category' => '', 'description' => '', 'price' => '', 'stock' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    foreach ($old as $k => $_) {
        $old[$k] = trim(strip_tags($_POST[$k] ?? ''));
    }
    $price = filter_var($old['price'], FILTER_VALIDATE_FLOAT);
    $stock = filter_var($old['stock'], FILTER_VALIDATE_INT);

    if ($old['name'] === '' || mb_strlen($old['name']) > 150) $errors[] = 'Enter a product name (max 150 characters).';
    if ($old['category'] === '')                              $errors[] = 'Enter a category.';
    if ($price === false || $price < 0)                       $errors[] = 'Enter a valid price.';
    if ($stock === false || $stock < 0)                       $errors[] = 'Enter a valid stock quantity.';

    [$image, $uploadError] = handle_image_upload($_FILES['image'] ?? ['error' => UPLOAD_ERR_NO_FILE]);
    if ($uploadError) $errors[] = $uploadError;

    if (!$errors) {
        $stmt = getConnection()->prepare(
            'INSERT INTO products (name, category, description, price, stock, image)
             VALUES (:name, :category, :description, :price, :stock, :image)'
        );
        // bound parameters: the values are sent separately from the SQL, so they can never change the query
        $stmt->bindValue(':name',        $old['name']);
        $stmt->bindValue(':category',    $old['category']);
        $stmt->bindValue(':description', $old['description']);
        $stmt->bindValue(':price',       $price);
        $stmt->bindValue(':stock',       $stock, PDO::PARAM_INT);
        $stmt->bindValue(':image',       $image, $image === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->execute();

        set_flash('Product "' . $old['name'] . '" added successfully.');
        redirect('products.php');
    }
}
require_once 'includes/header.php';
?>
<div class="panel form-narrow" style="max-width:600px">
  <h1>Add Product</h1>
  <?php foreach ($errors as $err): ?><div class="alert alert-danger"><?= e($err) ?></div><?php endforeach; ?>
  <form method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="<?= e($old['name']) ?>" required>
    <label for="category">Category</label>
    <input type="text" id="category" name="category" value="<?= e($old['category']) ?>" list="cats" required>
    <datalist id="cats"><option>Electronics</option><option>Books</option><option>Clothing</option><option>Home</option></datalist>
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="3"><?= e($old['description']) ?></textarea>
    <label for="price">Price (&#8377;)</label>
    <input type="number" id="price" name="price" step="0.01" min="0" value="<?= e($old['price']) ?>" required>
    <label for="stock">Stock</label>
    <input type="number" id="stock" name="stock" min="0" value="<?= e($old['stock']) ?>" required>
    <label for="image">Photo (JPG, PNG, GIF or WEBP, max 2 MB)</label>
    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/gif,image/webp">
    <br><button class="btn btn-accent" type="submit">Save Product</button>
    <a class="btn" href="products.php">Cancel</a>
  </form>
</div>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 8

**Aim:** Display all product records in a styled HTML table by fetching data from MySQL with a SELECT query.

**`products.php`**

````php
<?php
$pageTitle = 'Products';
require_once 'includes/auth.php';
require_once 'includes/product_filter.php';     // Exp 12: $where, $params, $categories ...
require_once 'includes/product_sort.php';       // Exp 13: $orderBy, sort_link()
require_once 'includes/pagination.php';         // Exp 11: paginate(), render_pagination()

$pdo     = getConnection();
$perPage = 5;

$count = $pdo->prepare("SELECT COUNT(*) FROM products $where");
$count->execute($params);
$total = (int)$count->fetchColumn();

$pg = paginate($total, $perPage, (int)($_GET['page'] ?? 1));

$stmt = $pdo->prepare("SELECT * FROM products $where ORDER BY $orderBy LIMIT :limit OFFSET :offset");
foreach ($params as $name => $value) {
    $stmt->bindValue($name, $value);
}
$stmt->bindValue(':limit',  $pg['perPage'], PDO::PARAM_INT);
$stmt->bindValue(':offset', $pg['offset'],  PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll();

require_once 'includes/header.php';
?>
<h1>Products</h1>

<form class="filters panel" method="get" action="products.php" autocomplete="off">
  <div>
    <label for="searchInput">Search name</label>
    <input type="search" id="searchInput" name="q" value="<?= e($q) ?>" placeholder="e.g. mouse">
    <ul class="suggestions" id="suggestions" hidden></ul>
  </div>
  <div>
    <label for="category">Category</label>
    <select id="category" name="category">
      <option value="">All</option>
      <?php foreach ($categories as $c): ?>
        <option value="<?= e($c) ?>" <?= $c === $category ? 'selected' : '' ?>><?= e($c) ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div><label for="min">Min price</label><input type="number" id="min" name="min" step="0.01" min="0" value="<?= $min !== false ? e($min) : '' ?>"></div>
  <div><label for="max">Max price</label><input type="number" id="max" name="max" step="0.01" min="0" value="<?= $max !== false ? e($max) : '' ?>"></div>
  <div style="flex:0 0 auto">
    <input type="hidden" name="sort" value="<?= e($sort) ?>"><input type="hidden" name="dir" value="<?= e($dir) ?>">
    <button class="btn" type="submit">Filter</button> <a class="btn btn-small" href="products.php">Reset</a>
  </div>
</form>

<p class="muted"><?= $total ?> product(s) found &middot; page <?= $pg['page'] ?> of <?= $pg['pages'] ?></p>

<div class="table-wrap">
<table>
  <tr>
    <th>Photo</th>
    <th><?= sort_link('name', 'Name', $sort, $dir) ?></th>
    <th><?= sort_link('category', 'Category', $sort, $dir) ?></th>
    <th><?= sort_link('price', 'Price', $sort, $dir) ?></th>
    <th><?= sort_link('stock', 'Stock', $sort, $dir) ?></th>
    <th>Actions</th>
  </tr>
  <?php foreach ($products as $p): ?>
    <tr>
      <td>
        <?php if ($p['image']): ?>
          <img class="thumb" src="uploads/products/<?= e($p['image']) ?>" alt="<?= e($p['name']) ?>">
        <?php else: ?><span class="thumb-empty" aria-hidden="true">&#128247;</span><?php endif; ?>
      </td>
      <td><strong><?= e($p['name']) ?></strong><br><small><?= e($p['description']) ?></small></td>
      <td><?= e($p['category']) ?></td>
      <td>&#8377;<?= number_format((float)$p['price'], 2) ?></td>
      <td><?= (int)$p['stock'] ?></td>
      <td class="actions">
        <?php if ($p['stock'] > 0): ?>
          <form method="post" action="cart.php" class="inline-form">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="product_id" value="<?= (int)$p['id'] ?>">
            <button class="btn btn-small btn-accent" type="submit">Add to cart</button>
          </form>
        <?php else: ?><span class="muted">Out of stock</span><?php endif; ?>

        <?php if (is_logged_in()): ?>
          <a class="btn btn-small" href="product_edit.php?id=<?= (int)$p['id'] ?>">Edit</a>
          <form method="post" action="product_delete.php" class="inline-form"
                data-confirm="Delete &quot;<?= e($p['name']) ?>&quot;? This cannot be undone.">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
            <button class="btn btn-small btn-danger" type="submit">Delete</button>
          </form>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
  <?php if (!$products): ?><tr><td colspan="6">No products match your search.</td></tr><?php endif; ?>
</table>
</div>
<?= render_pagination($pg) ?>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 9

**Aim:** Implement an edit form that pre-fills existing record data and updates it in the database using an UPDATE query.

**`product_edit.php`**

````php
<?php
$pageTitle = 'Edit Product';
require_once 'includes/auth.php';
require_once 'includes/upload.php';
require_login();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    redirect('products.php');
}

$pdo  = getConnection();
$stmt = $pdo->prepare('SELECT * FROM products WHERE id = :id');
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();
if (!$product) {
    set_flash('Product not found.', 'danger');
    redirect('products.php');
}

$errors = [];
$form = $product;                              // the form is pre-filled with the current database values

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    foreach (['name', 'category', 'description', 'price', 'stock'] as $k) {
        $form[$k] = trim(strip_tags($_POST[$k] ?? ''));
    }
    $price = filter_var($form['price'], FILTER_VALIDATE_FLOAT);
    $stock = filter_var($form['stock'], FILTER_VALIDATE_INT);

    if ($form['name'] === '')            $errors[] = 'Enter a product name.';
    if ($form['category'] === '')        $errors[] = 'Enter a category.';
    if ($price === false || $price < 0)  $errors[] = 'Enter a valid price.';
    if ($stock === false || $stock < 0)  $errors[] = 'Enter a valid stock quantity.';

    [$newImage, $uploadError] = handle_image_upload($_FILES['image'] ?? ['error' => UPLOAD_ERR_NO_FILE]);
    if ($uploadError) $errors[] = $uploadError;

    if (!$errors) {
        $image = $newImage ?? $product['image'];                 // keep the old photo unless a new one was uploaded
        $pdo->prepare(
            'UPDATE products SET name = :name, category = :category, description = :description,
                                 price = :price, stock = :stock, image = :image
             WHERE id = :id'
        )->execute([
            ':name' => $form['name'], ':category' => $form['category'], ':description' => $form['description'],
            ':price' => $price, ':stock' => $stock, ':image' => $image, ':id' => $id,
        ]);
        if ($newImage !== null) {
            delete_image($product['image']);                     // remove the replaced photo from disk
        }
        set_flash('Product updated successfully.');
        redirect('products.php');
    }
}
require_once 'includes/header.php';
?>
<div class="panel form-narrow" style="max-width:600px">
  <h1>Edit Product #<?= (int)$id ?></h1>
  <?php foreach ($errors as $err): ?><div class="alert alert-danger"><?= e($err) ?></div><?php endforeach; ?>
  <form method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= (int)$id ?>">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="<?= e($form['name']) ?>" required>
    <label for="category">Category</label>
    <input type="text" id="category" name="category" value="<?= e($form['category']) ?>" required>
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="3"><?= e($form['description']) ?></textarea>
    <label for="price">Price (&#8377;)</label>
    <input type="number" id="price" name="price" step="0.01" min="0" value="<?= e($form['price']) ?>" required>
    <label for="stock">Stock</label>
    <input type="number" id="stock" name="stock" min="0" value="<?= e($form['stock']) ?>" required>
    <?php if ($product['image']): ?>
      <p>Current photo:<br><img class="thumb" style="width:90px;height:90px" src="uploads/products/<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>"></p>
    <?php endif; ?>
    <label for="image">Replace photo (optional)</label>
    <input type="file" id="image" name="image" accept="image/*">
    <br><button class="btn btn-accent" type="submit">Update Product</button>
    <a class="btn" href="products.php">Cancel</a>
  </form>
</div>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 10

**Aim:** Implement record deletion with a JavaScript confirmation prompt and a secure PHP DELETE handler.

**`product_delete.php`**

````php
<?php
// Delete handler. The JavaScript prompt (js/confirm.js) is only a convenience;
// the real protection is here on the server: POST only, valid CSRF token, logged-in user.
require_once 'includes/auth.php';
require_once 'includes/upload.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die('Method not allowed. Deleting is only possible through the Delete button.');
}
csrf_check();

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    set_flash('Invalid product.', 'danger');
    redirect('products.php');
}

$pdo = getConnection();
$stmt = $pdo->prepare('SELECT name, image FROM products WHERE id = :id');
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();

if ($product) {
    $pdo->prepare('DELETE FROM products WHERE id = :id')->execute([':id' => $id]);
    delete_image($product['image']);
    set_flash('Product "' . $product['name'] . '" was deleted.');
} else {
    set_flash('That product no longer exists.', 'danger');
}
redirect('products.php');
````

**`js/confirm.js`**

````javascript
// Shows a confirmation prompt before submitting any form that has a data-confirm attribute.
// Example: <form data-confirm="Delete this product?">
document.addEventListener('submit', function (event) {
  var message = event.target.getAttribute('data-confirm');
  if (message && !window.confirm(message)) {
    event.preventDefault();          // user clicked Cancel: nothing is sent to the server
  }
});
````

---

## Experiment 11

**Aim:** Add pagination to the product listing page using LIMIT and OFFSET, with Previous/Next and numbered page links.

**`includes/pagination.php`**

````php
<?php
/** Works out the page number and the OFFSET for a LIMIT/OFFSET query. */
function paginate(int $total, int $perPage, int $page): array {
    $pages = max(1, (int)ceil($total / $perPage));
    $page  = min(max(1, $page), $pages);           // keep the page inside 1..$pages
    return ['total' => $total, 'perPage' => $perPage, 'pages' => $pages,
            'page' => $page, 'offset' => ($page - 1) * $perPage];
}

/** Previous / 1 2 3 ... / Next links. Search, filter and sort settings stay in the URL. */
function render_pagination(array $pg): string {
    if ($pg['pages'] <= 1) {
        return '';
    }
    $query = $_GET;
    unset($query['page']);
    $url = fn(int $p) => 'products.php?' . http_build_query($query + ['page' => $p]);

    $html = '<nav class="pagination" aria-label="Pagination">';
    $html .= $pg['page'] > 1
        ? '<a href="' . e($url($pg['page'] - 1)) . '">&laquo; Previous</a>'
        : '<span class="disabled">&laquo; Previous</span>';

    for ($p = 1; $p <= $pg['pages']; $p++) {
        if ($p === 1 || $p === $pg['pages'] || abs($p - $pg['page']) <= 2) {
            $html .= $p === $pg['page']
                ? '<span class="active">' . $p . '</span>'
                : '<a href="' . e($url($p)) . '">' . $p . '</a>';
        } elseif (abs($p - $pg['page']) === 3) {
            $html .= '<span class="disabled">&hellip;</span>';
        }
    }

    $html .= $pg['page'] < $pg['pages']
        ? '<a href="' . e($url($pg['page'] + 1)) . '">Next &raquo;</a>'
        : '<span class="disabled">Next &raquo;</span>';
    return $html . '</nav>';
}
````

---

## Experiment 12

**Aim:** Create a search and filter feature that retrieves products by name, category, or price range using LIKE and BETWEEN clauses.

**`includes/product_filter.php`**

````php
<?php
// Builds the WHERE clause for the product list from ?q= (name), ?category= and ?min= / ?max= (price).
// Every value goes through a named placeholder, never directly into the SQL text.
$q        = trim(strip_tags($_GET['q'] ?? ''));
$category = trim($_GET['category'] ?? '');
$min      = ($_GET['min'] ?? '') !== '' ? filter_var($_GET['min'], FILTER_VALIDATE_FLOAT) : false;
$max      = ($_GET['max'] ?? '') !== '' ? filter_var($_GET['max'], FILTER_VALIDATE_FLOAT) : false;
if ($min !== false && $max !== false && $min > $max) {
    [$min, $max] = [$max, $min];                     // swap if the user typed them the wrong way round
}

$conditions = [];
$params     = [];

if ($q !== '') {
    $conditions[] = 'name LIKE :q';
    $params[':q'] = '%' . addcslashes($q, '%_\\') . '%';      // escape LIKE wildcards typed by the user
}
if ($category !== '') {
    $conditions[] = 'category = :category';
    $params[':category'] = $category;
}
if ($min !== false && $max !== false) {
    $conditions[] = 'price BETWEEN :min AND :max';            // both limits given
    $params[':min'] = $min;
    $params[':max'] = $max;
} elseif ($min !== false) {
    $conditions[] = 'price >= :min';
    $params[':min'] = $min;
} elseif ($max !== false) {
    $conditions[] = 'price <= :max';
    $params[':max'] = $max;
}

$where = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';
$categories = getConnection()->query('SELECT DISTINCT category FROM products ORDER BY category')->fetchAll(PDO::FETCH_COLUMN);
````

---

## Experiment 13

**Aim:** Implement column sorting (ascending/descending) on the product table by clicking the table headers.

**`includes/product_sort.php`**

````php
<?php
// Column sorting. ORDER BY cannot use placeholders, so the column and direction are
// checked against a fixed whitelist instead.
$sortableColumns = ['id', 'name', 'category', 'price', 'stock'];

$sort = $_GET['sort'] ?? 'id';
$dir  = strtolower($_GET['dir'] ?? 'asc');
if (!in_array($sort, $sortableColumns, true)) { $sort = 'id'; }
if (!in_array($dir, ['asc', 'desc'], true))   { $dir  = 'asc'; }

$orderBy = "$sort " . strtoupper($dir);

/** Header link: first click sorts ascending, second click descending. Keeps search/filter in the URL. */
function sort_link(string $column, string $label, string $currentSort, string $currentDir): string {
    $nextDir = ($currentSort === $column && $currentDir === 'asc') ? 'desc' : 'asc';
    $query = $_GET;
    unset($query['page']);                         // go back to page 1 when the order changes
    $query['sort'] = $column;
    $query['dir']  = $nextDir;
    $arrow = $currentSort === $column ? ($currentDir === 'asc' ? ' &#9650;' : ' &#9660;') : '';
    return '<a href="products.php?' . e(http_build_query($query)) . '">' . e($label) . $arrow . '</a>';
}
````

---

## Experiment 14

**Aim:** Build an image upload feature for product photos with validation of file type, size, and unique file naming in PHP.

**`includes/upload.php`**

````php
<?php
const UPLOAD_DIR = __DIR__ . '/../uploads/products/';
const MAX_IMAGE_BYTES = 2 * 1024 * 1024;       // 2 MB

/**
 * Validates and stores an uploaded product photo.
 * Returns [stored file name or null, error message or null].
 */
function handle_image_upload(array $file): array {
    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        return [null, null];                                       // image is optional
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return [null, 'Upload failed (error code ' . $file['error'] . ').'];
    }
    if ($file['size'] > MAX_IMAGE_BYTES) {
        return [null, 'The image must be smaller than 2 MB.'];
    }
    if (!is_uploaded_file($file['tmp_name'])) {
        return [null, 'Invalid upload.'];
    }

    // check the real file contents, not the name or the browser-supplied type
    $info = @getimagesize($file['tmp_name']);
    $allowed = [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png', IMAGETYPE_GIF => 'gif', IMAGETYPE_WEBP => 'webp'];
    if ($info === false || !isset($allowed[$info[2]])) {
        return [null, 'Only JPG, PNG, GIF or WEBP images are allowed.'];
    }

    // unique, random name: the original file name is never used (prevents overwriting and path tricks)
    $newName = bin2hex(random_bytes(16)) . '.' . $allowed[$info[2]];

    if (!is_dir(UPLOAD_DIR) && !mkdir(UPLOAD_DIR, 0755, true)) {
        return [null, 'Upload folder is not available.'];
    }
    if (!move_uploaded_file($file['tmp_name'], UPLOAD_DIR . $newName)) {
        return [null, 'Could not save the image. Check folder permissions.'];
    }
    return [$newName, null];
}

function delete_image(?string $name): void {
    if ($name) {
        $path = UPLOAD_DIR . basename($name);
        if (is_file($path)) {
            unlink($path);
        }
    }
}
````

**`uploads/.htaccess`**

````apache
# Uploaded files must never be executed as code, even if a PHP file slips through.
php_flag engine off
RemoveHandler .php .phtml .php3 .php5
Options -Indexes -ExecCGI
<FilesMatch "\.(php|phtml|php\d?|pl|py|cgi|sh)$">
    Require all denied
</FilesMatch>
````

---

## Experiment 15

**Aim:** Demonstrate protection against SQL injection by comparing a vulnerable query with a prepared-statement version.

**`injection_demo.php`**

````php
<?php
$pageTitle = 'SQL Injection Demo';
require_once 'includes/auth.php';

$input = trim($_GET['name'] ?? '');
$vulnerableRows = $safeRows = null;
$vulnerableSql = $error = '';

if ($input !== '') {
    $pdo = getConnection();

    // ---------- VULNERABLE: user input is pasted into the SQL text ----------
    $vulnerableSql = "SELECT id, name, price FROM products WHERE name = '$input'";
    try {
        $vulnerableRows = $pdo->query($vulnerableSql)->fetchAll();
    } catch (PDOException $ex) {
        $error = 'SQL error: ' . $ex->getMessage();
    }

    // ---------- SAFE: prepared statement, the input is only ever data ----------
    $stmt = $pdo->prepare('SELECT id, name, price FROM products WHERE name = :name');
    $stmt->execute([':name' => $input]);
    $safeRows = $stmt->fetchAll();
}
require_once 'includes/header.php';
?>
<h1>SQL Injection: Vulnerable vs Safe</h1>
<div class="alert alert-danger">Educational demo only. Never build SQL like the vulnerable version in real code.</div>

<div class="panel">
  <form method="get">
    <label for="name">Product name</label>
    <input type="text" id="name" name="name" value="<?= e($input) ?>">
    <p class="muted">Try: <code>Wireless Mouse</code> (normal) and then <code>' OR '1'='1</code> (attack).</p>
    <button class="btn" type="submit">Search</button>
  </form>
</div>

<?php if ($input !== ''): ?>
<div class="panel">
  <h2>1. Vulnerable query (string concatenation)</h2>
  <p>SQL that was sent to MySQL:</p>
  <p class="output-box" style="background:#fdecea;border-color:#c0392b"><code><?= e($vulnerableSql) ?></code></p>
  <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
  <?php if ($vulnerableRows !== null): ?>
    <p><strong><?= count($vulnerableRows) ?> row(s) returned</strong>
       <?= count($vulnerableRows) > 1 ? ' - the attack changed the WHERE condition and exposed every product!' : '' ?></p>
    <ul><?php foreach ($vulnerableRows as $r): ?><li><?= e($r['name']) ?> (&#8377;<?= e($r['price']) ?>)</li><?php endforeach; ?></ul>
  <?php endif; ?>
</div>

<div class="panel">
  <h2>2. Safe query (prepared statement)</h2>
  <p>SQL sent to MySQL: <code>SELECT id, name, price FROM products WHERE name = :name</code><br>
     Value bound separately: <code><?= e($input) ?></code></p>
  <p><strong><?= count($safeRows) ?> row(s) returned</strong> - the input is treated only as text to compare with.</p>
  <ul><?php foreach ($safeRows as $r): ?><li><?= e($r['name']) ?> (&#8377;<?= e($r['price']) ?>)</li><?php endforeach; ?></ul>
</div>
<?php endif; ?>

<div class="panel">
  <h2>Why prepared statements work</h2>
  <ol style="margin-left:20px">
    <li>MySQL receives and compiles the SQL structure first, with placeholders.</li>
    <li>The values are sent afterwards as data. They can never become SQL commands.</li>
    <li>Every query in this project (login, products, cart, orders) uses this pattern.</li>
  </ol>
</div>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 16

**Aim:** Prevent Cross-Site Scripting (XSS) by escaping all user-generated output using htmlspecialchars().

**`includes/functions.php`**

````php
<?php
// Core helpers shared by every page: session, output escaping (XSS), CSRF tokens, flash messages.
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,           // session cookie
        'path'     => '/',
        'httponly' => true,        // not readable by JavaScript
        'samesite' => 'Lax',       // basic CSRF protection
    ]);
    session_start();
}
require_once __DIR__ . '/../config/db.php';

/**
 * Escape any value before printing it in HTML. This is the XSS defence:
 * <script> becomes &lt;script&gt; and is shown as harmless text.
 */
function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

/** Re-display a submitted form value (escaped). */
function old(string $key, $default = ''): string {
    return e($_POST[$key] ?? $default);
}

function set_flash(string $message, string $type = 'success'): void {
    $_SESSION['flash'] = ['msg' => $message, 'type' => $type];
}
function get_flash(): ?array {
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

/* ----- CSRF protection for every POST form ----- */
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}
function csrf_check(): void {
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
        http_response_code(400);
        die('Invalid or expired form token. Please go back, refresh and try again.');
    }
}

function cart_count(): int {
    return array_sum($_SESSION['cart'] ?? []);
}
````

**`xss_demo.php`**

````php
<?php
$pageTitle = 'XSS Demo';
require_once 'includes/auth.php';

$input = $_GET['comment'] ?? '<script>alert("XSS")</script><b>Hello</b>';
require_once 'includes/header.php';
?>
<h1>Cross-Site Scripting (XSS) Demo</h1>
<div class="panel">
  <form method="get">
    <label for="comment">Try typing HTML or JavaScript:</label>
    <input type="text" id="comment" name="comment" value="<?= e($input) ?>">
    <br><button class="btn" type="submit">Show output</button>
  </form>
</div>

<div class="panel">
  <h2>1. Without escaping (vulnerable)</h2>
  <p>If the page did <code>echo $input;</code>, the browser would treat the text as real HTML. It is shown below
     inside a sandboxed frame so scripts cannot run here:</p>
  <iframe sandbox srcdoc="<?= e($input) ?>" style="width:100%;height:80px;border:1px dashed #c0392b"></iframe>
  <p class="muted">An attacker could use this to steal cookies, change the page or redirect visitors.</p>
</div>

<div class="panel">
  <h2>2. With htmlspecialchars() (safe)</h2>
  <p>Using <code>echo e($input);</code> the browser shows exactly what was typed:</p>
  <p class="output-box"><?= e($input) ?></p>
  <p>Characters converted by <code>htmlspecialchars()</code>:</p>
  <table>
    <tr><th>Typed</th><th>Sent to browser</th></tr>
    <tr><td>&lt;</td><td><?= e('&lt;') ?></td></tr>
    <tr><td>&gt;</td><td><?= e('&gt;') ?></td></tr>
    <tr><td>&amp;</td><td><?= e('&amp;') ?></td></tr>
    <tr><td>&quot;</td><td><?= e('&quot;') ?></td></tr>
    <tr><td>&#039;</td><td><?= e('&#039;') ?></td></tr>
  </table>
</div>
<div class="panel">
  <h2>Where escaping is applied in this project</h2>
  <p>Every value printed from the database, the URL, cookies or a form uses <code>e()</code>:
     product names, categories, user names, search terms, flash messages and the "last visit" cookie.</p>
</div>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 17

**Aim:** Use cookies to implement a "Remember Me" option on the login form and display a personalized welcome message.

**`includes/remember.php`**

````php
<?php
// "Remember Me" using a split token (selector + validator).
//  - cookie holds  selector:validator   (validator is random, never stored in plain text)
//  - database holds selector + SHA-256 hash of the validator, so a leaked database cannot be used to log in
const REMEMBER_COOKIE = 'remember_me';
const REMEMBER_DAYS   = 30;

function remember_set(int $userId): void {
    $selector  = bin2hex(random_bytes(9));      // 18 hex characters
    $validator = bin2hex(random_bytes(32));
    $expires   = time() + 60 * 60 * 24 * REMEMBER_DAYS;

    getConnection()->prepare(
        'INSERT INTO remember_tokens (user_id, selector, validator_hash, expires_at) VALUES (:u, :s, :v, :e)'
    )->execute([
        ':u' => $userId,
        ':s' => $selector,
        ':v' => hash('sha256', $validator),
        ':e' => date('Y-m-d H:i:s', $expires),
    ]);

    setcookie(REMEMBER_COOKIE, $selector . ':' . $validator, [
        'expires' => $expires, 'path' => '/', 'httponly' => true, 'samesite' => 'Lax',
    ]);
}

/** Called on every request: logs the user in again if a valid remember cookie is present. */
function remember_autologin(): void {
    if (isset($_SESSION['user_id']) || empty($_COOKIE[REMEMBER_COOKIE])) {
        return;
    }
    $parts = explode(':', $_COOKIE[REMEMBER_COOKIE], 2);
    if (count($parts) !== 2 || !ctype_xdigit($parts[0]) || !ctype_xdigit($parts[1])) {
        remember_clear_cookie();
        return;
    }
    [$selector, $validator] = $parts;

    $stmt = getConnection()->prepare(
        'SELECT t.id, t.user_id, t.validator_hash, u.name
         FROM remember_tokens t JOIN users u ON u.id = t.user_id
         WHERE t.selector = :s AND t.expires_at > NOW()'
    );
    $stmt->execute([':s' => $selector]);
    $row = $stmt->fetch();

    if ($row && hash_equals($row['validator_hash'], hash('sha256', $validator))) {
        session_regenerate_id(true);
        $_SESSION['user_id']   = (int)$row['user_id'];
        $_SESSION['user_name'] = $row['name'];
        // rotate the token: the old one can never be used again
        getConnection()->prepare('DELETE FROM remember_tokens WHERE id = :id')->execute([':id' => $row['id']]);
        remember_set((int)$row['user_id']);
    } else {
        remember_clear_cookie();
    }
}

/** Removes the token from the database and the cookie from the browser (used on logout). */
function remember_forget(): void {
    if (!empty($_COOKIE[REMEMBER_COOKIE])) {
        $selector = explode(':', $_COOKIE[REMEMBER_COOKIE], 2)[0];
        getConnection()->prepare('DELETE FROM remember_tokens WHERE selector = :s')->execute([':s' => $selector]);
    }
    remember_clear_cookie();
}

function remember_clear_cookie(): void {
    setcookie(REMEMBER_COOKIE, '', ['expires' => time() - 3600, 'path' => '/', 'httponly' => true, 'samesite' => 'Lax']);
    unset($_COOKIE[REMEMBER_COOKIE]);
}
````

---

## Experiment 18

**Aim:** Implement a shopping cart using PHP sessions that supports adding, updating quantities, and removing items.

**`cart.php`**

````php
<?php
$pageTitle = 'Shopping Cart';
require_once 'includes/auth.php';

$pdo = getConnection();
$_SESSION['cart'] = $_SESSION['cart'] ?? [];          // structure: [product_id => quantity]

/** Sets a quantity but never above the stock available. */
function set_cart_qty(PDO $pdo, int $productId, int $qty): string {
    $stmt = $pdo->prepare('SELECT name, stock FROM products WHERE id = :id');
    $stmt->execute([':id' => $productId]);
    $p = $stmt->fetch();
    if (!$p || $p['stock'] < 1) {
        unset($_SESSION['cart'][$productId]);
        return 'That product is not available.';
    }
    if ($qty > $p['stock']) {
        $_SESSION['cart'][$productId] = (int)$p['stock'];
        return 'Only ' . $p['stock'] . ' of "' . $p['name'] . '" in stock. Quantity adjusted.';
    }
    $_SESSION['cart'][$productId] = $qty;
    return '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $action    = $_POST['action'] ?? '';
    $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

    if ($action === 'add' && $productId) {                               // ADD
        $warn = set_cart_qty($pdo, $productId, ($_SESSION['cart'][$productId] ?? 0) + 1);
        set_flash($warn ?: 'Product added to cart.', $warn ? 'danger' : 'success');

    } elseif ($action === 'update') {                                    // UPDATE quantities
        foreach (($_POST['qty'] ?? []) as $id => $qty) {
            $id = (int)$id; $qty = (int)$qty;
            if ($qty <= 0) { unset($_SESSION['cart'][$id]); continue; }
            $warn = set_cart_qty($pdo, $id, $qty);
            if ($warn) { set_flash($warn, 'danger'); }
        }
        if (!isset($_SESSION['flash'])) { set_flash('Cart updated.'); }

    } elseif ($action === 'remove' && $productId) {                      // REMOVE one item
        unset($_SESSION['cart'][$productId]);
        set_flash('Item removed.');

    } elseif ($action === 'clear') {                                     // EMPTY cart
        $_SESSION['cart'] = [];
        set_flash('Cart emptied.');
    }
    redirect('cart.php');
}

$items = [];
$total = 0.0;
if ($_SESSION['cart']) {
    $ids = array_keys($_SESSION['cart']);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    foreach ($stmt->fetchAll() as $p) {
        $qty = (int)$_SESSION['cart'][$p['id']];
        $items[] = ['p' => $p, 'qty' => $qty, 'subtotal' => $qty * (float)$p['price']];
        $total += $qty * (float)$p['price'];
    }
}
require_once 'includes/header.php';
?>
<h1>Your Cart</h1>
<?php if (!$items): ?>
  <div class="alert alert-info">Your cart is empty. <a href="products.php">Browse products</a></div>
<?php else: ?>
  <form method="post" class="panel">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="update">
    <div class="table-wrap"><table>
      <tr><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th></th></tr>
      <?php foreach ($items as $it): $p = $it['p']; ?>
        <tr>
          <td><?= e($p['name']) ?></td>
          <td>&#8377;<?= number_format((float)$p['price'], 2) ?></td>
          <td><input type="number" name="qty[<?= (int)$p['id'] ?>]" value="<?= $it['qty'] ?>" min="0" max="<?= (int)$p['stock'] ?>" style="width:80px"></td>
          <td>&#8377;<?= number_format($it['subtotal'], 2) ?></td>
          <td><button class="btn btn-small btn-danger" type="submit" form="remove-<?= (int)$p['id'] ?>">Remove</button></td>
        </tr>
      <?php endforeach; ?>
      <tr><td colspan="3" style="text-align:right"><strong>Total</strong></td><td colspan="2"><strong>&#8377;<?= number_format($total, 2) ?></strong></td></tr>
    </table></div>
    <p style="margin-top:14px">
      <button class="btn" type="submit">Update Quantities</button>
      <a class="btn btn-accent" href="checkout.php">Proceed to Checkout</a>
    </p>
  </form>

  <?php foreach ($items as $it): ?>
    <form method="post" id="remove-<?= (int)$it['p']['id'] ?>">
      <?= csrf_field() ?><input type="hidden" name="action" value="remove">
      <input type="hidden" name="product_id" value="<?= (int)$it['p']['id'] ?>">
    </form>
  <?php endforeach; ?>
  <form method="post" data-confirm="Remove everything from your cart?">
    <?= csrf_field() ?><input type="hidden" name="action" value="clear">
    <button class="btn btn-small" type="submit">Empty Cart</button>
  </form>
<?php endif; ?>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 19

**Aim:** Create a checkout script that saves the cart contents into the orders table using a database transaction (BEGIN, COMMIT, ROLLBACK).

**`checkout.php`**

````php
<?php
$pageTitle = 'Checkout';
require_once 'includes/auth.php';
require_login();

$pdo  = getConnection();
$cart = $_SESSION['cart'] ?? [];
if (!$cart) {
    set_flash('Your cart is empty.', 'danger');
    redirect('cart.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    try {
        $pdo->beginTransaction();                                  // BEGIN

        $lines = [];
        $total = 0.0;
        $lock  = $pdo->prepare('SELECT id, name, price, stock FROM products WHERE id = :id FOR UPDATE');   // lock the row

        foreach ($cart as $productId => $qty) {
            $lock->execute([':id' => $productId]);
            $p = $lock->fetch();
            if (!$p)                      throw new RuntimeException('A product in your cart no longer exists.');
            if ($p['stock'] < $qty)       throw new RuntimeException('Not enough stock for "' . $p['name'] . '" (only ' . $p['stock'] . ' left).');
            $lines[] = [$p, (int)$qty];
            $total  += (float)$p['price'] * $qty;                  // price always comes from the database
        }

        $pdo->prepare('INSERT INTO orders (user_id, total) VALUES (:u, :t)')
            ->execute([':u' => $_SESSION['user_id'], ':t' => $total]);
        $orderId = (int)$pdo->lastInsertId();

        $item   = $pdo->prepare('INSERT INTO order_items (order_id, product_id, product_name, quantity, price) VALUES (:o, :p, :n, :q, :pr)');
        $reduce = $pdo->prepare('UPDATE products SET stock = stock - :q WHERE id = :id');
        foreach ($lines as [$p, $qty]) {
            $item->execute([':o' => $orderId, ':p' => $p['id'], ':n' => $p['name'], ':q' => $qty, ':pr' => $p['price']]);
            $reduce->execute([':q' => $qty, ':id' => $p['id']]);
        }

        $pdo->commit();                                            // COMMIT: all steps succeeded together
        $_SESSION['cart'] = [];
        set_flash('Order #' . $orderId . ' placed successfully. Thank you!');
        redirect('dashboard.php');

    } catch (Throwable $ex) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();                                      // ROLLBACK: undo everything, no half-saved order
        }
        error_log('Checkout failed: ' . $ex->getMessage());
        $error = $ex instanceof RuntimeException ? $ex->getMessage() : 'Could not place the order. Nothing was charged. Please try again.';
    }
}

// order summary
$ids = array_keys($cart);
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$stmt = $pdo->prepare("SELECT id, name, price FROM products WHERE id IN ($placeholders)");
$stmt->execute($ids);
$rows = $stmt->fetchAll();
$total = 0.0;

require_once 'includes/header.php';
?>
<h1>Checkout</h1>
<?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?> <a href="cart.php">Back to cart</a></div><?php endif; ?>
<div class="panel">
  <h2>Order summary</h2>
  <table>
    <tr><th>Product</th><th>Qty</th><th>Amount</th></tr>
    <?php foreach ($rows as $r): $qty = (int)$cart[$r['id']]; $line = $qty * (float)$r['price']; $total += $line; ?>
      <tr><td><?= e($r['name']) ?></td><td><?= $qty ?></td><td>&#8377;<?= number_format($line, 2) ?></td></tr>
    <?php endforeach; ?>
    <tr><td colspan="2" style="text-align:right"><strong>Total</strong></td><td><strong>&#8377;<?= number_format($total, 2) ?></strong></td></tr>
  </table>
  <form method="post" style="margin-top:16px">
    <?= csrf_field() ?>
    <button class="btn btn-accent" type="submit">Confirm &amp; Place Order</button>
    <a class="btn" href="cart.php">Back to cart</a>
  </form>
</div>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 20

**Aim:** Use JavaScript fetch() (AJAX) to perform live search suggestions without reloading the page.

**`api/suggest.php`**

````php
<?php
// Returns up to 6 matching product names as JSON, e.g.  api/suggest.php?q=mou
require_once __DIR__ . '/../config/db.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

$q = trim(strip_tags($_GET['q'] ?? ''));
if (mb_strlen($q) < 2) {                      // ignore very short searches
    echo json_encode([]);
    exit;
}

$stmt = getConnection()->prepare(
    'SELECT id, name, category FROM products WHERE name LIKE :q ORDER BY name LIMIT 6'
);
$stmt->execute([':q' => '%' . addcslashes($q, '%_\\') . '%']);

echo json_encode($stmt->fetchAll(), JSON_UNESCAPED_UNICODE);
````

**`js/suggest.js`**

````javascript
// Live search suggestions using fetch() (AJAX): the page is never reloaded.
(function () {
  'use strict';

  var input = document.getElementById('searchInput');
  var list = document.getElementById('suggestions');
  if (!input || !list) { return; }

  var timer = null;        // debounce timer
  var controller = null;   // lets us cancel an outdated request
  var active = -1;

  function hide() { list.hidden = true; list.innerHTML = ''; active = -1; }

  function render(items) {
    list.innerHTML = '';
    if (!items.length) { hide(); return; }
    items.forEach(function (item) {
      var li = document.createElement('li');
      li.textContent = item.name + '  (' + item.category + ')';   // textContent: safe against XSS
      li.addEventListener('mousedown', function () {                // mousedown fires before the input loses focus
        input.value = item.name;
        hide();
        input.form.submit();
      });
      list.appendChild(li);
    });
    list.hidden = false;
  }

  function fetchSuggestions(term) {
    if (controller) { controller.abort(); }
    controller = new AbortController();

    fetch('api/suggest.php?q=' + encodeURIComponent(term), { signal: controller.signal })
      .then(function (response) {
        if (!response.ok) { throw new Error('HTTP ' + response.status); }
        return response.json();
      })
      .then(render)
      .catch(function (error) {
        if (error.name !== 'AbortError') { hide(); }
      });
  }

  input.addEventListener('input', function () {
    var term = input.value.trim();
    clearTimeout(timer);
    if (term.length < 2) { hide(); return; }
    timer = setTimeout(function () { fetchSuggestions(term); }, 250);   // wait until the user pauses typing
  });

  // keyboard support: arrows to move, Enter to pick, Escape to close
  input.addEventListener('keydown', function (event) {
    var items = list.querySelectorAll('li');
    if (list.hidden || !items.length) { return; }
    if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
      event.preventDefault();
      active = event.key === 'ArrowDown' ? (active + 1) % items.length : (active - 1 + items.length) % items.length;
      items.forEach(function (li, i) { li.classList.toggle('active', i === active); });
    } else if (event.key === 'Enter' && active >= 0) {
      event.preventDefault();
      items[active].dispatchEvent(new Event('mousedown'));
    } else if (event.key === 'Escape') {
      hide();
    }
  });

  input.addEventListener('blur', function () { setTimeout(hide, 150); });
})();
````

