<?php
class Product {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM books")->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM books WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Hàm này để lưu sản phẩm mới
    public function insert($data) {
        $sql = "INSERT INTO books (title, author, price, description, image, stock, category_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        
        return $stmt->execute([
            $data['title'] ?? null,
            $data['author'] ?? null,
            $data['price'] ?? 0,
            $data['description'] ?? null,
            $data['image'] ?? null,
            $data['stock'] ?? 0,
            $data['category_id'] ?? null
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE books SET 
                    title = ?, 
                    price = ?, 
                    image = ?, 
                    stock = ?, 
                    description = ?, 
                    author = ? 
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['title'], 
            $data['price'], 
            $data['image'], 
            $data['stock'],
            $data['description'] ?? null,
            $data['author'] ?? null,
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM books WHERE id=?");
        return $stmt->execute([$id]);
    }
} 
?>