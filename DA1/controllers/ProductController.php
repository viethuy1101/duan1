<?php

require_once PATH_MODEL . 'Product.php';

class ProductController
{
    public function index()
    {
        $products = (new Product())->getAll();
        require PATH_VIEW . 'product/list.php';
    }

    public function detail()
    {
        $id = $_GET['id'] ?? 0;
        $product = (new Product())->find($id);

        require PATH_VIEW . 'product/detail.php';
    }
}