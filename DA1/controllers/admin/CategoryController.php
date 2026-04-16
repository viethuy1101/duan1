<?php
namespace controllers\admin;
use models\Category;

class CategoryController extends BaseAdminController
{
    public function __construct() {
        parent::__construct();
    }

    public function renderView($view, $data = []) {
        extract($data);
        include_once "views/admin/layout/header.php"; 
        include_once "views/admin/$view.php"; 
        echo '</div>';
        include_once "views/admin/layout/footer.php";
    }

    public function index() {
        $model = new Category();
        $categories = $model->getAll();
        $this->renderView('categories/index', compact('categories'));
    }

    public function create() {
        $this->renderView('categories/create');
    }

    public function store() {
        $name = trim($_POST['name'] ?? '');
        if ($name === '') {
            $_SESSION['error'] = 'Tên danh mục không được để trống.';
            header("Location: ?action=admin/category/create");
            exit();
        }

        $model = new Category();
        $model->insert(['name' => $name]);
        $_SESSION['message'] = 'Thêm danh mục thành công!';
        header("Location: ?action=admin/category");
        exit();
    }

   public function edit() {
    // 1. Lấy ID từ URL, nếu không có ID thì không thể sửa
    $id = $_GET['id'] ?? null;
    
    if (!$id) {
        die("Lỗi: Không tìm thấy ID danh mục để sửa.");
    }

    // 2. Khởi tạo Model (Đảm bảo Class Category đã được use hoặc require)
    $model = new Category();

    // 3. Tìm dữ liệu danh mục theo ID
    $category = $model->find($id);

    // 4. Kiểm tra nếu không tìm thấy dữ liệu trong DB
    if (!$category) {
        die("Lỗi: Danh mục với ID $id không tồn tại.");
    }

    // 5. Render View (M phải kiểm tra xem thư mục là 'categories' hay 'category')
    // Nếu trong thư mục views/admin của m là 'category' thì đổi lại nhé
    $this->renderView('categories/edit', compact('category'));
}

    public function update() {
        $model = new Category();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $model->update($id, [
                'name' => $_POST['name'],
                'description' => $_POST['description'] ?? null
            ]);
            $_SESSION['message'] = 'Cập nhật danh mục thành công!';
        }
        header("Location: ?action=admin/category");
        exit();
    }

    public function delete() {
        $model = new Category();
        $model->delete($_GET['id']);
        $_SESSION['message'] = 'Xóa danh mục thành công!';
        header("Location: ?action=admin/category");
        exit();
    }
}