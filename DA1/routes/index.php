<?php
$action = $_GET['action'] ?? '/';

if ($action === 'login' || $action === 'check-login' || $action === 'logout') {
    $controller = new \controllers\admin\LoginController();
    if ($action === 'login') $controller->showFormLogin();
    elseif ($action === 'check-login') $controller->login();
    else $controller->logout();
} 
elseif (str_contains($action, 'admin')) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header("Location: ?action=login");
        exit();
    }
    require_once 'admin.php';
} 
else {

    require_once 'client.php';
}