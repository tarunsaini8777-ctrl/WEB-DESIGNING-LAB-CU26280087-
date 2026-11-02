<?php
// Task 17: wishlist stored in DB
$pageTitle = 'Wishlist';
require 'includes/header.php';
require_login();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    db()->prepare('DELETE FROM wishlist WHERE user_id=? AND book_id=?')->execute([$_SESSION['user']['id'], (int)($_POST['id'] ?? 0)]);
    flash('Removed from wishlist.', 'info'); redirect('wishlist.php');
}
$st = db()->prepare('SELECT b.* FROM wishlist w JOIN books b ON b.id=w.book_id WHERE w.user_id=? ORDER BY w.added_at DESC');
$st->execute([$_SESSION['user']['id']]); $books = $st->fetchAll();
?>
<h2>My wishlist</h2>
<?php if (!$books): ?><div class="alert alert-info">Your wishlist is empty.</div><?php else: ?>
<table class="table bg-white align-middle">
<?php foreach ($books as $b): ?>
<tr><td><img class="thumb" src="<?= e(cover($b['image'], $b['title'])) ?>" alt=""></td>
<td><a href="book.php?id=<?= (int)$b['id'] ?>"><?= e($b['title']) ?></a><br><small class="text-muted"><?= e($b['author']) ?></small></td>
<td><?= money($b['price']) ?></td>
<td class="text-end d-flex gap-2 justify-content-end">
  <?php if ($b['stock'] > 0): ?><form method="post" action="cart.php"><?= csrf_field() ?><input type="hidden" name="action" value="add"><input type="hidden" name="id" value="<?= (int)$b['id'] ?>"><button class="btn btn-sm btn-primary">Add to cart</button></form><?php else: ?><span class="badge bg-secondary">Out of stock</span><?php endif; ?>
  <form method="post"><?= csrf_field() ?><input type="hidden" name="id" value="<?= (int)$b['id'] ?>"><button class="btn btn-sm btn-outline-danger">Remove</button></form></td></tr>
<?php endforeach; ?></table>
<?php endif; ?>
<?php require 'includes/footer.php'; ?>
