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

    // Trong index() của ReviewController.php
public function index() {
    $db = connectDB();
    
    // Thống kê sơ bộ
    $countSql = "SELECT 
        COUNT(*) as total, 
        SUM(CASE WHEN status = 'show' THEN 1 ELSE 0 END) as showing,
        AVG(rating) as avg_rating 
        FROM reviews";
    $stats = $db->query($countSql)->fetch();

    $sql = "SELECT r.*, u.name, b.title as product_name 
            FROM reviews r 
            JOIN users u ON r.user_id = u.id 
            JOIN books b ON r.product_id = b.id 
            ORDER BY r.created_at DESC";
    
    $listReviews = $db->query($sql)->fetchAll();
    
    $this->view('reviews/index', [
        'listReviews' => $listReviews,
        'stats' => $stats
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