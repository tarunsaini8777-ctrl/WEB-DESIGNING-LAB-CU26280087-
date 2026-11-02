<?php
// Tasks 4, 15, 17: book detail via GET id, reviews/ratings, wishlist toggle
require_once 'config.php';
csrf_check();
$id = (int)($_GET['id'] ?? 0);
$st = db()->prepare('SELECT b.*, c.name AS category FROM books b LEFT JOIN categories c ON c.id=b.category_id WHERE b.id=?');
$st->execute([$id]);
$book = $st->fetch();
if (!$book) { http_response_code(404); $pageTitle = 'Not found'; require 'includes/header.php'; echo '<div class="alert alert-warning">Book not found.</div>'; require 'includes/footer.php'; exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_login();
    $action = $_POST['action'] ?? '';
    $uid = $_SESSION['user']['id'];
    if ($action === 'review') {
        $rating = (int)($_POST['rating'] ?? 0);
        $comment = mb_substr(post('comment'), 0, 1000);
        if ($rating < 1 || $rating > 5) flash('Choose a rating from 1 to 5.', 'danger');
        else {
            db()->prepare('INSERT INTO reviews (book_id,user_id,rating,comment) VALUES (?,?,?,?)
                           ON DUPLICATE KEY UPDATE rating=VALUES(rating), comment=VALUES(comment), created_at=NOW()')
                ->execute([$id, $uid, $rating, $comment]);
            flash('Thanks for your review!');
        }
    } elseif ($action === 'wish') {
        $has = db()->prepare('SELECT 1 FROM wishlist WHERE user_id=? AND book_id=?'); $has->execute([$uid, $id]);
        if ($has->fetch()) { db()->prepare('DELETE FROM wishlist WHERE user_id=? AND book_id=?')->execute([$uid, $id]); flash('Removed from wishlist.', 'info'); }
        else { db()->prepare('INSERT INTO wishlist (user_id,book_id) VALUES (?,?)')->execute([$uid, $id]); flash('Saved to your wishlist.'); }
    }
    redirect("book.php?id=$id");
}

$pageTitle = $book['title'];
require 'includes/header.php';

$rs = db()->prepare('SELECT r.*, u.name FROM reviews r JOIN users u ON u.id=r.user_id WHERE r.book_id=? ORDER BY r.created_at DESC');
$rs->execute([$id]);
$reviews = $rs->fetchAll();
$avg = $reviews ? array_sum(array_column($reviews, 'rating')) / count($reviews) : 0;

$wished = false; $mine = null;
if (is_logged_in()) {
    $w = db()->prepare('SELECT 1 FROM wishlist WHERE user_id=? AND book_id=?'); $w->execute([$_SESSION['user']['id'], $id]); $wished = (bool)$w->fetch();
    $m = db()->prepare('SELECT * FROM reviews WHERE user_id=? AND book_id=?'); $m->execute([$_SESSION['user']['id'], $id]); $mine = $m->fetch();
}
?>
<div class="row g-4">
  <div class="col-md-4"><img class="img-fluid rounded shadow-sm" src="<?= e(cover($book['image'], $book['title'])) ?>" alt="<?= e($book['title']) ?>"></div>
  <div class="col-md-8">
    <h2><?= e($book['title']) ?></h2>
    <p class="text-muted">by <?= e($book['author']) ?> · <a href="index.php?cat=<?= (int)$book['category_id'] ?>"><?= e($book['category'] ?? 'Uncategorised') ?></a></p>
    <p><?= stars($avg) ?> <small class="text-muted"><?= $reviews ? number_format($avg, 1) . ' (' . count($reviews) . ' reviews)' : 'No reviews yet' ?></small></p>
    <h3><?= money($book['price']) ?></h3>
    <p><?= nl2br(e($book['description'])) ?></p>
    <p><?= $book['stock'] > 0 ? '<span class="badge bg-success">In stock: ' . (int)$book['stock'] . '</span>' : '<span class="badge bg-secondary">Out of stock</span>' ?></p>
    <div class="d-flex gap-2">
      <?php if ($book['stock'] > 0): ?>
      <form method="post" action="cart.php" class="d-flex gap-2"><?= csrf_field() ?>
        <input type="hidden" name="action" value="add"><input type="hidden" name="id" value="<?= $id ?>">
        <input type="number" name="qty" value="1" min="1" max="<?= (int)$book['stock'] ?>" class="form-control" style="width:80px">
        <button class="btn btn-primary">Add to cart</button></form>
      <?php endif; ?>
      <form method="post"><?= csrf_field() ?><input type="hidden" name="action" value="wish">
        <button class="btn btn-outline-danger"><?= $wished ? '♥ In wishlist' : '♡ Add to wishlist' ?></button></form>
    </div>
  </div>
</div>

<hr class="my-5">
<h4>Reviews</h4>
<?php if (is_logged_in()): ?>
<form method="post" class="card card-body mb-4"><?= csrf_field() ?><input type="hidden" name="action" value="review">
  <h6><?= $mine ? 'Update your review' : 'Write a review' ?></h6>
  <div class="mb-2"><select name="rating" class="form-select w-auto" required>
    <option value="">Rating…</option>
    <?php for ($i = 5; $i >= 1; $i--): ?><option value="<?= $i ?>" <?= ($mine['rating'] ?? 0) == $i ? 'selected' : '' ?>><?= str_repeat('★', $i) ?> (<?= $i ?>)</option><?php endfor; ?>
  </select></div>
  <textarea name="comment" class="form-control mb-2" rows="3" maxlength="1000" placeholder="Share your thoughts…"><?= e($mine['comment'] ?? '') ?></textarea>
  <div><button class="btn btn-dark">Submit review</button></div>
</form>
<?php else: ?><p><a href="login.php">Log in</a> to leave a review.</p><?php endif; ?>
<?php foreach ($reviews as $r): ?>
  <div class="border-bottom py-3"><strong><?= e($r['name']) ?></strong> <?= stars($r['rating']) ?> <small class="text-muted"><?= e($r['created_at']) ?></small>
    <p class="mb-0"><?= nl2br(e($r['comment'])) ?></p></div>
<?php endforeach; ?>
<?php require 'includes/footer.php'; ?>
