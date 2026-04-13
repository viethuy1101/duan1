<?php
// 1. Nạp thêm file UserController ở đây
require_once PATH_CONTROLLER . 'admin/DashboardController.php';
require_once PATH_CONTROLLER . 'admin/ProductController.php';
require_once PATH_CONTROLLER . 'admin/CategoryController.php';
require_once PATH_CONTROLLER . 'admin/OrderController.php';
require_once PATH_CONTROLLER . 'admin/UserController.php'; // Thêm dòng này

use controllers\admin\OrderController;
use controllers\admin\DashboardController;
use controllers\admin\ProductController;
use controllers\admin\CategoryController;
use controllers\admin\UserController; // Thêm dòng này

$action = isset($_GET['action']) ? trim($_GET['action']) : 'admin';

match ($action) {
    'admin', 'admin/dashboard' => (new DashboardController())->index(),
    'admin/order'              => (new OrderController())->index(),
    'admin/order/detail'       => (new OrderController())->detail(),
    'admin/order/export'       => (new OrderController())->export(),
    'admin/user/create' => (new UserController())->create(),
    'admin/user/store'  => (new UserController())->store(),

    // Quản lý User (Thêm cụm này vào)
    'admin/users'              => (new UserController())->index(),
    'admin/user-role'          => (new UserController())->changeRole(),
    'admin/user-delete'        => (new UserController())->delete(),

    // CRUD Product
    'admin/product'         => (new ProductController())->index(),
    'admin/product/create'  => (new ProductController())->create(),
    'admin/product/store'   => (new ProductController())->store(),
    'admin/product/edit'    => (new ProductController())->edit($_GET['id'] ?? null),
    'admin/product/update'  => (new ProductController())->update($_GET['id'] ?? $_POST['id'] ?? null),
    'admin/product/delete'  => (new ProductController())->delete($_GET['id'] ?? null),
    
    // CRUD Category
    'admin/category'         => (new CategoryController())->index(),
    'admin/category/create'  => (new CategoryController())->create(),
    'admin/category/store'   => (new CategoryController())->store(),
    'admin/category/edit'    => (new CategoryController())->edit(),
    'admin/category/update'  => (new CategoryController())->update(),
    'admin/category/delete'  => (new CategoryController())->delete(),

    default => die("404 ADMIN: Không tìm thấy hành động $action"),
};