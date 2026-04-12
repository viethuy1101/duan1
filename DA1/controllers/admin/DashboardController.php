<?php
namespace controllers\admin;

class DashboardController {
    public function view($view, $data = []) {
        extract($data);
        include_once "views/admin/layout/header.php"; 
        include_once "views/admin/$view.php"; 
        echo '</div>';
        include_once "views/admin/layout/footer.php";
    }

   public function index() {
    $productModel = new \Product();
    
    $totalBooks = $productModel->countAll('books');
    $totalCats = $productModel->countAll('categories');
    $totalOrders = $productModel->countAll('orders');

    $latestBooks = $productModel->getLatest(5); 

    $sqlRevenue = "SELECT SUM(total_price) as total FROM orders WHERE status != 'canceled'";
    $stmt = connectDB()->query($sqlRevenue);
    $revenueData = $stmt->fetch();
    $totalRevenue = $revenueData['total'] ?? 0;

    $this->view('dashboard', [
        'totalProducts'   => $totalBooks,
        'totalCategories' => $totalCats,
        'totalOrders'     => $totalOrders,
        'totalRevenue'    => $totalRevenue,
        'latestBooks'     => $latestBooks
    ]);
}
}