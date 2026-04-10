<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $product['title'] ?> - Chi tiết sản phẩm</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    <style>
/* --- RESET & CƠ BẢN --- */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    background-color: #f5f7fa;
    font-family: 'Inter', 'Segoe UI', sans-serif;
    color: #333;
    line-height: 1.6;
}

.container {
    max-width: 1200px; /* Tăng nhẹ độ rộng để thoáng hơn */
    margin: 20px auto;
    padding: 0 15px;
}

/* --- FIX HEADER/BREADCRUMB --- */
.product-breadcrumb {
    margin-bottom: 15px;
    font-size: 0.9rem;
    color: #888;
}
.product-breadcrumb a {
    color: #007bff;
    text-decoration: none;
}

/* --- WRAPPER CHÍNH (FIX LỖI NHẢY) --- */
.product-detail-wrapper {
    background: #fff;
    display: flex;
    flex-direction: row; /* Ép nằm ngang trên desktop */
    flex-wrap: wrap;    /* Cho phép rớt dòng trên mobile */
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
}

/* --- PHẦN HÌNH ẢNH (LEFT) --- */
.product-image-section {
    flex: 1 1 45%; /* Sử dụng tỷ lệ % thay vì px cố định */
    padding: 40px;
    background-color: #fff;
    border-right: 1px solid #f0f0f0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.product-image-wrapper {
    position: relative;
    width: 100%;
    max-width: 400px; /* Cố định ảnh để không đẩy layout */
    margin-bottom: 30px;
}

.product-image {
    width: 100%;
    height: auto;
    border-radius: 8px;
    object-fit: contain;
}

.image-badge {
    position: absolute;
    top: 0;
    left: 0;
    background: #27ae60;
    color: white;
    padding: 5px 12px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: bold;
}

/* --- PHẦN THÔNG TIN (RIGHT) --- */
.product-info-section {
    flex: 1 1 55%;
    padding: 40px;
}

.product-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #222;
    margin-bottom: 12px;
    line-height: 1.3;
}

.product-rating {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    gap: 10px;
}

.stars { color: #ffc107; font-size: 0.85rem; }
.rating-count {
    color: #888;
    font-size: 0.85rem;
    border-left: 1px solid #ddd;
    padding-left: 10px;
}

/* --- GIÁ CẢ (LÀM NỔI BẬT) --- */
.product-price-section {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
}

.price-value {
    font-size: 2rem;
    font-weight: 700;
    color: #ee4d2d;
}

.discount-badge {
    background: #ee4d2d;
    color: white;
    padding: 2px 8px;
    border-radius: 3px;
    font-size: 0.85rem;
    margin-left: 15px;
    font-weight: bold;
}

/* --- FORM & NÚT --- */
.quantity-group {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
    gap: 20px;
}

.quantity-control {
    display: flex;
    border: 1px solid #ddd;
    border-radius: 4px;
    height: 40px;
}

.qty-btn {
    width: 40px;
    background: #fff;
    border: none;
    cursor: pointer;
    font-size: 1.2rem;
    transition: background 0.2s;
}
.qty-btn:hover { background: #f0f0f0; }

.quantity-input {
    width: 50px;
    text-align: center;
    border: none;
    border-left: 1px solid #ddd;
    border-right: 1px solid #ddd;
    font-weight: bold;
}

.form-actions {
    display: flex;
    gap: 15px;
    margin-bottom: 25px;
}

.btn {
    flex: 1;
    height: 54px;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: 0.3s;
}

.btn-add-cart {
    background-color: rgba(238, 77, 45, 0.08);
    border: 1px solid #ee4d2d;
    color: #ee4d2d;
}
.btn-add-cart:hover { background-color: rgba(238, 77, 45, 0.15); }

.btn-buy-now {
    background-color: #ee4d2d;
    color: white;
}
.btn-buy-now:hover { background-color: #d73211; }

/* --- RESPONSIVE (KHÔNG BỊ VỠ) --- */
@media (max-width: 992px) {
    .product-image-section, .product-info-section {
        flex: 1 1 100%; /* Tràn màn hình khi ở tablet/mobile */
        border-right: none;
        padding: 25px;
    }
    .product-image-section {
        border-bottom: 1px solid #eee;
    }
}

@media (max-width: 576px) {
    .form-actions {
        flex-direction: column; /* Nút xếp dọc trên điện thoại nhỏ */
    }
    .btn { width: 100%; }
}
</style>
  </style>
</head>
<body>
  <div class="container product-detail-container">
    <div class="product-detail-wrapper">
      
      <!-- Product Image Section -->
      <div class="product-image-section">
        <div class="product-image-wrapper">
          <img src="<?= $product['image'] ?>" alt="<?= $product['title'] ?>" class="product-image">
          <div class="image-badge">Có sẵn</div>
        </div>
        <div class="product-features">
          <div class="feature-item">
            <i class="fas fa-truck"></i>
            <span>Giao hàng nhanh</span>
          </div>
          <div class="feature-item">
            <i class="fas fa-shield-alt"></i>
            <span>Bảo hành chính hãng</span>
          </div>
          <div class="feature-item">
            <i class="fas fa-undo"></i>
            <span>Đổi trả dễ dàng</span>
          </div>
        </div>
      </div>

      <!-- Product Info Section -->
      <div class="product-info-section">
        <h1 class="product-title"><?= $product['title'] ?></h1>
        
        <div class="product-rating">
          <div class="stars">
            <i class="fas fa-star filled"></i>
            <i class="fas fa-star filled"></i>
            <i class="fas fa-star filled"></i>
            <i class="fas fa-star filled"></i>
            <i class="fas fa-star half"></i>
          </div>
          <span class="rating-count">(256 đánh giá)</span>
        </div>

        <div class="product-meta">
          <div class="meta-item">
            <span class="meta-label">Tác giả:</span>
            <span class="meta-value"><?= $product['author'] ?></span>
          </div>
          <!-- Add more product details if available -->
        </div>

        <div class="product-price-section">
          <div class="price-main">
            <span class="price-label">Giá:</span>
            <span class="price-value"><?= number_format($product['price']) ?> đ</span>
          </div>
          <div class="price-discount">
            <span class="discount-badge">-15%</span>
          </div>
        </div>

        <form method="POST" action="<?= BASE_URL ?>?action=add-to-cart" class="product-form">
          <input type="hidden" name="id" value="<?= $product['id'] ?>">

          <div class="form-group quantity-group">
            <label for="quantity" class="quantity-label">Số lượng:</label>
            <div class="quantity-control">
              <button type="button" class="qty-btn minus" onclick="decreaseQty()">−</button>
              <input type="number" id="quantity" name="quantity" value="1" min="1" max="100" class="quantity-input">
              <button type="button" class="qty-btn plus" onclick="increaseQty()">+</button>
            </div>
            <span class="stock-info">Còn <strong>45</strong> sản phẩm</span>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-add-cart">
              <i class="fas fa-shopping-cart"></i>
              Thêm vào giỏ hàng
            </button>

            <button type="button" class="btn btn-buy-now" onclick="buyNow(<?= $product['id'] ?>, <?= $product['price'] ?>)">
              <i class="fas fa-bolt"></i>
              Mua ngay
            </button>
          </div>

          <div class="form-info">
            <p>
              <i class="fas fa-info-circle"></i>
              Nhận thêm khuyến mãi khi mua nhiều
            </p>
          </div>
        </form>

        <div class="product-description">
          <h3>Mô tả sản phẩm</h3>
          <p>Đây là một sản phẩm chất lượng cao được chọn lọc kỹ lưỡng. Sản phẩm đã được kiểm định và đảm bảo chất lượng.</p>
        </div>

      </div>

    </div>
  </div>

  <script>
    function decreaseQty() {
      const input = document.getElementById('quantity');
      if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
      }
    }

    function increaseQty() {
      const input = document.getElementById('quantity');
      if (input.value < 100) {
        input.value = parseInt(input.value) + 1;
      }
    }

    function buyNow(productId, price) {
      // Implement buy now functionality
      alert('Chức năng mua ngay sẽ được triển khai');
    }
  </script>
</body>
</html>