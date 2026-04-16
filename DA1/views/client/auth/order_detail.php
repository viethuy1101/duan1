<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white py-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Chi tiết đơn hàng #<?= $order['id'] ?></h5>
                        <span class="badge bg-warning text-dark p-2"><?= $order['status'] ?></span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold text-uppercase small text-muted mb-3">Thông tin nhận hàng</h6>
                            <p class="mb-1 fw-bold"><?= $order['fullname'] ?></p>
                            <p class="mb-1 text-muted small"><?= $order['phone'] ?></p>
                            <p class="mb-0 text-muted small"><?= $order['address'] ?></p>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <h6 class="fw-bold text-uppercase small text-muted mb-3">Dự kiến giao hàng</h6>
                            <h5 class="text-success fw-bold"><?= $expectedDate ?></h5>
                            <p class="small text-muted">Phương thức: Giao hàng tiêu chuẩn</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Đơn giá</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($details as $item): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= BASE_ASSETS_UPLOADS . 'img/' . $item['product_image'] ?>" width="60" class="rounded me-3" style="object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=' + encodeURIComponent('No+Image')">
                                            <span class="fw-bold"><?= $item['product_name'] ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center">x<?= $item['quantity'] ?></td>
                                    <td class="text-end"><?= number_format($item['price']) ?>đ</td>
                                    <td class="text-end fw-bold"><?= number_format($item['price'] * $item['quantity']) ?>đ</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end border-0 pt-4 text-muted">Tạm tính:</td>
                                    <td class="text-end border-0 pt-4"><?= number_format($order['total_money'] - 30000) ?>đ</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end border-0 text-muted">Phí vận chuyển:</td>
                                    <td class="text-end border-0">30,000đ</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end border-0 fw-bold h5">Tổng cộng:</td>
                                    <td class="text-end border-0 fw-bold h5 text-danger"><?= number_format($order['total_money']) ?>đ</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-4 border-top pt-3">
                        <a href="?action=profile" class="btn btn-outline-dark">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại lịch sử
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>