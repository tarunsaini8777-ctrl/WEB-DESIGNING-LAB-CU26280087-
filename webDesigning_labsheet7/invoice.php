<?php
// Task 16: invoice summary (owner or admin only)
$pageTitle = 'Invoice';
require 'includes/header.php';
require_login();
$id = (int)($_GET['id'] ?? 0);
$st = db()->prepare('SELECT o.*, u.email FROM orders o JOIN users u ON u.id=o.user_id WHERE o.id=?'); $st->execute([$id]);
$o = $st->fetch();
if (!$o || ($o['user_id'] != $_SESSION['user']['id'] && !is_admin())) { http_response_code(404); echo '<div class="alert alert-warning">Invoice not found.</div>'; require 'includes/footer.php'; exit; }
$it = db()->prepare('SELECT * FROM order_items WHERE order_id=?'); $it->execute([$id]); $items = $it->fetchAll();
?>
<div class="invoice">
  <div class="d-flex justify-content-between"><div><h3>Invoice #<?= str_pad($o['id'], 5, '0', STR_PAD_LEFT) ?></h3><div class="text-muted"><?= e($o['created_at']) ?></div></div>
  <div class="text-end"><strong>📚 Online Bookstore</strong><br><span class="badge bg-info text-dark"><?= e($o['status']) ?></span></div></div>
  <hr>
  <div class="row mb-3"><div class="col-sm-6"><strong>Ship to</strong><br><?= e($o['ship_name']) ?><br><?= e($o['ship_address']) ?><br><?= e($o['ship_city']) ?> <?= e($o['ship_zip']) ?><br><?= e($o['ship_phone']) ?></div>
  <div class="col-sm-6"><strong>Billed to</strong><br><?= e($o['email']) ?></div></div>
  <table class="table"><thead><tr><th>Item</th><th class="text-end">Price</th><th class="text-end">Qty</th><th class="text-end">Amount</th></tr></thead>
  <?php foreach ($items as $i): ?><tr><td><?= e($i['title']) ?></td><td class="text-end"><?= money($i['price']) ?></td><td class="text-end"><?= (int)$i['quantity'] ?></td><td class="text-end"><?= money($i['price'] * $i['quantity']) ?></td></tr><?php endforeach; ?>
  <tfoot><tr><th colspan="3" class="text-end">Total</th><th class="text-end"><?= money($o['total']) ?></th></tr></tfoot></table>
  <div class="no-print"><button class="btn btn-outline-dark" onclick="window.print()">Print invoice</button> <a href="orders.php" class="btn btn-primary">My orders</a></div>
</div>
<?php require 'includes/footer.php'; ?>
