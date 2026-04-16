<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý tài khoản - Book Verse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-vip: #4f46e5;
            --secondary-vip: #7c3aed;
            --bg-body: #f8fafc;
            --sidebar-bg: #1a1d20;
        }

        body { display: flex; min-height: 100vh; background-color: var(--bg-body); margin: 0; font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Sidebar Styles */
        .sidebar { width: 260px; background: var(--sidebar-bg); color: white; position: fixed; height: 100vh; padding: 25px 0; z-index: 1000; transition: all 0.3s; }
        .sidebar h2 { color: #0d6efd; font-weight: 800; text-align: center; margin-bottom: 35px; letter-spacing: 1px; }
        .sidebar a { display: block; color: #adb5bd; text-decoration: none; padding: 14px 25px; transition: 0.3s; font-size: 15px; font-weight: 500; }
        .sidebar a:hover, .sidebar a.active { background: #2b2f33; color: white; border-left: 5px solid var(--primary-vip); padding-left: 30px; }
        .sidebar i { margin-right: 10px; font-size: 1.1rem; }

        /* Main Content */
        .main-content { margin-left: 260px; flex: 1; padding: 40px; width: calc(100% - 260px); }

        /* VIP UI Components */
        .header-section {
            background: linear-gradient(135deg, var(--primary-vip) 0%, var(--secondary-vip) 100%);
            border-radius: 24px;
            padding: 40px;
            color: white;
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.15);
        }

        .action-bar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: -30px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            position: relative;
            z-index: 10;
        }

        .search-input {
            height: 48px;
            padding-left: 45px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            width: 350px;
        }

        .btn-add-vip {
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary-vip) 0%, var(--secondary-vip) 100%);
            color: white;
            font-weight: 700;
            padding: 0 25px;
            border: none;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none !important;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.25);
        }

        .glass-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(0,0,0,0.05);
            border: none;
        }

        .table thead th {
            background: #fcfcfd;
            color: #64748b;
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 800;
            padding: 20px 25px;
        }

        .avatar-wrap {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: #eef2ff;
            color: var(--primary-vip);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.1);
        }

        .badge-vip {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
        }
        .badge-admin { background: #fee2e2; color: #dc2626; }
        .badge-user { background: #e0f2fe; color: #0284c7; }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="?action=admin"><h2>BOOK VERSE</h2></a>
    
    <a href="?action=admin" class="<?= !isset($_GET['action']) || $_GET['action'] == 'admin' ? 'active' : '' ?>">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="?action=admin/product" class="<?= isset($_GET['action']) && strpos($_GET['action'], 'admin/product') !== false ? 'active' : '' ?>">
        <i class="bi bi-book"></i> Quản lý sản phẩm
    </a>
    <a href="?action=admin/category" class="<?= isset($_GET['action']) && strpos($_GET['action'], 'admin/category') !== false ? 'active' : '' ?>">
        <i class="bi bi-tags"></i> Quản lý danh mục
    </a>
    <a href="?action=admin/order" class="<?= isset($_GET['action']) && strpos($_GET['action'], 'admin/order') !== false ? 'active' : '' ?>">
        <i class="bi bi-cart"></i> Quản lý đơn hàng
    </a>
    <a href="?action=admin/users" class="<?= isset($_GET['action']) && strpos($_GET['action'], 'admin/users') !== false ? 'active' : '' ?>">
        <i class="bi bi-people-fill"></i> Quản lý tài khoản
    </a>
    <a href="?action=admin/reviews" class="<?= isset($_GET['action']) && strpos($_GET['action'], 'admin/reviews') !== false ? 'active' : '' ?>">
        <i class="bi bi-chat-left-text"></i> Quản lý đánh giá
    </a>

    <hr class="opacity-25 mx-3 my-4">
    
    <a href="index.php"><i class="bi bi-house"></i> Về Trang Chủ</a>
</div>

<div class="main-content">
    <div class="header-section">
        <h2 class="fw-bold mb-1">Quản lý tài khoản</h2>
        <p class="mb-0 opacity-75 fw-medium">Hệ thống đang vận hành với <?= count($listUsers) ?> thành viên</p>
    </div>

    <div class="action-bar">
        <form action="" method="GET" class="d-flex gap-3 flex-grow-1">
            <input type="hidden" name="action" value="admin/users">
            <div class="position-relative">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" name="search" class="search-input shadow-sm border-0" placeholder="Tìm tên hoặc email..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </div>
            <select name="role" class="form-select border-0 shadow-sm" style="width: 180px; border-radius: 14px;">
                <option value="">Tất cả vai trò</option>
                <option value="admin" <?= ($_GET['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Quản trị viên</option>
                <option value="user" <?= ($_GET['role'] ?? '') == 'user' ? 'selected' : '' ?>>Thành viên</option>
            </select>
            <button type="submit" class="btn btn-dark shadow-sm px-4" style="border-radius: 14px;">
                <i class="bi bi-funnel me-2"></i> Lọc
            </button>
        </form>

        <a href="?action=admin/user/create" class="btn-add-vip">
            <i class="bi bi-person-plus-fill fs-5"></i> <span>Tạo tài khoản</span>
        </a>
    </div>

    <div class="glass-card">
        <div class="table-responsive">
            <table class="table mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Thành viên</th>
                        <th>Email</th>
                        <th>Quyền hạn</th>
                        <th>Ngày tham gia</th>
                        <th class="text-end" style="padding-right: 40px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($listUsers) > 0): ?>
                        <?php foreach ($listUsers as $user): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted">#<?= $user['id'] ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-wrap">
                                        <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                    </div>
                                    <div class="fw-bold text-dark"><?= htmlspecialchars($user['name']) ?></div>
                                </div>
                            </td>
                            <td class="text-secondary small"><?= htmlspecialchars($user['email']) ?></td>
                            <td>
                                <span class="badge-vip <?= $user['role'] === 'admin' ? 'badge-admin' : 'badge-user' ?>">
                                    <i class="bi <?= $user['role'] === 'admin' ? 'bi-shield-lock' : 'bi-person' ?> me-1"></i>
                                    <?= $user['role'] === 'admin' ? 'Quản trị viên' : 'Thành viên' ?>
                                </span>
                            </td>
     <td class="text-end" style="padding-right: 30px;">
    <div class="d-flex gap-2 justify-content-end">
        <?php if ($user['role'] === 'admin'): ?>
            <a href="?action=admin/user-unrole&id=<?= $user['id'] ?>&role=admin" 
               class="btn btn-sm btn-outline-warning border-0" 
               style="border-radius: 8px; background: #fff9e6;">
                <i class="bi bi-person-dash"></i> Hủy quyền
            </a>
        <?php else: ?>
            <a href="?action=admin/user-role&id=<?= $user['id'] ?>&role=user" 
               class="btn btn-sm btn-outline-primary border-0" 
               style="border-radius: 8px; background: #f0f7ff;">
                <i class="bi bi-shield-check"></i> Cấp quyền
            </a>
        <?php endif; ?>

        <a href="?action=admin/user-delete&id=<?= $user['id'] ?>" 
           class="btn btn-sm btn-outline-danger border-0" 
           onclick="return confirm('Xác nhận xóa tài khoản này?')">
            <i class="bi bi-trash"></i>
        </a>
    </div>
</td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Không có dữ liệu.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>