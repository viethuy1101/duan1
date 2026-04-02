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

    public function create($data) {
    // Thêm cột stock vào câu lệnh INSERT
    $stmt = $this->conn->prepare("INSERT INTO books(title, price, image, stock) VALUES(?,?,?,?)");
    return $stmt->execute([
        $data['title'], 
        $data['price'], 
        $data['image'], 
        $data['stock'] // Lấy dữ liệu từ ô input stock
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