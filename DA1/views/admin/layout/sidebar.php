<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
        }

        .sidebar {
            width: 220px;
            background: #2c2c2c;
            color: white;
            height: 100vh;
            padding: 20px;
        }

        .sidebar h2 {
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px 0;
        }

        .sidebar a:hover {
            background: #444;
        }

        .content {
            flex: 1;
            padding: 30px;
            background: #f5f5f5;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-add { background: green; color: white; }
        .btn-edit { background: orange; color: white; }
        .btn-delete { background: red; color: white; }

    </style>
</head>
<body>

<div class="sidebar">
    <h2>BOOK VERSE</h2>
    <a href="<?= BASE_URL ?>admin">Dashboard</a>

<a href="<?= BASE_URL ?>admin/product">Quản Lý Sản Phẩm</a>

<a href="<?= BASE_URL ?>admin/category">Quản Lý Danh Mục</a>

<a href="<?= BASE_URL ?>admin/order">Quản Lý Đơn Hàng</a>
</div>


</body>
</html>