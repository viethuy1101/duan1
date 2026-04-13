<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .profile-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow: hidden; background: #fff; }
        .profile-header { background: linear-gradient(135deg, #1a1a1a 0%, #434343 100%); padding: 40px; color: white; text-align: center; }
        .avatar-img { width: 120px; height: 120px; border-radius: 50%; border: 5px solid rgba(255,255,255,0.2); object-fit: cover; }
        .nav-pills .nav-link { color: #555; font-weight: 600; border-radius: 8px; padding: 12px 20px; }
        .nav-pills .nav-link.active { background-color: #1a1a1a; }
        .form-control { border-radius: 8px; padding: 12px; border: 1px solid #e1e1e1; }
        .table thead { background-color: #f8f9fa; }
        .status-badge { padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; }
        .btn-eye {width: 38px; height: 38px; border-radius: 50%; border: none; background-color: #f8f9fa; color: #333; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease}
        .btn-eye:hover { background-color: #1a1a1a; color: #fff}
        .order-detail-collapse { background-color: #fafafa; border: 1px solid #eee; border-radius: 12px; margin: 10px 0}
        .btn-view-order {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    border: none;
    background: #f4f4f4;
    color: #333;
    transition: 0.3s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.btn-view-order:hover {
    background: #000;
    color: #fff;
}
.detail-container {
    background-color: #f9f9f9;
    border-radius: 8px;
    border: 1px solid #eee;
}
.product-thumb {
    width: 40px;
    height: 55px;
    object-fit: cover;
    border-radius: 4px;
}
    </style>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card profile-card">
                <div class="profile-header">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Avatar" class="avatar-img mb-3">
                    <h2 class="mb-1 text-uppercase fw-bold"><?= htmlspecialchars($user['name']) ?></h2>
                    <p class="mb-0 opacity-75">Thành viên thân thiết của BookVerse</p>
                </div>

                <div class="card-body p-4">
                    <ul class="nav nav-pills mb-4 justify-content-center" id="profileTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="info-tab" data-bs-toggle="pill" data-bs-target="#info" type="button">
                                <i class="fas fa-user-circle me-2"></i>Thông tin tài khoản
                            </button>
                        </li>
                        <li class="nav-item mx-2">
                            <button class="nav-link" id="orders-tab" data-bs-toggle="pill" data-bs-target="#orders" type="button">
                                <i class="fas fa-shopping-bag me-2"></i>Lịch sử đơn hàng
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="profileTabsContent">
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <form action="<?= BASE_URL ?>?action=profile" method="POST" class="px-md-4">
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold text-muted">Họ và tên</label>
                                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-muted">Địa chỉ Email</label>
                                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-muted">Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" placeholder="Cập nhật số điện thoại">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold text-muted">Địa chỉ nhận hàng mặc định</label>
                                        <textarea name="address" class="form-control" rows="3" placeholder="Nhập địa chỉ chi tiết của bạn"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-5 pt-3 border-top">
                                    <a href="<?= BASE_URL ?>" class="btn btn-outline-secondary px-4">Quay lại trang chủ</a>
                                    <button type="submit" class="btn btn-dark px-5 fw-bold">Lưu thay đổi</button>
                                </div>
                            </form>
                        </div>

                       <table class="table align-middle">
    <thead>
        <tr class="text-secondary small">
            <th>Mã đơn hàng</th>
            <th>Ngày đặt</th>
            <th>Trạng thái</th>
            <th>Tổng tiền</th>
            <th class="text-center">Chi tiết</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): 
            // 1. Gọi model lấy chi tiết sản phẩm cho ĐÚNG mã đơn hàng này
            $details = $orderModel->getOrderDetails($order['id']);
            
            // 2. Tính ngày giao dự kiến
            $expectedDate = date('d/m/Y', strtotime('+3 days', strtotime($order['created_at'])));
        ?>
        <tr>
            <td class="fw-bold">#<?= $order['id'] ?></td>
            
            <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
            
            <td>
                <span class="badge bg-warning text-dark px-3 rounded-pill"><?= $order['status'] ?></span>
            </td>
            
            <td class="fw-bold text-danger"><?= number_format($order['total_money']) ?>đ</td>
            
            <td class="text-center">
                <button class="btn btn-sm btn-outline-dark border-0 shadow-none" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#order-detail-<?= $order['id'] ?>">
                    <i class="fas fa-eye"></i>
                </button>
            </td>
        </tr>

        <tr class="collapse" id="order-detail-<?= $order['id'] ?>">
            <td colspan="5" class="p-0 border-0">
                <div class="m-3 p-4 border rounded-3 bg-light shadow-sm">
                    <div class="row mb-3 pb-2 border-bottom">
                        <div class="col-md-6">
                            <h6 class="fw-bold"><i class="fas fa-map-marker-alt me-2"></i>Thông tin nhận hàng</h6>
                            <div class="small ps-4">
                                <p class="mb-1"><strong>Người nhận:</strong> <?= htmlspecialchars($order['fullname'] ?? $user['name']) ?></p>
                                <p class="mb-1"><strong>SĐT:</strong> <?= htmlspecialchars($order['phone'] ?? '') ?></p>
                                <p class="mb-0"><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['address'] ?? '') ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <div class="d-inline-block text-start p-2 border bg-white rounded">
                                <small class="text-muted d-block">Dự kiến giao hàng:</small>
                                <span class="text-success fw-bold"><?= $expectedDate ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-borderless align-middle mb-0">
                            <thead class="bg-white">
                                <tr class="small text-muted border-bottom">
                                    <th>Sản phẩm</th>
                                    <th class="text-center">SL</th>
                                    <th class="text-end">Đơn giá</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($details as $item): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= BASE_ASSETS_UPLOADS . 'img/' . $item['product_image'] ?>" width="40" height="55" class="rounded me-2" style="object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=' + encodeURIComponent('No+Image')">
                                            <span class="small fw-bold"><?= $item['product_name'] ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center small">x<?= $item['quantity'] ?></td>
                                    <td class="text-end small"><?= number_format($item['price']) ?>đ</td>
                                    <td class="text-end small fw-bold"><?= number_format($item['price'] * $item['quantity']) ?>đ</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>