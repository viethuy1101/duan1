<?php

namespace models;

class Category extends BaseModel
{
    protected $table = 'categories';
     function getAll()
    {
        $sql = "SELECT c.*, COUNT(p.id) as total_books 
                FROM {$this->table} c 
                LEFT JOIN books p ON c.id = p.category_id 
                GROUP BY c.id 
                ORDER BY c.id DESC";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
   public function update($id, $data)
    {
        $sql = "UPDATE {$this->table} SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['name'], 
            $data['description'] ?? null,
            $id
        ]);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
}