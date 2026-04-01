<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold text-dark mb-1">Bảng Điều Khiển Hệ Thống</h2>
            <p class="text-muted mb-0">Chào mừng trở lại, quản trị viên Book Verse!</p>
        </div>
        <span class="badge bg-light text-dark border px-3 py-2">
            <i class="bi bi-calendar3 me-2"></i><?= date('d/m/Y') ?>
        </span>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 bg-primary text-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1 opacity-75">Sản phẩm</p>
                            <h3 class="fw-bold mb-0">124</h3>
                        </div>
                        <i class="bi bi-book fs-1 opacity-50"></i>
                    </div>
                </div>
                <a href="?action=admin/product" class="card-footer bg-white text-primary border-0 py-2 small text-center text-decoration-none">
                    Xem chi tiết <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 bg-success text-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1 opacity-75">Danh mục</p>
                            <h3 class="fw-bold mb-0">12</h3>
                        </div>
                        <i class="bi bi-tags fs-1 opacity-50"></i>
                    </div>
                </div>
                <a href="?action=admin/category" class="card-footer bg-white text-success border-0 py-2 small text-center text-decoration-none">
                    Quản lý loại <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 bg-warning text-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1 opacity-75">Đơn hàng mới</p>
                            <h3 class="fw-bold mb-0">08</h3>
                        </div>
                        <i class="bi bi-cart-check fs-1 opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer bg-white text-warning border-0 py-2 small text-center">
                    Cần xử lý ngay
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 bg-danger text-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1 opacity-75">Khách hàng</p>
                            <h3 class="fw-bold mb-0">520</h3>
                        </div>
                        <i class="bi bi-people fs-1 opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer bg-white text-danger border-0 py-2 small text-center">
                    Tăng 12% tháng này
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mt-5">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-dark">Ghi chú quản trị</h5>
        </div>
        <div class="card-body py-5 text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" width="80" class="mb-3 opacity-25">
            <p class="text-muted">Hệ thống đang hoạt động ổn định. Chưa có thông báo mới.</p>
        </div>
    </div>
</div>