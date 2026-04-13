<?php
namespace models;

class BaseModel {
    protected $table;
    protected $pdo;

    public function __construct() {
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', DB_HOST, DB_PORT, DB_NAME);
        try {
            $this->pdo = new \PDO($dsn, DB_USERNAME, DB_PASSWORD); 
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function getAll() {
        return $this->pdo->query("SELECT * FROM {$this->table} ORDER BY id DESC")->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}