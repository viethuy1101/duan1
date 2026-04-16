<?php
namespace controllers\admin;

class DashboardController extends BaseAdminController {
    public function __construct() {
        parent::__construct();
    }

    public function view($view, $data = []) {
        extract($data);
        include_once "views/admin/layout/header.php"; 
        include_once "views/admin/$view.php"; 
        echo '</div>'; 
        include_once "views/admin/layout/footer.php";
    }

    public function index() {
        $db = connectDB();
        
        $startDate = $_GET['start_date'] ?? date('Y-m-d', strtotime('-30 days'));
        $endDate = $_GET['end_date'] ?? date('Y-m-d');

        $sql = "SELECT SUM(total_money) as revenue, COUNT(id) as orders 
                FROM orders 
                WHERE DATE(created_at) BETWEEN ? AND ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        $result = $stmt->fetch();

        $totalProducts = $db->query("SELECT COUNT(id) FROM books")->fetchColumn() ?: 0;
        $totalCategories = $db->query("SELECT COUNT(id) FROM categories")->fetchColumn() ?: 0;
        
        $newestBooks = $db->query("SELECT b.*, c.name as category_name 
                                   FROM books b 
                                   LEFT JOIN categories c ON b.category_id = c.id 
                                   ORDER BY b.id DESC LIMIT 5")->fetchAll();

        $this->view('dashboard', [
            'totalRevenue'  => $result['revenue'] ?? 0,
            'totalOrders'   => $result['orders'] ?? 0,
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
            'newestBooks'   => $newestBooks, 
            'startDate'     => $startDate,
            'endDate'       => $endDate
        ]);
    }
}