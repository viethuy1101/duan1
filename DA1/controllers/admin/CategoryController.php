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
        $model = new Category();
        $model->insert(['name' => $_POST['name']]);
        $_SESSION['message'] = 'Thêm danh mục thành công!';
        header("Location: ?action=admin/category");
        exit();
    }

    public function edit() {
        $model = new Category();
        $category = $model->find($_GET['id']);
        $this->renderView('categories/edit', compact('category'));
    }

    public function update() {
        $model = new Category();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $model->update($id, ['name' => $_POST['name']]);
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