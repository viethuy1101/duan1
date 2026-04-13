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
}