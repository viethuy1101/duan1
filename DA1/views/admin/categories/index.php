<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Danh Mục - BookVerse Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary-color: #4f46e5; --bg-body: #f8fafc; }
        body { background-color: var(--bg-body); font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; }
        .vip-header-box { background: #ffffff; border-radius: 24px; padding: 30px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); margin-bottom: 30px; border: 1px solid rgba(255, 255, 255, 0.8); }
        .card-custom { border: none; border-radius: 24px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04); background: #ffffff; overflow: hidden; }
        .table thead th { background-color: #fcfcfd; font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b; padding: 20px 24px; border-bottom: 1px solid #f1f5f9; }
        .table tbody td { padding: 20px 24px; border-bottom: 1px solid #f8fafc; font-size: 14px; }
        .cat-id-badge { background: #eef2ff; color: #4338ca; font-weight: 800; padding: 6px 14px; border-radius: 10px; font-size: 11px; border: 1px solid #e0e7ff; }
        .status-pill { padding: 6px 16px; border-radius: 50px; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; }
        .status-active { background: #dcfce7; color: #15803d; }
        .status-inactive { background: #fee2e2; color: #b91c1c; }
        .btn-action { width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center; border-radius: 12px; transition: 0.3s; border: 1px solid #f1f5f9; background: #ffffff; text-decoration: none; }
        .btn-edit { color: #4f46e5; }
        .btn-edit:hover { background: #4f46e5; color: white; transform: translateY(-2px); }
        .btn-delete { color: #ef4444; }
        .btn-delete:hover { background: #ef4444; color: white; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="container-fluid py-5 px-lg-5">
    <div class="vip-header-box d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div>
            <h2 class="fw-bold text-dark mb-1" style="letter-spacing: -1px;">Danh Mục Sách</h2>
            <p class="text-muted small mb-0">Hệ thống phân loại dữ liệu BookVerse</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="index.php?action=admin/category/create" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Thêm Danh Mục
            </a>
        </div>
    </div>

    <div class="card card-custom">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="150px" class="ps-5">Mã ID</th>
                            <th>Thông tin danh mục</th>
                            <th class="text-center">Số lượng sách</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-end pe-5">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($categories)): ?>
                            <?php foreach ($categories as $item): ?>
                            <tr>
                                <td class="ps-5">
                                    <span class="cat-id-badge">ID-<?= $item['id'] ?></span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark mb-0 fs-6"><?= $item['category_name'] ?? $item['name'] ?></div>
                                    <div class="text-muted" style="font-size: 11px;">Hệ thống BookVerse</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                        <i class="bi bi-collection me-1 text-primary"></i> <?= $item['total_books'] ?? 0 ?> sản phẩm
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if (($item['status'] ?? 1) == 1): ?>
                                        <span class="status-pill status-active"><i class="bi bi-check-circle-fill"></i> Hiển thị</span>
                                    <?php else: ?>
                                        <span class="status-pill status-inactive"><i class="bi bi-dash-circle-fill"></i> Đang ẩn</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-5">
                                    <a href="index.php?action=admin/category/edit&id=<?= $item['id'] ?>" class="btn-action btn-edit me-2">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="index.php?action=admin/category/delete&id=<?= $item['id'] ?>" 
                                       class="btn-action btn-delete" 
                                       onclick="return confirm('M chắc chắn muốn xóa danh mục này không?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-5 text-muted">Chưa có danh mục nào.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>