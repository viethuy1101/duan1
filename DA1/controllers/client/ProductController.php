<?php
namespace controllers\client;

use Product;

require_once PATH_MODEL . 'Product.php';
require_once PATH_MODEL . 'Order.php';

class ProductController
{
    public function index()
    {
        $products = (new Product())->getAll();
        require PATH_VIEW . 'client/product/list.php';
    }

    public function detail() {
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: index.php"); exit(); }

        $db = connectDB();    
        
        // CHỖ SỬA QUAN TRỌNG: Đổi products thành books cho khớp DB của m
        $sqlProduct = "SELECT * FROM books WHERE id = ?";
        $stmtProduct = $db->prepare($sqlProduct);
        $stmtProduct->execute([$id]);
        $product = $stmtProduct->fetch();

        if (!$product) { echo "Sản phẩm không tồn tại!"; exit(); }

        // Lấy danh sách biến thể
        $sqlVariants = "SELECT * FROM product_variants WHERE product_id = ? ORDER BY id ASC";
        $stmtVariants = $db->prepare($sqlVariants);
        $stmtVariants->execute([$id]);
        $variants = $stmtVariants->fetchAll();

        // Lấy danh sách đánh giá
        $sqlReviews = "SELECT r.*, u.name 
                       FROM reviews r 
                       JOIN users u ON r.user_id = u.id 
                       WHERE r.product_id = ? AND r.status = 'show' 
                       ORDER BY r.created_at DESC";
        $stmtReviews = $db->prepare($sqlReviews);
        $stmtReviews->execute([$id]);
        $reviews = $stmtReviews->fetchAll(); 

        // Đổ dữ liệu ra view (Dùng require cho chắc chắn giống hàm index của m)
        require PATH_VIEW . 'client/product/detail.php'; 
    }

    public function postReview() {
        // Kiểm tra đăng nhập trước khi cho đánh giá
        if (!isset($_SESSION['user'])) {
            echo "<script>alert('M phải đăng nhập mới đánh giá được!'); window.history.back();</script>";
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            $userId = $_SESSION['user']['id']; 
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];
            $orderId = $_POST['order_id'] ?? null;

            $db = connectDB();
            $sql = "INSERT INTO reviews (product_id, user_id, rating, comment, order_id, status, created_at) 
                    VALUES (?, ?, ?, ?, ?, 'show', NOW())";
            
            $stmt = $db->prepare($sql);
            $stmt->execute([$productId, $userId, $rating, $comment, $orderId]);

            // Quay lại trang chi tiết đúng action
            header("Location: index.php?action=product-detail&id=" . $productId);
            exit();
        }
    }

    // Giữ nguyên hàm resizeImage của m nếu m có dùng ở đâu đó
    private function resizeImage($file, $width, $height)
    {
        $imageInfo = getimagesize($file);
        if (!$imageInfo) return;
        $mime = $imageInfo['mime'];
        switch ($mime) {
            case 'image/jpeg': $source = imagecreatefromjpeg($file); break;
            case 'image/png': $source = imagecreatefrompng($file); break;
            case 'image/gif': $source = imagecreatefromgif($file); break;
            default: return;
        }
        $originalWidth = imagesx($source);
        $originalHeight = imagesy($source);
        $ratio = min($width / $originalWidth, $height / $originalHeight);
        $newWidth = $originalWidth * $ratio;
        $newHeight = $originalHeight * $ratio;
        $resized = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
        switch ($mime) {
            case 'image/jpeg': imagejpeg($resized, $file, 90); break;
            case 'image/png': imagepng($resized, $file, 9); break;
            case 'image/gif': imagegif($resized, $file); break;
        }
        imagedestroy($source);
        imagedestroy($resized);
    }
}