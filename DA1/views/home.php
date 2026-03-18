
<img src="<?= BASE_ASSETS_UPLOADS . 'img/banner.jpg' ?>" alt="Banner">
<h3 class="mb-4 fw-bold">Chào mừng bạn đến với BookVerse!</h3>

<div class="row">
<?php foreach($products as $item): ?>
  <div class="col-md-3">
    
    <div class="card mb-4">
      
      <img src="<?= BASE_ASSETS_UPLOADS . $item['image'] ?>" class="card-img-top">

      <div class="card-body text-center">
        
        <h6 class="fw-bold"><?= $item['title'] ?></h6>

        <p class="price"><?= number_format($item['price']) ?> đ</p>

        <a href="<?= BASE_URL ?>?action=detail&id=<?= $item['id'] ?>" 
           class="btn btn-primary btn-sm">
           Xem chi tiết
        </a>

      </div>
    </div>

  </div>
<?php endforeach; ?>
</div>