<?php

use controllers\admin\DashboardController;
use controllers\admin\ProductController;
use controllers\admin\CategoryController;
use controllers\admin\OrderController;

match ($action) {

    // dashboard
    'admin', 'admin/dashboard'
        => (new DashboardController())->index(),

    // CRUD PRODUCT
    'admin/product'
        => (new ProductController())->index(),

    'admin/product/create'
        => (new ProductController())->create(),

    'admin/product/store'
        => (new ProductController())->store(),

    'admin/product/edit'
        => (new ProductController())->edit(),

    'admin/product/update'
        => (new ProductController())->update(),

    'admin/product/delete'
        => (new ProductController())->delete(),

    'admin/category' 
        => (new CategoryController())->index(),

    'admin/order' 
        => (new OrderController())->index(),


    default => die('404 ADMIN'),
};