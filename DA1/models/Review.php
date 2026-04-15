<?php
namespace controllers\admin;

// Nạp file class cha - Hãy chắc chắn đường dẫn này đúng trong dự án của m
require_once "controllers/admin/BaseAdminController.php";

class ReviewController extends BaseAdminController {
    
    public function __construct() {
        // Kiểm tra xem class cha có tồn tại không để tránh lỗi
        if (!class_exists('controllers\admin\BaseAdminController')) {
            require_once "controllers/admin/BaseAdminController.php";
        }
        parent::__construct();
    }

    public function index() {
        // Kết nối database
        $db = connectDB(); 
      
        // Query lấy dữ liệu (đã sửa tên bảng books và cột name cho m)
        $sql = "SELECT r.*, u.name, b.title as product_name 
                FROM reviews r 
                JOIN users u ON r.user_id = u.id 
                JOIN books b ON r.product_id = b.id 
                ORDER BY r.created_at DESC";
        
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $listReviews = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        // Gọi hàm view để hiển thị giao diện
        // Nếu vẫn lỗi "undefined method view", nghĩa là BaseAdminController của m không có hàm view()
        $this->view('reviews/index', [
            'listReviews' => $listReviews
        ]);
    }

    public function toggleStatus() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = connectDB();
            $sql = "UPDATE reviews SET status = IF(status = 'show', 'hide', 'show') WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
        }
        header("Location: ?action=admin/reviews");
        exit;
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = connectDB();
            $sql = "DELETE FROM reviews WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
        }
        header("Location: ?action=admin/reviews");
        exit;
    }
}