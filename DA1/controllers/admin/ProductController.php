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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $this->model->create($_POST);
        header("Location: ?action=admin/product");
         exit;
    }   
}

    public function edit() {
        $product = $this->model->getById($_GET['id']);
        view('product/edit', compact('product'), 'admin');
    }

 public function update() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $id = $_POST['id'] ?? null; 

        if ($id) {
            $data = [
                'title'       => $_POST['title'],
                'price'       => $_POST['price'],
                'author'      => $_POST['author'],
                'stock'       => $_POST['stock'], 
                'image'       => $_POST['image'],    
                'description' => $_POST['description'],
            ];

            $result = $this->model->update($id, $data);

            if ($result) {
                header("Location: ?action=admin/product");
                exit();
            }
        } else {
            die("Không tìm thấy ID sản phẩm để update m ơi!");
        }
    }
}

    public function delete() {
        $this->model->delete($_GET['id']);
        header("Location: ?action=admin/product");
        exit;
    }
}
?>