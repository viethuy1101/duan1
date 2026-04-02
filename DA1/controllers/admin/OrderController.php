<?php
namespace controllers\admin;

class OrderController {
    public function index() {
        // Dữ liệu mẫu để m thấy giao diện hoạt động
        $orders = [
            ['id' => 'DH001', 'customer_name' => 'Nguyễn Văn A', 'total' => '500,000đ', 'status' => 0],
            ['id' => 'DH002', 'customer_name' => 'Lê Thị B', 'total' => '1,200,000đ', 'status' => 1],
        ];

        // Gọi view đơn hàng
        require_once PATH_VIEW . 'admin/order/index.php';
    }
}