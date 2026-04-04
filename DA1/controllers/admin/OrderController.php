<?php

namespace controllers\admin;

use models\Order;

class OrderController {
    protected $model;

    public function __construct() {
        $this->model = new Order();
    }

    public function index() {
        $orders = $this->model->getAll(); 
        view('order/index', compact('orders'), 'admin');
    }

    public function detail() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $order = $this->model->find($id); 
            $order_details = $this->model->getOrderDetails($id); 
            
            if ($order) {
                view('order/detail', compact('order', 'order_details'), 'admin');
                return;
            }
        }
        die("Không tìm thấy đơn hàng #$id m ơi!");
    }
}   