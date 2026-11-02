<?php
// Task 21: sales summary and total revenue
$pageTitle = 'Admin – Sales';
require '../includes/header.php';
require_admin();
$sum = db()->query("SELECT COUNT(*) orders, COALESCE(SUM(total),0) revenue, COALESCE(AVG(total),0) avg_order FROM orders")->fetch();
$units = (int)db()->query('SELECT COALESCE(SUM(quantity),0) FROM order_items')->fetchColumn();
$byStatus = db()->query('SELECT status, COUNT(*) n, SUM(total) revenue FROM orders GROUP BY status')->fetchAll();
$daily = db()->query("SELECT DATE(created_at) d, COUNT(*) n, SUM(total) revenue FROM orders GROUP BY DATE(created_at) ORDER BY d DESC LIMIT 14")->fetchAll();
$top = db()->query('SELECT title, SUM(quantity) units, SUM(price*quantity) revenue FROM order_items GROUP BY book_id, title ORDER BY units DESC LIMIT 5')->fetchAll();
?>
<h2>Sales reports</h2>
<div class="mb-3 d-flex gap-2"><a class="btn btn-outline-dark" href="index.php">Books &amp; inventory</a><a class="btn btn-outline-dark" href="orders.php">Orders</a><a class="btn btn-dark" href="reports.php">Sales reports</a></div>
<div class="row g-3 mb-4 text-center">
  <div class="col-md-3"><div class="card card-body bg-success text-white"><div class="fs-3"><?= money($sum['revenue']) ?></div>Total revenue</div></div>
  <div class="col-md-3"><div class="card card-body"><div class="fs-3"><?= (int)$sum['orders'] ?></div>Orders</div></div>
  <div class="col-md-3"><div class="card card-body"><div class="fs-3"><?= $units ?></div>Books sold</div></div>
  <div class="col-md-3"><div class="card card-body"><div class="fs-3"><?= money($sum['avg_order']) ?></div>Average order</div></div>
</div>
<div class="row g-4">
  <div class="col-md-6"><h5>Top selling books</h5><table class="table bg-white"><tr><th>Title</th><th>Units</th><th>Revenue</th></tr>
    <?php foreach ($top as $t): ?><tr><td><?= e($t['title']) ?></td><td><?= (int)$t['units'] ?></td><td><?= money($t['revenue']) ?></td></tr><?php endforeach; ?></table></div>
  <div class="col-md-6"><h5>Orders by status</h5><table class="table bg-white"><tr><th>Status</th><th>Orders</th><th>Value</th></tr>
    <?php foreach ($byStatus as $s): ?><tr><td><?= e($s['status']) ?></td><td><?= (int)$s['n'] ?></td><td><?= money($s['revenue']) ?></td></tr><?php endforeach; ?></table></div>
  <div class="col-12"><h5>Daily sales (last 14 days with orders)</h5><table class="table bg-white"><tr><th>Date</th><th>Orders</th><th>Revenue</th></tr>
    <?php foreach ($daily as $d): ?><tr><td><?= e($d['d']) ?></td><td><?= (int)$d['n'] ?></td><td><?= money($d['revenue']) ?></td></tr><?php endforeach; ?></table></div>
</div>
<?php require '../includes/footer.php'; ?>
