<?php
namespace controllers\admin;

require_once PATH_MODEL . 'Product.php';

class ProductController {
    private $model;

    public function __construct() {
        $this->model = new \Product();
    }

    public function index() {
        $products = $this->model->getAll();
        view('product/index', compact('products'), 'admin');
    }

    public function create() {
        view('product/create', [], 'admin');
    }

    public function store() {
        $this->model->create($_POST);
        echo "<script>alert('Thêm sản phẩm thành công!');window.location='?action=admin/product';</script>";
        exit;
    }

    public function edit() {
        $product = $this->model->getById($_GET['id']);
        view('product/edit', compact('product'), 'admin');
    }

    public function update() {
        $this->model->update($_POST['id'], $_POST);
        echo "<script>alert('Cập nhật sản phẩm thành công!');window.location='?action=admin/product';</script>";
        exit;
    }

    public function delete() {
        $this->model->delete($_GET['id']);
        echo "<script>alert('Xóa sản phẩm thành công!');window.location='?action=admin/product';</script>";
        exit;
    }
}