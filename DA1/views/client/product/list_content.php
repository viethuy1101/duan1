<h3>Danh sách sách</h3>

<div class="row">
<?php foreach($products as $item): ?>
  <div class="col-md-3">
    <div class="card mb-4">
      <img src="<?= BASE_ASSETS_UPLOADS . $item['image'] ?>">

      <div class="card-body">
        <h6><?= $item['title'] ?></h6>
        <p class="text-danger"><?= number_format($item['price']) ?> đ</p>

        <a href="<?= BASE_URL ?>?action=detail&id=<?= $item['id'] ?>" class="btn btn-primary btn-sm">
          Xem
        </a>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>