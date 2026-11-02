<?php /** @var array $b */ ?>
<div class="col-6 col-md-4 col-lg-3">
  <div class="card h-100 book-card">
    <a href="<?= base() ?>book.php?id=<?= (int)$b['id'] ?>"><img src="<?= e(cover($b['image'], $b['title'])) ?>" class="card-img-top" alt="<?= e($b['title']) ?>"></a>
    <div class="card-body d-flex flex-column">
      <h6 class="card-title mb-1"><a class="text-decoration-none text-dark" href="<?= base() ?>book.php?id=<?= (int)$b['id'] ?>"><?= e($b['title']) ?></a></h6>
      <small class="text-muted"><?= e($b['author']) ?></small>
      <div class="mt-auto pt-2 d-flex justify-content-between align-items-center">
        <strong><?= money($b['price']) ?></strong>
        <?php if ($b['stock'] > 0): ?>
          <form method="post" action="<?= base() ?>cart.php"><?= csrf_field() ?>
            <input type="hidden" name="action" value="add"><input type="hidden" name="id" value="<?= (int)$b['id'] ?>">
            <button class="btn btn-sm btn-primary">Add</button></form>
        <?php else: ?><span class="badge bg-secondary">Out of stock</span><?php endif; ?>
      </div>
    </div>
  </div>
</div>
