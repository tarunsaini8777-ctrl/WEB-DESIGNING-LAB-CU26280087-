<?php
// Task 8: admin dashboard – add books, update prices, manage inventory
$pageTitle = 'Admin';
require '../includes/header.php';
require_admin();
$cats = db()->query('SELECT * FROM categories ORDER BY name')->fetchAll();

function save_image(): ?string {
    if (empty($_FILES['image']['name']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) return null;
    if ($_FILES['image']['size'] > 2 * 1024 * 1024) throw new RuntimeException('Image must be under 2 MB.');
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($_FILES['image']['tmp_name']);
    $ext = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'][$mime] ?? null;
    if (!$ext) throw new RuntimeException('Only JPG, PNG or WEBP images allowed.');
    $name = bin2hex(random_bytes(8)) . '.' . $ext;
    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../uploads/' . $name);
    return $name;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['action'] ?? '';
    try {
        if ($a === 'add') {
            $title = post('title'); $author = post('author'); $price = (float)($_POST['price'] ?? 0); $stock = (int)($_POST['stock'] ?? 0);
            if ($title === '' || $author === '' || $price <= 0 || $stock < 0) throw new RuntimeException('Title, author, positive price and non-negative stock are required.');
            $cid = (int)($_POST['category_id'] ?? 0) ?: null;
            db()->prepare('INSERT INTO books (title,author,price,stock,image,category_id,description,featured) VALUES (?,?,?,?,?,?,?,?)')
                ->execute([$title, $author, $price, $stock, save_image(), $cid, post('description'), isset($_POST['featured']) ? 1 : 0]);
            flash('Book added.');
        } elseif ($a === 'update') {
            $price = (float)($_POST['price'] ?? 0); $stock = (int)($_POST['stock'] ?? 0);
            if ($price <= 0 || $stock < 0) throw new RuntimeException('Invalid price or stock.');
            db()->prepare('UPDATE books SET price=?, stock=? WHERE id=?')->execute([$price, $stock, (int)$_POST['id']]);
            flash('Book updated.');
        } elseif ($a === 'delete') {
            db()->prepare('DELETE FROM books WHERE id=?')->execute([(int)$_POST['id']]);
            flash('Book deleted.', 'info');
        }
    } catch (PDOException $ex) {
        flash($ex->getCode() === '23000' ? 'Cannot delete a book that appears in past orders. Set its stock to 0 instead.' : 'Database error.', 'danger');
    } catch (RuntimeException $ex) { flash($ex->getMessage(), 'danger'); }
    redirect('index.php');
}
$books = db()->query('SELECT * FROM books ORDER BY id DESC')->fetchAll();
$stats = db()->query("SELECT (SELECT COUNT(*) FROM books) b, (SELECT COUNT(*) FROM orders) o, (SELECT COUNT(*) FROM users WHERE role='customer') u, (SELECT COUNT(*) FROM books WHERE stock<=5) low")->fetch();
?>
<h2>Admin dashboard</h2>
<div class="mb-3 d-flex gap-2"><a class="btn btn-dark" href="index.php">Books &amp; inventory</a><a class="btn btn-outline-dark" href="orders.php">Orders</a><a class="btn btn-outline-dark" href="reports.php">Sales reports</a></div>
<div class="row g-3 mb-4 text-center">
  <div class="col-6 col-md-3"><div class="card card-body"><div class="fs-3"><?= $stats['b'] ?></div>Books</div></div>
  <div class="col-6 col-md-3"><div class="card card-body"><div class="fs-3"><?= $stats['o'] ?></div>Orders</div></div>
  <div class="col-6 col-md-3"><div class="card card-body"><div class="fs-3"><?= $stats['u'] ?></div>Customers</div></div>
  <div class="col-6 col-md-3"><div class="card card-body text-danger"><div class="fs-3"><?= $stats['low'] ?></div>Low stock (≤5)</div></div>
</div>

<div class="card mb-4"><div class="card-header">Add a new book</div><div class="card-body">
<form method="post" enctype="multipart/form-data" class="row g-2"><?= csrf_field() ?><input type="hidden" name="action" value="add">
  <div class="col-md-4"><input name="title" class="form-control" placeholder="Title" required></div>
  <div class="col-md-3"><input name="author" class="form-control" placeholder="Author" required></div>
  <div class="col-md-2"><input name="price" type="number" step="0.01" min="0.01" class="form-control" placeholder="Price" required></div>
  <div class="col-md-1"><input name="stock" type="number" min="0" class="form-control" placeholder="Stock" required></div>
  <div class="col-md-2"><select name="category_id" class="form-select"><option value="">Category</option><?php foreach ($cats as $c): ?><option value="<?= (int)$c['id'] ?>"><?= e($c['name']) ?></option><?php endforeach; ?></select></div>
  <div class="col-md-6"><textarea name="description" class="form-control" rows="2" placeholder="Description"></textarea></div>
  <div class="col-md-4"><input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="form-control"></div>
  <div class="col-md-1 form-check pt-2"><input type="checkbox" name="featured" class="form-check-input" id="ft"><label for="ft" class="form-check-label">Featured</label></div>
  <div class="col-md-1"><button class="btn btn-primary w-100">Add</button></div>
</form></div></div>

<table class="table bg-white align-middle"><thead><tr><th></th><th>Title</th><th>Author</th><th>Price</th><th>Stock</th><th></th></tr></thead>
<?php foreach ($books as $b): ?>
<tr><td><img class="thumb" src="<?= e(cover($b['image'], $b['title'])) ?>" alt=""></td>
<td><form method="post" id="f<?= (int)$b['id'] ?>"><?= csrf_field() ?><input type="hidden" name="id" value="<?= (int)$b['id'] ?>"></form><?= e($b['title']) ?></td><td><?= e($b['author']) ?></td>
<td><input form="f<?= (int)$b['id'] ?>" name="price" type="number" step="0.01" min="0.01" class="form-control form-control-sm" style="width:100px" value="<?= e($b['price']) ?>"></td>
<td><input form="f<?= (int)$b['id'] ?>" name="stock" type="number" min="0" class="form-control form-control-sm <?= $b['stock'] <= 5 ? 'border-danger' : '' ?>" style="width:80px" value="<?= (int)$b['stock'] ?>"></td>
<td class="text-nowrap"><button form="f<?= (int)$b['id'] ?>" name="action" value="update" class="btn btn-sm btn-success">Save</button>
<button form="f<?= (int)$b['id'] ?>" name="action" value="delete" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this book?')">Delete</button></td></tr>
<?php endforeach; ?></table>
<?php require '../includes/footer.php'; ?>
