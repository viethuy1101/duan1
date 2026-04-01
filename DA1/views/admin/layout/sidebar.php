<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin - Book Verse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        /* 1. Đổi màu nền toàn trang sang xám nhạt để Card trắng nổi lên */
        body { 
            display: flex; 
            min-height: 100vh; 
            background-color: #f0f2f5; /* Màu xám đặc trưng của Facebook/Admin Dashboard */
            margin: 0; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* 2. Sidebar cố định bên trái */
        .sidebar { 
            width: 260px; 
            background: #1a1d20; /* Màu tối hơn chút cho sang */
            color: white; 
            position: fixed; 
            height: 100vh; 
            padding: 25px 0;
            z-index: 1000;
        }
        .sidebar h2 { 
            color: #0d6efd; 
            font-weight: 800; 
            text-align: center; 
            margin-bottom: 35px; 
            letter-spacing: 1px;
        }
        .sidebar a { 
            display: block; 
            color: #adb5bd; 
            text-decoration: none; 
            padding: 14px 25px; 
            transition: all 0.3s;
            font-size: 15px;
        }
        .sidebar a:hover { 
            background: #2b2f33; 
            color: white; 
            border-left: 5px solid #0d6efd; 
            padding-left: 30px; /* Hiệu ứng đẩy sang phải khi hover */
        }
        .sidebar a i { margin-right: 12px; font-size: 18px; }
        .sidebar a.active {
            background: #2b2f33;
            color: white;
            border-left: 5px solid #0d6efd;
        }

        /* 3. Phần nội dung bên phải - Căn chỉnh dãn cách */
        .main-content { 
            margin-left: 10px; 
            flex: 1; 
            padding: 40px 50px; /* Dãn cách rộng rãi giúp nhìn không bị bí */
            min-height: 100vh;
        }

        /* 4. Tinh chỉnh Card cho nổi bật hẳn lên */
        .card { 
            border: none !important; 
            /* Đổ bóng sâu hơn để tạo hiệu ứng nổi (Elevation) */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important; 
            border-radius: 15px !important; 
            background-color: #ffffff !important;
            overflow: hidden;
        }

        /* Tinh chỉnh bảng cho dãn dòng rộng hơn */
        .table { margin-bottom: 0; }
        .table thead th { 
            background-color: #f8f9fa; 
            text-uppercase; 
            font-size: 12px; 
            letter-spacing: 1px; 
            padding: 15px;
        }
        .table tbody td { padding: 20px 15px; vertical-align: middle; }
    </style>
</head>
<body>
    <div class="sidebar shadow">
        <h2>BOOK VERSE</h2>
        <a href="?action=admin"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="?action=admin/product"><i class="bi bi-book"></i> Quản Lý Sản Phẩm</a>
        <a href="?action=admin/category"><i class="bi bi-tags"></i> Quản Lý Danh Mục</a>
        <a href="?action=admin/order"><i class="bi bi-cart"></i> Quản Lý Đơn Hàng</a>
        <hr class="mx-3 opacity-25">
        <a href="?action=client"><i class="bi bi-house"></i> Về Trang Chủ</a>
    </div>
    
    <div class="main-content">

