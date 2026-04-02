<div class="sidebar shadow">
    <h2>BOOK VERSE</h2>
    <a href="?action=admin"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="?action=admin/product"><i class="bi bi-book"></i> Quản Lý Sản Phẩm</a>
    <a href="?action=admin/category"><i class="bi bi-tags"></i> Quản Lý Danh Mục</a>
    <a href="?action=admin/order" class="<?= ($_GET['action'] ?? '') == 'admin/order' ? 'active' : '' ?>"><i class="bi bi-cart"></i> Quản Lý Đơn Hàng</a>
    <hr class="mx-3 opacity-25">
    <a href="?action=client"><i class="bi bi-house"></i> Về Trang Chủ</a>
</div>
<div class="main-content">

</div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>