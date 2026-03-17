<?php

require_once PATH_MODEL . 'BaseModel.php';

class Cart extends BaseModel
{
    public function getAll()
    {
        $sql = "SELECT c.*, b.title, b.price 
                FROM cart c
                JOIN books b ON c.book_id = b.id";

        return $this->pdo->query($sql)->fetchAll();
    }
}