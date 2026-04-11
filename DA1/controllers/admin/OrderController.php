<?php

namespace controllers\admin;

use models\Order;

// Sửa lại đường dẫn nạp file: lùi 1 cấp ra ngoài folder admin để vào controllers
if (file_exists('controllers/BaseController.php')) {
    require_once 'controllers/BaseController.php';
}

class OrderController {
    protected $model;

    public function __construct() {
        $this->model = new Order();
    }

    // Hàm view dự phòng để không bao giờ bị lỗi "Call to undefined method" nữa
    public function view($view, $data = [], $layout = 'admin') {
    extract($data);
    $viewPath = "views/$view.php";
    
    // Nạp header có chứa Sidebar m vừa sửa ở Bước 1
    include_once "views/admin/layout/header.php"; 
    
    // Nạp nội dung trang (ví dụ: index.php hoặc detail.php của đơn hàng)
    include_once $viewPath; 
    
    // Đóng thẻ main-content và nạp footer
    echo '</div>'; // Đóng cái div main-content ở header
    include_once "views/admin/layout/footer.php";
}

    public function index() {
        $orders = $this->model->getAll(); 
        $totalOrders = $this->model->countTotalOrders();
        $pendingOrders = $this->model->countPendingOrders();
        $totalRevenue = $this->model->sumTotalRevenue();

        return $this->view('admin/order/index', compact('orders', 'totalOrders', 'pendingOrders', 'totalRevenue'));
    }

    public function detail() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $order = $this->model->find($id); 
            $order_details = $this->model->getOrderDetails($id); 
            
            if ($order) {
                return $this->view('admin/order/detail', compact('order', 'order_details'));
            }
        }
        die("Không tìm thấy đơn hàng #$id m ơi!");
    }
}