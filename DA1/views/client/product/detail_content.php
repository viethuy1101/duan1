<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $product['title'] ?> - Chi tiết sản phẩm</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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