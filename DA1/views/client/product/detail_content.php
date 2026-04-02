<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
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
</body>
</html>