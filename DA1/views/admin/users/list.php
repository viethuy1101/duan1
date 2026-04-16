<style>
    :root {
        --primary-vip: #4f46e5;
        --secondary-vip: #7c3aed;
        --bg-body: #f8fafc;
    }

    /* Tổng thể container */
    .user-container {
        padding: 40px;
        background-color: var(--bg-body);
        min-height: 100vh;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* 1. Tiêu đề - Chỉnh lại Gradient mượt hơn */
    .header-section {
        background: linear-gradient(135deg, var(--primary-vip) 0%, var(--secondary-vip) 100%);
        border-radius: 24px;
        padding: 40px;
        color: white;
        margin-bottom: -40px;
        box-shadow: 0 20px 40px rgba(79, 70, 229, 0.15);
        position: relative;
    }

    /* 2. Thanh Action Bar - Hiệu ứng Glassmorphism VIP */
    .action-bar {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 20px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        position: relative;
        z-index: 10;
    }

    .filter-form {
        display: flex;
        gap: 12px;
        flex: 1;
        align-items: center;
    }

    /* Search Input mượt hơn */
    .search-box-wrap {
        position: relative;
        flex: 1;
        max-width: 400px;
    }

    .search-box-wrap i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.1rem;
    }

    .search-input {
        width: 100%;
        height: 48px;
        padding-left: 50px;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        font-size: 14px;
        background: #ffffff;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: var(--primary-vip);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        outline: none;
    }

    .form-select-custom {
        height: 48px;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        padding: 0 20px;
        font-size: 14px;
        font-weight: 500;
        background-color: white;
    }

    .btn-filter-vip {
        height: 48px;
        border-radius: 14px;
        background: #1e293b;
        color: white;
        font-weight: 600;
        padding: 0 30px;
        border: none;
        transition: 0.3s;
    }

    .btn-filter-vip:hover {
        background: #0f172a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* Nút Thêm mới - Đồng bộ màu Dashboard */
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
        transition: 0.3s;
        text-decoration: none !important;
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.25);
    }

    .btn-add-vip:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(79, 70, 229, 0.35);
        color: white;
    }

    /* 3. Bảng dữ liệu Card */
    .glass-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        border: none;
        box-shadow: 0 15px 45px rgba(0,0,0,0.05);
    }

    .table thead th {
        background: #fcfcfd;
        color: #64748b;
        text-transform: uppercase;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.05em;
        padding: 20px 25px;
        border-bottom: 1px solid #f1f5f9;
    }

    .table tbody td {
        padding: 20px 25px;
        vertical-align: middle;
        border-bottom: 1px solid #f8fafc;
        color: #334155;
    }

    .table tbody tr:hover { background-color: #f8faff; }

    /* Avatar Wrap mượt */
    .avatar-wrap {
        width: 48px;
        height: 48px;
        border-radius: 15px;
        background: #eef2ff;
        color: var(--primary-vip);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        border: 2px solid white;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.1);
    }

    /* Badge quyền hạn VIP */
    .badge-vip {
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
    }
    .badge-admin { background: #fee2e2; color: #dc2626; }
    .badge-user { background: #e0f2fe; color: #0284c7; }

    /* Cụm nút thao tác */
    .action-wrap {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-vip-action {
        padding: 8px 18px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 700;
        border: none;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-role-vip { background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; }
    .btn-role-vip:hover { background: #ffffff; color: var(--primary-vip); border-color: var(--primary-vip); }

    .btn-delete-vip { background: #fff1f2; color: #e11d48; }
    .btn-delete-vip:hover { background: #e11d48; color: white; transform: translateY(-2px); }

    /* 4. Footer & Phân trang */
    .footer-wrapper {
        padding: 25px 35px;
        background: #ffffff;
    }

    .page-link-vip {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #f1f5f9;
        color: #475569;
        text-decoration: none !important;
        font-weight: 700;
        transition: 0.3s;
    }

    .page-item.active .page-link-vip {
        background: var(--primary-vip);
        color: white;
        box-shadow: 0 8px 15px rgba(79, 70, 229, 0.3);
    }
    
    .btn-back-dash {
        background: #f1f5f9;
        color: #475569;
        font-weight: 700;
        padding: 0 20px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        transition: 0.3s;
    }
    .btn-back-dash:hover { background: #e2e8f0; color: #1e293b; }
</style>

<div class="user-container">
    <div class="header-section">
        <div>
            <h2 class="fw-bold mb-1" style="font-size: 1.8rem; letter-spacing: -0.5px;">Quản lý tài khoản</h2>
            <p class="mb-0 opacity-75 fw-medium">Hệ thống đang vận hành với <?= count($listUsers) ?> thành viên</p>
        </div>
    </div>

    <div class="action-bar mt-5">
        <form action="" method="GET" class="filter-form">
            <input type="hidden" name="action" value="admin/users">
            
            <div class="search-box-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="search-input shadow-sm" placeholder="Tìm kiếm tên hoặc email..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </div>

            <select name="role" class="form-select-custom shadow-sm border-0" style="width: 180px;">
                <option value="">Tất cả vai trò</option>
                <option value="admin" <?= ($_GET['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Quản trị viên</option>
                <option value="user" <?= ($_GET['role'] ?? '') == 'user' ? 'selected' : '' ?>>Thành viên</option>
            </select>

            <button type="submit" class="btn-filter-vip shadow-sm">
                <i class="bi bi-funnel-fill me-2"></i> Lọc dữ liệu
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
                        <th style="width: 100px;" class="text-center">ID</th>
                        <th>Thông tin thành viên</th>
                        <th>Địa chỉ Email</th>
                        <th>Quyền hạn</th>
                        <th>Ngày tham gia</th>
                        <th class="text-end" style="padding-right: 35px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($listUsers) > 0): ?>
                        <?php foreach ($listUsers as $user): ?>
                        <tr>
                            <td class="text-center">
                                <span class="fw-bold text-muted small">#<?= $user['id'] ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-wrap">
                                        <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark fs-6"><?= htmlspecialchars($user['name']) ?></div>
                                        <div class="text-muted small" style="font-size: 11px;">BookVerse Member</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-medium text-secondary small"><?= htmlspecialchars($user['email']) ?></span>
                            </td>
                            <td>
                                <?php if ($user['role'] === 'admin'): ?>
                                    <span class="badge-vip badge-admin">
                                        <i class="bi bi-shield-lock-fill me-1"></i> Quản trị viên
                                    </span>
                                <?php else: ?>
                                    <span class="badge-vip badge-user">
                                        <i class="bi bi-person-fill me-1"></i> Thành viên
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="small text-muted fw-medium"><?= date('d/m/Y', strtotime($user['created_at'])) ?></span>
                            </td>
                            <td class="text-end">
                            <div class="action-wrap" style="display: flex; gap: 10px; justify-content: flex-end; padding-right: 1.5rem;">
                              <a href="?action=admin/user-role&id=<?= $user['id'] ?>" class="btn-action-vip btn-role-vip" style="text-decoration: none; display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #eef2ff; color: #4f46e5; border-radius: 8px; font-weight: 600; font-size: 13px;">
                               <i class="bi bi-shield-check"></i>
                                  <span>Cấp quyền</span>
                               </a>

                               <a href="?action=admin/user-delete-role&id=<?= $user['id'] ?>" class="btn-action-vip btn-delete-vip" onclick="return confirm('Xóa quyền của thành viên này?')" style="text-decoration: none; display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #fff1f2; color: #e11d48; border-radius: 8px; font-weight: 600; font-size: 13px;">
                               <i class="bi bi-shield-slash"></i>
                                  <span>Xóa quyền</span>
                              </a>
                             </div>
                             </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted opacity-25"></i>
                                <p class="text-muted mt-3">Không có dữ liệu thành viên nào được tìm thấy.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="footer-wrapper border-top d-flex align-items-center" style="padding: 20px 30px; background: #ffffff;">
    
    <div class="d-flex align-items-center gap-3">
        <a href="?action=admin" class="btn-back-dash text-decoration-none shadow-sm" style="display: flex; align-items: center; padding: 8px 20px; background: #f1f5f9; border-radius: 12px; color: #475569; font-weight: 700;">
            <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
        </a>
        <span class="small text-muted fw-medium">Tổng kết: <b class="text-dark"><?= count($listUsers) ?></b> thành viên</span>
    </div>

    <nav style="flex-grow: 1; display: flex; justify-content: flex-end;">
        <ul class="pagination-container mb-0" style="list-style: none; display: flex; gap: 10px; padding: 0;">
            <li class="page-item-vip active">
                <a href="#" class="page-link-vip" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 12px; text-decoration: none; font-weight: 700; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: white; box-shadow: 0 8px 16px rgba(79, 70, 229, 0.3);">1</a>
            </li>
            <li class="page-item-vip">
                <a href="#" class="page-link-vip" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 12px; text-decoration: none; font-weight: 700; background: #f1f5f9; color: #64748b;">2</a>
            </li>
        </ul>
    </nav>
</div>
    </div>
</div>