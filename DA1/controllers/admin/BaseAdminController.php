<?php
namespace controllers\admin;

class BaseAdminController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            unset($_SESSION['user']);
            header("Location: ?action=login");
            exit();
        }
    }

    public function view($view, $data = []) {
    extract($data);
    
    // Sử dụng đường dẫn tương đối từ file index.php gốc cho an toàn
    include_once "views/admin/layout/header.php"; 
    include_once "views/admin/" . $view . ".php"; 
    include_once "views/admin/layout/footer.php";
}
}