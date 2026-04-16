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
                JOIN books b ON od.book_id = b.id 
                WHERE od.order_id = ?";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAll($search = null) {
        if ($search) {
            $search = trim($search);
            if (ctype_digit($search)) {
                $sql = "SELECT * FROM {$this->table} WHERE id = ? ORDER BY id DESC";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$search]);
            } else {
                $sql = "SELECT * FROM {$this->table} WHERE fullname LIKE ? OR phone LIKE ? ORDER BY id DESC";
                $like = '%' . $search . '%';
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$like, $like]);
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

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
        $sql = "SELECT SUM(total_money) FROM orders WHERE LOWER(status) IN ('completed', 'delivered')";
        $revenue = $this->pdo->query($sql)->fetchColumn();
        return $revenue ? $revenue : 0;
    }

    public function getAllOrdersForExport() {
        $sql = "SELECT id, fullname as receiver_name, total_money as total_price, status, created_at FROM orders ORDER BY id DESC";
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

    // Lấy danh sách đơn hàng của một user
    public function getOrdersByUserId($userId) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function saveOrderWithDetails($orderData, $cartItems) {
        try {
            $this->pdo->beginTransaction();

            // 1. Lưu đơn hàng chính
            $sqlOrder = "INSERT INTO orders (user_id, fullname, phone, address, note, total_money, status) 
                         VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmtOrder = $this->pdo->prepare($sqlOrder);
            $stmtOrder->execute([
                $orderData['user_id'] ?? null,
                $orderData['fullname'],
                $orderData['phone'],
                $orderData['address'],
                $orderData['note'] ?? '',
                $orderData['total_money'],
                $orderData['status'] ?? 'Pending'
            ]);

            $orderId = $this->pdo->lastInsertId();

            // 2. Lưu chi tiết sản phẩm từ giỏ hàng
            if (!empty($cartItems) && is_array($cartItems)) {
                $sqlDetail = "INSERT INTO order_details (order_id, book_id, quantity, price) VALUES (?, ?, ?, ?)";
                $stmtDetail = $this->pdo->prepare($sqlDetail);

                foreach ($cartItems as $item) {
                    $stmtDetail->execute([
                        $orderId,
                        $item['product_id'] ?? $item['id'],
                        $item['quantity'] ?? 1,
                        $item['price'] ?? 0
                    ]);
                }
            }

            $this->pdo->commit();
            return $orderId;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
    public function addReview($data) {
        $sql = "INSERT INTO reviews (product_id, user_id, order_id, rating, comment) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->query($sql, [
            $data['product_id'],
            $data['user_id'],
            $data['order_id'],
            $data['rating'],
            $data['comment']
        ]);
        return $stmt->rowCount() > 0;
    }

    public function getReviewsByProductId($productId) {
        $sql = "SELECT r.*, u.name as user_name 
                FROM reviews r 
                JOIN users u ON r.user_id = u.id 
                WHERE r.product_id = ? AND r.status = 'show' 
                ORDER BY r.id DESC";
        return $this->query($sql, [$productId])->fetchAll();
    }

    public function checkProductReviewed($productId, $orderId) {
        $sql = "SELECT id FROM reviews WHERE product_id = ? AND order_id = ?";
        return $this->query($sql, [$productId, $orderId])->fetch();
}
    }