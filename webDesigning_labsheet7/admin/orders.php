<?php
// Task 9: view all orders and update fulfilment status
$pageTitle = 'Admin – Orders';
require '../includes/header.php';
require_admin();
$statuses = ['Pending', 'Shipped', 'Delivered'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $s = $_POST['status'] ?? '';
    if (in_array($s, $statuses, true)) { db()->prepare('UPDATE orders SET status=? WHERE id=?')->execute([$s, (int)$_POST['id']]); flash('Order status updated.'); }
    redirect('orders.php' . (!empty($_GET['status']) ? '?status=' . urlencode($_GET['status']) : ''));
}
$f = $_GET['status'] ?? '';
$sql = 'SELECT o.*, u.name, u.email FROM orders o JOIN users u ON u.id=o.user_id' . (in_array($f, $statuses, true) ? ' WHERE o.status=?' : '') . ' ORDER BY o.created_at DESC, o.id DESC';
$st = db()->prepare($sql); $st->execute(in_array($f, $statuses, true) ? [$f] : []); $orders = $st->fetchAll();
$it = db()->prepare('SELECT title, quantity FROM order_items WHERE order_id=?');
?>
<h2>All orders</h2>
<div class="mb-3 d-flex gap-2"><a class="btn btn-outline-dark" href="index.php">Books &amp; inventory</a><a class="btn btn-dark" href="orders.php">Orders</a><a class="btn btn-outline-dark" href="reports.php">Sales reports</a></div>
<div class="mb-3"><a href="orders.php" class="btn btn-sm <?= $f ? 'btn-outline-secondary' : 'btn-secondary' ?>">All</a>
<?php foreach ($statuses as $s): ?><a href="?status=<?= $s ?>" class="btn btn-sm <?= $f === $s ? 'btn-secondary' : 'btn-outline-secondary' ?>"><?= $s ?></a> <?php endforeach; ?></div>
<table class="table bg-white align-middle"><thead><tr><th>#</th><th>Customer</th><th>Items</th><th>Ship to</th><th>Total</th><th>Date</th><th>Status</th></tr></thead>
<?php foreach ($orders as $o): $it->execute([$o['id']]); ?>
<tr><td><a href="../invoice.php?id=<?= (int)$o['id'] ?>"><?= (int)$o['id'] ?></a></td>
<td><?= e($o['name']) ?><br><small class="text-muted"><?= e($o['email']) ?></small></td>
<td><?php foreach ($it->fetchAll() as $i) echo e($i['title']) . ' × ' . (int)$i['quantity'] . '<br>'; ?></td>
<td><small><?= e($o['ship_address']) ?>, <?= e($o['ship_city']) ?> <?= e($o['ship_zip']) ?></small></td>
<td><?= money($o['total']) ?></td><td><?= e(substr($o['created_at'], 0, 10)) ?></td>
<td><form method="post" class="d-flex gap-1"><?= csrf_field() ?><input type="hidden" name="id" value="<?= (int)$o['id'] ?>">
<select name="status" class="form-select form-select-sm"><?php foreach ($statuses as $s): ?><option <?= $o['status'] === $s ? 'selected' : '' ?>><?= $s ?></option><?php endforeach; ?></select>
<button class="btn btn-sm btn-primary">Update</button></form></td></tr>
<?php endforeach; if (!$orders) echo '<tr><td colspan="7" class="text-center text-muted">No orders.</td></tr>'; ?>
</table>
<?php require '../includes/footer.php'; ?>
