<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin - Book Verse</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { display: flex; min-height: 100vh; background-color: #f0f2f5; margin: 0; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 260px; background: #1a1d20; color: white; position: fixed; height: 100vh; padding: 25px 0; z-index: 1000; }
        .sidebar h2 { color: #0d6efd; font-weight: 800; text-align: center; margin-bottom: 35px; }
        .sidebar a { display: block; color: #adb5bd; text-decoration: none; padding: 14px 25px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #2b2f33; color: white; border-left: 5px solid #0d6efd; padding-left: 30px; }
        .main-content { margin-left: 260px; flex: 1; padding: 40px 50px; width: calc(100% - 260px); }
        .sidebar i { margin-right: 10px; }
    </style>
</head>
<body>
    <div class="sidebar">
    <a href="?action=admin" style="text-decoration: none;"><h2>BOOK VERSE</h2></a>
    
    <a href="?action=admin" class="<?= !isset($_GET['action']) || $_GET['action'] == 'admin' ? 'active' : '' ?>">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="?action=admin/product" class="<?= isset($_GET['action']) && $_GET['action'] == 'admin/product' ? 'active' : '' ?>">
        <i class="bi bi-book"></i> Quản lý sản phẩm
    </a>
    <a href="?action=admin/category" class="<?= isset($_GET['action']) && strpos($_GET['action'], 'admin/category') !== false ? 'active' : '' ?>">
        <i class="bi bi-tags"></i> Quản lý danh mục
    </a>
    <a href="?action=admin/order" class="<?= isset($_GET['action']) && strpos($_GET['action'], 'admin/order') !== false ? 'active' : '' ?>">
        <i class="bi bi-cart"></i> Quản lý đơn hàng
    </a>

    <a href="?action=admin/users" class="<?= isset($_GET['action']) && $_GET['action'] == 'admin/users' ? 'active' : '' ?>">
        <i class="bi bi-people-fill"></i> Quản lý tài khoản
    </a>
    <a href="?action=admin/reviews" class="<?= isset($_GET['action']) && $_GET['action'] == 'admin/reviews' ? 'active' : '' ?>">
    <i class="bi bi-chat-left-text"></i> Quản lý đánh giá
    </a>

    <hr class="opacity-25 mx-3">
    
    <a href="index.php"><i class="bi bi-house"></i> Về Trang Chủ</a>
</div>
    <div class="main-content">