<?php

namespace controllers\admin;

use models\Category;

class CategoryController
{
    public function view($view, $data = []) {
        extract($data);
        include_once "views/admin/layout/header.php"; 
        include_once "views/admin/$view.php"; 
        echo '</div>';
        include_once "views/admin/layout/footer.php";
    }

    public function index() {
        $model = new \models\Category();
        $categories = $model->getAll();
        $this->view('categories/index', compact('categories'));
    }

    public function create()
    {
        view('categories/create', [], 'admin');
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

        $this->view('categories/edit', compact('category'), 'admin');
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