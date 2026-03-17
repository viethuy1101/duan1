<div class="row">
  <div class="col-md-5">
    <img src="<?= BASE_ASSETS_UPLOADS . $product['image'] ?>" class="img-fluid">
  </div>

  <div class="col-md-7">
    <h3><?= $product['title'] ?></h3>
    <p>Tác giả: <?= $product['author'] ?></p>
    <h4 class="text-danger"><?= number_format($product['price']) ?> đ</h4>
    <p><?= $product['description'] ?></p>
  </div>
</div>