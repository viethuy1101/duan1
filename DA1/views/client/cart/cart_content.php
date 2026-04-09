<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giỏ hàng của tôi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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