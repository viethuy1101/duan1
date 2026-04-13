<?php
namespace controllers\admin;

use models\User;

class UserController extends BaseAdminController {
   public function index() {
    $userModel = new \models\User();
    $keyword = $_GET['search'] ?? ''; 
    $role = $_GET['role'] ?? '';


   if (!empty($keyword) || (!empty($role) && $role !== 'Tất cả vai trò')) {
     
        $listUsers = $userModel->searchUsers($keyword, $role);
    } else {

        $listUsers = $userModel->getAll();
    }

    include_once "views/admin/users/list.php";
}
    public function changeRole() {
        $id = $_GET['id'];
        $currentRole = $_GET['role'];
        $newRole = ($currentRole === 'admin') ? 'user' : 'admin';

        (new User())->updateRole($id, $newRole);
        header("Location: ?action=admin/users");
    }
    public function delete() {
    $id = $_GET['id'] ?? null;
    if ($id) {
        (new \models\User())->delete($id);
    }
    header("Location: ?action=admin/users");
    }
    public function create() {
    include_once "views/admin/users/create.php";
}

public function store() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'name'       => $_POST['name'],
            'email'      => $_POST['email'],
            'password'   => $_POST['password'], 
            'role'       => $_POST['role'],
            'created_at' => date('Y-m-d H:i:s') 
        ];

        $userModel = new \models\User();
        $userModel->insert($data);
        header("Location: ?action=admin/users");
        exit();
    }
}
}
