<?php

require_once PATH_MODEL . 'BaseModel.php';

class Product extends BaseModel
{
    protected $table = 'books';

    public function getAll()
{
    return $this->pdo->query("SELECT * FROM books")->fetchAll();
}

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // public function create($data)
    // {
    //     $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (title, author, price, description, image) VALUES (?, ?, ?, ?, ?)");
    //     $stmt->execute([$data['title'], $data['author'], $data['price'], $data['description'], $data['image']]);
    //     return $this->pdo->lastInsertId();
    // }
}