<style>
    :root {
        --primary: #4f46e5;
        --secondary: #a855f7;
        --bg-glass: rgba(255, 255, 255, 0.9);
        --text: #334155;
    }

    /* Tổng thể container */
    .user-container {
        padding: 30px;
        background-color: #f1f5f9;
        min-height: 100vh;
        font-family: 'Segoe UI', Roboto, sans-serif;
    }

    /* 1. Tiêu đề Glassmorphism */
    .header-section {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        border-radius: 20px;
        padding: 30px;
        color: white;
        margin-bottom: -30px; /* Hiệu ứng đè nhẹ lên thanh filter */
        box-shadow: 0 10px 30px rgba(79, 70, 229, 0.2);
    }

    /* 2. Thanh Action Bar Glassmorphism - Căn lề cực chuẩn */
    .action-bar {
        background: var(--bg-glass);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 15px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        border: 1px solid rgba(255,255,255,0.5);
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
        position: relative; /* Nằm trên header section */
        z-index: 10;
    }

    .filter-form {
        display: flex;
        gap: 12px;
        flex: 1; /* Chiếm tối đa không gian bên trái */
        align-items: center;
    }

    /* Đồng bộ chiều cao cho các ô và nút */
    .search-box-wrap {
        position: relative;
        flex: 1;
        max-width: 350px;
    }

    .search-box-wrap i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .search-input {
        width: 100%;
        height: 42px;
        padding-left: 40px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        transition: 0.3s;
    }

    .search-input:focus {
        background: white;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        outline: none;
    }

    .form-select-custom {
        height: 42px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 0 15px;
        font-size: 14px;
        color: var(--text);
    }

    .btn-custom-dark {
        height: 42px;
        border-radius: 10px;
        background: #1e293b;
        color: white;
        font-weight: 500;
        padding: 0 25px;
        border: none;
        transition: 0.2s;
    }

    .btn-custom-dark:hover {
        background: #0f172a;
        transform: translateY(-1px);
    }

    /* Nút Thêm mới nổi bật */
    .btn-add-vip {
        height: 42px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        font-weight: 600;
        padding: 0 20px;
        border: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: 0.3s;
        white-space: nowrap;
        text-decoration: none !important;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
    }

    .btn-add-vip:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
    }

    /* 3. Bảng dữ liệu - Căn chỉnh nội dung đều đẹp */
    .glass-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .table thead th {
        background: #f8fafc;
        color: #64748b;
        text-transform: uppercase;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        padding: 16px 20px;
        border: none;
    }

    .table tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: var(--text);
    }

    /* Thông tin thành viên - Căn chỉnh chuyên nghiệp */
    .avatar-wrap {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #e0e7ff;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
    }

    /* Badge quyền hạn màu sắc */
    .badge-vip {
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Cụm nút thao tác căn phải chuẩn Flex */
    .action-wrap {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .btn-vip-action {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-role-vip { background: #f1f5f9; color: var(--text); border: 1px solid #e2e8f0; }
    .btn-role-vip:hover { background: #e2e8f0; }

    .btn-delete-vip { background: #fee2e2; color: #dc2626; }
    .btn-delete-vip:hover { background: #dc2626; color: white; transform: scale(1.03); }

    /* 4. Phân trang và thống kê */
    .footer-wrapper {
        padding: 20px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: white;
    }

    .pagination {
        display: flex;
        gap: 8px;
        margin: 0;
        list-style: none !important;
        padding: 0 !important;
    }

    .page-link-vip {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #f1f5f9;
        color: #475569;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: 0.3s;
    }

    .page-item.active .page-link-vip {
        background: var(--primary);
        color: white;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
    }
</style>

<div class="user-container">
    <div class="header-section">
        <div>
            <h2 class="fw-bold mb-1" style="font-size: 1.6rem;">Quản lý tài khoản</h2>
            <p class="mb-0 opacity-75 small">Hệ thống có tổng cộng <?= count($listUsers) ?> thành viên đang hoạt động</p>
        </div>
    </div>

    <div class="action-bar mt-5">
        <form action="" method="GET" class="filter-form">
            <a href="?action=admin" class="btn btn-outline-secondary btn-custom-back" style="height: 42px; border-radius: 10px;">
                <i class="bi bi-arrow-left"></i>
            </a>

            <input type="hidden" name="action" value="admin/users">
            
            <div class="search-box-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="search-input" placeholder="Tìm tên, email..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </div>

            <select name="role" class="form-select-custom border" style="width: 170px;">
                <option value="">Tất cả vai trò</option>
                <option value="admin" <?= ($_GET['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Quản trị viên</option>
                <option value="user" <?= ($_GET['role'] ?? '') == 'user' ? 'selected' : '' ?>>Thành viên</option>
            </select>

            <button type="submit" class="btn-custom-dark shadow-sm">
                <i class="bi bi-filter"></i> Lọc
            </button>
        </form>

        <a href="?action=admin/user/create" class="btn-add-vip">
            <i class="bi bi-person-plus-fill fs-5"></i> <span>Thêm thành viên</span>
        </a>
    </div>

    <div class="glass-card mt-3">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th style="width: 80px;" class="text-center">ID</th>
                    <th>Thành viên</th>
                    <th>Email</th>
                    <th>Quyền hạn</th>
                    <th>Ngày gia nhập</th>
                    <th class="text-end" style="padding-right: 2rem;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($listUsers) > 0): ?>
                    <?php foreach ($listUsers as $user): ?>
                    <tr>
                        <td class="text-center text-muted fw-bold small">#<?= $user['id'] ?></td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-wrap">
                                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark"><?= htmlspecialchars($user['name']) ?></div>
                                    <div class="text-muted" style="font-size: 11px;">Tên: <?= explode('@', $user['email'])[0] ?></div>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted small"><?= htmlspecialchars($user['email']) ?></span></td>
                        <td>
                            <?php if ($user['role'] === 'admin'): ?>
                                <span class="badge-vip bg-danger bg-opacity-10 text-danger">Quản trị viên</span>
                            <?php else: ?>
                                <span class="badge-vip bg-primary bg-opacity-10 text-primary">Thành viên</span>
                            <?php endif; ?>
                        </td>
                        <td class="small text-muted"><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                        <td>
                            <div class="action-wrap" style="padding-right: 1rem;">
                                <a href="?action=admin/user-role&id=<?= $user['id'] ?>" class="btn-vip-action btn-role-vip shadow-sm">Quyền</a>
                                <a href="?action=admin/user-delete&id=<?= $user['id'] ?>" class="btn-vip-action btn-delete-vip shadow-sm" onclick="return confirm('Xóa?')">Xóa</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center py-5 text-muted">Không tìm thấy thành viên phù hợp.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
<div class="footer-wrapper border-top d-flex justify-content-between align-items-center" style="padding: 20px 30px;">
    <div class="d-flex align-items-center gap-3">
        <a href="?action=admin" class="page-link-vip border-0 shadow-sm text-decoration-none" style="width: auto; padding: 0 20px; background: #f1f5f9; display: flex; align-items: center; transition: 0.3s;">
            <i class="bi bi-house-door me-2"></i> Dashboard
        </a>
        <span class="small text-muted">Hiển thị <b><?= count($listUsers) ?></b> kết quả</span>
    </div>

    <nav>
        <ul class="pagination mb-0">
            <li class="page-item active"><a href="#" class="page-link-vip">1</a></li>
            <li class="page-item"><a href="#" class="page-link-vip">2</a></li>
        </ul>
    </nav>
</div>
</div>