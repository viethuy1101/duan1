<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Danh Mục - Book Verse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
        .card-custom { border: none; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .table thead { background-color: #f1f5f9; }
        .table thead th { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #64748b; padding: 15px 20px; }
        .table tbody tr { transition: all 0.3s ease; }
        .table tbody tr:hover { background-color: #f8fafc; transform: scale(1.002); }
        .cat-id-badge { background: #e0e7ff; color: #4338ca; font-weight: 700; padding: 6px 12px; border-radius: 8px; font-size: 13px; }
        .btn-action { width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; transition: 0.2s; }
        .btn-add { background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 12px; transition: 0.3s; }
        .btn-add:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
    </style>
</head>
<body>

<div class="container-fluid py-5 px-4">
   <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">Cấu hình Danh Mục</h2>
        <p class="text-muted small">Quản lý và phân loại các đầu sách trong hệ thống</p>
    </div>
    <a href="?action=admin/category/create" class="btn btn-success rounded-pill px-4">
        <i class="bi bi-plus-circle me-2"></i> Thêm Danh Mục Mới
    </a>
</div>

    <div class="row">
        <div class="col-12">
            <div class="card card-custom overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="150px">Mã định danh</th>
                                    <th>Tên danh mục</th>
                                    <th class="text-center">Số lượng sách</th>
                                    <th>Trạng thái</th>
                                    <th class="text-end pe-4">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $cat): ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="cat-id-badge">CAT-<?= $cat['id'] ?></span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark fs-6"><?= $cat['name'] ?></div>
                                        <small class="text-muted">ID Hệ thống: #<?= $cat['id'] ?></small>
                                    </td>
                                    <td class="text-center">
                                        <div class="badge bg-light text-dark border rounded-pill px-3 fw-normal">
                                            <i class="bi bi-book me-1 text-primary"></i> <?= $cat['total_books'] ?? 0 ?> cuốn
                                        </div>
                                    </td>
                                    <td>
                                        <?php if (($cat['status'] ?? 1) == 1): ?>
                                      <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill" style="font-size: 11px;">
                                         <i class="bi bi-check-circle-fill me-1"></i> Đang hoạt động
                                       </span>
                                        <?php else: ?>
                                         <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill" style="font-size: 11px;">
                                        <i class="bi bi-x-circle-fill me-1"></i> Tạm ngưng
                                        </span>
                                     <?php endif; ?>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <a href="?action=admin/category/edit&id=<?= $cat['id'] ?>" 
                                           class="btn-action bg-primary-subtle text-primary border-0 me-2" 
                                           title="Chỉnh sửa">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="?action=admin/category/delete&id=<?= $cat['id'] ?>" 
                                           class="btn-action bg-danger-subtle text-danger border-0"
                                           onclick="return confirm('Cảnh báo: Xóa danh mục này có thể ảnh hưởng đến các sách liên quan!')"
                                           title="Xóa mục này">
                                            <i class="bi bi-trash3-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white py-3 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Hiển thị tất cả <?= count($categories) ?> danh mục hiện có</span>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled"><a class="page-link" href="#">Trước</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">Sau</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>