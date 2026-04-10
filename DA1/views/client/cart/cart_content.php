<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giỏ hàng của tôi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
/* --- BIẾN MÀU SẮC CHỦ ĐẠO (ĐÃ CHUYỂN SANG TÔNG ĐỎ) --- */
:root {
    --primary: #ee4d2d;       /* Màu đỏ chủ đạo giống trang chi tiết */
    --primary-hover: #d73211; /* Đỏ đậm hơn khi hover */
    --accent: #f59e0b;        
    --danger: #ef4444;        
    --bg: #f5f5f5;           /* Nền xám nhẹ cho chuyên nghiệp */
    --text-main: #222;
    --text-muted: #777;
    --border: #e0e0e0;
}

/* --- RESET & LAYOUT --- */
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
    background-color: var(--bg);
    font-family: 'Inter', 'Segoe UI', sans-serif;
    color: var(--text-main);
    padding: 20px;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 0 15px;
}

.cart-wrapper {
    background: #fff;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
}

.cart-title {
    font-size: 1.6rem;
    font-weight: 700;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #333;
}

/* --- BẢNG SẢN PHẨM --- */
.cart-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 12px; /* Tạo khoảng cách giữa các hàng */
}

.cart-table th {
    text-transform: uppercase;
    font-size: 0.75rem;
    color: var(--text-muted);
    padding: 0 15px;
    text-align: left;
    font-weight: 600;
}

.cart-item {
    background: #fff;
    transition: transform 0.2s;
}

.cart-item td {
    padding: 15px;
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
}

.cart-item td:first-child { border-left: 1px solid var(--border); border-radius: 8px 0 0 8px; }
.cart-item td:last-child { border-right: 1px solid var(--border); border-radius: 0 8px 8px 0; }

/* Hình ảnh */
.cart-image img {
    width: 65px;
    height: 85px;
    object-fit: cover;
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.product-link {
    text-decoration: none;
    color: var(--text-main);
    font-weight: 600;
    display: block;
    margin-bottom: 3px;
    transition: color 0.2s;
}
.product-link:hover { color: var(--primary); } /* Hover tên sản phẩm hiện màu đỏ */

.price { font-weight: 500; color: var(--text-muted); }
.subtotal { font-weight: 700; color: var(--primary); } /* Tổng tiền từng dòng màu đỏ */

/* --- CẢI THIỆN NÚT BẤM (BUTTONS) --- */
.qty-input {
    width: 45px;
    height: 35px;
    border: 1px solid var(--border);
    border-radius: 4px;
    text-align: center;
    font-weight: 600;
}

.btn-update-qty {
    background: #f1f5f9;
    border: none;
    width: 35px;
    height: 35px;
    border-radius: 4px;
    cursor: pointer;
    color: #555;
    transition: all 0.2s;
}
.btn-update-qty:hover { background: var(--primary); color: #fff; }

.btn-delete {
    color: var(--danger);
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    padding: 6px 10px;
    border-radius: 4px;
    transition: background 0.2s;
}
.btn-delete:hover { background: #fee2e2; }

/* --- KHU VỰC TỔNG TIỀN (SỬA ĐỂ GIỐNG ẢNH BẠN GỬI) --- */
.cart-summary {
    margin-top: 30px;
    background: #f8f9fa; /* Nền xám nhạt hơn */
    border-radius: 12px;
    padding: 25px;
    width: 100%;
    max-width: 350px;
    margin-left: auto;
    border: 1px solid #f0f0f0;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 0.95rem;
    color: #555;
}
.summary-item .label { color: #666; }
.summary-item .value { font-weight: 500; color: #333; }

.total-amount {
    border-top: 1px dashed var(--border);
    margin-top: 15px;
    padding-top: 15px;
}

.total-amount .label { font-weight: 600; font-size: 1rem; color: #333; }
.total-amount .value {
    font-size: 1.6rem;
    color: var(--primary); /* Tổng cộng màu đỏ nổi bật */
    font-weight: 800;
}

/* --- NÚT HÀNH ĐỘNG CHÍNH --- */
.cart-actions {
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-continue {
    text-decoration: none;
    color: var(--text-muted);
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: color 0.2s;
}
.btn-continue:hover { color: var(--primary); }

.btn-checkout {
    background: var(--primary); /* Nút thanh toán màu đỏ */
    color: #fff;
    text-decoration: none;
    padding: 16px 45px;
    border-radius: 8px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 8px 15px rgba(238, 77, 45, 0.2); /* Shadow đỏ nhẹ */
    transition: all 0.3s;
}

.btn-checkout:hover {
    background: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 15px 20px rgba(238, 77, 45, 0.3);
}

/* --- RESPONSIVE --- */
@media (max-width: 992px) {
    .cart-wrapper { padding: 20px; }
}
@media (max-width: 768px) {
    .cart-actions { flex-direction: column-reverse; gap: 20px; }
    .btn-checkout { width: 100%; text-align: center; justify-content: center; }
}
</style>
</head>
<body>
  <div class="container cart-container">
    <div class="cart-wrapper">
      <h1 class="cart-title">
        <i class="fas fa-shopping-cart"></i> Giỏ hàng của bạn
      </h1>

      <?php if (empty($_SESSION['cart'])): ?>
        <div class="empty-cart">
          <i class="fas fa-inbox"></i>
          <h3>Giỏ hàng trống</h3>
          <p>Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
          <a href="<?= BASE_URL ?>" class="btn btn-add-cart" style="text-decoration: none; display: inline-block;">
            <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
          </a>
        </div>
      <?php else: ?>
        <div class="cart-content">
          <!-- Cart Table -->
          <table class="cart-table">
            <thead>
              <tr>
                <th>Ảnh sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng cộng</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php $total = 0; ?>
              <?php foreach($_SESSION['cart'] as $id => $item): ?>
                <?php 
                    $sum = $item['price'] * $item['quantity'];
                    $total += $sum;
                ?>
                <tr class="cart-item">
                  <td class="cart-image">
                    <img src="<?= BASE_ASSETS_UPLOADS . $item['image'] ?>" alt="<?= $item['name'] ?>">
                  </td>
                  <td class="cart-name">
                    <a href="<?= BASE_URL ?>?action=detail&id=<?= $id ?>" class="product-link">
                      <?= $item['name'] ?>
                    </a>
                  </td>
                  <td class="cart-price">
                    <span class="price"><?= number_format($item['price']) ?> đ</span>
                  </td>
                  <td class="cart-quantity">
                    <form method="POST" action="<?= BASE_URL ?>?action=update-cart" class="qty-form" style="display: flex; gap: 5px;">
                      <input type="hidden" name="item_id" value="<?= $id ?>">
                      <input type="number" name="qty[<?= $id ?>]" value="<?= $item['quantity'] ?>" min="1" max="100" class="qty-input">
                      <button type="submit" class="btn-update-qty" title="Cập nhật">
                        <i class="fas fa-sync"></i>
                      </button>
                    </form>
                  </td>
                  <td class="cart-subtotal">
                    <span class="subtotal"><?= number_format($sum) ?> đ</span>
                  </td>
                  <td class="cart-action">
                    <a href="<?= BASE_URL ?>?action=delete-cart&id=<?= $id ?>" class="btn-delete" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')">
                      <i class="fas fa-trash"></i> Xóa
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <!-- Cart Summary -->
          <div class="cart-summary">
            <div class="summary-item">
              <span class="label">Tổng số sản phẩm:</span>
              <span class="value"><?= count($_SESSION['cart']) ?> sản phẩm</span>
            </div>
            <div class="summary-item">
              <span class="label">Cộng tiền sản phẩm:</span>
              <span class="value"><?= number_format($total) ?> đ</span>
            </div>
            <div class="summary-item">
              <span class="label">Phí vận chuyển:</span>
              <span class="value">30,000 đ</span>
            </div>
            <div class="summary-item total-amount">
              <span class="label">Tổng cộng:</span>
              <span class="value"><?= number_format($total + 30000) ?> đ</span>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="cart-actions">
          <a href="<?= BASE_URL ?>" class="btn btn-continue">
            <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
          </a>
          <a href="<?= BASE_URL ?>?action=checkout" class="btn btn-checkout">
            <i class="fas fa-credit-card"></i> Thanh toán
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>