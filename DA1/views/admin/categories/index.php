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
        :root {
            --primary-color: #4f46e5;
            --success-color: #10b981;
            --bg-body: #f8fafc;
        }

        body { 
            background-color: var(--bg-body); 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: #1e293b;
        }

        /* Đồng bộ Header Box giống Dashboard */
        .vip-header-box {
            background: #ffffff;
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        /* Đồng bộ Card Table */
        .card-custom { 
            border: none; 
            border-radius: 24px; 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04); 
            background: #ffffff;
            overflow: hidden;
        }

        /* Table Styling VIP */
        .table thead th { 
            background-color: #fcfcfd; 
            font-size: 11px; 
            text-transform: uppercase; 
            font-weight: 700;
            color: #64748b; 
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody td { 
            padding: 20px 24px; 
            border-bottom: 1px solid #f8fafc; 
            font-size: 14px;
        }

        .table tbody tr:hover { background-color: #f8faff; }

        /* Badge ID chuẩn màu Indigo của m */
        .cat-id-badge { 
            background: #eef2ff; 
            color: #4338ca; 
            font-weight: 800; 
            padding: 6px 14px; 
            border-radius: 10px; 
            font-size: 11px; 
            border: 1px solid #e0e7ff;
        }

        /* Badge Số lượng */
        .book-count-badge {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #475569;
            font-size: 12px;
            padding: 6px 14px;
            border-radius: 12px;
            font-weight: 600;
        }

        /* Status Badge đồng bộ */
        .status-pill {
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-active { background: #dcfce7; color: #15803d; }
        .status-inactive { background: #fee2e2; color: #b91c1c; }

        /* Nút thao tác hiện đại */
        .btn-action { 
            width: 38px; 
            height: 38px; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 12px; 
            transition: 0.3s; 
            border: 1px solid #f1f5f9;
            background: #ffffff;
            text-decoration: none;
        }
        .btn-edit { color: #4f46e5; }
        .btn-edit:hover { background: #4f46e5; color: white; border-color: #4f46e5; transform: translateY(-2px); }
        .btn-delete { color: #ef4444; }
        .btn-delete:hover { background: #ef4444; color: white; border-color: #ef4444; transform: translateY(-2px); }

        /* Nút thêm mới chuẩn Gradient mượt */
        .btn-add-vip {
            background: linear-gradient(135deg, #4f46e5 0%, #764ba2 100%);
            color: #ffffff;
            border-radius: 16px;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }
        .btn-add-vip:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
            filter: brightness(1.1);
        }
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
            <a href="?action=admin/category/create" class="btn btn-add-vip">
                <i class="bi bi-plus-lg me-2"></i> Thêm Danh Mục
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
                        <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td class="ps-5">
                                <span class="cat-id-badge">ID-<?= $cat['id'] ?></span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark mb-0 fs-6"><?= $cat['name'] ?></div>
                                <div class="text-muted" style="font-size: 11px;">Hệ thống BookVerse</div>
                            </td>
                            <td class="text-center">
                                <div class="book-count-badge d-inline-flex align-items-center">
                                    <i class="bi bi-collection-play me-2 text-primary"></i> 
                                    <?= $cat['total_books'] ?? 0 ?> sản phẩm
                                </div>
                            </td>
                            <td class="text-center">
                                <?php if (($cat['status'] ?? 1) == 1): ?>
                                    <span class="status-pill status-active">
                                        <i class="bi bi-check-circle-fill"></i> Hiển thị
                                    </span>
                                <?php else: ?>
                                    <span class="status-pill status-inactive">
                                        <i class="bi bi-dash-circle-fill"></i> Đang ẩn
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="pe-5 text-end">
                                <a href="?action=admin/category/edit&id=<?= $cat['id'] ?>" 
                                   class="btn-action btn-edit me-2" title="Sửa">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="?action=admin/category/delete&id=<?= $cat['id'] ?>" 
                                   class="btn-action btn-delete"
                                   onclick="return confirm('Xác nhận xóa danh mục này?')" title="Xóa">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-white py-4 border-0 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted small font-weight-bold">
                    Tổng số: <span class="text-dark fw-bold"><?= count($categories) ?></span> danh mục
                </span>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item"><a class="page-link border-0 bg-light rounded-3 px-3 me-2 text-dark" href="#">Trước</a></li>
                        <li class="page-item active"><a class="page-link border-0 rounded-3 px-3 me-2 shadow-sm" href="#" style="background: #4f46e5;">1</a></li>
                        <li class="page-item"><a class="page-link border-0 bg-light rounded-3 px-3 text-dark" href="#">Sau</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

</body>
</html>