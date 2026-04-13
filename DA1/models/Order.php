<?php
namespace models;

class Order extends BaseModel {
    protected $table = 'orders';

    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getOrderDetails($id) {
        $sql = "SELECT od.*, b.title as product_name, b.image as product_image 
                FROM order_details od               
                JOIN books b ON od.book_id = b.id 
                WHERE od.order_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        return $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countTotalOrders() {
        return $this->pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
    }

    public function countPendingOrders() {
        return $this->pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")->fetchColumn();
    }

    public function sumTotalRevenue() {
        $revenue = $this->pdo->query("SELECT SUM(total_price) FROM orders WHERE status = 'Completed'")->fetchColumn();
        return $revenue ? $revenue : 0;
    }

    public function getAllOrdersForExport() {
        $sql = "SELECT id, receiver_name, total_price, status, created_at FROM orders ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}