<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới sản phẩm</title>
</head>
<body>
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
                <div class="row g-3 mb-4">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Tên sách</label>
                        <input type="text" name="title" class="form-control" placeholder="Nhập tên sách..." required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Giá bán gốc (VNĐ)</label>
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
                        <label class="form-label fw-bold">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Ảnh sản phẩm</label>
                        <input type="file" name="image_upload" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Nhập nội dung tóm tắt sách..."></textarea>
                    </div>
                </div>

                <div class="card border-0 bg-light mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3"><i class="bi bi-layers me-2"></i>Biến thể sản phẩm (Tùy chọn)</h6>
                        <div id="variant-container">
                            <div class="row g-2 mb-2 variant-item">
                                <div class="col-md-5">
                                    <input type="text" name="variant_names[]" class="form-control form-control-sm" placeholder="Tên biến thể (Vd: Bìa cứng)">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="variant_prices[]" class="form-control form-control-sm" placeholder="Giá">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="variant_stocks[]" class="form-control form-control-sm" placeholder="Kho">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary w-100" onclick="addVariantField()">Thêm dòng</button>
                                </div>
                            </div>
                        </div>
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

<script>
function addVariantField() {
    const container = document.getElementById('variant-container');
    const div = document.createElement('div');
    div.className = 'row g-2 mb-2 variant-item';
    div.innerHTML = `
        <div class="col-md-5"><input type="text" name="variant_names[]" class="form-control form-control-sm" placeholder="Tên biến thể..."></div>
        <div class="col-md-3"><input type="number" name="variant_prices[]" class="form-control form-control-sm" placeholder="Giá"></div>
        <div class="col-md-2"><input type="number" name="variant_stocks[]" class="form-control form-control-sm" placeholder="Kho"></div>
        <div class="col-md-2"><button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="this.parentElement.parentElement.remove()">Xóa</button></div>
    `;
    container.appendChild(div);
}
</script>
</body>
</html>