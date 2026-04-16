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

    /* // css đánh giá sản phẩm */
   /* Star Rating Style */
.star-rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    gap: 8px;
}

.star-rating input { display: none; }

.star-rating label {
    font-size: 32px; /* To hơn để dễ bấm */
    color: #e9ecef;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

/* Hiệu ứng hover và check */
.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label {
    color: #ffc107;
    transform: scale(1.1);
}

/* Tinh chỉnh Modal */
.modal-content {
    border-radius: 15px;
    overflow: hidden;
}

.modal-header {
    background-color: #1a1a1a;
    color: white;
    border-bottom: none;
}

.modal-body {
    padding: 2rem;
}
.review-textarea {
    border: 1px solid #dee2e6;
    border-radius: 10px;
    padding: 12px;
    resize: none;
    transition: 0.3s;
}

.review-textarea:focus {
    border-color: #1a1a1a;
    box-shadow: 0 0 0 0.2rem rgba(0,0,0,0.05);
}
    </style>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card profile-card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="profile-header text-center py-5 bg-dark text-white">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Avatar" class="avatar-img mb-3 rounded-circle border border-4 border-white shadow-sm" style="width: 100px;">
                    <h2 class="mb-1 text-uppercase fw-bold"><?= htmlspecialchars($user['name']) ?></h2>
                    <p class="mb-0 opacity-75">Thành viên thân thiết của BookVerse</p>
                </div>

                <div class="card-body p-4">
                    <ul class="nav nav-pills mb-4 justify-content-center gap-2" id="profileTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active fw-bold px-4 rounded-pill" id="info-tab" data-bs-toggle="pill" data-bs-target="#info" type="button">
                                <i class="fas fa-user-circle me-2"></i>Thông tin tài khoản
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fw-bold px-4 rounded-pill" id="orders-tab" data-bs-toggle="pill" data-bs-target="#orders" type="button">
                                <i class="fas fa-shopping-bag me-2"></i>Lịch sử đơn hàng
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content pt-3" id="profileTabsContent">
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <form action="<?= BASE_URL ?>?action=profile" method="POST" class="px-md-4">
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold text-muted small">Họ và tên</label>
                                        <input type="text" name="name" class="form-control rounded-3" value="<?= htmlspecialchars($user['name']) ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-muted small">Địa chỉ Email</label>
<input type="email" name="email" class="form-control rounded-3" value="<?= htmlspecialchars($user['email']) ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-muted small">Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control rounded-3" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" placeholder="Cập nhật số điện thoại">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold text-muted small">Địa chỉ nhận hàng mặc định</label>
                                        <textarea name="address" class="form-control rounded-3" rows="3" placeholder="Nhập địa chỉ chi tiết của bạn"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-5 pt-3 border-top">
                                    <a href="<?= BASE_URL ?>" class="btn btn-outline-secondary px-4 rounded-3">Quay lại trang chủ</a>
                                    <button type="submit" class="btn btn-dark px-5 fw-bold rounded-3">Lưu thay đổi</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="orders" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table align-middle border-top">
                                    <thead>
                                        <tr class="text-secondary small">
                                            <th class="ps-3">Mã đơn hàng</th>
                                            <th>Ngày đặt</th>
                                            <th>Trạng thái</th>
                                            <th>Tổng tiền</th>
                                            <th class="text-center">Chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $order): 
                                            $details = $orderModel->getOrderDetails($order['id']);
                                            $expectedDate = date('d/m/Y', strtotime('+3 days', strtotime($order['created_at'])));
                                        ?>
                                        <tr>
                                            <td class="fw-bold ps-3">#<?= $order['id'] ?></td>
                                            <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                                            <td>
                                                <?php
                                                    $statusRaw = mb_strtolower(trim($order['status'] ?? 'pending'));
                                                    $statusOptions = [
                                                        'pending'   => ['class' => 'bg-warning text-dark', 'label' => 'Chờ xử lý'],
                                                        'confirmed' => ['class' => 'bg-info text-white', 'label' => 'Đã xác nhận'],
                                                        'shipping'  => ['class' => 'bg-primary text-white', 'label' => 'Đang giao hàng'],
                                                        'completed' => ['class' => 'bg-success text-white', 'label' => 'Đã hoàn thành'],
                                                        'cancelled' => ['class' => 'bg-danger text-white', 'label' => 'Đã hủy'],
                                                        'delivered' => ['class' => 'bg-success text-white', 'label' => 'Đã hoàn thành'],
                                                        'canceled'  => ['class' => 'bg-danger text-white', 'label' => 'Đã hủy'],
                                                        'chờ xử lý'     => ['class' => 'bg-warning text-dark', 'label' => 'Chờ xử lý'],
                                                        'đã xác nhận'    => ['class' => 'bg-info text-white', 'label' => 'Đã xác nhận'],
                                                        'đang giao hàng' => ['class' => 'bg-primary text-white', 'label' => 'Đang giao hàng'],
                                                        'đã hoàn thành'  => ['class' => 'bg-success text-white', 'label' => 'Đã hoàn thành'],
                                                        'đã hủy'        => ['class' => 'bg-danger text-white', 'label' => 'Đã hủy'],
                                                    ];
                                                    $statusInfo = $statusOptions[$statusRaw] ?? ['class' => 'bg-secondary text-white', 'label' => ucfirst($order['status'] ?? 'Không xác định')];
                                                ?>
                                                <span class="badge <?= $statusInfo['class'] ?> px-3 py-2 rounded-pill shadow-sm">
                                                    <i class="bi bi-dot me-1"></i> <?= htmlspecialchars($statusInfo['label']) ?>
                                                </span>
                                            </td>
                                            <td class="fw-bold text-danger"><?= number_format($order['total_money']) ?>đ</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-light border shadow-sm rounded-circle" data-bs-toggle="collapse" data-bs-target="#order-detail-<?= $order['id'] ?>">
                                                    <i class="fas fa-chevron-down"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <tr class="collapse" id="order-detail-<?= $order['id'] ?>">
                                            <td colspan="5" class="p-0 border-0 bg-white">
                                                <div class="m-3 p-4 border rounded-4 bg-light shadow-sm">
                                                    <div class="row mb-3 pb-3 border-bottom align-items-center">
                                                        <div class="col-md-7">
                                                            <h6 class="fw-bold text-dark mb-3"><i class="fas fa-map-marker-alt me-2 text-danger"></i>Thông tin nhận hàng</h6>
                                                            <div class="small ps-4 border-start border-2 ms-2">
                                                                <p class="mb-1 text-dark"><strong>Người nhận:</strong> <?= htmlspecialchars($order['fullname'] ?? $user['name']) ?></p>
                                                                <p class="mb-1 text-muted"><strong>SĐT:</strong> <?= htmlspecialchars($order['phone'] ?? '') ?></p>
                                                                <p class="mb-0 text-muted"><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['address'] ?? '') ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5 text-md-end mt-3 mt-md-0">
                                                            <div class="d-inline-block text-start p-3 border bg-white rounded-3 shadow-sm">
                                                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 10px;">Dự kiến giao hàng:</small>
                                                                <span class="text-success fw-bold fs-5"><?= $expectedDate ?></span>
                                                            </div>
                                                        </div>
</div>

                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-borderless align-middle mb-0">
                                                            <thead>
                                                                <tr class="small text-muted border-bottom">
                                                                    <th class="pb-2">Sản phẩm</th>
                                                                    <th class="text-center pb-2">SL</th>
                                                                    <th class="text-end pb-2">Đơn giá</th>
                                                                    <th class="text-center pb-2">Hành động</th>
                                                                    <th class="text-end pb-2">Thành tiền</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($details as $item): 
                                                                    $book_id = $item['book_id'] ?? $item['product_id']; 
                                                                    $isReviewed = $orderModel->checkProductReviewed($book_id, $order['id']);
                                                                ?>
                                                                <tr>
                                                                    <td class="py-3">
                                                                        <div class="d-flex align-items-center">
                                                                            <?php $productImage = !empty($item['image']) ? $item['image'] : 'no-image-book.png'; ?>
                                                                            <img src="<?= BASE_ASSETS_UPLOADS . 'img/' . $productImage ?>" width="45" height="65" class="rounded shadow-sm me-3" style="object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Book'">
                                                                            <span class="small fw-bold text-dark"><?= htmlspecialchars($item['product_name'] ?? 'Sản phẩm') ?></span>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center small text-muted">x<?= htmlspecialchars($item['quantity'] ?? 0) ?></td>
                                                                    <td class="text-end small"><?= number_format($item['price'] ?? 0) ?>đ</td>
                                                                    <td class="text-center">
                                                                        <?php
                                                                            $orderStatus = mb_strtolower(trim($order['status'] ?? 'pending'));
                                                                            $canReview = in_array($orderStatus, ['completed', 'delivered', 'đã hoàn thành'], true);
                                                                        ?>
                                                                        <?php if ($canReview): ?>
                                                                            <?php if (!$isReviewed): ?>
                                                                                <button class="btn btn-sm btn-dark px-3 rounded-pill shadow-sm" style="font-size: 11px;" data-bs-toggle="modal" data-bs-target="#reviewModal-<?= $book_id ?>-<?= $order['id'] ?>">
                                                                                    Viết đánh giá
                                                                                </button>
                                                                            <?php else: ?>
                                                                                <span class="badge bg-light text-success border border-success px-3 py-2 rounded-pill" style="font-size: 10px;">
                                                                                    <i class="fas fa-check-circle me-1"></i>Đã đánh giá
                                                                                </span>
                                                                            <?php endif; ?>
                                                                        <?php else: ?>
                                                                            <span class="badge bg-secondary text-white px-3 py-2 rounded-pill" style="font-size: 10px;">
                                                                                Chỉ đánh giá khi đơn hàng hoàn thành
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td class="text-end small fw-bold text-dark"><?= number_format($item['price'] * $item['quantity']) ?>đ</td>
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
                            </div>
                        </div>
                    </div> </div> </div>
        </div>
    </div>
</div>

<?php foreach ($orders as $order): 
    $details = $orderModel->getOrderDetails($order['id']);
    foreach ($details as $item): 
        $book_id = $item['book_id'] ?? $item['product_id'];
        $isReviewed = $orderModel->checkProductReviewed($book_id, $order['id']);
        if (!$isReviewed): 
?>
<div class="modal fade review-modal" id="reviewModal-<?= $book_id ?>-<?= $order['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?= BASE_URL ?>?action=post-review" method="POST" class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-dark text-white border-0 py-3">
                <h6 class="modal-title fw-bold">Đánh giá sản phẩm</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
<div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3">
                    <?php $reviewImage = !empty($item['image']) ? $item['image'] : 'no-image-book.png'; ?>
                    <img src="<?= BASE_ASSETS_UPLOADS . 'img/' . $reviewImage ?>" width="50" height="70" class="rounded shadow-sm me-3" style="object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Book'">
                    <div>
                        <h6 class="mb-1 fw-bold text-dark"><?= htmlspecialchars($item['product_name'] ?? 'Sản phẩm') ?></h6>
                        <small class="text-muted">Đơn hàng #<?= $order['id'] ?></small>
                    </div>
                </div>

                <input type="hidden" name="product_id" value="<?= $book_id ?>">
                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                
                <div class="text-center mb-4">
                    <label class="d-block mb-3 fw-bold">Bạn chấm mấy sao cho cuốn sách này?</label>
                    <div class="star-rating fs-2">
                        <input type="radio" id="s5-<?= $book_id ?>-<?= $order['id'] ?>" name="rating" value="5" required/><label for="s5-<?= $book_id ?>-<?= $order['id'] ?>" class="fas fa-star"></label>
                        <input type="radio" id="s4-<?= $book_id ?>-<?= $order['id'] ?>" name="rating" value="4"/><label for="s4-<?= $book_id ?>-<?= $order['id'] ?>" class="fas fa-star"></label>
                        <input type="radio" id="s3-<?= $book_id ?>-<?= $order['id'] ?>" name="rating" value="3"/><label for="s3-<?= $book_id ?>-<?= $order['id'] ?>" class="fas fa-star"></label>
                        <input type="radio" id="s2-<?= $book_id ?>-<?= $order['id'] ?>" name="rating" value="2"/><label for="s2-<?= $book_id ?>-<?= $order['id'] ?>" class="fas fa-star"></label>
                        <input type="radio" id="s1-<?= $book_id ?>-<?= $order['id'] ?>" name="rating" value="1"/><label for="s1-<?= $book_id ?>-<?= $order['id'] ?>" class="fas fa-star"></label>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label fw-bold small">Chia sẻ cảm nhận của bạn</label>
                    <textarea name="comment" class="form-control rounded-3 border-2" rows="4" placeholder="Ví dụ: Sách đóng gói đẹp, nội dung rất hay..."></textarea>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0">
                <button type="button" class="btn btn-light fw-bold px-4 rounded-3" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-dark fw-bold px-4 rounded-3 shadow">Gửi đánh giá ngay</button>
            </div>
        </form>
    </div>
</div>
<?php endif; endforeach; endforeach; ?>
</body>
</html>