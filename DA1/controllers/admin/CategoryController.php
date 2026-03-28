<?php

namespace controllers\admin;

use models\Category;

class CategoryController
{
    public function index()
    {
        $model = new Category();
        $categories = $model->getAll();

        $view = 'views/admin/categories/index.php';
        require 'views/layout/admin.php';
    }

    public function create()
    {
        $view = 'views/admin/categories/create.php';
        require 'views/layout/admin.php';
    }

    public function store()
    {
        $model = new Category();

        $model->insert([
            'name' => $_POST['name']
        ]);

        header('Location: ' . BASE_URL . 'admin/category');
    }

    public function edit()
    {
        $model = new Category();
        $category = $model->find($_GET['id']);

        $view = 'views/admin/categories/edit.php';
        require 'views/layout/admin.php';
    }

    public function update()
    {
        $model = new Category();

        $model->update($_GET['id'], [
            'name' => $_POST['name']
        ]);

        header('Location: ' . BASE_URL . 'admin/category');
    }

    public function delete()
    {
        $model = new Category();

        $model->delete($_GET['id']);

        header('Location: ' . BASE_URL . 'admin/category');
    }
}