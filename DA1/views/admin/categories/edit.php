<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid mt-4">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 600px;">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="mb-0 fw-bold text-primary">
                <i class="bi bi-pencil-fill me-2"></i>Cập nhật danh mục
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="?action=admin/category/update&id=<?= $category['id'] ?>" method="POST">
                <div class="mb-4">
                    <label class="form-label fw-bold small text-muted text-uppercase">Tên danh mục</label>
                    <input type="text" name="name" class="form-control form-control-lg border-2" 
                           value="<?= $category['name'] ?>" required>
                </div>

                <div class="row g-2 mt-4">
                    <div class="col-8">
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                            Xác nhận thay đổi
                        </button>
                    </div>
                    <div class="col-4">
                        <a href="?action=admin/category" class="btn btn-light border w-100 py-2 text-muted">
                            Hủy
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>