<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="sidebar-right shadow-sm border-start bg-white d-none d-lg-flex flex-column py-4">
    <div class="text-center mb-4">
        <i class="bi bi-list fs-3 text-primary"></i>
        <h6 class="mt-2 fw-bold small">MENU</h6>
    </div>

    <div class="nav-links-vertical d-flex flex-column gap-3 px-2">
        <a href="index.php" class="v-nav-item active" title="Trang chủ">
            <i class="bi bi-house-door fs-4"></i>
            <span>Trang chủ</span>
        </a>
        <a href="index.php?act=san-pham" class="v-nav-item" title="Sách mới">
            <i class="bi bi-book fs-4"></i>
            <span>Sách mới</span>
        </a>
        <a href="index.php?act=khuyen-mai" class="v-nav-item text-danger" title="Khuyến mãi">
            <i class="bi bi-gift fs-4"></i>
            <span>Ưu đãi</span>
        </a>
        <a href="index.php?act=gio-hang" class="v-nav-item" title="Giỏ hàng">
            <i class="bi bi-cart3 fs-4"></i>
            <span>Giỏ hàng</span>
        </a>
    </div>

    <div class="mt-auto text-center pb-4">
        <a href="index.php?act=ho-tro" class="btn btn-sm btn-outline-secondary rounded-circle">
            <i class="bi bi-question-circle"></i>
        </a>
    </div>
</div>
</body>
</html>