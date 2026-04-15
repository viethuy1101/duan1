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

    public function getOrderDetails($orderId) {
        $sql = "SELECT od.*, b.title as product_name, b.image 
                FROM order_details od 
                JOIN books b ON od.product_id = b.id 
                WHERE od.order_id = ?";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orderId]);
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

    public function getStatsByDate($startDate, $endDate) {
        $sql = "SELECT DATE(created_at) as order_date, 
                       COUNT(id) as total_orders, 
                       SUM(total_money) as daily_revenue 
                FROM orders 
                WHERE DATE(created_at) BETWEEN ? AND ? 
                GROUP BY DATE(created_at) 
                ORDER BY order_date DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function deleteOrder($id) {
    // Xóa chi tiết đơn hàng trước để tránh lỗi khóa ngoại (Foreign Key)
    $sqlDetails = "DELETE FROM order_details WHERE order_id = ?";
    $stmtDetails = $this->pdo->prepare($sqlDetails);
    $stmtDetails->execute([$id]);

    // Sau đó mới xóa đơn hàng chính
    $sqlOrder = "DELETE FROM orders WHERE id = ?";
    $stmtOrder = $this->pdo->prepare($sqlOrder);
    return $stmtOrder->execute([$id]);
}
}