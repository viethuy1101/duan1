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

    // Tạo đơn hàng mới và trả về ID
    public function createOrder(array $data): int
    {
        if ($this->insert($data)) {
            return (int)$this->pdo->lastInsertId();
        }

        throw new \Exception('Không thể tạo đơn hàng.');
    }

    // Lưu chi tiết đơn hàng vào bảng order_details
    public function createOrderDetails(int $order_id, array $cartItems): void
    {
        $sql = "INSERT INTO order_details (order_id, book_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);

        foreach ($cartItems as $book_id => $item) {
            $stmt->execute([
                $order_id,
                $book_id,
                (int)$item['quantity'],
                (float)$item['price']
            ]);
        }
    }

    // Tạo đơn hàng cùng chi tiết trong transaction
    public function saveOrderWithDetails(array $orderData, array $cartItems): int
    {
        try {
            $this->pdo->beginTransaction();

            $order_id = $this->createOrder($orderData);
            $this->createOrderDetails($order_id, $cartItems);

            $this->pdo->commit();
            return $order_id;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
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