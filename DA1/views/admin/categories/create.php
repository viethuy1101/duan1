<style>
    /* CSS tinh chỉnh để Form không bị giật và trông chuyên nghiệp hơn */
    .card-custom { border: none !important; box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important; border-radius: 20px !important; overflow: hidden; }
    .form-control, .form-select { border-radius: 10px !important; border: 1px solid #e0e6ed !important; padding: 12px 15px !important; transition: 0.3s; }
    .form-control:focus { border-color: #3b82f6 !important; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important; }
    .btn-submit { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); border: none; border-radius: 12px; padding: 15px; font-weight: 700; letter-spacing: 1px; transition: 0.3s; }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(30, 58, 138, 0.3); color: white; }
    .label-custom { font-size: 0.75rem; color: #64748b; letter-spacing: 0.5px; margin-bottom: 8px; }
</style>

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            
            <div class="card card-custom">
                <div class="card-header text-center py-5 text-white" 
                     style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">
                    <div class="mb-3 d-inline-flex align-items-center justify-content-center bg-white bg-opacity-20 rounded-circle" style="width: 70px; height: 70px;">
                        <i class="bi bi-folder-plus" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="fw-bold mb-1">KIẾN TẠO DANH MỤC</h3>
                    <p class="opacity-75 small mb-0">Phân loại sách giúp người dùng dễ dàng tìm kiếm</p>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    <?php if (!empty($_SESSION['error'])): ?>
                        <div class="alert alert-danger mb-4">
                            <?= htmlspecialchars($_SESSION['error']) ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <form action="<?= BASE_URL ?>?action=admin/category/store" method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-bold label-custom text-uppercase">Tên danh mục sách</label>
                            <input type="text" name="name" class="form-control" placeholder="Ví dụ: Công nghệ thông tin, Văn học..." required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold label-custom text-uppercase">Mô tả ngắn</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Ghi chú tóm tắt về loại danh mục này..."></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold label-custom text-uppercase">Trạng thái</label>
                                <select name="status" class="form-select">
                                    <option value="1" selected>Đang hoạt động</option>
                                    <option value="0">Tạm ngưng</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold label-custom text-uppercase">Thứ tự hiển thị</label>
                                <input type="number" name="sort_order" class="form-control" value="0">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-submit text-white w-100 mb-3">
                                <i class="bi bi-cloud-check me-2"></i>XÁC NHẬN LƯU VÀO HỆ THỐNG
                            </button>
                            <a href="<?= BASE_URL ?>admin/category" class="btn btn-light w-100 py-3 fw-bold text-muted border-0" style="border-radius: 12px;">HỦY BỎ</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <span class="badge bg-white text-dark shadow-sm border py-2 px-3 rounded-pill fw-normal">
                    <i class="bi bi-clock-history me-1 text-primary"></i> Phiên làm việc: <strong><?= date('H:i') ?></strong>
                </span>
            </div>
        </div>
    </div>
</div>