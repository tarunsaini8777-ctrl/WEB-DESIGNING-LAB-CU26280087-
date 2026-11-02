<?php
// Task 12: order history
$pageTitle = 'My Orders';
require 'includes/header.php';
require_login();
$st = db()->prepare('SELECT * FROM orders WHERE user_id=? ORDER BY created_at DESC, id DESC'); $st->execute([$_SESSION['user']['id']]);
$orders = $st->fetchAll();
$it = db()->prepare('SELECT title, quantity FROM order_items WHERE order_id=?');
$badge = ['Pending' => 'warning text-dark', 'Shipped' => 'info text-dark', 'Delivered' => 'success'];
?>
<h2>My orders</h2>
<?php if (!$orders): ?><div class="alert alert-info">No orders yet. <a href="index.php">Start shopping</a></div><?php else: ?>
<table class="table bg-white align-middle"><thead><tr><th>#</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th><th></th></tr></thead>
<?php foreach ($orders as $o): $it->execute([$o['id']]); ?>
<tr><td><?= (int)$o['id'] ?></td><td><?= e(substr($o['created_at'], 0, 10)) ?></td>
<td><?php foreach ($it->fetchAll() as $i) echo e($i['title']) . ' × ' . (int)$i['quantity'] . '<br>'; ?></td>
<td><?= money($o['total']) ?></td><td><span class="badge bg-<?= $badge[$o['status']] ?>"><?= e($o['status']) ?></span></td>
<td><a class="btn btn-sm btn-outline-dark" href="invoice.php?id=<?= (int)$o['id'] ?>">Invoice</a></td></tr>
<?php endforeach; ?></table><?php endif; ?>
<?php require 'includes/footer.php'; ?>
