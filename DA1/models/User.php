<?php
namespace models;

class User extends BaseModel {
    protected $table = 'users';

    public function __construct() {
        parent::__construct(); 
    }

    public function updateRole($id, $role) {
        $sql = "UPDATE users SET role = :role WHERE id = :id";
        return $this->pdo->prepare($sql)->execute(['role' => $role, 'id' => $id]);
    }
   public function searchUsers($keyword, $role = '') {
    $sql = "SELECT * FROM users WHERE (name LIKE :keyword OR email LIKE :keyword OR id LIKE :keyword)";
    $params = ['keyword' => "%$keyword%"];

    if (!empty($role)) {
        $sql .= " AND role = :role";
        $params['role'] = $role;
    }

    $sql .= " ORDER BY id DESC";
    return $this->query($sql, $params)->fetchAll(\PDO::FETCH_ASSOC);
}

public function getUsersByRole($role = '') {
    if (empty($role)) {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        return $this->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    $sql = "SELECT * FROM users WHERE role = :role ORDER BY id DESC";
    return $this->query($sql, ['role' => $role])->fetchAll(\PDO::FETCH_ASSOC);
}
}