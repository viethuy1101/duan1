<?php
namespace controllers\admin;

class LoginController {
    
    public function showFormLogin() {

        include_once "views/admin/login.php"; 
    }

   public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($email === 'admin@gmail.com' && $password === '123456') {
            
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user'] = [
                'id'    => 1,
                'email' => 'admin@gmail.com',
                'role'  => 'admin' 
            ];

            header("Location: ?action=admin");
            exit();
        } else {
            echo "Sai tài khoản hoặc mật khẩu rồi m ơi!";
        }
    }
}
public function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    unset($_SESSION['user']);
    session_destroy(); 

  
    header("Location: ?action=login");
    exit();
}
}
