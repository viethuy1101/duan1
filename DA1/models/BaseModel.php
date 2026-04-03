<?php

namespace models;

class BaseModel
{
    protected $table;
    protected $pdo;

   
   // Kết nối CSDL
    public function __construct()
    {
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', DB_HOST, DB_PORT, DB_NAME);

        try {
          
            $this->pdo = new \PDO($dsn, DB_USERNAME, DB_PASSWORD); 
            
            // Thêm dòng này để báo lỗi nếu có vấn đề về SQL
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            
        } catch (\PDOException $e) {
            die("Kết nối cơ sở dữ liệu thất bại: {$e->getMessage()}");
        }
    }
    // Hủy kết nối CSDL
    public function __destruct()
    {
        $this->pdo = null;
    }

    // Lấy tất cả bản ghi
    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Tìm bản ghi theo ID
    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Thêm bản ghi mới
    public function insert($data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = str_repeat('?, ', count($data) - 1) . '?';
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})");
        return $stmt->execute(array_values($data));
    }

    // Cập nhật bản ghi
    public function update($id, $data) {
    $set = "";
    foreach ($data as $key => $value) {
        $set .= "$key = :$key, ";
    }
    $set = rtrim($set, ", ");
    
    $sql = "UPDATE {$this->table} SET {$set} WHERE id = :id";
    $data['id'] = $id;

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute($data);
}

    // Xóa bản ghi
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
  
public function query($sql, $params = []) {
    $stmt = $this->pdo->prepare($sql); 
    $stmt->execute($params);
    return $stmt;
}
}
