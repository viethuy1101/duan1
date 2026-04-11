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
    $totalCats  = $productModel->countAll('categories'); 
    $totalOrders = $productModel->countAll('orders');

    $this->view('dashboard', [
        'title'          => 'Dashboard',
        'totalProducts'  => $totalBooks,
        'totalCategories' => $totalCats,
        'totalOrders'    => $totalOrders
    ]);
}
}