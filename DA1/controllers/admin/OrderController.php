<?php

namespace controllers\admin;

// 1. Phải nạp Model Order vào đây để dùng
use models\Order;

class OrderController {
    protected $model;

    // 2. Tạo hàm __construct để khởi tạo kết nối database
    public function __construct()
    {
        $this->model = new Order();
    }

  public function index() {
    // Gọi hàm getAll() từ model để lấy dữ liệu từ bảng orders vừa chèn
    $orders = $this->model->getAll(); 

    // Đổ dữ liệu ra view
    view('order/index', compact('orders'), 'admin');
}

    public function detail() {
        // Lấy ID từ URL (ví dụ: ?action=admin/order/detail&id=1)
        $id = $_GET['id'] ?? null;

        if ($id) {
            // 4. Lấy thông tin chung của đơn hàng (tên khách, tổng tiền...)
            $order = $this->model->find($id); 
            
            // 5. Lấy danh sách các món hàng bên trong đơn đó
            $order_details = $this->model->getOrderDetails($id); 
            
            if ($order) {
                view('order/detail', compact('order', 'order_details'), 'admin');
                return;
            }
        }
        
        die("Không tìm thấy đơn hàng này m ơi!");
    }

    // 6. Thêm hàm xuất file mà t đã nói ở trên
    public function export() {
        $orders = $this->model->getAll();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=don_hang_bookverse.csv');
        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF)); // Fix lỗi font tiếng Việt
        fputcsv($output, ['Mã Đơn', 'Khách Hàng', 'Tổng Tiền', 'Ngày Đặt']);
        foreach ($orders as $row) {
    // Sửa 'customer_name' thành 'user_id' và 'total' thành 'total_price'
    fputcsv($output, [$row['id'], $row['user_id'], $row['total_price'], $row['created_at']]);
}
        fclose($output);
        exit();
    }
}