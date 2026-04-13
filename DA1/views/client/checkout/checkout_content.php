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

    .form-control:focus {
        border-color: #212529 !important;
        box-shadow: 0 0 0 0.25rem rgba(33, 37, 41, 0.1) !important;
    }
    hr.dashed {
        border-top: 2px dashed #eee;
        background-color: transparent;
    }
</style>
</head>
<body>
   <div class="container my-5">
    <form action="<?= BASE_URL ?>?action=checkout-process" method="POST" class="row g-5">
        <div class="col-lg-7">
    <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
        <h4 class="mb-4 fw-bold text-uppercase">Thông tin giao hàng</h4>
        
        <div class="mb-3">
            <label class="form-label small fw-bold">Họ và tên người nhận</label>
            <input type="text" name="fullname" class="form-control p-3 border-light-subtle shadow-none" 
                   style="border-radius: 12px;" 
                   value="<?= $currentUser['name'] ?? $_SESSION['user']['name'] ?? '' ?>" required>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold">Số điện thoại</label>
                <input type="tel" name="phone" class="form-control p-3 border-light-subtle shadow-none" 
                       style="border-radius: 12px;" placeholder="0xxxxxxxxx" 
                       value="<?= $currentUser['phone'] ?? '' ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold">Email</label>
                <input type="email" class="form-control p-3 border-light-subtle bg-light" 
                       style="border-radius: 12px;" 
                       value="<?= $currentUser['email'] ?? $_SESSION['user']['email'] ?? '' ?>" readonly>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label small fw-bold">Địa chỉ chi tiết</label>
            <textarea name="address" class="form-control p-3 border-light-subtle shadow-none" 
                      style="border-radius: 12px;" rows="3" 
                      placeholder="Số nhà, tên đường..." required><?= $currentUser['address'] ?? '' ?></textarea>
        </div>
        
        <div class="mb-3">
            <label class="form-label small fw-bold">Ghi chú (Tùy chọn)</label>
            <textarea name="note" class="form-control p-3 border-light-subtle shadow-none" 
                      style="border-radius: 12px;" rows="2" 
                      placeholder="Ví dụ: Giao giờ hành chính, gọi trước khi giao..."></textarea>
        </div>
    </div>
</div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 sticky-top" style="border-radius: 20px; top: 20px;">
                <h4 class="mb-4 fw-bold text-uppercase">Tóm tắt đơn hàng</h4>
                <div class="cart-items mb-3" style="max-height: 350px; overflow-y: auto;">
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?= BASE_ASSETS_UPLOADS . 'img/' . $item['image'] ?>" class="rounded shadow-sm" style="width: 55px; height: 75px; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=' + encodeURIComponent('No+Image')">
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0 small fw-bold text-truncate" style="max-width: 180px;"><?= $item['name'] ?></h6>
                            <small class="text-muted">x<?= $item['quantity'] ?></small>
                        </div>
                        <span class="small fw-bold"><?= number_format($item['price'] * $item['quantity']) ?>đ</span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Tạm tính</span>
                    <span><?= number_format($subtotal) ?>đ</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Phí ship</span>
                    <span>30,000đ</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mt-3">
                    <span class="fw-bold fs-5">TỔNG CỘNG</span>
                    <span class="fw-bold text-danger fs-4"><?= number_format($total_money) ?>đ</span>
                </div>
                <button type="submit" name="btn_place_order" class="btn btn-dark w-100 py-3 mt-4 rounded-pill fw-bold shadow">
                    XÁC NHẬN ĐẶT HÀNG
                </button>
            </div>
        </div>
    </form>
</div>
</body>
</html>