
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
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold m-0 border-start border-4 border-primary ps-3">🔥 Sản phẩm bán chạy</h2>
        <a href="#" class="text-decoration-none">Xem tất cả <i class="bi bi-arrow-right"></i></a>
    </div>

    <div class="row g-4">
        <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm product-card">
                <div class="p-3">
                    <img src="path/to/clean-code.jpg" class="card-img-top rounded-3" alt="Clean Code" style="height: 200px; object-fit: cover;">
                </div>
                <div class="card-body text-center pt-0">
                    <h6 class="fw-bold mb-1">Clean Code</h6>
                    <p class="text-primary fw-bold mb-3">250,000 đ</p>
                    <a href="#" class="btn btn-sm btn-outline-primary w-100 rounded-pill">Xem chi tiết</a>
                </div>
            </div>
        </div>
        
        </div>
</div>
<div class="container my-5">
    <div class="p-4 bg-light rounded-4 shadow-sm">
        <div class="d-flex align-items-center mb-4">
            <h2 class="fw-bold m-0 text-primary">✨ Sản phẩm Nổi bật</h2>
            <hr class="flex-grow-1 ms-3 d-none d-md-block">
        </div>

        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 shadow-sm featured-item">
                    <div class="position-relative">
                        <img src="path/to/sach-1.jpg" class="card-img p-2 rounded-4" alt="Sách" style="height: 250px; object-fit: contain;">
                        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">Nổi bật</span>
                    </div>
                    <div class="card-body text-center">
                        <h6 class="fw-bold mb-1">DORAEMON</h6>
                        <p class="text-danger fw-bold">1,000,000 đ</p>
                        <button class="btn btn-primary rounded-pill btn-sm w-100">Xem chi tiết</button>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>


</div>