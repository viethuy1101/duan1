<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
:root {
    --primary: #ee4d2d;
    --primary-hover: #d73211;
}

.checkout-grid { display: flex; gap: 30px; padding: 40px 0; }
.col-left { flex: 1.5; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
.col-right { flex: 1; background: #fff; padding: 25px; border-radius: 12px; border: 1px solid #eee; height: fit-content; }

.form-group { margin-bottom: 20px; }
.form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #555; }
.form-control { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; }

/* Kế thừa style .btn-checkout từ hình ảnh code bạn gửi */
.btn-place-order {
    background: var(--primary); /* Nut thanh toan mau do */
    color: #fff;
    text-decoration: none;
    padding: 16px;
    border-radius: 8px;
    font-weight: 700;
    width: 100%;
    border: none;
    cursor: pointer;
    box-shadow: 0 8px 15px rgba(238, 77, 45, 0.2);
    transition: all 0.3s;
}

.btn-place-order:hover {
    background: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 15px 20px rgba(238, 77, 45, 0.3);
}

.summary-item { display: flex; justify-content: space-between; margin-bottom: 12px; }
.total-money { color: var(--primary); font-size: 1.5rem; font-weight: 800; border-top: 1px dashed #ddd; padding-top: 15px; }
</style>
</head>
<body>
    <div class="container checkout-grid">
    <div class="col-left">
        <h2 style="margin-bottom: 25px;">Thông tin nhận hàng</h2>
        <form action="" method="POST" id="checkout-form">
            <div class="form-group">
                <label>Họ và tên</label>
                <input type="text" name="fullname" class="form-control" placeholder="Nhập tên đầy đủ" required>
            </div>
            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="tel" name="phone" class="form-control" placeholder="Số điện thoại của bạn" required>
            </div>
            <div class="form-group">
                <label>Địa chỉ cụ thể</label>
                <textarea name="address" class="form-control" rows="3" placeholder="Số nhà, đường, phường/xã..." required></textarea>
            </div>
            <div class="form-group">
                <label>Ghi chú</label>
                <input type="text" name="note" class="form-control" placeholder="Lưu ý cho shipper">
            </div>
        </form>
    </div>

    <div class="col-right">
        <h2 style="margin-bottom: 20px;">Đơn hàng của bạn</h2>
        <?php foreach($_SESSION['cart'] as $item): ?>
            <div class="summary-item">
                <span><?= $item['name'] ?> (x<?= $item['quantity'] ?>)</span>
                <span><?= number_format($item['price'] * $item['quantity']) ?>đ</span>
            </div>
        <?php endforeach; ?>

        <div style="margin-top: 20px; color: #666;">
            <div class="summary-item">
                <span>Tạm tính:</span>
                <span><?= number_format($subtotal) ?>đ</span>
            </div>
            <div class="summary-item">
                <span>Phí ship:</span>
                <span><?= number_format($shipping) ?>đ</span>
            </div>
        </div>

        <div class="summary-item total-money">
            <span>TỔNG:</span>
            <span><?= number_format($total_money) ?>đ</span>
        </div>

        <button type="submit" form="checkout-form" name="btn_place_order" class="btn-place-order">
            XÁC NHẬN ĐẶT HÀNG
        </button>
    </div>
</div>
</body>
</html>