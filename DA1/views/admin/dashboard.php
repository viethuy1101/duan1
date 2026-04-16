<div class="container-fluid py-4" style="background: #f8f9fa; min-height: 100vh;">
    <div class="d-flex justify-content-between align-items-center mb-4 p-4 rounded-4 bg-white shadow-sm">
        <div>
            <h2 class="fw-bold text-dark mb-1">Thống Kê Tổng Quan <span class="text-primary">BookVerse</span></h2>
            <p class="text-muted mb-0">Hệ thống đang vận hành với hiệu suất tối ưu.</p>
        </div>
        <div class="text-end">
            <div class="fw-bold fs-5"><?= date('H:i A') ?></div>
            <div class="text-muted small"><?= date('l, d/m/Y') ?></div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
        <form action="index.php" method="GET" class="row g-3 align-items-center">
            <input type="hidden" name="action" value="admin/dashboard"> 
            <div class="col-auto">
                <input type="date" name="start_date" class="form-control" value="<?= $startDate ?>">
            </div>
            <div class="col-auto">
                <input type="date" name="end_date" class="form-control" value="<?= $endDate ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Lọc dữ liệu</button>
            </div>
        </form>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="opacity-75 mb-2">Kho Sách</h6>
                            <h2 class="fw-bold mb-0"><?= number_format($totalProducts) ?></h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-journal-bookmark-fill fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #2af598 0%, #009efd 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="opacity-75 mb-2">Danh Mục</h6>
                            <h2 class="fw-bold mb-0"><?= number_format($totalCategories) ?></h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-tag fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="opacity-75 mb-2">Đơn Hàng</h6>
                            <h2 class="fw-bold mb-0"><?= $totalOrders ?></h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-cart-check-fill fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #fccb90 0%, #d57eeb 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="opacity-75 mb-2">Doanh Thu</h6>
                            <h2 class="fw-bold mb-0"><?= number_format($totalRevenue) ?>đ</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-currency-exchange fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                <h5 class="fw-bold mb-4">Sách Mới Nhất</h5>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <thead>
                            <tr class="text-muted small">
                                <th>TÊN SÁCH</th>
                                <th>THỂ LOẠI</th>
                                <th>GIÁ</th>
                                <th>TRẠNG THÁI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($newestBooks)): foreach ($newestBooks as $book): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 shadow-sm border overflow-hidden me-3" style="width: 45px; height: 60px;">
                                            <?php 
                                                $imagePath = !empty($book['image']) ? BASE_URL . "assets/uploads/img/" . htmlspecialchars($book['image']) : BASE_URL . "assets/uploads/img/no-image-book.png";
                                            ?>
                                            <img src="<?= $imagePath ?>" 
                                                 style="width: 100%; height: 100%; object-fit: cover;" 
                                                 onerror="this.src='<?= BASE_URL ?>assets/uploads/img/no-image-book.png'">
                                        </div>
                                        <div class="fw-bold text-dark"><?= $book['title'] ?></div>
                                    </div>
                                </td>
                                <td><?= $book['category_name'] ?? 'Chưa phân loại' ?></td>
                                <td class="fw-bold text-primary"><?= number_format($book['price']) ?>đ</td>
                                <td>
                                    <?php if($book['stock'] > 0): ?>
                                        <span class="badge bg-primary-subtle text-primary">Đang bán</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger">Hết hàng</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="4" class="text-center text-muted">Chưa có dữ liệu sách mới.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 p-4 h-100 text-white" style="background: #111827;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-0 text-uppercase small">Hoạt Động Hệ Thống</h5>
                        <small class="text-muted">Thời gian thực: <?= date('H:i:s') ?></small>
                    </div>
                    <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-3 py-2 small">
                        ĐANG CHẠY
                    </span>
                </div>

                <div class="p-3 rounded-4 mb-3" style="background: rgba(99, 102, 241, 0.1);">
                    <div class="small fw-bold text-muted text-uppercase mb-1" style="font-size: 10px;">Giao dịch mới</div>
                    <div class="fw-bold">Đơn hàng mới #<?= $totalOrders ?></div>
                </div>

                <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                    <h6 class="small fw-bold text-white-50 mb-3">TRẠNG THÁI TÀI NGUYÊN</h6>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2 small">
                            <span>CPU</span>
                            <span class="text-info">24%</span>
                        </div>
                        <div class="progress" style="height: 6px; background: #1f2937;">
                            <div class="progress-bar bg-info" style="width: 24%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2 small">
                            <span>RAM</span>
                            <span class="text-warning">48%</span>
                        </div>
                        <div class="progress" style="height: 6px; background: #1f2937;">
                            <div class="progress-bar bg-warning" style="width: 48%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>