<div class="container-fluid mt-4">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 600px;">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="mb-0 fw-bold text-primary">
                <i class="bi bi-plus-square-fill me-2"></i>Thêm Danh Mục Mới
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="?action=admin/category/store" method="POST">
                
                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary small text-uppercase">Tên danh mục</label>
                    <input type="text" 
                           name="name" 
                           class="form-control form-control-lg border-2" 
                           placeholder="Nhập tên danh mục tại đây..." 
                           required>
                    <div class="form-text mt-2">Ví dụ: Sách giáo khoa, Văn học nước ngoài...</div>
                </div>

                <div class="row g-2 mt-4">
                    <div class="col-8">
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                            <i class="bi bi-save2 me-2"></i>Lưu danh mục
                        </button>
                    </div>
                    <div class="col-4">
                        <a href="?action=admin/category" class="btn btn-light border w-100 py-2 text-muted">
                            Hủy bỏ
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>