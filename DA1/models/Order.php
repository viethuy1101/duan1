<?php

namespace models;

class Order extends BaseModel {
    protected $table = 'orders';

    // Lấy thông tin 1 đơn hàng cụ thể
    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Lấy chi tiết các sách trong đơn hàng đó
    public function getOrderDetails($id) {
        $sql = "SELECT od.*, b.title as product_name, b.image as product_image 
                FROM order_details od
                JOIN books b ON od.book_id = b.id 
                WHERE od.order_id = ?";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}