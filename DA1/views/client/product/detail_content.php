<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $product['title'] ?> - Chi tiết sản phẩm</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
/* --- GIỮ NGUYÊN CSS CỦA M --- */
* { box-sizing: border-box; margin: 0; padding: 0; }
body { background-color: #f5f7fa; font-family: 'Inter', 'Segoe UI', sans-serif; color: #333; line-height: 1.6; }
.container { max-width: 1200px; margin: 20px auto; padding: 0 15px; }
.product-detail-wrapper { background: #fff; display: flex; flex-direction: row; flex-wrap: wrap; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05); }
.product-image-section { flex: 1 1 45%; padding: 40px; background-color: #fff; border-right: 1px solid #f0f0f0; display: flex; flex-direction: column; align-items: center; }
.product-image-wrapper { position: relative; width: 100%; max-width: 400px; margin-bottom: 30px; }
.product-image { width: 100%; height: auto; border-radius: 8px; object-fit: contain; }
.image-badge { position: absolute; top: 0; left: 0; background: #27ae60; color: white; padding: 5px 12px; border-radius: 4px; font-size: 0.75rem; font-weight: bold; }
.product-info-section { flex: 1 1 55%; padding: 40px; }
.product-title { font-size: 1.8rem; font-weight: 700; color: #222; margin-bottom: 12px; line-height: 1.3; }
.product-rating { display: flex; align-items: center; margin-bottom: 20px; gap: 10px; }
.stars { color: #ffc107; font-size: 0.85rem; }
.rating-count { color: #888; font-size: 0.85rem; border-left: 1px solid #ddd; padding-left: 10px; }
.product-price-section { background-color: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 30px; display: flex; align-items: center; }
.price-value { font-size: 2rem; font-weight: 700; color: #ee4d2d; }
.discount-badge { background: #ee4d2d; color: white; padding: 2px 8px; border-radius: 3px; font-size: 0.85rem; margin-left: 15px; font-weight: bold; }
.quantity-group { display: flex; align-items: center; margin-bottom: 30px; gap: 20px; }
.quantity-control { display: flex; border: 1px solid #ddd; border-radius: 4px; height: 40px; }
.qty-btn { width: 40px; background: #fff; border: none; cursor: pointer; font-size: 1.2rem; transition: background 0.2s; }
.qty-btn:hover { background: #f0f0f0; }
.quantity-input { width: 50px; text-align: center; border: none; border-left: 1px solid #ddd; border-right: 1px solid #ddd; font-weight: bold; }
.form-actions { display: flex; gap: 15px; margin-bottom: 25px; }
.btn { flex: 1; height: 54px; border: none; border-radius: 4px; font-size: 1rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: 0.3s; }
.btn-add-cart { background-color: rgba(238, 77, 45, 0.08); border: 1px solid #ee4d2d; color: #ee4d2d; }
.btn-buy-now { background-color: #ee4d2d; color: white; }
.product-reviews-section { margin-top: 40px; padding: 30px; background: #fafafa; border-radius: 12px; border: 1px solid #ececec; }
.product-reviews-section h3 { margin-bottom: 18px; font-size: 1.2rem; color: #222; }
.review-summary { display: flex; flex-wrap: wrap; align-items: center; gap: 15px; margin-bottom: 24px; }
.average-rating { display: flex; align-items: baseline; gap: 6px; font-size: 2rem; font-weight: 700; color: #ee4d2d; }
.rating-out-of { font-size: 1rem; color: #777; }
.rating-stars { display: flex; gap: 4px; color: #ffc107; font-size: 1.1rem; }
.review-item { padding: 18px; background: white; border-radius: 12px; border: 1px solid #e6e6e6; margin-bottom: 15px; }
.review-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
.review-author { font-weight: 700; color: #222; }
.review-rating { color: #ffc107; }
@media (max-width: 992px) { .product-image-section, .product-info-section { flex: 1 1 100%; border-right: none; padding: 25px; } }
</style>
</head>
<body>
  <div class="container product-detail-container">
    <div class="product-detail-wrapper">
      
      <div class="product-image-section">
        <div class="product-image-wrapper">
          <img src="<?= BASE_ASSETS_UPLOADS . 'img/' . htmlspecialchars($product['image'] ?? 'no-image-book.png') ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="product-image" onerror="this.src='<?= BASE_ASSETS_UPLOADS . 'img/no-image-book.png' ?>'">
          <div class="image-badge">Có sẵn</div>
        </div>
      </div>

      <div class="product-info-section">
        <h1 class="product-title"><?= $product['title'] ?></h1>
        
        <?php
          $reviews = $reviews ?? []; // Đảm bảo biến luôn tồn tại
          $reviewCount = count($reviews);
          $averageRating = 0;
          if ($reviewCount > 0) {
              $total = 0;
              foreach ($reviews as $review) { $total += (int) $review['rating']; }
              $averageRating = round($total / $reviewCount, 1);
          }
          $filledStars = floor($averageRating);
          $hasHalfStar = ($averageRating - $filledStars) >= 0.5;
        ?>

        <div class="product-rating">
          <div class="stars">
            <?php for ($i = 1; $i <= 5; $i++): ?>
              <?php if ($i <= $filledStars): ?> <i class="fas fa-star filled"></i>
              <?php elseif ($i === $filledStars + 1 && $hasHalfStar): ?> <i class="fas fa-star-half-alt filled"></i>
              <?php else: ?> <i class="far fa-star"></i> <?php endif; ?>
            <?php endfor; ?>
          </div>
          <span class="rating-count"><?= $reviewCount > 0 ? ($averageRating . '/5 từ ' . $reviewCount . ' đánh giá') : 'Chưa có đánh giá' ?></span>
        </div>

        <div class="product-price-section">
          <div class="price-main">
            <span class="price-value" id="displayPrice"><?= number_format($product['price']) ?> đ</span>
          </div>
        </div>

        <form method="POST" action="<?= BASE_URL ?>?action=add-to-cart">
          <input type="hidden" name="id" value="<?= $product['id'] ?>">
          <input type="hidden" id="basePrice" value="<?= $product['price'] ?>">
          
          <!-- Biến thể sản phẩm -->
          <?php if (!empty($variants)): ?>
          <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Loại bìa:</label>
            <select name="variant_id" id="variantSelect" onchange="updatePrice()" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem;">
              <option value="" data-price="<?= $product['price'] ?>">-- Loại bìa --</option>
              <?php foreach ($variants as $variant): ?>
                <option value="<?= $variant['id'] ?>" data-price="<?= $variant['price'] ?>" data-stock="<?= $variant['stock'] ?>">
                  <?= htmlspecialchars($variant['variant_name']) ?> 
                  <?php if ($variant['price'] != $product['price']): ?>
                    (<?= number_format($variant['price']) ?> đ)
                  <?php endif; ?>
                  (Kho: <?= $variant['stock'] ?>)
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <?php endif; ?>
          
          <div class="quantity-group">
            <div class="quantity-control">
              <button type="button" class="qty-btn" onclick="decreaseQty()">−</button>
              <input type="number" id="quantity" name="quantity" value="1" min="1" class="quantity-input">
              <button type="button" class="qty-btn" onclick="increaseQty()">+</button>
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-add-cart"><i class="fas fa-shopping-cart"></i> Giỏ hàng</button>
            <button type="submit" class="btn btn-buy-now">Mua ngay</button>
          </div>
        </form>

        <div class="product-description" style="margin-top:20px;">
          <h3>Mô tả sản phẩm</h3>
          <p>Đây là một sản phẩm chất lượng cao được chọn lọc kỹ lưỡng.</p>
        </div>

        <div class="product-reviews-section">
          <h3>Đánh giá từ khách hàng (<?= $reviewCount ?>)</h3>
          <div class="review-summary">
            <div class="average-rating">
              <span><?= $averageRating ?: '0' ?></span><span class="rating-out-of">/5</span>
            </div>
            <div class="rating-stars">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <i class="<?= $i <= $filledStars ? 'fas' : 'far' ?> fa-star"></i>
              <?php endfor; ?>
            </div>
          </div>

          <?php if ($reviewCount === 0): ?>
            <p>Chưa có đánh giá nào.</p>
          <?php else: ?>
            <div class="review-list">
              <?php foreach ($reviews as $review): ?>
                <div class="review-item">
                  <div class="review-header">
                    <span class="review-author"><?= htmlspecialchars($review['username'] ?? 'Khách') ?></span>
                    <span class="review-rating"><?= (int)$review['rating'] ?> ⭐</span>
                  </div>
                  <p class="review-comment"><?= nl2br(htmlspecialchars($review['comment'] ?? '')) ?></p>
                  <small class="review-date"><?= date('d/m/Y', strtotime($review['created_at'])) ?></small>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>

  <script>
    const basePrice = parseInt(document.getElementById('basePrice').value);
    
    function updatePrice() {
      const variantSelect = document.getElementById('variantSelect');
      const selectedOption = variantSelect.options[variantSelect.selectedIndex];
      const price = parseInt(selectedOption.dataset.price) || basePrice;
      const displayPrice = document.getElementById('displayPrice');
      
      // Format price with thousand separator
      displayPrice.textContent = new Intl.NumberFormat('vi-VN').format(price) + ' đ';
    }

    function decreaseQty() { 
      const i = document.getElementById('quantity'); 
      if (i.value > 1) i.value = parseInt(i.value) - 1; 
    }
    
    function increaseQty() { 
      const i = document.getElementById('quantity'); 
      i.value = parseInt(i.value) + 1; 
    }
  </script>
</body>
</html>