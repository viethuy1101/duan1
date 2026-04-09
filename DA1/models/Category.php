<?php

namespace models;

class Category extends BaseModel
{
    protected $table = 'categories';

    // Thêm hàm update nếu lớp cha chưa có
    public function update($id, $data)
    {
        $sql = "UPDATE {$this->table} SET name = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql); // Dùng pdo từ BaseModel
        return $stmt->execute([$data['name'], $id]);
    }

    // Thêm hàm find để trang Edit lấy được dữ liệu cũ
    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}