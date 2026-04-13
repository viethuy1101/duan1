<?php
namespace controllers\admin;

require_once PATH_MODEL . 'Product.php';

class ProductController extends BaseAdminController {
    private $model;

    public function __construct() {
        parent::__construct();
        $this->model = new \Product();
    }

    public function view($view, $data = []) {
        extract($data);
        include_once "views/admin/layout/header.php"; 
        include_once "views/admin/$view.php"; 
        echo '</div>'; 
        include_once "views/admin/layout/footer.php";
    }

    public function index() {
        $products = $this->model->getAll();
        $this->view('product/index', compact('products'));
    }

    public function create() {
        $this->view('product/create', []);
    }

    public function store() {
        $data = $_POST;
        if (isset($_FILES['image_upload']) && $_FILES['image_upload']['size'] > 0) {
            $filename = time() . '_' . $_FILES['image_upload']['name'];
            move_uploaded_file($_FILES['image_upload']['tmp_name'], 'assets/uploads/img/' . $filename);
            $data['image'] = $filename;
        } else {
            $data['image'] = null;
        }
        $res = $this->model->insert($data);
        if ($res) {
            header("Location: ?action=admin/product");
            exit();
        }
    }

    public function edit() {
        $product = $this->model->getById($_GET['id']);
        $this->view('product/edit', compact('product'));
    }

    public function update($id) {
        $data = $_POST;
        $file = $_FILES['image_upload'];
        if ($file['size'] > 0) {
            $filename = $file['name']; 
            move_uploaded_file($file['tmp_name'], 'assets/uploads/img/' . $filename);
            $data['image'] = $filename; 
        } else {
            $data['image'] = $_POST['current_image'];
        }
        $res = $this->model->update($id, $data); 
        if ($res) {
            header("Location: ?action=admin/product");
            exit();
        }
    }

    public function delete() {
        $this->model->delete($_GET['id']);
        header("Location: ?action=admin/product");
        exit;
    }
}