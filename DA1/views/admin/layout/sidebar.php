<div class="sidebar shadow">
    <h2 class="text-primary fw-bold px-3 py-4">BOOK VERSE</h2>
    
    <a href="?action=admin" class="menu-item <?= (!isset($_GET['action']) || $_GET['action'] == 'admin') ? 'active' : '' ?>">
        <i class="bi bi-speedometer2 me-2"></i> <span>Dashboard</span>
    </a>
    
    <a href="?action=admin/product" class="menu-item <?= (strpos($_GET['action'] ?? '', 'admin/product') !== false) ? 'active' : '' ?>">
        <i class="bi bi-book me-2"></i> <span>Quản Lý Sản Phẩm</span>
    </a>
    
    <a href="?action=admin/category" class="menu-item <?= (strpos($_GET['action'] ?? '', 'admin/category') !== false) ? 'active' : '' ?>">
        <i class="bi bi-tags me-2"></i> <span>Quản Lý Danh Mục</span>
    </a>
    
    <a href="?action=admin/order" class="menu-item <?= (strpos($_GET['action'] ?? '', 'admin/order') !== false) ? 'active' : '' ?>">
        <i class="bi bi-cart me-2"></i> <span>Quản Lý Đơn Hàng</span>
    </a>

    <a href="?action=admin/users" class="menu-item <?= (strpos($_GET['action'] ?? '', 'admin/users') !== false) ? 'active' : '' ?>">
        <i class="bi bi-people-fill me-2"></i> <span>Quản Lý Tài Khoản</span>
    </a>
    
    <hr class="mx-3 my-4 opacity-25">
    
    <a href="<?= BASE_URL ?>" class="menu-item">
        <i class="bi bi-house me-2"></i> <span>Về Trang Chủ</span>
    </a>
</div>