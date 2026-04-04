<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Kho Sách</title>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">Quản Lý Kho Sách</h3>
                <p class="text-muted small mb-0">Hiển thị danh sách sách hiện có trong hệ thống</p>
            </div>
            <a href="?action=admin/product/create" class="btn btn-primary rounded-pill px-4 shadow">
                <i class="bi bi-plus-circle-fill me-2"></i>Thêm Sản Phẩm Mới
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 border-0 text-uppercase small fw-bold text-muted" style="width: 80px;">ID</th>
                                <th class="py-3 border-0 text-uppercase small fw-bold text-muted">Thông tin sách</th>
                                <th class="py-3 border-0 text-uppercase small fw-bold text-muted text-center" style="width: 150px;">Giá bán</th>
                                <th class="py-3 border-0 text-uppercase small fw-bold text-muted text-center" style="width: 150px;">Tồn kho</th>
                                <th class="pe-4 py-3 border-0 text-uppercase small fw-bold text-muted text-end" style="width: 120px;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $p): ?>
                            <tr>
                                <td class="ps-4 text-muted fw-medium">#<?= $p['id'] ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 shadow-sm border overflow-hidden me-3" style="width: 50px; height: 70px;">
                                            <img src="assets/uploads/img/<?= $p['image'] ?>" 
     onerror="this.src='https://via.placeholder.com/50x70?text=No+Image'"
     class="w-100 h-100" style="object-fit: cover;">
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark mb-0"><?= $p['title'] ?></div>
                                            <div class="text-muted small italic"><?= $p['author'] ?? 'Chưa rõ tác giả' ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="text-danger fw-bold"><?= number_format($p['price']) ?>đ</span>
                                </td>
                                <td class="text-center">
                                    <?php if($p['stock'] <= 5): ?>
                                        <span class="badge rounded-pill bg-danger-subtle text-danger px-3">Sắp hết: <?= $p['stock'] ?></span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill bg-success-subtle text-success px-3"><?= $p['stock'] ?> cuốn</span>
                                    <?php endif; ?>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="?action=admin/product/edit&id=<?= $p['id'] ?>" 
                                           class="btn btn-sm btn-light border shadow-sm text-warning" title="Sửa">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="?action=admin/product/delete&id=<?= $p['id'] ?>" 
                                           class="btn btn-sm btn-light border shadow-sm text-danger" 
                                           onclick="return confirm('Xóa cuốn này không m?')" title="Xóa">
                                            <i class="bi bi-trash3-fill"></i>
                                        </a>
                                    </div>
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