<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary fs-3" href="<?= BASE_URL ?>">
            Book<span class="text-warning">Verse</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= BASE_URL ?>">Trang chủ</a>
                </li>
                <li class="nav-item">
                  <!-- <a class="nav-link active" href="<?= BASE_URL ?>?action=create">Thêm sách</a> -->
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        Danh mục sách
                    </a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>?action=category&id=1">Sách Kỹ năng</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>?action=category&id=2">Truyện tranh</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>?action=category&id=3">Kinh tế - Khởi nghiệp</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>?action=category&id=all">Tất cả sản phẩm</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tin tức</a>
                </li>
            </ul>

            <form class="d-flex mx-auto w-50 justify-content-center">
                <div class="input-group">
                    <input class="form-control border-end-0 rounded-start-pill" type="search" placeholder="Tìm sách bạn muốn..." aria-label="Search">
                    <button class="btn btn-outline-primary border-start-0 rounded-end-pill" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            <div class="d-flex align-items-center ms-auto">
                <a href="<?= BASE_URL ?>?action=cart" class="nav-link position-relative me-3 text-dark"> Giỏ Hàng 
                    <i class="bi bi-cart3 fs-4"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php 
                            if (!isset($_SESSION['cart'])) {
                                $_SESSION['cart'] = [];
                            }
                            echo count($_SESSION['cart']);
                        ?>
                    </span>
                </a>
                
               <div class="dropdown">
    <?php if (isset($_SESSION['user'])): ?>
        <a class="btn btn-outline-dark rounded-pill px-4 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-check"></i> Chào, <?= $_SESSION['user']['name'] ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
            <li><a class="dropdown-item" href="<?= BASE_URL ?>?action=profile">Trang cá nhân</a></li>
            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                <li><a class="dropdown-item text-primary" href="<?= BASE_URL ?>/admin">Vào trang quản trị</a></li>
            <?php endif; ?>
            <li><hr class="dropdown-divider"></li>
            <li>
    <a class="dropdown-item text-danger" href="<?= BASE_URL ?>?action=logout">
        <i class="bi bi-box-arrow-right"></i> Đăng xuất
    </a>
</li>
        </ul>
    <?php else: ?>
        <a class="btn btn-outline-dark rounded-pill px-4 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person"></i> Tài Khoản
        </a>
        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
            <li><a class="dropdown-item" href="<?= BASE_URL ?>?action=login">Đăng nhập</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>?action=register">Đăng ký</a></li>
        </ul>
    <?php endif; ?>
</div>
            </div>
        </div>
    </div>
    <a href="?action=admin">Vào Admin</a>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>