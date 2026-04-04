<?php
// Ép PHP nạp file để tránh lỗi "Class not found"
require_once PATH_CONTROLLER . 'admin/DashboardController.php';
require_once PATH_CONTROLLER . 'admin/ProductController.php';
require_once PATH_CONTROLLER . 'admin/CategoryController.php';
require_once PATH_CONTROLLER . 'admin/OrderController.php';

use controllers\admin\OrderController;
use controllers\admin\DashboardController;
use controllers\admin\ProductController;
use controllers\admin\CategoryController;

$action = isset($_GET['action']) ? trim($_GET['action']) : 'admin';

// XÓA BỎ DÒNG $router->get(...) Ở ĐÂY - ĐÂY LÀ NGUYÊN NHÂN GÂY LỖI

match ($action) {
    'admin', 'admin/dashboard' => (new DashboardController())->index(),
    'admin/order'              => (new OrderController())->index(),
    'admin/order/detail'       => (new OrderController())->detail(),
    
    // Đừng quên thêm route cho hàm export nếu m muốn dùng
    'admin/order/export'       => (new OrderController())->export(),

    // CRUD Product
    'admin/product'         => (new ProductController())->index(),
    'admin/product/create'  => (new ProductController())->create(),
    'admin/product/store'   => (new ProductController())->store(),
    'admin/product/edit'    => (new ProductController())->edit($_GET['id'] ?? null),
    'admin/product/update'  => (new ProductController())->update($_GET['id'] ?? $_POST['id'] ?? null),
    'admin/product/delete'  => (new ProductController())->delete($_GET['id'] ?? null),
    
    // CRUD Category
    'admin/category'        => (new CategoryController())->index(),
    'admin/category/create' => (new CategoryController())->create(),
    'admin/category/store'  => (new CategoryController())->store(),
    'admin/category/edit'   => (new CategoryController())->edit(),
    'admin/category/update' => (new CategoryController())->update(),
    'admin/category/delete' => (new CategoryController())->delete(),

    default => die("404 ADMIN: Không tìm thấy hành động $action"),
};