<?php
class Product {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // --- HÀM CŨ MÀ CÁC CONTROLLER KHÁC ĐANG DÙNG ---
    public function getAll() {
        return $this->conn->query("SELECT * FROM books ORDER BY id DESC")->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM books WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Hàm find để hỗ trợ Controller gọi kiểu mới
    public function find($table, $id) {
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function insert($table, $data) {
        $keys = array_keys($data);
        $fields = implode(", ", $keys);
        $placeholders = ":" . implode(", :", $keys);
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $title = $data['title'] ?? '';
        $price = $data['price'] ?? 0;
        $image = $data['image'] ?? null;
        $stock = $data['stock'] ?? 0;
        $description = $data['description'] ?? null;
        $author = $data['author'] ?? null;
        $category_id = $data['category_id'] ?? null;

        $sql = "UPDATE books SET 
                    title = ?, 
                    price = ?, 
                    image = ?, 
                    stock = ?, 
                    description = ?, 
                    author = ?,
                    category_id = ?
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $title,
            $price,
            $image,
            $stock,
            $description,
            $author,
            $category_id,
            $id
        ]);
    }

    public function delete($table, $id) {
        $stmt = $this->conn->prepare("DELETE FROM $table WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function deleteVariantsByProductId($product_id) {
        $stmt = $this->conn->prepare("DELETE FROM product_variants WHERE product_id = ?");
        return $stmt->execute([$product_id]);
    }

    public function hasOrderReferences($product_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM order_details WHERE book_id = ?");
        $stmt->execute([$product_id]);
        return $stmt->fetchColumn() > 0;
    }

    public function countAll($table) {
        $sql = "SELECT COUNT(*) as total FROM $table";
        $result = $this->conn->query($sql)->fetch(); 
        return $result['total'] ?? 0;
    }

    public function getLatest($limit = 5) {
        $sql = "SELECT books.*, categories.name as category_name 
                FROM books 
                LEFT JOIN categories ON books.category_id = categories.id 
                ORDER BY books.id DESC 
                LIMIT $limit";
        return $this->conn->query($sql)->fetchAll();
    }

    // --- HÀM VỀ BIẾN THỂ (VARIANTS) ---
    public function getVariants($product_id) {
        $stmt = $this->conn->prepare("SELECT * FROM product_variants WHERE product_id = ?");
        $stmt->execute([$product_id]);
        return $stmt->fetchAll();
    }

    public function addVariant($product_id, $name, $price, $stock) {
    $product_id = (int) $product_id;
    $price      = (float) $price;
    $stock      = (int) $stock; 

    $sql = "INSERT INTO product_variants (product_id, variant_name, price, stock) VALUES (?, ?, ?, ?)";
    
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$product_id, $name, $price, $stock]);
}

    public function getVariantsByProductId($productId) {
        $sql = "SELECT * FROM product_variants WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetchAll();
    }

public function insertWithVariants($productData, $variants) {
    try {
        $this->conn->beginTransaction();
        

        $keys = array_keys($productData);
        $fields = implode(", ", $keys);
        $placeholders = ":" . implode(", :", $keys);
        $stmt = $this->conn->prepare("INSERT INTO books ($fields) VALUES ($placeholders)");
        $stmt->execute($productData);
        
        $productId = $this->conn->lastInsertId();


        if (!empty($variants['names'])) {
            $stmtVar = $this->conn->prepare("INSERT INTO product_variants (product_id, variant_name, price, stock) VALUES (?, ?, ?, ?)");
            foreach ($variants['names'] as $i => $name) {
                if (!empty($name)) {
                    $stmtVar->execute([
                        $productId, 
                        $name, 
                        $variants['prices'][$i] ?? 0, 
                        $variants['stocks'][$i] ?? 0
                    ]);
                }
            }
        }

        $this->conn->commit();
        return true;
    } catch (Exception $e) {
        $this->conn->rollBack();
        return false;
    }
}
}