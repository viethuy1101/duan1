<?php
namespace controllers\admin;

use models\BaseModel;

class ReviewController extends BaseAdminController {
    public function index() {
        $db = connectDB();
        // JOIN để lấy tên người dùng và tên sách thật
        $sql = "SELECT r.*, u.username, p.name as product_name 
                FROM reviews r
                JOIN users u ON r.user_id = u.id
                JOIN products p ON r.product_id = p.id
                ORDER BY r.created_at DESC";
        
        $stmt = $db->query($sql);
        $listReviews = $stmt->fetchAll();

        // Gọi view (Dùng hàm view có sẵn của m)
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
}
}