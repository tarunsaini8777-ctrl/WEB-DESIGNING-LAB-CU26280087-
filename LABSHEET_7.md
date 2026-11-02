# MCA108P-AS07: Online Bookstore (PHP + MySQL)

All programs in one file. Copy each block into the file named above it (keep the folder structure).

**Setup:**
1. Install XAMPP/WAMP and put the project folder `MCA108P-AS07` in `htdocs`.
2. Run `sql/schema.sql` and then `sql/seed.sql` in phpMyAdmin.
3. Set your MySQL password in `config/db.php`.
4. Open `create_admin.php` once in the browser (admin: `admin@booknest.com` / `Admin@123`), then delete it.
5. Open `http://localhost/MCA108P-AS07/`.

> The shared files `includes/functions.php` (Exp 14) and `includes/header.php`, `footer.php`, `css/style.css` (Exp 19) are used by every page, so create them first.

## Project Structure

````text
MCA108P-AS07/
|-- config/db.php
|-- includes/   functions.php, header.php, footer.php, search_filter.php, pagination.php,
|               cart_helpers.php, stock.php, reviews.php
|-- admin/      index.php, books.php, orders.php, reports.php
|-- css/style.css      js/validation.js
|-- sql/        schema.sql, seed.sql
|-- tests/      smoke_test.php, TESTING.md
|-- images/books/      (optional cover images)
|-- index.php, books.php, book.php, register.php, login.php, logout.php, cart.php,
|   checkout.php, invoice.php, orders.php, wishlist.php, wishlist_toggle.php,
|   review_submit.php, create_admin.php
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
21. [Experiment 21](#experiment-21)

---

## Common Files

**`config/db.php`**

````php
<?php
// Database settings for the bookstore. Change DB_USER / DB_PASS for your MySQL setup.
const DB_HOST = 'localhost';
const DB_NAME = 'bookstore_db';
const DB_USER = 'root';
const DB_PASS = '';

function getConnection(): PDO {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    return new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,   // real prepared statements
    ]);
}
````

---

## Experiment 1

**Aim:** Design the homepage of the online bookstore featuring featured books, search bar, category navigation, and promotional banners using HTML and CSS.

**`index.php`**

````php
<?php
$pageTitle = 'Home';
require_once 'includes/header.php';
?>
<section class="hero">
  <h1>Find your next favourite book</h1>
  <p>Thousands of titles across fiction, technology, self-help and more. Free delivery above &#8377;499.</p>
  <a class="btn btn-accent" href="books.php">Browse All Books</a>
</section>

<section class="promos">
  <div class="promo p1"><h3>Flat 20% OFF</h3><p>On all Technology books this week.</p></div>
  <div class="promo p2"><h3>Buy 2 Get 1 Free</h3><p>On selected Fiction bestsellers.</p></div>
  <div class="promo p3"><h3>New Arrivals</h3><p>Fresh titles added every Monday.</p></div>
</section>

<h2>Shop by Category</h2>
<nav class="category-nav">
  <a href="books.php?category=Fiction">Fiction</a>
  <a href="books.php?category=Technology">Technology</a>
  <a href="books.php?category=Self-Help">Self-Help</a>
  <a href="books.php?category=Science">Science</a>
  <a href="books.php?category=Biography">Biography</a>
  <a href="books.php?category=Finance">Finance</a>
  <a href="books.php?category=History">History</a>
</nav>

<h2>Featured Books</h2>
<section class="book-grid">
  <article class="book-card">
    <div class="cover cover-placeholder" style="background:#2c3e50"><span>A</span></div>
    <div class="body"><h3>The Alchemist</h3><span class="author">Paulo Coelho</span><span class="price">&#8377;299.00</span></div>
  </article>
  <article class="book-card">
    <div class="cover cover-placeholder" style="background:#8e44ad"><span>C</span></div>
    <div class="body"><h3>Clean Code</h3><span class="author">Robert C. Martin</span><span class="price">&#8377;899.00</span></div>
  </article>
  <article class="book-card">
    <div class="cover cover-placeholder" style="background:#c0392b"><span>A</span></div>
    <div class="body"><h3>Atomic Habits</h3><span class="author">James Clear</span><span class="price">&#8377;499.00</span></div>
  </article>
  <article class="book-card">
    <div class="cover cover-placeholder" style="background:#16a085"><span>W</span></div>
    <div class="body"><h3>Wings of Fire</h3><span class="author">A. P. J. Abdul Kalam</span><span class="price">&#8377;350.00</span></div>
  </article>
</section>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 2

**Aim:** Create a MySQL database schema for the bookstore with tables for books (id, title, author, price, stock, image), users, and orders.

**`sql/schema.sql`**

````sql
CREATE DATABASE IF NOT EXISTS bookstore_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bookstore_db;

CREATE TABLE IF NOT EXISTS books (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  title       VARCHAR(200)  NOT NULL,
  author      VARCHAR(150)  NOT NULL,
  category    VARCHAR(60)   NOT NULL DEFAULT 'General',
  description TEXT,
  price       DECIMAL(10,2) NOT NULL CHECK (price >= 0),
  stock       INT           NOT NULL DEFAULT 0 CHECK (stock >= 0),
  image       VARCHAR(255)  DEFAULT NULL,
  created_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_category (category),
  FULLTEXT KEY ft_title_author (title, author)
);

CREATE TABLE IF NOT EXISTS users (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(100) NOT NULL,
  email      VARCHAR(150) NOT NULL UNIQUE,
  password   VARCHAR(255) NOT NULL,
  role       ENUM('customer','admin') NOT NULL DEFAULT 'customer',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
  id               INT AUTO_INCREMENT PRIMARY KEY,
  user_id          INT NOT NULL,
  total            DECIMAL(10,2) NOT NULL,
  status           ENUM('Pending','Shipped','Delivered') NOT NULL DEFAULT 'Pending',
  shipping_name    VARCHAR(100) NOT NULL,
  shipping_phone   VARCHAR(15)  NOT NULL,
  shipping_address VARCHAR(255) NOT NULL,
  shipping_city    VARCHAR(80)  NOT NULL,
  shipping_pincode VARCHAR(10)  NOT NULL,
  payment_method   VARCHAR(30)  NOT NULL DEFAULT 'Cash on Delivery',
  created_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS order_items (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  book_id  INT NULL,
  title    VARCHAR(200)  NOT NULL,      -- snapshot so history survives book deletion
  price    DECIMAL(10,2) NOT NULL,
  quantity INT NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (book_id)  REFERENCES books(id)  ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS reviews (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  book_id    INT NOT NULL,
  user_id    INT NOT NULL,
  rating     TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
  comment    VARCHAR(500),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY one_review_per_user (book_id, user_id),
  FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS wishlist (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  user_id  INT NOT NULL,
  book_id  INT NOT NULL,
  added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY one_per_user (user_id, book_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);
````

**`sql/seed.sql`**

````sql
USE bookstore_db;
INSERT INTO books (title, author, category, description, price, stock) VALUES
('The Alchemist', 'Paulo Coelho', 'Fiction', 'A shepherd boy travels to Egypt in search of treasure and discovers his destiny.', 299.00, 25),
('Wings of Fire', 'A. P. J. Abdul Kalam', 'Biography', 'The autobiography of India''s Missile Man.', 350.00, 18),
('Clean Code', 'Robert C. Martin', 'Technology', 'A handbook of agile software craftsmanship.', 899.00, 12),
('Atomic Habits', 'James Clear', 'Self-Help', 'Tiny changes that lead to remarkable results.', 499.00, 30),
('Let Us C', 'Yashavant Kanetkar', 'Technology', 'Popular book for learning the C programming language.', 450.00, 40),
('The Girl in Room 105', 'Chetan Bhagat', 'Fiction', 'A fast-paced thriller set in Delhi.', 199.00, 20),
('A Brief History of Time', 'Stephen Hawking', 'Science', 'From the Big Bang to black holes.', 399.00, 10),
('Rich Dad Poor Dad', 'Robert Kiyosaki', 'Finance', 'What the rich teach their kids about money.', 349.00, 22),
('Learning PHP, MySQL & JavaScript', 'Robin Nixon', 'Technology', 'Step-by-step guide to dynamic websites.', 1050.00, 8),
('Ikigai', 'Hector Garcia', 'Self-Help', 'The Japanese secret to a long and happy life.', 275.00, 15),
('Sapiens', 'Yuval Noah Harari', 'History', 'A brief history of humankind.', 550.00, 14),
('The Immortals of Meluha', 'Amish Tripathi', 'Fiction', 'First book of the Shiva Trilogy.', 250.00, 0);
````

---

## Experiment 3

**Aim:** Develop a PHP script to fetch and display available books dynamically from the MySQL database in a grid layout.

**`books.php`**

````php
<?php
$pageTitle = 'All Books';
require_once 'includes/header.php';
require_once 'includes/search_filter.php';   // Exp 10: $where, $params, $orderBy ...
require_once 'includes/pagination.php';      // Exp 11: paginate(), render_pagination()

$pdo     = db();
$perPage = 8;

$count = $pdo->prepare("SELECT COUNT(*) FROM books $where");
$count->execute($params);
$total = (int)$count->fetchColumn();

$pg = paginate($total, $perPage, (int)($_GET['page'] ?? 1));

$stmt = $pdo->prepare("SELECT * FROM books $where ORDER BY $orderBy LIMIT :limit OFFSET :offset");
foreach ($params as $name => $value) {
    $stmt->bindValue($name, $value);
}
$stmt->bindValue(':limit',  $pg['perPage'], PDO::PARAM_INT);
$stmt->bindValue(':offset', $pg['offset'],  PDO::PARAM_INT);
$stmt->execute();
$books = $stmt->fetchAll();
?>
<h1>Books</h1>
<?= render_filter_form($q, $category, $sort, $categories, $sortOptions) ?>
<p><?= $total ?> book(s) found.</p>

<?php if (!$books): ?>
  <div class="alert alert-info">No books match your search.</div>
<?php else: ?>
  <section class="book-grid">
    <?php foreach ($books as $b): ?>
      <article class="book-card">
        <a href="book.php?id=<?= (int)$b['id'] ?>"><?= book_cover($b) ?></a>
        <div class="body">
          <h3><a href="book.php?id=<?= (int)$b['id'] ?>"><?= e($b['title']) ?></a></h3>
          <span class="author">by <?= e($b['author']) ?></span>
          <span class="price"><?= money($b['price']) ?></span>
          <span>
            <?php if ($b['stock'] <= 5): ?><span class="badge badge-low">Only <?= (int)$b['stock'] ?> left</span>
            <?php else: ?><span class="badge badge-ok">In stock</span><?php endif; ?>
          </span>
          <form method="post" action="cart.php">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="book_id" value="<?= (int)$b['id'] ?>">
            <button class="btn btn-small btn-accent" type="submit">Add to Cart</button>
          </form>
        </div>
      </article>
    <?php endforeach; ?>
  </section>
  <?= render_pagination($pg) ?>
<?php endif; ?>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 4

**Aim:** Build a book detail page in PHP that retrieves a specific book's information using its ID passed via URL (GET).

**`book.php`**

````php
<?php
require_once 'includes/functions.php';
require_once 'includes/reviews.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(400);
    die('Invalid book ID.');
}

$pdo  = db();
$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute([':id' => $id]);
$book = $stmt->fetch();

if (!$book) {
    http_response_code(404);
    $pageTitle = 'Book not found';
    require_once 'includes/header.php';
    echo '<div class="alert alert-danger">Sorry, that book does not exist. <a href="books.php">Back to books</a></div>';
    require_once 'includes/footer.php';
    exit;
}

$inWishlist = false;
if (is_logged_in()) {
    $w = $pdo->prepare('SELECT 1 FROM wishlist WHERE user_id = :u AND book_id = :b');
    $w->execute([':u' => $_SESSION['user_id'], ':b' => $id]);
    $inWishlist = (bool)$w->fetchColumn();
}

$pageTitle = $book['title'];
require_once 'includes/header.php';
?>
<p><a href="books.php">&laquo; Back to books</a></p>
<div class="panel detail">
  <div class="cover-box"><?= book_cover($book) ?></div>
  <div class="info">
    <h1><?= e($book['title']) ?></h1>
    <p class="author">by <?= e($book['author']) ?> &middot; <?= e($book['category']) ?></p>
    <p class="price" style="font-size:1.6rem;margin:10px 0"><?= money($book['price']) ?></p>
    <p><?= nl2br(e($book['description'])) ?></p>
    <p style="margin:12px 0">
      <?php if ($book['stock'] > 0): ?>
        <span class="badge badge-ok">In stock (<?= (int)$book['stock'] ?> available)</span>
      <?php else: ?>
        <span class="badge badge-out">Out of stock</span>
      <?php endif; ?>
    </p>

    <?php if ($book['stock'] > 0): ?>
      <form method="post" action="cart.php" class="inline-form">
        <?= csrf_field() ?>
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="book_id" value="<?= (int)$book['id'] ?>">
        <input type="number" name="quantity" value="1" min="1" max="<?= (int)$book['stock'] ?>">
        <button class="btn btn-accent" type="submit">Add to Cart</button>
      </form>
    <?php endif; ?>

    <?php if (is_logged_in()): ?>
      <form method="post" action="wishlist_toggle.php" class="inline-form" style="margin-left:8px">
        <?= csrf_field() ?>
        <input type="hidden" name="book_id" value="<?= (int)$book['id'] ?>">
        <button class="btn" type="submit"><?= $inWishlist ? '&#9829; Remove from Wishlist' : '&#9825; Add to Wishlist' ?></button>
      </form>
    <?php endif; ?>
  </div>
</div>

<?php render_reviews($pdo, (int)$book['id']); ?>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 5

**Aim:** Implement a user registration and login system in PHP with password hashing and secure session management.

**`register.php`**

````php
<?php
$pageTitle = 'Register';
require_once 'includes/functions.php';

if (is_logged_in()) {
    redirect('index.php');
}

$errors = [];
$name = $email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $name     = clean_input($_POST['name'] ?? '');
    $email    = strtolower(clean_input($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if (mb_strlen($name) < 2)                          $errors[] = 'Name must be at least 2 characters.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))    $errors[] = 'Enter a valid email address.';
    if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
        $errors[] = 'Password must be at least 8 characters and contain a letter and a number.';
    }
    if ($password !== $confirm)                        $errors[] = 'Passwords do not match.';

    if (!$errors) {
        $check = db()->prepare('SELECT id FROM users WHERE email = :email');
        $check->execute([':email' => $email]);
        if ($check->fetch()) {
            $errors[] = 'An account with this email already exists.';
        } else {
            $insert = db()->prepare('INSERT INTO users (name, email, password) VALUES (:n, :e, :p)');
            $insert->execute([':n' => $name, ':e' => $email, ':p' => password_hash($password, PASSWORD_DEFAULT)]);
            set_flash('Registration successful. Please log in.');
            redirect('login.php');
        }
    }
}
require_once 'includes/header.php';
?>
<div class="panel form-narrow">
  <h2>Create an account</h2>
  <?php foreach ($errors as $err): ?><div class="alert alert-danger"><?= e($err) ?></div><?php endforeach; ?>
  <form method="post" id="registerForm" novalidate>
    <?= csrf_field() ?>
    <label for="name">Full name</label>
    <input type="text" id="name" name="name" value="<?= e($name) ?>" required>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= e($email) ?>" required>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
    <label for="confirm_password">Confirm password</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    <br><button class="btn" type="submit">Register</button>
  </form>
  <p style="margin-top:12px">Already registered? <a href="login.php">Log in</a></p>
</div>
<?php require_once 'includes/footer.php'; ?>
````

**`login.php`**

````php
<?php
$pageTitle = 'Login';
require_once 'includes/functions.php';

if (is_logged_in()) {
    redirect('index.php');
}

$error = '';
$email = '';
$next  = $_GET['next'] ?? $_POST['next'] ?? '';
// only allow redirects to simple local pages such as "cart.php" or "book.php?id=3"
if (!preg_match('/^[a-z_]+\.php(\?[A-Za-z0-9=&_-]*)?$/', $next)) {
    $next = 'index.php';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $email    = strtolower(clean_input($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    $stmt = db()->prepare('SELECT id, name, password, role FROM users WHERE email = :email');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);               // prevents session fixation
        $_SESSION['user_id']   = (int)$user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role']      = $user['role'];
        redirect($user['role'] === 'admin' && $next === 'index.php' ? 'admin/index.php' : $next);
    }
    $error = 'Invalid email or password.';
}
require_once 'includes/header.php';
?>
<div class="panel form-narrow">
  <h2>Login</h2>
  <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
  <form method="post" id="loginForm" novalidate>
    <?= csrf_field() ?>
    <input type="hidden" name="next" value="<?= e($next) ?>">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= e($email) ?>" required>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
    <br><button class="btn" type="submit">Login</button>
  </form>
  <p style="margin-top:12px">New here? <a href="register.php">Create an account</a></p>
</div>
<?php require_once 'includes/footer.php'; ?>
````

**`logout.php`**

````php
<?php
require_once 'includes/functions.php';

$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}
session_destroy();

session_start();                       // new session just to show the message
set_flash('You have been logged out.');
redirect('login.php');
````

---

## Experiment 6

**Aim:** Create a shopping cart system using PHP sessions ($_SESSION['cart']) allowing users to add books, update quantities, and remove items.

**`includes/cart_helpers.php`**

````php
<?php
/** Loads the books in $_SESSION['cart'] from the DB. Returns [items, total]. */
function cart_items(PDO $pdo): array {
    $cart = $_SESSION['cart'] ?? [];
    if (!$cart) {
        return [[], 0.0];
    }
    $ids          = array_keys($cart);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id IN ($placeholders)");
    $stmt->execute($ids);

    $items = [];
    $total = 0.0;
    foreach ($stmt->fetchAll() as $book) {
        $qty      = (int)$cart[$book['id']];
        $subtotal = $qty * (float)$book['price'];
        $items[]  = ['book' => $book, 'qty' => $qty, 'subtotal' => $subtotal];
        $total   += $subtotal;
    }
    return [$items, $total];
}
````

**`cart.php`**

````php
<?php
$pageTitle = 'Shopping Cart';
require_once 'includes/functions.php';
require_once 'includes/stock.php';
require_once 'includes/cart_helpers.php';

$pdo = db();
$_SESSION['cart'] = $_SESSION['cart'] ?? [];      // [book_id => quantity]

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $action = $_POST['action'] ?? '';
    $bookId = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

    if ($action === 'add' && $bookId) {
        $qty = max(1, (int)($_POST['quantity'] ?? 1));
        [$ok, $msg] = cart_set_quantity($pdo, $bookId, ($_SESSION['cart'][$bookId] ?? 0) + $qty);
        set_flash($ok ? 'Book added to your cart.' : $msg, $ok ? 'success' : 'danger');

    } elseif ($action === 'update') {
        foreach (($_POST['qty'] ?? []) as $id => $q) {
            $id = (int)$id;
            $q  = (int)$q;
            if ($q <= 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                [$ok, $msg] = cart_set_quantity($pdo, $id, $q);
                if (!$ok) set_flash($msg, 'danger');
            }
        }
        if (!isset($_SESSION['flash'])) set_flash('Cart updated.');

    } elseif ($action === 'remove' && $bookId) {
        unset($_SESSION['cart'][$bookId]);
        set_flash('Item removed from cart.');

    } elseif ($action === 'clear') {
        $_SESSION['cart'] = [];
        set_flash('Cart cleared.');
    }
    redirect('cart.php');
}

[$items, $total] = cart_items($pdo);
require_once 'includes/header.php';
?>
<h1>Your Shopping Cart</h1>
<?php if (!$items): ?>
  <div class="alert alert-info">Your cart is empty. <a href="books.php">Browse books</a></div>
<?php else: ?>
  <form method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="update">
    <div class="table-wrap">
    <table>
      <tr><th>Book</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th></th></tr>
      <?php foreach ($items as $it): $b = $it['book']; ?>
        <tr>
          <td><a href="book.php?id=<?= (int)$b['id'] ?>"><?= e($b['title']) ?></a><br><small><?= e($b['author']) ?></small></td>
          <td><?= money($b['price']) ?></td>
          <td><input type="number" name="qty[<?= (int)$b['id'] ?>]" value="<?= $it['qty'] ?>" min="0" max="<?= (int)$b['stock'] ?>" style="width:80px"></td>
          <td><?= money($it['subtotal']) ?></td>
          <td>
            <button class="btn btn-small btn-danger" type="submit" form="remove-<?= (int)$b['id'] ?>">Remove</button>
          </td>
        </tr>
      <?php endforeach; ?>
      <tr><td colspan="3" style="text-align:right"><strong>Total</strong></td><td colspan="2"><strong><?= money($total) ?></strong></td></tr>
    </table>
    </div>
    <p style="margin-top:15px">
      <button class="btn" type="submit">Update Quantities</button>
      <a class="btn btn-accent" href="checkout.php">Proceed to Checkout</a>
    </p>
  </form>

  <?php foreach ($items as $it): ?>
    <form method="post" id="remove-<?= (int)$it['book']['id'] ?>">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="remove">
      <input type="hidden" name="book_id" value="<?= (int)$it['book']['id'] ?>">
    </form>
  <?php endforeach; ?>
  <form method="post" style="margin-top:10px">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="clear">
    <button class="btn btn-small" type="submit">Empty Cart</button>
  </form>
<?php endif; ?>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 7

**Aim:** Develop a checkout page in PHP where users enter shipping details and place an order, recording transaction data into the MySQL database.

**`checkout.php`**

````php
<?php
$pageTitle = 'Checkout';
require_once 'includes/functions.php';
require_once 'includes/cart_helpers.php';
require_login();

$pdo = db();
[$items, $total] = cart_items($pdo);
if (!$items) {
    set_flash('Your cart is empty.', 'danger');
    redirect('cart.php');
}

$errors = [];
$f = ['shipping_name' => $_SESSION['user_name'], 'shipping_phone' => '', 'shipping_address' => '',
      'shipping_city' => '', 'shipping_pincode' => '', 'payment_method' => 'Cash on Delivery'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    foreach ($f as $key => $_) {
        $f[$key] = clean_input($_POST[$key] ?? '');
    }
    if (mb_strlen($f['shipping_name']) < 2)              $errors[] = 'Enter the recipient name.';
    if (!preg_match('/^[6-9]\d{9}$/', $f['shipping_phone'])) $errors[] = 'Enter a valid 10-digit mobile number.';
    if (mb_strlen($f['shipping_address']) < 8)           $errors[] = 'Enter the full shipping address.';
    if ($f['shipping_city'] === '')                      $errors[] = 'Enter the city.';
    if (!preg_match('/^\d{6}$/', $f['shipping_pincode'])) $errors[] = 'Enter a valid 6-digit PIN code.';
    if (!in_array($f['payment_method'], ['Cash on Delivery', 'UPI', 'Card'], true)) $errors[] = 'Choose a payment method.';

    if (!$errors) {
        try {
            $pdo->beginTransaction();

            // lock each book row, re-check stock and use the price from the database
            $lines = [];
            $orderTotal = 0.0;
            $lock = $pdo->prepare('SELECT id, title, price, stock FROM books WHERE id = :id FOR UPDATE');
            foreach ($_SESSION['cart'] as $bookId => $qty) {
                $lock->execute([':id' => $bookId]);
                $book = $lock->fetch();
                if (!$book || $book['stock'] < $qty) {
                    throw new RuntimeException('Not enough stock for "' . ($book['title'] ?? 'a book in your cart') . '". Please update your cart.');
                }
                $lines[]     = [$book, (int)$qty];
                $orderTotal += (float)$book['price'] * $qty;
            }

            $ins = $pdo->prepare(
                'INSERT INTO orders (user_id, total, shipping_name, shipping_phone, shipping_address, shipping_city, shipping_pincode, payment_method)
                 VALUES (:u, :t, :n, :p, :a, :c, :z, :m)'
            );
            $ins->execute([':u' => $_SESSION['user_id'], ':t' => $orderTotal, ':n' => $f['shipping_name'],
                           ':p' => $f['shipping_phone'], ':a' => $f['shipping_address'],
                           ':c' => $f['shipping_city'], ':z' => $f['shipping_pincode'], ':m' => $f['payment_method']]);
            $orderId = (int)$pdo->lastInsertId();

            $insItem = $pdo->prepare('INSERT INTO order_items (order_id, book_id, title, price, quantity) VALUES (:o, :b, :t, :p, :q)');
            $reduce  = $pdo->prepare('UPDATE books SET stock = stock - :q WHERE id = :id');
            foreach ($lines as [$book, $qty]) {
                $insItem->execute([':o' => $orderId, ':b' => $book['id'], ':t' => $book['title'], ':p' => $book['price'], ':q' => $qty]);
                $reduce->execute([':q' => $qty, ':id' => $book['id']]);
            }

            $pdo->commit();
            $_SESSION['cart'] = [];
            redirect('invoice.php?id=' . $orderId . '&placed=1');
        } catch (Throwable $ex) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            error_log('Checkout failed: ' . $ex->getMessage());
            $errors[] = $ex instanceof RuntimeException ? $ex->getMessage() : 'Could not place your order. Please try again.';
        }
    }
}
require_once 'includes/header.php';
?>
<h1>Checkout</h1>
<div class="detail">
  <div class="info panel">
    <h2>Shipping details</h2>
    <?php foreach ($errors as $err): ?><div class="alert alert-danger"><?= e($err) ?></div><?php endforeach; ?>
    <form method="post" id="checkoutForm" novalidate>
      <?= csrf_field() ?>
      <label for="shipping_name">Full name</label>
      <input type="text" id="shipping_name" name="shipping_name" value="<?= e($f['shipping_name']) ?>" required>
      <label for="shipping_phone">Mobile number</label>
      <input type="text" id="shipping_phone" name="shipping_phone" value="<?= e($f['shipping_phone']) ?>" maxlength="10" required>
      <label for="shipping_address">Address</label>
      <input type="text" id="shipping_address" name="shipping_address" value="<?= e($f['shipping_address']) ?>" required>
      <label for="shipping_city">City</label>
      <input type="text" id="shipping_city" name="shipping_city" value="<?= e($f['shipping_city']) ?>" required>
      <label for="shipping_pincode">PIN code</label>
      <input type="text" id="shipping_pincode" name="shipping_pincode" value="<?= e($f['shipping_pincode']) ?>" maxlength="6" required>
      <label for="payment_method">Payment method</label>
      <select id="payment_method" name="payment_method">
        <?php foreach (['Cash on Delivery', 'UPI', 'Card'] as $m): ?>
          <option <?= $f['payment_method'] === $m ? 'selected' : '' ?>><?= e($m) ?></option>
        <?php endforeach; ?>
      </select>
      <br><button class="btn btn-accent" type="submit">Place Order</button>
    </form>
  </div>

  <div class="panel" style="flex:0 1 340px">
    <h2>Order summary</h2>
    <?php foreach ($items as $it): ?>
      <p><?= e($it['book']['title']) ?> &times; <?= $it['qty'] ?> <span style="float:right"><?= money($it['subtotal']) ?></span></p>
    <?php endforeach; ?>
    <hr style="margin:10px 0">
    <p><strong>Total <span style="float:right"><?= money($total) ?></span></strong></p>
  </div>
</div>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 8

**Aim:** Implement an admin dashboard in PHP allowing administrators to add new books, update prices, and manage inventory levels.

**`create_admin.php`**

````php
<?php
// Run ONCE in the browser (http://localhost/MCA108P-AS07/create_admin.php), then DELETE this file.
require_once 'includes/functions.php';

$email    = 'admin@booknest.com';
$password = 'Admin@123';          // change after first login / before going live

$check = db()->prepare('SELECT id FROM users WHERE email = :e');
$check->execute([':e' => $email]);

if ($check->fetch()) {
    echo 'Admin already exists.';
} else {
    db()->prepare("INSERT INTO users (name, email, password, role) VALUES ('Administrator', :e, :p, 'admin')")
        ->execute([':e' => $email, ':p' => password_hash($password, PASSWORD_DEFAULT)]);
    echo "Admin created. Email: $email  Password: $password  -- now delete create_admin.php";
}
````

**`admin/index.php`**

````php
<?php
$base = '../';
$pageTitle = 'Admin Dashboard';
require_once '../includes/functions.php';
require_admin();

$pdo = db();
$stats = [
    'Books'          => $pdo->query('SELECT COUNT(*) FROM books')->fetchColumn(),
    'Low stock (<=5)'=> $pdo->query('SELECT COUNT(*) FROM books WHERE stock <= 5')->fetchColumn(),
    'Customers'      => $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'customer'")->fetchColumn(),
    'Pending orders' => $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'Pending'")->fetchColumn(),
];
require_once '../includes/header.php';
?>
<h1>Admin Dashboard</h1>
<div class="stats">
  <?php foreach ($stats as $label => $value): ?>
    <div class="stat"><?= e($label) ?><b><?= (int)$value ?></b></div>
  <?php endforeach; ?>
</div>
<div class="panel">
  <h2>Manage</h2>
  <p><a class="btn" href="books.php">Books &amp; Inventory</a>
     <a class="btn" href="orders.php">Customer Orders</a>
     <a class="btn" href="reports.php">Sales Reports</a></p>
</div>
<?php require_once '../includes/footer.php'; ?>
````

**`admin/books.php`**

````php
<?php
$base = '../';
$pageTitle = 'Manage Books';
require_once '../includes/functions.php';
require_admin();

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $title    = clean_input($_POST['title'] ?? '');
        $author   = clean_input($_POST['author'] ?? '');
        $category = clean_input($_POST['category'] ?? '') ?: 'General';
        $desc     = clean_input($_POST['description'] ?? '');
        $image    = basename(clean_input($_POST['image'] ?? ''));       // file name inside images/books/
        $price    = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $stock    = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

        if ($title === '' || $author === '' || $price === false || $price < 0 || $stock === false || $stock < 0) {
            set_flash('Please fill title, author, a valid price and stock.', 'danger');
        } else {
            $pdo->prepare('INSERT INTO books (title, author, category, description, price, stock, image)
                           VALUES (:t, :a, :c, :d, :p, :s, :i)')
                ->execute([':t' => $title, ':a' => $author, ':c' => $category, ':d' => $desc,
                           ':p' => $price, ':s' => $stock, ':i' => $image ?: null]);
            set_flash('Book added.');
        }
    } elseif ($action === 'update') {
        $id    = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
        if ($id && $price !== false && $price >= 0 && $stock !== false && $stock >= 0) {
            $pdo->prepare('UPDATE books SET price = :p, stock = :s WHERE id = :id')
                ->execute([':p' => $price, ':s' => $stock, ':id' => $id]);
            set_flash('Book updated.');
        } else {
            set_flash('Invalid price or stock value.', 'danger');
        }
    } elseif ($action === 'delete') {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $pdo->prepare('DELETE FROM books WHERE id = :id')->execute([':id' => $id]);
            set_flash('Book deleted.');
        }
    }
    redirect('books.php');
}

$books = $pdo->query('SELECT * FROM books ORDER BY id DESC')->fetchAll();
require_once '../includes/header.php';
?>
<h1>Books &amp; Inventory</h1>

<div class="panel">
  <h2>Add a new book</h2>
  <form method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="add">
    <div class="filters">
      <div><label>Title</label><input type="text" name="title" required></div>
      <div><label>Author</label><input type="text" name="author" required></div>
      <div><label>Category</label><input type="text" name="category" placeholder="e.g. Fiction"></div>
    </div>
    <div class="filters">
      <div><label>Price (&#8377;)</label><input type="number" name="price" step="0.01" min="0" required></div>
      <div><label>Stock</label><input type="number" name="stock" min="0" required></div>
      <div><label>Image file name (optional)</label><input type="text" name="image" placeholder="cover.jpg"></div>
    </div>
    <label>Description</label>
    <textarea name="description" rows="3"></textarea>
    <br><button class="btn btn-accent" type="submit">Add Book</button>
  </form>
</div>

<div class="table-wrap">
<table>
  <tr><th>ID</th><th>Title</th><th>Category</th><th>Price &amp; Stock</th><th></th></tr>
  <?php foreach ($books as $b): ?>
    <tr>
      <td><?= (int)$b['id'] ?></td>
      <td><?= e($b['title']) ?><br><small><?= e($b['author']) ?></small></td>
      <td><?= e($b['category']) ?></td>
      <td>
        <form method="post" class="inline-form">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?= (int)$b['id'] ?>">
          &#8377;<input type="number" name="price" step="0.01" min="0" value="<?= e($b['price']) ?>">
          Stock <input type="number" name="stock" min="0" value="<?= (int)$b['stock'] ?>">
          <button class="btn btn-small" type="submit">Save</button>
        </form>
        <?php if ($b['stock'] <= 5): ?><span class="badge badge-low">Low stock</span><?php endif; ?>
      </td>
      <td>
        <form method="post" onsubmit="return confirm('Delete this book?');">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="id" value="<?= (int)$b['id'] ?>">
          <button class="btn btn-small btn-danger" type="submit">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
</div>
<?php require_once '../includes/footer.php'; ?>
````

---

## Experiment 9

**Aim:** Write a PHP script enabling administrators to view all customer orders and update order fulfillment status (Pending, Shipped, Delivered).

**`admin/orders.php`**

````php
<?php
$base = '../';
$pageTitle = 'Customer Orders';
require_once '../includes/functions.php';
require_admin();

$allowedStatuses = ['Pending', 'Shipped', 'Delivered'];
$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $orderId = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
    $status  = $_POST['status'] ?? '';
    if ($orderId && in_array($status, $allowedStatuses, true)) {
        $pdo->prepare('UPDATE orders SET status = :s WHERE id = :id')->execute([':s' => $status, ':id' => $orderId]);
        set_flash("Order #$orderId marked as $status.");
    } else {
        set_flash('Invalid order or status.', 'danger');
    }
    redirect('orders.php' . (isset($_GET['filter']) ? '?filter=' . urlencode($_GET['filter']) : ''));
}

$filter = in_array($_GET['filter'] ?? '', $allowedStatuses, true) ? $_GET['filter'] : '';
$sql = 'SELECT o.id, o.total, o.status, o.created_at, o.shipping_city, u.name, u.email,
               GROUP_CONCAT(CONCAT(oi.title, " x", oi.quantity) SEPARATOR ", ") AS items
        FROM orders o
        JOIN users u ON u.id = o.user_id
        LEFT JOIN order_items oi ON oi.order_id = o.id ' .
       ($filter ? 'WHERE o.status = :status ' : '') .
       'GROUP BY o.id ORDER BY o.created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute($filter ? [':status' => $filter] : []);
$orders = $stmt->fetchAll();

require_once '../includes/header.php';
?>
<h1>Customer Orders</h1>
<p>Filter:
  <a href="orders.php">All</a> |
  <?php foreach ($allowedStatuses as $s): ?><a href="orders.php?filter=<?= $s ?>"><?= $s ?></a> | <?php endforeach; ?>
</p>
<div class="table-wrap">
<table>
  <tr><th>Order</th><th>Customer</th><th>Items</th><th>Total</th><th>Date</th><th>Status</th></tr>
  <?php foreach ($orders as $o): ?>
    <tr>
      <td><a href="../invoice.php?id=<?= (int)$o['id'] ?>">#<?= (int)$o['id'] ?></a></td>
      <td><?= e($o['name']) ?><br><small><?= e($o['email']) ?> &middot; <?= e($o['shipping_city']) ?></small></td>
      <td><?= e($o['items']) ?></td>
      <td><?= money($o['total']) ?></td>
      <td><?= e(date('d M Y', strtotime($o['created_at']))) ?></td>
      <td>
        <form method="post" class="inline-form">
          <?= csrf_field() ?>
          <input type="hidden" name="order_id" value="<?= (int)$o['id'] ?>">
          <select name="status">
            <?php foreach ($allowedStatuses as $s): ?>
              <option <?= $o['status'] === $s ? 'selected' : '' ?>><?= $s ?></option>
            <?php endforeach; ?>
          </select>
          <button class="btn btn-small" type="submit">Update</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  <?php if (!$orders): ?><tr><td colspan="6">No orders found.</td></tr><?php endif; ?>
</table>
</div>
<?php require_once '../includes/footer.php'; ?>
````

---

## Experiment 10

**Aim:** Incorporate a search and filter feature in PHP allowing users to search books by title, author, or category.

**`includes/search_filter.php`**

````php
<?php
// Builds the WHERE clause from ?q=, ?category=, ?sort= using placeholders only.
$q        = clean_input($_GET['q'] ?? '');
$category = clean_input($_GET['category'] ?? '');
$sort     = $_GET['sort'] ?? 'newest';

$conditions = ['stock > 0'];          // only available books
$params     = [];

if ($q !== '') {
    $conditions[] = '(title LIKE :q1 OR author LIKE :q2 OR category LIKE :q3)';
    $like = '%' . addcslashes($q, '%_\\') . '%';
    $params[':q1'] = $params[':q2'] = $params[':q3'] = $like;
}
if ($category !== '') {
    $conditions[] = 'category = :category';
    $params[':category'] = $category;
}
$where = 'WHERE ' . implode(' AND ', $conditions);

// ORDER BY cannot use placeholders, so it is chosen from a fixed whitelist.
$sortOptions = [
    'newest'     => ['Newest first',        'created_at DESC'],
    'price_asc'  => ['Price: low to high',  'price ASC'],
    'price_desc' => ['Price: high to low',  'price DESC'],
    'title'      => ['Title A-Z',           'title ASC'],
];
if (!isset($sortOptions[$sort])) {
    $sort = 'newest';
}
$orderBy = $sortOptions[$sort][1];

$categories = db()->query("SELECT DISTINCT category FROM books WHERE category <> '' ORDER BY category")
                  ->fetchAll(PDO::FETCH_COLUMN);

function render_filter_form(string $q, string $category, string $sort, array $categories, array $sortOptions): string {
    ob_start(); ?>
    <form class="filters" method="get" action="books.php">
      <div><label for="q">Search</label>
        <input type="search" id="q" name="q" value="<?= e($q) ?>" placeholder="Title, author or category"></div>
      <div><label for="category">Category</label>
        <select id="category" name="category">
          <option value="">All categories</option>
          <?php foreach ($categories as $c): ?>
            <option value="<?= e($c) ?>" <?= $c === $category ? 'selected' : '' ?>><?= e($c) ?></option>
          <?php endforeach; ?>
        </select></div>
      <div><label for="sort">Sort by</label>
        <select id="sort" name="sort">
          <?php foreach ($sortOptions as $key => $opt): ?>
            <option value="<?= e($key) ?>" <?= $key === $sort ? 'selected' : '' ?>><?= e($opt[0]) ?></option>
          <?php endforeach; ?>
        </select></div>
      <div><button class="btn" type="submit">Apply</button> <a class="btn btn-small" href="books.php">Reset</a></div>
    </form>
    <?php
    return ob_get_clean();
}
````

---

## Experiment 11

**Aim:** Implement pagination in PHP to display a limited number of books per page with page number links.

**`includes/pagination.php`**

````php
<?php
function paginate(int $total, int $perPage, int $page): array {
    $pages = max(1, (int)ceil($total / $perPage));
    $page  = min(max(1, $page), $pages);
    return ['total' => $total, 'perPage' => $perPage, 'pages' => $pages,
            'page' => $page, 'offset' => ($page - 1) * $perPage];
}

/** Renders Previous / numbered links / Next, keeping the current search and filter in the URL. */
function render_pagination(array $pg): string {
    if ($pg['pages'] <= 1) {
        return '';
    }
    $query = $_GET;
    unset($query['page']);
    $url = fn(int $p) => 'books.php?' . http_build_query($query + ['page' => $p]);

    $html = '<nav class="pagination" aria-label="Pagination">';
    $html .= $pg['page'] > 1
        ? '<a href="' . e($url($pg['page'] - 1)) . '">&laquo; Previous</a>'
        : '<span class="disabled">&laquo; Previous</span>';

    for ($p = 1; $p <= $pg['pages']; $p++) {
        // show first, last and two pages around the current one
        if ($p == 1 || $p == $pg['pages'] || abs($p - $pg['page']) <= 2) {
            $html .= $p == $pg['page']
                ? '<span class="active">' . $p . '</span>'
                : '<a href="' . e($url($p)) . '">' . $p . '</a>';
        } elseif (abs($p - $pg['page']) == 3) {
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

**Aim:** Create a customer order history page where logged-in users can view their past purchases and status.

**`orders.php`**

````php
<?php
$pageTitle = 'My Orders';
require_once 'includes/functions.php';
require_login();

$stmt = db()->prepare(
    'SELECT o.id, o.total, o.status, o.created_at,
            GROUP_CONCAT(CONCAT(oi.title, " x", oi.quantity) SEPARATOR ", ") AS items
     FROM orders o
     LEFT JOIN order_items oi ON oi.order_id = o.id
     WHERE o.user_id = :u
     GROUP BY o.id
     ORDER BY o.created_at DESC'
);
$stmt->execute([':u' => $_SESSION['user_id']]);
$orders = $stmt->fetchAll();

require_once 'includes/header.php';
?>
<h1>My Orders</h1>
<?php if (!$orders): ?>
  <div class="alert alert-info">You have not placed any orders yet. <a href="books.php">Start shopping</a></div>
<?php else: ?>
  <div class="table-wrap">
  <table>
    <tr><th>Order</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th><th></th></tr>
    <?php foreach ($orders as $o): ?>
      <tr>
        <td>#<?= (int)$o['id'] ?></td>
        <td><?= e(date('d M Y', strtotime($o['created_at']))) ?></td>
        <td><?= e($o['items']) ?></td>
        <td><?= money($o['total']) ?></td>
        <td><span class="badge badge-<?= e($o['status']) ?>"><?= e($o['status']) ?></span></td>
        <td><a href="invoice.php?id=<?= (int)$o['id'] ?>">View invoice</a></td>
      </tr>
    <?php endforeach; ?>
  </table>
  </div>
<?php endif; ?>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 13

**Aim:** Build an inventory stock check in PHP that prevents users from adding more books to the cart than available stock.

**`includes/stock.php`**

````php
<?php
/**
 * Sets the cart quantity for a book but never above the available stock.
 * Returns [success(bool), message(string)].
 */
function cart_set_quantity(PDO $pdo, int $bookId, int $qty): array {
    $stmt = $pdo->prepare('SELECT title, stock FROM books WHERE id = :id');
    $stmt->execute([':id' => $bookId]);
    $book = $stmt->fetch();

    if (!$book) {
        unset($_SESSION['cart'][$bookId]);
        return [false, 'That book no longer exists.'];
    }
    if ((int)$book['stock'] < 1) {
        unset($_SESSION['cart'][$bookId]);
        return [false, '"' . $book['title'] . '" is out of stock.'];
    }
    if ($qty > (int)$book['stock']) {
        $_SESSION['cart'][$bookId] = (int)$book['stock'];
        return [false, 'Only ' . (int)$book['stock'] . ' copies of "' . $book['title'] .
                       '" are available. Your quantity was adjusted.'];
    }
    $_SESSION['cart'][$bookId] = max(1, $qty);
    return [true, ''];
}
````

---

## Experiment 14

**Aim:** Implement secure input sanitization and prepared statements across all bookstore database queries to prevent SQL injection.

**`includes/functions.php`**

````php
<?php
// Shared helpers: session start, DB connection, sanitisation, CSRF, auth guards, flash messages.
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
    session_start();
}
require_once __DIR__ . '/../config/db.php';

/** One shared PDO connection. All queries use prepared statements (see each page). */
function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $pdo = getConnection();
    }
    return $pdo;
}

/** Escape for HTML output (prevents XSS). */
function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

/** Trim and strip tags from user input. */
function clean_input($value): string {
    return trim(strip_tags((string)$value));
}

function money($amount): string {
    return '&#8377;' . number_format((float)$amount, 2);
}

function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

/* ---------- flash messages ---------- */
function set_flash(string $message, string $type = 'success'): void {
    $_SESSION['flash'] = ['msg' => $message, 'type' => $type];
}
function get_flash(): ?array {
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

/* ---------- CSRF protection ---------- */
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
    $sent = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $sent)) {
        http_response_code(400);
        die('Invalid or expired form token. Go back, refresh the page and try again.');
    }
}

/* ---------- authentication guards ---------- */
function is_logged_in(): bool {
    return isset($_SESSION['user_id']);
}
function is_admin(): bool {
    return ($_SESSION['role'] ?? '') === 'admin';
}
function require_login(): void {
    if (!is_logged_in()) {
        set_flash('Please log in to continue.', 'danger');
        redirect('login.php?next=' . urlencode(basename($_SERVER['PHP_SELF'])));
    }
}
function require_admin(): void {
    if (!is_admin()) {
        http_response_code(403);
        die('Access denied. Administrator login required.');
    }
}

/* ---------- display helpers ---------- */
function cart_count(): int {
    return array_sum($_SESSION['cart'] ?? []);
}

function book_cover(array $book, string $base = ''): string {
    if (!empty($book['image'])) {
        return '<img class="cover" src="' . e($base . 'images/books/' . basename($book['image'])) .
               '" alt="' . e($book['title']) . '">';
    }
    $colors = ['#2c3e50', '#8e44ad', '#c0392b', '#16a085', '#d35400', '#2980b9'];
    $color  = $colors[((int)($book['id'] ?? 0)) % count($colors)];
    $letter = strtoupper(substr($book['title'], 0, 1));
    return '<div class="cover cover-placeholder" style="background:' . $color . '"><span>' . e($letter) . '</span></div>';
}

function stars(float $rating): string {
    $full = (int)round($rating);
    return str_repeat('&#9733;', $full) . str_repeat('&#9734;', 5 - $full);
}
````

---

## Experiment 15

**Aim:** Design a user review and rating system where registered users can leave star ratings and comments on book detail pages.

**`includes/reviews.php`**

````php
<?php
/** Prints the rating summary, all reviews and (for logged-in users) the review form. */
function render_reviews(PDO $pdo, int $bookId): void {
    $summary = $pdo->prepare('SELECT COUNT(*) AS cnt, COALESCE(AVG(rating), 0) AS avg FROM reviews WHERE book_id = :id');
    $summary->execute([':id' => $bookId]);
    $s = $summary->fetch();

    $list = $pdo->prepare('SELECT r.rating, r.comment, r.created_at, u.name
                           FROM reviews r JOIN users u ON u.id = r.user_id
                           WHERE r.book_id = :id ORDER BY r.created_at DESC');
    $list->execute([':id' => $bookId]);
    $reviews = $list->fetchAll();

    $mine = null;
    if (is_logged_in()) {
        $m = $pdo->prepare('SELECT rating, comment FROM reviews WHERE book_id = :b AND user_id = :u');
        $m->execute([':b' => $bookId, ':u' => $_SESSION['user_id']]);
        $mine = $m->fetch() ?: null;
    }
    ?>
    <section class="panel" id="reviews">
      <h2>Ratings &amp; Reviews</h2>
      <?php if ($s['cnt'] > 0): ?>
        <p><span class="stars"><?= stars((float)$s['avg']) ?></span>
           <strong><?= number_format((float)$s['avg'], 1) ?></strong> out of 5 (<?= (int)$s['cnt'] ?> review<?= $s['cnt'] == 1 ? '' : 's' ?>)</p>
      <?php else: ?>
        <p>No reviews yet. Be the first to review this book.</p>
      <?php endif; ?>

      <?php foreach ($reviews as $r): ?>
        <div class="review">
          <span class="stars"><?= stars((float)$r['rating']) ?></span>
          <strong><?= e($r['name']) ?></strong>
          <small>&middot; <?= e(date('d M Y', strtotime($r['created_at']))) ?></small>
          <?php if ($r['comment'] !== null && $r['comment'] !== ''): ?><p><?= nl2br(e($r['comment'])) ?></p><?php endif; ?>
        </div>
      <?php endforeach; ?>

      <?php if (is_logged_in()): ?>
        <h3 style="margin-top:20px"><?= $mine ? 'Update your review' : 'Write a review' ?></h3>
        <form method="post" action="review_submit.php">
          <?= csrf_field() ?>
          <input type="hidden" name="book_id" value="<?= $bookId ?>">
          <label for="rating">Rating</label>
          <select name="rating" id="rating" required>
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <option value="<?= $i ?>" <?= ($mine['rating'] ?? 5) == $i ? 'selected' : '' ?>><?= $i ?> star<?= $i > 1 ? 's' : '' ?></option>
            <?php endfor; ?>
          </select>
          <label for="comment">Comment (optional, max 500 characters)</label>
          <textarea name="comment" id="comment" rows="3" maxlength="500"><?= e($mine['comment'] ?? '') ?></textarea>
          <br><button class="btn" type="submit">Submit Review</button>
        </form>
      <?php else: ?>
        <p><a href="login.php?next=<?= urlencode('book.php?id=' . $bookId) ?>">Log in</a> to leave a review.</p>
      <?php endif; ?>
    </section>
    <?php
}
````

**`review_submit.php`**

````php
<?php
require_once 'includes/functions.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('books.php');
}
csrf_check();

$bookId  = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
$rating  = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 5]]);
$comment = mb_substr(clean_input($_POST['comment'] ?? ''), 0, 500);

if (!$bookId || !$rating) {
    set_flash('Please choose a rating between 1 and 5.', 'danger');
    redirect('books.php');
}

// one review per user per book: insert, or update the existing one
$stmt = db()->prepare(
    'INSERT INTO reviews (book_id, user_id, rating, comment) VALUES (:b, :u, :r, :c)
     ON DUPLICATE KEY UPDATE rating = VALUES(rating), comment = VALUES(comment), created_at = CURRENT_TIMESTAMP'
);
$stmt->execute([':b' => $bookId, ':u' => $_SESSION['user_id'], ':r' => $rating, ':c' => $comment]);

set_flash('Thank you! Your review has been saved.');
redirect('book.php?id=' . $bookId . '#reviews');
````

---

## Experiment 16

**Aim:** Write a PHP script to generate an invoice summary page after successful order placement.

**`invoice.php`**

````php
<?php
$pageTitle = 'Invoice';
require_once 'includes/functions.php';
require_login();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    redirect('orders.php');
}

$stmt = db()->prepare('SELECT o.*, u.email FROM orders o JOIN users u ON u.id = o.user_id WHERE o.id = :id');
$stmt->execute([':id' => $id]);
$order = $stmt->fetch();

// customers can only open their own invoices; admins can open any
if (!$order || ($order['user_id'] != $_SESSION['user_id'] && !is_admin())) {
    http_response_code(404);
    die('Invoice not found.');
}

$items = db()->prepare('SELECT title, price, quantity FROM order_items WHERE order_id = :id');
$items->execute([':id' => $id]);
$items = $items->fetchAll();

require_once 'includes/header.php';
?>
<?php if (isset($_GET['placed'])): ?>
  <div class="alert alert-success no-print">
    &#10004; Thank you! Your order #<?= (int)$order['id'] ?> has been placed successfully.
  </div>
<?php endif; ?>

<div class="panel">
  <h1>Invoice #<?= str_pad((string)$order['id'], 5, '0', STR_PAD_LEFT) ?></h1>
  <p>Date: <?= e(date('d M Y, h:i A', strtotime($order['created_at']))) ?> &middot;
     Status: <span class="badge badge-<?= e($order['status']) ?>"><?= e($order['status']) ?></span></p>

  <h3 style="margin-top:15px">Ship to</h3>
  <p><?= e($order['shipping_name']) ?><br>
     <?= e($order['shipping_address']) ?>, <?= e($order['shipping_city']) ?> - <?= e($order['shipping_pincode']) ?><br>
     Phone: <?= e($order['shipping_phone']) ?><br>
     Payment: <?= e($order['payment_method']) ?></p>

  <div class="table-wrap" style="margin-top:15px">
  <table>
    <tr><th>Book</th><th>Price</th><th>Qty</th><th>Amount</th></tr>
    <?php foreach ($items as $it): ?>
      <tr>
        <td><?= e($it['title']) ?></td>
        <td><?= money($it['price']) ?></td>
        <td><?= (int)$it['quantity'] ?></td>
        <td><?= money($it['price'] * $it['quantity']) ?></td>
      </tr>
    <?php endforeach; ?>
    <tr><td colspan="3" style="text-align:right"><strong>Grand Total</strong></td><td><strong><?= money($order['total']) ?></strong></td></tr>
  </table>
  </div>

  <p class="no-print" style="margin-top:18px">
    <button class="btn" onclick="window.print()">Print Invoice</button>
    <a class="btn btn-accent" href="orders.php">My Orders</a>
    <a class="btn" href="books.php">Continue Shopping</a>
  </p>
</div>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 17

**Aim:** Implement a wishlist feature allowing users to save books to a personal wishlist stored in the database.

**`wishlist_toggle.php`**

````php
<?php
require_once 'includes/functions.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('books.php');
}
csrf_check();

$bookId = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
if (!$bookId) {
    redirect('books.php');
}

$pdo = db();
$check = $pdo->prepare('SELECT id FROM wishlist WHERE user_id = :u AND book_id = :b');
$check->execute([':u' => $_SESSION['user_id'], ':b' => $bookId]);

if ($check->fetch()) {
    $pdo->prepare('DELETE FROM wishlist WHERE user_id = :u AND book_id = :b')
        ->execute([':u' => $_SESSION['user_id'], ':b' => $bookId]);
    set_flash('Removed from your wishlist.');
} else {
    $pdo->prepare('INSERT IGNORE INTO wishlist (user_id, book_id) VALUES (:u, :b)')
        ->execute([':u' => $_SESSION['user_id'], ':b' => $bookId]);
    set_flash('Added to your wishlist.');
}
redirect('book.php?id=' . $bookId);
````

**`wishlist.php`**

````php
<?php
$pageTitle = 'My Wishlist';
require_once 'includes/functions.php';
require_login();

$stmt = db()->prepare(
    'SELECT b.* FROM wishlist w JOIN books b ON b.id = w.book_id
     WHERE w.user_id = :u ORDER BY w.added_at DESC'
);
$stmt->execute([':u' => $_SESSION['user_id']]);
$books = $stmt->fetchAll();

require_once 'includes/header.php';
?>
<h1>My Wishlist</h1>
<?php if (!$books): ?>
  <div class="alert alert-info">Your wishlist is empty. Open any book and click "Add to Wishlist".</div>
<?php else: ?>
  <section class="book-grid">
    <?php foreach ($books as $b): ?>
      <article class="book-card">
        <a href="book.php?id=<?= (int)$b['id'] ?>"><?= book_cover($b) ?></a>
        <div class="body">
          <h3><a href="book.php?id=<?= (int)$b['id'] ?>"><?= e($b['title']) ?></a></h3>
          <span class="author">by <?= e($b['author']) ?></span>
          <span class="price"><?= money($b['price']) ?></span>
          <form method="post" action="wishlist_toggle.php">
            <?= csrf_field() ?>
            <input type="hidden" name="book_id" value="<?= (int)$b['id'] ?>">
            <button class="btn btn-small btn-danger" type="submit">Remove</button>
          </form>
        </div>
      </article>
    <?php endforeach; ?>
  </section>
<?php endif; ?>
<?php require_once 'includes/footer.php'; ?>
````

---

## Experiment 18

**Aim:** Add client-side form validation in JavaScript for registration, login, and checkout forms.

**`js/validation.js`**

````javascript
// Client-side validation for the registration, login and checkout forms.
// The server repeats every check, so this is only for faster feedback.
(function () {
  const V = {
    required: (label) => (v) => v.trim() !== '' || label + ' is required.',
    minLen: (n, label) => (v) => v.trim().length >= n || label + ' must be at least ' + n + ' characters.',
    email: (v) => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim()) || 'Enter a valid email address.',
    password: (v) => (v.length >= 8 && /[A-Za-z]/.test(v) && /\d/.test(v)) ||
      'Password needs 8+ characters with at least one letter and one number.',
    match: (other, msg) => (v, form) => v === form.elements[other].value || msg,
    phone: (v) => /^[6-9]\d{9}$/.test(v.trim()) || 'Enter a valid 10-digit mobile number.',
    pincode: (v) => /^\d{6}$/.test(v.trim()) || 'Enter a valid 6-digit PIN code.',
  };

  const formRules = {
    registerForm: {
      name: [V.required('Name'), V.minLen(2, 'Name')],
      email: [V.required('Email'), V.email],
      password: [V.required('Password'), V.password],
      confirm_password: [V.match('password', 'Passwords do not match.')],
    },
    loginForm: {
      email: [V.required('Email'), V.email],
      password: [V.required('Password')],
    },
    checkoutForm: {
      shipping_name: [V.required('Name'), V.minLen(2, 'Name')],
      shipping_phone: [V.required('Mobile number'), V.phone],
      shipping_address: [V.required('Address'), V.minLen(8, 'Address')],
      shipping_city: [V.required('City')],
      shipping_pincode: [V.required('PIN code'), V.pincode],
    },
  };

  function showError(input, message) {
    let box = input.nextElementSibling;
    if (!box || !box.classList.contains('error')) {
      box = document.createElement('small');
      box.className = 'error';
      input.insertAdjacentElement('afterend', box);
    }
    box.textContent = message || '';
    input.classList.toggle('is-invalid', !!message);
  }

  function validateField(form, name, rules) {
    const input = form.elements[name];
    if (!input) return true;
    for (const rule of rules) {
      const result = rule(input.value, form);
      if (result !== true) { showError(input, result); return false; }
    }
    showError(input, '');
    return true;
  }

  Object.keys(formRules).forEach((formId) => {
    const form = document.getElementById(formId);
    if (!form) return;
    const rules = formRules[formId];

    Object.keys(rules).forEach((name) => {
      const input = form.elements[name];
      if (input) input.addEventListener('blur', () => validateField(form, name, rules[name]));
    });

    form.addEventListener('submit', (event) => {
      let allValid = true;
      Object.keys(rules).forEach((name) => {
        if (!validateField(form, name, rules[name])) allValid = false;
      });
      if (!allValid) {
        event.preventDefault();
        const firstBad = form.querySelector('.is-invalid');
        if (firstBad) firstBad.focus();
      }
    });
  });
})();
````

---

## Experiment 19

**Aim:** Style the entire bookstore application consistently using an external CSS framework (e.g., Bootstrap or custom CSS).

**`includes/header.php`**

````php
<?php
require_once __DIR__ . '/functions.php';
$base      = $base ?? '';                       // '' for root pages, '../' for admin pages
$pageTitle = $pageTitle ?? 'Online Bookstore';
$flash     = get_flash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($pageTitle) ?> | BookNest</title>
  <link rel="stylesheet" href="<?= $base ?>css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container header-row">
    <a class="brand" href="<?= $base ?>index.php">&#128214; BookNest</a>

    <form class="search-form" action="<?= $base ?>books.php" method="get">
      <input type="search" name="q" placeholder="Search by title, author or category" value="<?= e($_GET['q'] ?? '') ?>">
      <button type="submit">Search</button>
    </form>

    <nav class="main-nav">
      <a href="<?= $base ?>books.php">Books</a>
      <?php if (is_logged_in()): ?>
        <a href="<?= $base ?>wishlist.php">Wishlist</a>
        <a href="<?= $base ?>orders.php">My Orders</a>
      <?php endif; ?>
      <a href="<?= $base ?>cart.php">Cart (<?= cart_count() ?>)</a>
      <?php if (is_admin()): ?><a href="<?= $base ?>admin/index.php">Admin</a><?php endif; ?>
      <?php if (is_logged_in()): ?>
        <a href="<?= $base ?>logout.php">Logout (<?= e($_SESSION['user_name']) ?>)</a>
      <?php else: ?>
        <a href="<?= $base ?>login.php">Login</a>
        <a href="<?= $base ?>register.php">Register</a>
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
  <div class="container">
    <p>&copy; <?= date('Y') ?> BookNest Online Bookstore. MCA108P Project.</p>
  </div>
</footer>
<script src="<?= $base ?? '' ?>js/validation.js"></script>
</body>
</html>
````

**`css/style.css`**

````css
/* BookNest - custom CSS used by every page */
:root {
  --primary: #2c3e50;
  --accent: #e67e22;
  --light: #f4f6f8;
  --success: #27ae60;
  --danger: #e74c3c;
  --text: #2d3436;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: "Segoe UI", Arial, sans-serif; background: var(--light); color: var(--text); line-height: 1.55; display: flex; flex-direction: column; min-height: 100vh; }
a { color: var(--primary); text-decoration: none; }
a:hover { color: var(--accent); }
.container { width: 100%; max-width: 1150px; margin: 0 auto; padding: 0 18px; }
main.container { flex: 1; padding-top: 25px; padding-bottom: 40px; }
h1, h2, h3 { margin-bottom: 12px; color: var(--primary); }

/* header */
.site-header { background: var(--primary); color: #fff; padding: 12px 0; }
.header-row { display: flex; flex-wrap: wrap; align-items: center; gap: 15px; }
.brand { color: #fff; font-size: 1.5rem; font-weight: bold; }
.search-form { flex: 1 1 280px; display: flex; }
.search-form input { flex: 1; padding: 9px 12px; border: none; border-radius: 4px 0 0 4px; }
.search-form button { padding: 9px 16px; border: none; background: var(--accent); color: #fff; border-radius: 0 4px 4px 0; cursor: pointer; }
.main-nav { display: flex; flex-wrap: wrap; gap: 14px; }
.main-nav a { color: #ecf0f1; font-size: 0.95rem; }
.main-nav a:hover { color: var(--accent); }

/* alerts */
.alert { padding: 12px 16px; border-radius: 5px; margin-bottom: 18px; }
.alert-success { background: #d4efdf; color: #1e8449; }
.alert-danger { background: #fadbd8; color: #922b21; }
.alert-info { background: #d6eaf8; color: #1b4f72; }

/* buttons */
.btn { display: inline-block; background: var(--primary); color: #fff; border: none; padding: 9px 18px; border-radius: 5px; cursor: pointer; font-size: 0.95rem; }
.btn:hover { background: #1a252f; color: #fff; }
.btn-accent { background: var(--accent); }
.btn-accent:hover { background: #ca6f1e; }
.btn-danger { background: var(--danger); }
.btn-small { padding: 5px 11px; font-size: 0.85rem; }
.btn[disabled] { background: #b2bec3; cursor: not-allowed; }

/* hero + promo banners (homepage) */
.hero { background: linear-gradient(120deg, #2c3e50, #4ca1af); color: #fff; padding: 45px 30px; border-radius: 10px; margin-bottom: 25px; }
.hero h1 { color: #fff; font-size: 2.2rem; }
.hero p { margin: 8px 0 18px; }
.promos { display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 25px; }
.promo { flex: 1 1 240px; padding: 22px; border-radius: 8px; color: #fff; }
.promo.p1 { background: #e67e22; } .promo.p2 { background: #8e44ad; } .promo.p3 { background: #16a085; }
.promo h3 { color: #fff; margin-bottom: 4px; }
.category-nav { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 25px; }
.category-nav a { background: #fff; border: 1px solid #dcdfe3; padding: 7px 16px; border-radius: 20px; }
.category-nav a:hover { background: var(--accent); color: #fff; border-color: var(--accent); }

/* book grid + cards */
.book-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 20px; }
.book-card { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1); display: flex; flex-direction: column; transition: transform 0.2s, box-shadow 0.2s; }
.book-card:hover { transform: translateY(-4px); box-shadow: 0 8px 18px rgba(0,0,0,0.15); }
.book-card .body { padding: 14px; flex: 1; display: flex; flex-direction: column; gap: 4px; }
.book-card h3 { font-size: 1rem; margin: 0; }
.author { color: #636e72; font-size: 0.9rem; }
.price { font-weight: bold; color: var(--accent); font-size: 1.1rem; }
.cover { width: 100%; height: 220px; object-fit: cover; display: block; }
.cover-placeholder { display: flex; align-items: center; justify-content: center; color: #fff; font-size: 4rem; font-weight: bold; }
.badge { display: inline-block; padding: 2px 9px; border-radius: 10px; font-size: 0.75rem; color: #fff; }
.badge-ok { background: var(--success); } .badge-out { background: var(--danger); } .badge-low { background: var(--accent); }
.badge-Pending { background: #f39c12; } .badge-Shipped { background: #2980b9; } .badge-Delivered { background: var(--success); }

/* forms + tables + panels */
.panel { background: #fff; padding: 22px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); margin-bottom: 22px; }
.form-narrow { max-width: 460px; margin: 20px auto; }
label { display: block; font-weight: 600; margin: 12px 0 4px; }
input[type=text], input[type=email], input[type=password], input[type=number], input[type=search], input[type=date], select, textarea {
  width: 100%; padding: 9px 11px; border: 2px solid #ccd1d4; border-radius: 5px; font-size: 1rem; font-family: inherit; }
input:focus, select:focus, textarea:focus { outline: none; border-color: var(--primary); }
.is-invalid { border-color: var(--danger) !important; }
.error { color: var(--danger); font-size: 0.85rem; display: block; min-height: 16px; }
.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; background: #fff; }
th, td { padding: 10px 12px; border-bottom: 1px solid #e5e8ea; text-align: left; }
th { background: var(--primary); color: #fff; }
.inline-form { display: inline-flex; gap: 6px; align-items: center; }
.inline-form input[type=number] { width: 80px; }
.filters { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px; align-items: flex-end; }
.filters > div { flex: 1 1 160px; }
.filters label { margin-top: 0; }

/* detail page */
.detail { display: flex; flex-wrap: wrap; gap: 30px; }
.detail .cover-box { flex: 0 0 280px; max-width: 100%; }
.detail .info { flex: 1 1 300px; }
.stars { color: #f39c12; letter-spacing: 2px; }
.review { border-bottom: 1px solid #e5e8ea; padding: 10px 0; }

/* pagination */
.pagination { display: flex; flex-wrap: wrap; gap: 6px; justify-content: center; margin-top: 25px; }
.pagination a, .pagination span { padding: 7px 13px; background: #fff; border: 1px solid #dcdfe3; border-radius: 4px; }
.pagination .active { background: var(--primary); color: #fff; border-color: var(--primary); }
.pagination .disabled { color: #b2bec3; }

/* stat cards (admin) */
.stats { display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 22px; }
.stat { flex: 1 1 170px; background: var(--primary); color: #fff; padding: 18px; border-radius: 8px; }
.stat b { display: block; font-size: 1.7rem; color: #f1c40f; }

.site-footer { background: var(--primary); color: #bdc3c7; text-align: center; padding: 18px 0; }

@media (max-width: 600px) {
  .hero h1 { font-size: 1.6rem; }
  .main-nav { gap: 10px; }
}
@media print {
  .site-header, .site-footer, .no-print { display: none !important; }
  body { background: #fff; }
  .panel { box-shadow: none; border: 1px solid #999; }
}
````

---

## Experiment 20

**Aim:** Test the complete end-to-end e-commerce user journey: browsing, searching, adding to cart, user login, checkout, and order confirmation.

**`tests/smoke_test.php`**

````php
<?php
// Quick environment check before the manual end-to-end test.
// Open: http://localhost/MCA108P-AS07/tests/smoke_test.php   (delete before deployment)
require_once __DIR__ . '/../config/db.php';

$results = [];
try {
    $pdo = getConnection();
    $results['Database connection'] = true;

    foreach (['books', 'users', 'orders', 'order_items', 'reviews', 'wishlist'] as $table) {
        $results["Table '$table' exists"] = (bool)$pdo->query("SHOW TABLES LIKE '$table'")->fetchColumn();
    }
    $results['Books available (stock > 0)'] = (int)$pdo->query('SELECT COUNT(*) FROM books WHERE stock > 0')->fetchColumn() > 0;
    $results['Admin account exists']        = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'")->fetchColumn() > 0;
} catch (PDOException $e) {
    $results['Database connection: ' . $e->getMessage()] = false;
}
$results['PHP version >= 7.4 (' . PHP_VERSION . ')'] = version_compare(PHP_VERSION, '7.4.0', '>=');
$results['PDO MySQL driver loaded']                  = extension_loaded('pdo_mysql');
$results['mbstring loaded']                          = extension_loaded('mbstring');
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Smoke Test</title>
<style>body{font-family:Arial;margin:30px}li{margin:6px 0}.ok{color:green}.fail{color:red}</style></head>
<body><h2>Bookstore Smoke Test</h2><ul>
<?php foreach ($results as $label => $ok): ?>
  <li class="<?= $ok ? 'ok' : 'fail' ?>"><?= $ok ? '&#10004;' : '&#10008;' ?> <?= htmlspecialchars($label) ?></li>
<?php endforeach; ?>
</ul></body></html>
````

**`tests/TESTING.md`**

````markdown
# Experiment 20: End-to-End Test Plan

Run `tests/smoke_test.php` first (all items must be green), then follow the journey below.
Admin login: `admin@booknest.com` / `Admin@123` (created by `create_admin.php`).

| # | Step | Action | Expected result | Pass/Fail |
|---|------|--------|-----------------|-----------|
| 1 | Browse | Open `index.php`, then click **Books** | Homepage shows banners/categories; books grid shows 8 books per page with pagination | |
| 2 | Category | Click category "Technology" on the homepage | Only Technology books are listed | |
| 3 | Search | Type `clean` in the search bar | "Clean Code" is shown; searching `xyz123` shows "No books match" | |
| 4 | Detail | Open a book | Title, author, price, stock, reviews are shown; `book.php?id=9999` shows "does not exist" | |
| 5 | Add to cart | Click **Add to Cart** while logged out | Item is added, header shows `Cart (1)` | |
| 6 | Stock limit | Set quantity above available stock and click Update | Quantity is reduced to stock and a message is displayed | |
| 7 | Login gate | Click **Proceed to Checkout** while logged out | Redirected to login with a message | |
| 8 | Register | Register a new customer with a weak password (`abc`) | Client and server show errors; valid data creates the account | |
| 9 | Login | Log in with the new account | Redirected back to checkout; cart is preserved | |
| 10 | Checkout | Submit with an invalid phone / PIN | Validation errors are shown and no order is created | |
| 11 | Place order | Submit valid shipping details | Redirected to invoice with "order placed" message; cart empty | |
| 12 | Stock updated | Open the same book | Stock reduced by the purchased quantity | |
| 13 | Order history | Open **My Orders** | New order appears with status Pending | |
| 14 | Review | On the book page, add a 4-star review | Review and average rating appear; adding again updates it | |
| 15 | Wishlist | Click **Add to Wishlist**, open **Wishlist** | Book is listed; Remove works | |
| 16 | Admin status | Log in as admin, open **Customer Orders**, set order to Shipped | Customer's **My Orders** shows Shipped | |
| 17 | Admin inventory | Admin > Books: change price/stock, add a new book | Changes appear on the storefront | |
| 18 | Report | Admin > Sales Reports | Revenue and order totals include the new order | |
| 19 | Security | Try `book.php?id=1' OR '1'='1` and a `<script>` comment | No SQL error; script text is displayed as plain text | |
| 20 | Access control | While logged in as customer open `admin/index.php` | "Access denied" (HTTP 403) | |
````

---

## Experiment 21

**Aim:** Write a PHP script for administrators to view sales summary reports and total revenue generated.

**`admin/reports.php`**

````php
<?php
$base = '../';
$pageTitle = 'Sales Reports';
require_once '../includes/functions.php';
require_admin();

$pdo = db();
$valid = fn($d) => preg_match('/^\d{4}-\d{2}-\d{2}$/', (string)$d) ? $d : '';
$from  = $valid($_GET['from'] ?? '');
$to    = $valid($_GET['to'] ?? '');
$range = [':from' => $from ?: '1970-01-01', ':to' => $to ?: '2999-12-31'];
$cond  = 'DATE(o.created_at) BETWEEN :from AND :to';

$q = $pdo->prepare("SELECT COUNT(*) AS orders, COALESCE(SUM(o.total),0) AS revenue, COALESCE(AVG(o.total),0) AS avg_order
                    FROM orders o WHERE $cond");
$q->execute($range);
$summary = $q->fetch();

$q = $pdo->prepare("SELECT COALESCE(SUM(oi.quantity),0) FROM order_items oi JOIN orders o ON o.id = oi.order_id WHERE $cond");
$q->execute($range);
$booksSold = (int)$q->fetchColumn();

$q = $pdo->prepare("SELECT DATE_FORMAT(o.created_at, '%Y-%m') AS month, COUNT(*) AS orders, SUM(o.total) AS revenue
                    FROM orders o WHERE $cond GROUP BY month ORDER BY month DESC LIMIT 12");
$q->execute($range);
$monthly = $q->fetchAll();

$q = $pdo->prepare("SELECT oi.title, SUM(oi.quantity) AS qty, SUM(oi.price * oi.quantity) AS revenue
                    FROM order_items oi JOIN orders o ON o.id = oi.order_id
                    WHERE $cond GROUP BY oi.title ORDER BY qty DESC, revenue DESC LIMIT 5");
$q->execute($range);
$top = $q->fetchAll();

$q = $pdo->prepare("SELECT o.status, COUNT(*) AS orders, SUM(o.total) AS revenue FROM orders o WHERE $cond GROUP BY o.status");
$q->execute($range);
$byStatus = $q->fetchAll();

require_once '../includes/header.php';
?>
<h1>Sales Summary Report</h1>
<form class="filters" method="get">
  <div><label>From</label><input type="date" name="from" value="<?= e($from) ?>"></div>
  <div><label>To</label><input type="date" name="to" value="<?= e($to) ?>"></div>
  <div><button class="btn" type="submit">Apply</button> <a class="btn btn-small" href="reports.php">Reset</a></div>
</form>

<div class="stats">
  <div class="stat">Total Revenue<b><?= money($summary['revenue']) ?></b></div>
  <div class="stat">Orders<b><?= (int)$summary['orders'] ?></b></div>
  <div class="stat">Books Sold<b><?= $booksSold ?></b></div>
  <div class="stat">Avg. Order Value<b><?= money($summary['avg_order']) ?></b></div>
</div>

<div class="panel">
  <h2>Revenue by month</h2>
  <div class="table-wrap"><table>
    <tr><th>Month</th><th>Orders</th><th>Revenue</th></tr>
    <?php foreach ($monthly as $m): ?>
      <tr><td><?= e($m['month']) ?></td><td><?= (int)$m['orders'] ?></td><td><?= money($m['revenue']) ?></td></tr>
    <?php endforeach; ?>
    <?php if (!$monthly): ?><tr><td colspan="3">No sales in this period.</td></tr><?php endif; ?>
  </table></div>
</div>

<div class="panel">
  <h2>Top 5 selling books</h2>
  <div class="table-wrap"><table>
    <tr><th>Title</th><th>Copies sold</th><th>Revenue</th></tr>
    <?php foreach ($top as $t): ?>
      <tr><td><?= e($t['title']) ?></td><td><?= (int)$t['qty'] ?></td><td><?= money($t['revenue']) ?></td></tr>
    <?php endforeach; ?>
    <?php if (!$top): ?><tr><td colspan="3">No data.</td></tr><?php endif; ?>
  </table></div>
</div>

<div class="panel">
  <h2>Orders by status</h2>
  <div class="table-wrap"><table>
    <tr><th>Status</th><th>Orders</th><th>Value</th></tr>
    <?php foreach ($byStatus as $s): ?>
      <tr><td><span class="badge badge-<?= e($s['status']) ?>"><?= e($s['status']) ?></span></td>
          <td><?= (int)$s['orders'] ?></td><td><?= money($s['revenue']) ?></td></tr>
    <?php endforeach; ?>
    <?php if (!$byStatus): ?><tr><td colspan="3">No data.</td></tr><?php endif; ?>
  </table></div>
</div>
<?php require_once '../includes/footer.php'; ?>
````

