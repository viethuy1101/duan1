<?php

namespace controllers\admin;

use models\Category;

class CategoryController
{
    public function index()
    {
        $model = new Category();
        $categories = $model->getAll();

        view('categories/index', compact('categories'), 'admin');
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
    }

    public function edit()
    {
        $model = new Category();
        $category = $model->find($_GET['id']);

        view('categories/edit', compact('category'), 'admin');
    }

    public function update()
    {
        $model = new Category();
        $model->update($_POST['id'], ['name' => $_POST['name']]);
        $_SESSION['message'] = 'Cập nhật danh mục thành công!';
        header('Location: ' . BASE_URL . 'admin/category');
    }

    public function delete()
    {
        $model = new Category();
        $model->delete($_GET['id']);
        $_SESSION['message'] = 'Xóa danh mục thành công!';
        header('Location: ' . BASE_URL . 'admin/category');
    }
}