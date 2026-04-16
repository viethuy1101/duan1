<style>
        .form-label { font-weight: 600; color: #64748b; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 8px; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 24px; background: #fff; }
        .form-control, .form-select { border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px; transition: 0.2s; }
        .form-control:focus { border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
        
        /* Cột ảnh sản phẩm */
        .img-preview-container { border: 2px dashed #e2e8f0; border-radius: 12px; padding: 20px; text-align: center; background: #f8fafc; }
        .img-preview { width: 100%; max-height: 300px; object-fit: contain; border-radius: 8px; margin-bottom: 15px; }

        /* Biến thể Table */
        .variant-row { transition: 0.2s; }
        .variant-row:hover { background-color: #f8fafc; }
        .variant-input { border-color: transparent !important; background: transparent !important; font-weight: 600; }
        .variant-input:focus { background: #fff !important; border-color: #3b82f6 !important; }

        /* Nút lưu chính - màu xanh của m */
        .btn-save-main { background-color: #3b82f6; color: #fff; padding: 12px 30px; border-radius: 50px; font-weight: 600; border: none; transition: 0.3s; }
        .btn-save-main:hover { background-color: #2563eb; transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3); }
        
        /* Badge biến thể */
        .badge-variant-count { background: #eff6ff; color: #3b82f6; font-size: 12px; padding: 4px 12px; border-radius: 20px; }
    </style>

<form action="?action=admin/product/update&id=<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product['id'] ?>"> 
    <div class="container-fluid py-4 px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="?action=admin/product" class="text-decoration-none">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa</li>
                    </ol>
                </nav>
                <h3 class="fw-bold m-0">Sửa thông tin: <span class="text-primary"><?= $product['title'] ?></span></h3>
            </div>
            <div class="d-flex gap-2">
                <a href="?action=admin/product" class="btn btn-outline-secondary rounded-pill px-4">Quay lại</a>
                <button type="submit" class="btn btn-save-main">Lưu thay đổi</button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card card-custom p-4">
                    <h5 class="fw-bold mb-4">Thông tin cơ bản</h5>
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" name="title" class="form-control" value="<?= $product['title'] ?>" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Danh mục</label>
                            <select name="category_id" class="form-select">
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= $product['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                                        <?= $cat['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Giá gốc (VNĐ)</label>
                            <input type="number" name="price" class="form-control" value="<?= $product['price'] ?>" required>
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="6"><?= $product['description'] ?></textarea>
                    </div>
                </div>

                <div class="card card-custom overflow-hidden">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0">
                        <h5 class="fw-bold m-0">Biến thể sản phẩm</h5>
                        <span class="badge-variant-count"><?= count($variants) ?> Phiên bản</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle">
                            <thead class="bg-light">
                                <tr class="text-muted small">
                                    <th class="ps-4">TÊN LOẠI (Vd: Bìa cứng)</th>
                                    <th class="text-center">GIÁ BÁN</th>
                                    <th class="text-center">KHO</th>
                                    <th class="text-end pe-4">XÓA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($variants as $v): ?>
                                <tr class="variant-row">
                                    <td class="ps-4">
                                        <input type="hidden" name="variant_id[]" value="<?= $v['id'] ?>">
                                        <input type="text" name="variant_name[]" class="form-control variant-input" value="<?= $v['variant_name'] ?>" readonly>
                                    </td>
                                    <td class="text-center" style="width: 180px;">
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="variant_price[]" class="form-control text-center fw-bold text-danger" value="<?= $v['price'] ?>">
                                            <span class="input-group-text bg-white border-start-0 text-muted">đ</span>
                                        </div>
                                    </td>
                                    <td class="text-center" style="width: 120px;">
                                        <input type="number" name="variant_stock[]" class="form-control form-control-sm text-center" value="<?= $v['stock'] ?>">
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="?action=admin/product/delete-variant&id=<?= $v['id'] ?>" class="text-danger opacity-50 hover-opacity-100" onclick="return confirm('Xóa biến thể này?')">
                                            <i class="bi bi-x-circle-fill fs-5"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3 border-top bg-light/30">
                        <div class="row g-2">
                            <div class="col-md-5">
                                <input type="text" name="new_variant_name" class="form-control form-control-sm" placeholder="Tên biến thể mới...">
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="new_variant_price" class="form-control form-control-sm" placeholder="Giá">
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="new_variant_stock" class="form-control form-control-sm" placeholder="Kho">
                            </div>
                            <div class="col-md-2 text-end">
                                <button type="submit" class="btn btn-dark btn-sm w-100 rounded-pill">Thêm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-custom p-4">
                    <label class="form-label d-block mb-3 text-center">Ảnh đại diện</label>
                    <div class="img-preview-container">
                        <img src="<?= BASE_URL ?>assets/uploads/img/<?= htmlspecialchars($product['image'] ?? 'no-image-book.png') ?>" class="img-preview" id="preview" onerror="this.src='<?= BASE_URL ?>assets/uploads/img/no-image-book.png'">
                        <input type="hidden" name="current_image" value="<?= htmlspecialchars($product['image']) ?>">
                        <input type="file" name="image_upload" class="form-control mt-3" onchange="previewImage(this)">
                        <p class="text-muted small mt-2 m-0">Click để thay đổi hình ảnh (JPG, PNG)</p>
                    </div>
                </div>

                <div class="card card-custom p-4">
                    <h5 class="fw-bold mb-3">Kho hàng tổng</h5>
                    <div class="mb-3">
                        <label class="form-label text-dark">Tổng tồn kho</label>
                        <input type="number" name="stock" class="form-control fw-bold" value="<?= $product['stock'] ?? 0 ?>" readonly>
                        <small class="text-muted mt-2 d-block">Hệ thống sẽ tự động cập nhật khi m sửa biến thể.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>