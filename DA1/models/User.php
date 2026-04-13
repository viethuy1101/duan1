<?php

namespace models;

class User extends BaseModel
{
    // Khai báo tên bảng để BaseModel sử dụng
    protected $table = 'users';

    // Đăng ký (sử dụng hàm insert có sẵn của bạn)
    public function register($data)
    {
        return $this->insert([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role'     => 'client'
        ]);
    }

    // Kiểm tra đăng nhập (sử dụng hàm query có sẵn của bạn)
    public function checkLogin($email, $password)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        $user = $this->query($sql, [$email])->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Kiểm tra email tồn tại
    public function isEmailExists($email)
    {
        $sql = "SELECT id FROM {$this->table} WHERE email = ?";
        return $this->query($sql, [$email])->fetch();
    }
    // Lấy thông tin người dùng theo ID
    public function getUserById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id])->fetch(\PDO::FETCH_ASSOC);
    }

    // Cập nhật thông tin cá nhân (không đổi mật khẩu ở đây)
    public function updateProfile($id, $data)
    {
        $sql = "UPDATE {$this->table} SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
        return $this->query($sql, [
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['address'],
            $id
        ]);
    }
}