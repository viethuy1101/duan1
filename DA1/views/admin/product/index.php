<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">Quản Lý Kho Sách</h3>
        <a href="?action=admin/product/create" class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>Thêm Sản Phẩm
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 border-0">ID</th>
                            <th class="py-3 border-0">Thông tin sách</th>
                            <th class="py-3 border-0">Giá bán</th>
                            <th class="py-3 border-0">Tồn kho</th>
                            <th class="pe-4 py-3 border-0 text-end">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $p): ?>
                        <tr>
                            <td class="ps-4 text-muted">#<?= $p['id'] ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="ms-2">
                                        <div class="fw-bold text-dark"><?= $p['title'] ?></div>
                                        <small class="text-muted"><?= $p['author'] ?? 'Chưa có tác giả' ?></small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-danger-subtle text-danger px-3 py-2 fw-bold"><?= number_format($p['price']) ?>đ</span></td>
                            <td>
                                <span class="badge bg-info-subtle text-info px-3 py-2 fw-bold"><?= $p['stock'] ?> cuốn</span>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="?action=admin/product/edit&id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-warning border-0 mx-1">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="?action=admin/product/delete&id=<?= $p['id'] ?>" 
                                   class="btn btn-sm btn-outline-danger border-0 mx-1"
                                   onclick="return confirm('Xóa cuốn này không m?')">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>