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

match ($action) {
    'admin', 'admin/dashboard' => (new DashboardController())->index(),
    'admin/order'             => (new OrderController())->index(),
    // CRUD Product
    'admin/product'         => (new ProductController())->index(),
    'admin/product/create'  => (new ProductController())->create(),
    'admin/product/store'   => (new ProductController())->store(),
    'admin/product/edit'    => (new ProductController())->edit(),
    'admin/product/update'  => (new ProductController())->update(),
    'admin/product/delete'  => (new ProductController())->delete(),

    // CRUD Category
    'admin/category'        => (new CategoryController())->index(),
    'admin/category/create' => (new CategoryController())->create(),
    'admin/category/store'  => (new CategoryController())->store(),
    'admin/category/edit'   => (new CategoryController())->edit(),
    'admin/category/update' => (new CategoryController())->update(),
    'admin/category/delete' => (new CategoryController())->delete(),

    default => die("404 ADMIN: Không tìm thấy hành động $action"),
};
?>