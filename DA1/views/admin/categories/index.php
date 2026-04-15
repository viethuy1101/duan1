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
        .card-custom { border: none; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
        
        /* Table Styling */
        .table thead th { 
            background-color: #ffffff; 
            font-size: 11px; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            color: #94a3b8; 
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
        }
        .table tbody td { padding: 18px 20px; border-bottom: 1px solid #f8fafc; }
        .table tbody tr:hover { background-color: #fbfcfd; }

        /* Badge Styling */
        .cat-id-badge { 
            background: #f0f3ff; 
            color: #4f46e5; 
            font-weight: 700; 
            padding: 5px 12px; 
            border-radius: 6px; 
            font-size: 11px; 
        }
        .book-count-badge {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 11px;
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* Status Badge */
        .status-active { background-color: #ecfdf5; color: #10b981; }
        .status-inactive { background-color: #fef2f2; color: #ef4444; }

        /* Action Buttons */
        .btn-action { 
            width: 34px; 
            height: 34px; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 8px; 
            transition: 0.2s; 
            border: 1px solid #f1f5f9;
            background: #ffffff;
        }
        .btn-edit { color: #3b82f6; }
        .btn-edit:hover { background: #eff6ff; border-color: #dbeafe; }
        .btn-delete { color: #f87171; }
        .btn-delete:hover { background: #fef2f2; border-color: #fee2e2; }

        /* Add Button - Chuẩn màu xanh lá của m */
        .btn-add-custom {
            background-color: #108548;
            color: #ffffff;
            border-radius: 50px;
            padding: 10px 24px;
            font-weight: 500;
            font-size: 14px;
            border: none;
            transition: 0.3s;
        }
        .btn-add-custom:hover {
            background-color: #0d6e3c;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 133, 72, 0.2);
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="container-fluid py-5 px-4">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Cấu hình Danh Mục</h2>
            <p class="text-muted small mb-0">Quản lý và phân loại các đầu sách trong hệ thống</p>
        </div>
        <a href="?action=admin/category/create" class="btn btn-add-custom shadow-sm">
            <i class="bi bi-plus-circle me-2"></i> Thêm Danh Mục Mới
        </a>
    </div>

    <div class="card card-custom">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="180px">Mã định danh</th>
                            <th>Tên danh mục</th>
                            <th class="text-center">Số lượng sách</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-end pe-5">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td class="ps-4">
                                <span class="cat-id-badge">CAT-<?= $cat['id'] ?></span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark mb-0"><?= $cat['name'] ?></div>
                                <div class="text-muted" style="font-size: 11px;">ID Hệ thống: #<?= $cat['id'] ?></div>
                            </td>
                            <td class="text-center">
                                <div class="book-count-badge d-inline-flex align-items-center">
                                    <i class="bi bi-book-half me-2 opacity-50"></i> <?= $cat['total_books'] ?? 0 ?> cuốn
                                </div>
                            </td>
                            <td class="text-center">
                                <?php if (($cat['status'] ?? 1) == 1): ?>
                                    <span class="badge status-active px-3 py-2 rounded-pill fw-medium" style="font-size: 10px;">
                                        <i class="bi bi-dot fs-5 align-middle"></i> Đang hoạt động
                                    </span>
                                <?php else: ?>
                                    <span class="badge status-inactive px-3 py-2 rounded-pill fw-medium" style="font-size: 10px;">
                                        <i class="bi bi-dot fs-5 align-middle"></i> Tạm ngưng
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="pe-5 text-end">
                                <a href="?action=admin/category/edit&id=<?= $cat['id'] ?>" 
                                   class="btn-action btn-edit me-2" 
                                   title="Chỉnh sửa">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="?action=admin/category/delete&id=<?= $cat['id'] ?>" 
                                   class="btn-action btn-delete"
                                   onclick="return confirm('Cảnh báo: Xóa danh mục này có thể ảnh hưởng đến các sách liên quan!')"
                                   title="Xóa">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-white py-4 border-0 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted small">Hiển thị tất cả <strong><?= count($categories) ?></strong> danh mục hiện có</span>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link border-0 bg-light rounded-start-pill px-3" href="#">Trước</a></li>
                        <li class="page-item active"><a class="page-link border-0 px-3" href="#" style="background-color: #3b82f6;">1</a></li>
                        <li class="page-item"><a class="page-link border-0 bg-light rounded-end-pill px-3" href="#">Sau</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

</body>
</html>