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
        $stmt = $this->conn->prepare("INSERT INTO books(title,price,image) VALUES(?,?,?)");
        return $stmt->execute([$data['title'], $data['price'], $data['image']]);
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE books SET title=?,price=?,image=? WHERE id=?");
        return $stmt->execute([$data['title'], $data['price'], $data['image'], $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM books WHERE id=?");
        return $stmt->execute([$id]);
    }
}