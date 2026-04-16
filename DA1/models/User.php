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

public function isEmailExists($email) {
    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetchColumn() > 0;
}

public function register($data) {
    $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        $data['name'],
        $data['email'],
        $hashedPassword,
        $data['role'] ?? 'client'
    ]);
}

public function checkLogin($email, $password) {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(\PDO::FETCH_ASSOC);

    if (!$user) {
        return false;
    }

    $storedPassword = $user['password'] ?? '';

    if (!empty($storedPassword) && password_verify($password, $storedPassword)) {
        return $user;
    }

    if (strlen($storedPassword) === 32 && md5($password) === $storedPassword) {
        return $user;
    }

    if ($password === $storedPassword) {
        return $user;
    }

    return false;
}

public function getUserById($id) {
    $sql = "SELECT * FROM users WHERE id = :id";
    return $this->query($sql, ['id' => $id])->fetch(\PDO::FETCH_ASSOC);
}

public function updateProfile($id, $data) {
    $updates = [];
    $params = ['id' => $id];
    
    foreach ($data as $key => $value) {
        $updates[] = "$key = :$key";
        $params[$key] = $value;
    }
    
    $sql = "UPDATE users SET " . implode(", ", $updates) . " WHERE id = :id";
    return $this->pdo->prepare($sql)->execute($params);
}
}