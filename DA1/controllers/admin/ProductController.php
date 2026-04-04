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

// Trong ProductController.php hàm store()
public function store() {
    $data = $_POST; // Lấy dữ liệu từ form
    
    // Xử lý upload ảnh như t đã chỉ ở bước trước
    if (isset($_FILES['image_upload']) && $_FILES['image_upload']['size'] > 0) {
        $filename = time() . '_' . $_FILES['image_upload']['name'];
        move_uploaded_file($_FILES['image_upload']['tmp_name'], 'assets/uploads/img/' . $filename);
        $data['image'] = $filename;
    } else {
        $data['image'] = null;
    }

    // Gọi hàm insert vừa tạo ở Bước 1
    $res = $this->model->insert($data);

    if ($res) {
        header("Location: ?action=admin/product");
        exit(); // Chặn lỗi đơ trang
    }
}

    public function edit() {
        $product = $this->model->getById($_GET['id']);
        view('product/edit', compact('product'), 'admin');
    }

public function update($id) {
    $data = $_POST;
    $file = $_FILES['image_upload'];

    if ($file['size'] > 0) {
        // Nếu có chọn ảnh mới
        $filename = $file['name']; 
        // Lưu vào thư mục m đang có
        move_uploaded_file($file['tmp_name'], 'assets/uploads/img/' . $filename);
        $data['image'] = $filename; 
    } else {
        // Nếu không chọn ảnh mới, dùng lại cái current_image từ form
        $data['image'] = $_POST['current_image'];
    }

    // Gọi model để lưu vào bảng 'books'
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
?>