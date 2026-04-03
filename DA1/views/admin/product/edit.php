<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid mt-4">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 800px;">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="mb-0 fw-bold text-primary">
                <i class="bi bi-pencil-square me-2"></i>Chỉnh sửa sản phẩm
            </h5>
        </div>
        <div class="card-body p-4">
            <<form action="?action=admin/product/update" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    
    <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold small text-muted text-uppercase">Tên sách</label>
                        <input type="text" name="title" class="form-control form-control-lg" value="<?= $product['title'] ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted text-uppercase">Giá bán (đ)</label>
                        <input type="number" name="price" class="form-control form-control-lg text-danger fw-bold" value="<?= $product['price'] ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted text-uppercase">Tác giả</label>
                        <input type="text" name="author" class="form-control" value="<?= $product['author'] ?>">
                    </div>

                    <div class="col-md-6">
    <label class="form-label fw-bold small text-muted text-uppercase">Số lượng kho</label>
    <input type="number" name="stock" class="form-control" value="<?= $product['stock'] ?? 0 ?>">
</div>

                    <div class="col-12">
                        <label class="form-label fw-bold small text-muted text-uppercase">Đường dẫn ảnh</label>
                        <input type="text" name="image" class="form-control" value="<?= $product['image'] ?>">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold small text-muted text-uppercase">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="4"><?= $product['description'] ?></textarea>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-5 shadow-sm">Lưu thay đổi</button>
                    <a href="?action=admin/product" class="btn btn-light border px-4">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>