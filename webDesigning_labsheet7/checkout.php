<?php
// Task 7: checkout; records order + items in a transaction, re-checks stock, decrements inventory
$pageTitle = 'Checkout';
require 'includes/header.php';
require_login();
$cart = $_SESSION['cart'] ?? [];
if (!$cart) { flash('Your cart is empty.', 'warning'); redirect('cart.php'); }

$ids = array_keys($cart);
$in = implode(',', array_fill(0, count($ids), '?'));
$st = db()->prepare("SELECT * FROM books WHERE id IN ($in)"); $st->execute($ids);
$books = $st->fetchAll();
$total = 0; foreach ($books as $b) $total += $b['price'] * $cart[$b['id']];

$errors = []; $f = ['ship_name' => $_SESSION['user']['name'], 'ship_address' => '', 'ship_city' => '', 'ship_zip' => '', 'ship_phone' => ''];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($f as $k => $_) $f[$k] = post($k);
    if (mb_strlen($f['ship_name']) < 2) $errors[] = 'Enter the recipient name.';
    if (mb_strlen($f['ship_address']) < 5) $errors[] = 'Enter a full street address.';
    if (mb_strlen($f['ship_city']) < 2) $errors[] = 'Enter the city.';
    if (!preg_match('/^[A-Za-z0-9 -]{4,10}$/', $f['ship_zip'])) $errors[] = 'Enter a valid postal code.';
    if (!preg_match('/^[0-9+() -]{7,15}$/', $f['ship_phone'])) $errors[] = 'Enter a valid phone number.';

    if (!$errors) {
        $pdo = db();
        try {
            $pdo->beginTransaction();
            $lock = $pdo->prepare("SELECT id,title,price,stock FROM books WHERE id IN ($in) FOR UPDATE");
            $lock->execute($ids);
            $rows = $lock->fetchAll(); $sum = 0;
            foreach ($rows as $r) {
                $q = $cart[$r['id']];
                if ($q > $r['stock']) throw new RuntimeException("Sorry, only {$r['stock']} copies of “{$r['title']}” are left.");
                $sum += $r['price'] * $q;
            }
            if (count($rows) !== count($ids)) throw new RuntimeException('A book in your cart is no longer available.');
            $pdo->prepare('INSERT INTO orders (user_id,total,ship_name,ship_address,ship_city,ship_zip,ship_phone) VALUES (?,?,?,?,?,?,?)')
                ->execute([$_SESSION['user']['id'], $sum, $f['ship_name'], $f['ship_address'], $f['ship_city'], $f['ship_zip'], $f['ship_phone']]);
            $oid = (int)$pdo->lastInsertId();
            $ins = $pdo->prepare('INSERT INTO order_items (order_id,book_id,title,price,quantity) VALUES (?,?,?,?,?)');
            $upd = $pdo->prepare('UPDATE books SET stock = stock - ? WHERE id=?');
            foreach ($rows as $r) { $q = $cart[$r['id']]; $ins->execute([$oid, $r['id'], $r['title'], $r['price'], $q]); $upd->execute([$q, $r['id']]); }
            $pdo->commit();
            $_SESSION['cart'] = [];
            flash("Order #$oid placed successfully!");
            redirect("invoice.php?id=$oid");
        } catch (RuntimeException $ex) {
            $pdo->rollBack(); $errors[] = $ex->getMessage();
        }
    }
}
?>
<h2>Checkout</h2>
<div class="row g-4">
  <div class="col-md-7">
    <?php foreach ($errors as $er): ?><div class="alert alert-danger py-2"><?= e($er) ?></div><?php endforeach; ?>
    <form method="post" data-validate="checkout" novalidate><?= csrf_field() ?>
      <h5>Shipping details</h5>
      <div class="mb-3"><label class="form-label">Full name</label><input name="ship_name" class="form-control" value="<?= e($f['ship_name']) ?>"></div>
      <div class="mb-3"><label class="form-label">Street address</label><input name="ship_address" class="form-control" value="<?= e($f['ship_address']) ?>"></div>
      <div class="row"><div class="col-md-7 mb-3"><label class="form-label">City</label><input name="ship_city" class="form-control" value="<?= e($f['ship_city']) ?>"></div>
      <div class="col-md-5 mb-3"><label class="form-label">Postal code</label><input name="ship_zip" class="form-control" value="<?= e($f['ship_zip']) ?>"></div></div>
      <div class="mb-3"><label class="form-label">Phone</label><input name="ship_phone" class="form-control" value="<?= e($f['ship_phone']) ?>"></div>
      <button class="btn btn-success btn-lg">Place order (<?= money($total) ?>)</button>
    </form>
  </div>
  <div class="col-md-5"><div class="card"><div class="card-header">Order summary</div><ul class="list-group list-group-flush">
    <?php foreach ($books as $b): ?><li class="list-group-item d-flex justify-content-between"><span><?= e($b['title']) ?> × <?= (int)$cart[$b['id']] ?></span><span><?= money($b['price'] * $cart[$b['id']]) ?></span></li><?php endforeach; ?>
    <li class="list-group-item d-flex justify-content-between fw-bold"><span>Total</span><span><?= money($total) ?></span></li>
  </ul></div><p class="small text-muted mt-2">Payment is collected on delivery (demo).</p></div>
</div>
<?php require 'includes/footer.php'; ?>
