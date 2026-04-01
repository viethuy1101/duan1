<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?action=admin/product">Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
        </ol>
    </nav>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-plus-square me-2"></i>Thêm Sản Phẩm Mới</h5>
        </div>
        <div class="card-body p-4">
            <form action="?action=admin/product/store" method="POST" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Tên sách</label>
                        <input type="text" name="title" class="form-control" placeholder="Nhập tên sách..." required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Giá bán (VNĐ)</label>
                        <div class="input-group">
                            <input type="number" name="price" class="form-control text-danger fw-bold" required>
                            <span class="input-group-text">đ</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tác giả</label>
                        <input type="text" name="author" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Số lượng tồn kho</label>
                        <input type="number" name="stock" class="form-control" value="0">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Đường dẫn ảnh</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-image"></i></span>
                            <input type="text" name="image" class="form-control" placeholder="assets/images/book1.jpg">
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Nhập nội dung tóm tắt sách..."></textarea>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                    <a href="?action=admin/product" class="btn btn-outline-secondary px-4">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary px-5 shadow-sm">
                        <i class="bi bi-save me-2"></i>Lưu sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>