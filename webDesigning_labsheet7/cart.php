<?php
// Tasks 6 and 13: session cart with stock checks
require_once 'config.php';
csrf_check();
$_SESSION['cart'] = $_SESSION['cart'] ?? [];

function book_stock(int $id): ?array {
    $s = db()->prepare('SELECT id,title,stock FROM books WHERE id=?'); $s->execute([$id]); return $s->fetch() ?: null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = (int)($_POST['id'] ?? 0);
    if (isset($_POST['remove'])) { $action = 'remove'; $id = (int)$_POST['remove']; }
    if ($action === 'add') {
        $qty = max(1, (int)($_POST['qty'] ?? 1));
        $b = book_stock($id);
        if (!$b) flash('Book not found.', 'danger');
        else {
            $want = ($_SESSION['cart'][$id] ?? 0) + $qty;
            if ($want > $b['stock']) {
                $_SESSION['cart'][$id] = min($b['stock'], $_SESSION['cart'][$id] ?? 0);
                if ($_SESSION['cart'][$id] <= 0) unset($_SESSION['cart'][$id]);
                flash("Only {$b['stock']} copies of “{$b['title']}” available.", 'warning');
            } else { $_SESSION['cart'][$id] = $want; flash("Added “{$b['title']}” to cart."); }
        }
        redirect($_SERVER['HTTP_REFERER'] ?? 'cart.php');
    }
    if ($action === 'update') {
        foreach (($_POST['qty'] ?? []) as $bid => $q) {
            $bid = (int)$bid; $q = (int)$q;
            if (!isset($_SESSION['cart'][$bid])) continue;
            $b = book_stock($bid);
            if ($q <= 0 || !$b) { unset($_SESSION['cart'][$bid]); continue; }
            if ($q > $b['stock']) { $q = $b['stock']; flash("Quantity for “{$b['title']}” reduced to available stock ($q).", 'warning'); }
            if ($q <= 0) unset($_SESSION['cart'][$bid]); else $_SESSION['cart'][$bid] = $q;
        }
        flash('Cart updated.');
    }
    if ($action === 'remove') { unset($_SESSION['cart'][$id]); flash('Item removed.', 'info'); }
    redirect('cart.php');
}

$pageTitle = 'Cart';
require 'includes/header.php';
$items = []; $total = 0;
if ($_SESSION['cart']) {
    $ids = array_keys($_SESSION['cart']);
    $in = implode(',', array_fill(0, count($ids), '?'));
    $st = db()->prepare("SELECT * FROM books WHERE id IN ($in)"); $st->execute($ids);
    foreach ($st->fetchAll() as $b) {
        $b['qty'] = $_SESSION['cart'][$b['id']]; $b['sub'] = $b['qty'] * $b['price']; $total += $b['sub']; $items[] = $b;
    }
}
?>
<h2>Your cart</h2>
<?php if (!$items): ?>
  <div class="alert alert-info">Your cart is empty. <a href="index.php">Browse books</a></div>
<?php else: ?>
<form method="post"><?= csrf_field() ?><input type="hidden" name="action" value="update">
<table class="table align-middle bg-white">
  <thead><tr><th></th><th>Book</th><th>Price</th><th style="width:110px">Qty</th><th>Subtotal</th><th></th></tr></thead>
  <?php foreach ($items as $b): ?>
  <tr>
    <td><img class="thumb" src="<?= e(cover($b['image'], $b['title'])) ?>" alt=""></td>
    <td><a href="book.php?id=<?= (int)$b['id'] ?>"><?= e($b['title']) ?></a><br><small class="text-muted">Stock: <?= (int)$b['stock'] ?></small></td>
    <td><?= money($b['price']) ?></td>
    <td><input type="number" class="form-control" name="qty[<?= (int)$b['id'] ?>]" value="<?= (int)$b['qty'] ?>" min="0" max="<?= (int)$b['stock'] ?>"></td>
    <td><?= money($b['sub']) ?></td>
    <td><button class="btn btn-sm btn-outline-danger" name="remove" value="<?= (int)$b['id'] ?>">✕</button></td>
  </tr>
  <?php endforeach; ?>
  <tfoot><tr><th colspan="4" class="text-end">Total</th><th colspan="2"><?= money($total) ?></th></tr></tfoot>
</table>
<div class="d-flex justify-content-between">
  <a href="index.php" class="btn btn-outline-secondary">Continue shopping</a>
  <div><button class="btn btn-secondary">Update cart</button> <a href="checkout.php" class="btn btn-success">Checkout →</a></div>
</div>
</form>
<?php endif; ?>
<?php require 'includes/footer.php'; ?>
