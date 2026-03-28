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
        header("Location: ?action=admin/product");
    }

    public function edit() {
        $product = $this->model->getById($_GET['id']);
        view('product/edit', compact('product'), 'admin');
    }

    public function update() {
        $this->model->update($_POST['id'], $_POST);
        header("Location: ?action=admin/product");
    }

    public function delete() {
        $this->model->delete($_GET['id']);
        header("Location: ?action=admin/product");
    }
}