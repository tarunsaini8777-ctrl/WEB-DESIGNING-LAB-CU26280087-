<?php
// Tasks 1, 3, 10, 11: homepage, dynamic grid, search/filter, pagination
$pageTitle = 'Home';
require 'includes/header.php';

$q   = clean($_GET['q'] ?? '');
$cat = (int)($_GET['cat'] ?? 0);
$page = max(1, (int)($_GET['page'] ?? 1));
$filtering = $q !== '' || $cat > 0;

$where = []; $args = [];
if ($q !== '') {
    $where[] = '(b.title LIKE ? OR b.author LIKE ? OR c.name LIKE ?)';
    $like = '%' . $q . '%'; array_push($args, $like, $like, $like);
}
if ($cat > 0) { $where[] = 'b.category_id = ?'; $args[] = $cat; }
$sqlWhere = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$cnt = db()->prepare("SELECT COUNT(*) FROM books b LEFT JOIN categories c ON c.id=b.category_id $sqlWhere");
$cnt->execute($args);
$total = (int)$cnt->fetchColumn();
$pages = max(1, (int)ceil($total / PER_PAGE));
$page  = min($page, $pages);
$offset = ($page - 1) * PER_PAGE;

// LIMIT/OFFSET are validated integers, safe to inline
$st = db()->prepare("SELECT b.* FROM books b LEFT JOIN categories c ON c.id=b.category_id $sqlWhere ORDER BY b.created_at DESC, b.id DESC LIMIT " . PER_PAGE . " OFFSET $offset");
$st->execute($args);
$books = $st->fetchAll();

$cats = db()->query('SELECT * FROM categories ORDER BY name')->fetchAll();
$qs = fn(array $o) => '?' . http_build_query(array_filter(array_merge(['q' => $q, 'cat' => $cat], $o)));
?>
<?php if (!$filtering): ?>
<section class="hero mb-4">
  <h1 class="display-5 fw-bold">Find your next great read</h1>
  <p class="lead mb-3">Thousands of stories, ideas and adventures – delivered to your door.</p>
  <a href="#catalog" class="btn btn-warning btn-lg">Browse books</a>
</section>
<div class="row g-3 mb-4 promo-strip">
  <div class="col-md-4"><div class="promo" style="background:#c0392b">🔥 Free shipping on orders over $50</div></div>
  <div class="col-md-4"><div class="promo" style="background:#16807a">📖 New arrivals every week</div></div>
  <div class="col-md-4"><div class="promo" style="background:#8e6a00">★ Review books &amp; build your wishlist</div></div>
</div>
<?php
$feat = db()->query('SELECT * FROM books WHERE featured=1 ORDER BY id DESC LIMIT 4')->fetchAll();
if ($feat): ?>
<h3 class="mb-3">Featured books</h3>
<div class="row g-3 mb-5"><?php foreach ($feat as $b) include 'includes/book_card.php'; ?></div>
<?php endif; endif; ?>

<h3 id="catalog" class="mb-3"><?= $filtering ? 'Search results' : 'All books' ?> <small class="text-muted fs-6">(<?= $total ?>)</small></h3>
<div class="cat-pills mb-3">
  <a class="btn btn-sm <?= $cat ? 'btn-outline-dark' : 'btn-dark' ?>" href="<?= e($qs(['cat' => 0, 'page' => 1])) ?>">All</a>
  <?php foreach ($cats as $c): ?>
    <a class="btn btn-sm <?= $cat === (int)$c['id'] ? 'btn-dark' : 'btn-outline-dark' ?>" href="<?= e($qs(['cat' => $c['id'], 'page' => 1])) ?>"><?= e($c['name']) ?></a>
  <?php endforeach; ?>
</div>

<?php if (!$books): ?>
  <div class="alert alert-info">No books matched your search.</div>
<?php else: ?>
  <div class="row g-3"><?php foreach ($books as $b) include 'includes/book_card.php'; ?></div>
<?php endif; ?>

<?php if ($pages > 1): ?>
<nav class="mt-4"><ul class="pagination justify-content-center">
  <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="<?= e($qs(['page' => $page - 1])) ?>">«</a></li>
  <?php for ($i = 1; $i <= $pages; $i++): ?>
    <li class="page-item <?= $i === $page ? 'active' : '' ?>"><a class="page-link" href="<?= e($qs(['page' => $i])) ?>"><?= $i ?></a></li>
  <?php endfor; ?>
  <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>"><a class="page-link" href="<?= e($qs(['page' => $page + 1])) ?>">»</a></li>
</ul></nav>
<?php endif; ?>
<?php require 'includes/footer.php'; ?>
