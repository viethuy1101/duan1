<?php

namespace controllers\client;

use models\User;

class AuthController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // Hàm render tự chế vì BaseModel của bạn chưa có
    public function render($view, $data = [])
    {
        extract($data);
        $viewPath = str_replace('.', '/', $view);
        include "views/{$viewPath}.php";
    }

    public function login()
    {
        $this->render('client.auth.login');
    }

    public function register()
    {
        $this->render('client.auth.register');
    }

    public function postRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name'     => $_POST['name'],
                'email'    => $_POST['email'],
                'password' => $_POST['password']
            ];

            if ($this->userModel->isEmailExists($data['email'])) {
                echo "<script>alert('Email đã tồn tại!'); window.history.back();</script>";
                return;
            }

            $this->userModel->register($data);
            header("Location: " . BASE_URL . "?action=login");
        }
    }

    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->checkLogin($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: " . BASE_URL);
            } else {
                echo "<script>alert('Sai tài khoản hoặc mật khẩu!'); window.history.back();</script>";
            }
        }
    }
    public function logout() {
    // 1. Xóa toàn bộ dữ liệu trong session liên quan đến user
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }

    // 2. (Tùy chọn) Hủy toàn bộ session nếu muốn an toàn tuyệt đối
    // session_destroy();

    // 3. Chuyển hướng về trang chủ hoặc trang đăng nhập
    header("Location: " . BASE_URL);
    exit();
}
}