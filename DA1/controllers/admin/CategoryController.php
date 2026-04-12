<?php

namespace controllers\admin;

use models\Category;

class CategoryController
{
    // Hàm này dùng để load giao diện chung cho Admin
    public function renderView($view, $data = []) {
        extract($data);
        // Header này đã chứa Sidebar bên trong (theo các bước trước mình làm)
        include_once "views/admin/layout/header.php"; 
        include_once "views/admin/$view.php"; 
        echo '</div>'; // Đóng div main-content từ header
        include_once "views/admin/layout/footer.php";
    }

    public function index() {
        $model = new Category();
        $categories = $model->getAll();
        // Sửa từ $this->view thành $this->renderView
        $this->renderView('categories/index', compact('categories'));
    }

    public function create()
    {
        // QUAN TRỌNG: Thay vì dùng view() global, hãy dùng hàm của class này
        $this->renderView('categories/create');
    }

    public function store()
    {
        $model = new Category();
        $model->insert([
            'name' => $_POST['name']
        ]);
        $_SESSION['message'] = 'Thêm danh mục thành công!';
        header('Location: ' . BASE_URL . 'admin/category');
        exit();
    }

    public function edit()
    {
        $model = new Category();
        $category = $model->find($_GET['id']);
        // Sửa tại đây nữa để đồng bộ
        $this->renderView('categories/edit', compact('category'));
    }

    public function update()
    {
        $model = new Category();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $model->update($id, ['name' => $_POST['name']]);
            $_SESSION['message'] = 'Cập nhật danh mục thành công!';
        }
        header('Location: ' . BASE_URL . 'admin/category');
        exit();
    }

    public function delete()
    {
        $model = new Category();
        $model->delete($_GET['id']);
        $_SESSION['message'] = 'Xóa danh mục thành công!';
        header('Location: ' . BASE_URL . 'admin/category');
        exit();
    }
}