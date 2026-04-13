<?php

namespace controllers\client;

use models\Order;
use models\User;

class AuthController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // Hàm render tự chế vì BaseModel của bạn chưa có
    public function render($view, $data = [])
    {
        extract($data);
        $viewPath = str_replace('.', '/', $view);
        include "views/{$viewPath}.php";
    }

    public function login()
    {
        $this->render('client.auth.login');
    }

    public function register()
    {
        $this->render('client.auth.register');
    }

    public function postRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name'     => $_POST['name'],
                'email'    => $_POST['email'],
                'password' => $_POST['password']
            ];

            if ($this->userModel->isEmailExists($data['email'])) {
                echo "<script>alert('Email đã tồn tại!'); window.history.back();</script>";
                return;
            }

            $this->userModel->register($data);
            header("Location: " . BASE_URL . "?action=login");
        }
    }

    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->checkLogin($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: " . BASE_URL);
            } else {
                echo "<script>alert('Sai tài khoản hoặc mật khẩu!'); window.history.back();</script>";
            }
        }
    }
    public function logout() {
    // 1. Xóa toàn bộ dữ liệu trong session liên quan đến user
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }

    // 2. (Tùy chọn) Hủy toàn bộ session nếu muốn an toàn tuyệt đối
    // session_destroy();

    // 3. Chuyển hướng về trang chủ hoặc trang đăng nhập
    header("Location: " . BASE_URL);
    exit();
}
public function profile()
    {
        // 1. Kiểm tra đăng nhập
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "?action=login");
            exit();
        }

        $userId = $_SESSION['user']['id'];
        $orderModel = new Order(); // Khởi tạo model đơn hàng

        // 2. Xử lý cập nhật thông tin cá nhân
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dataUpdate = [
                'name'    => $_POST['name'],
                'email'   => $_POST['email'],
                'phone'   => $_POST['phone'],
                'address' => $_POST['address']
            ];
            $this->userModel->updateProfile($userId, $dataUpdate);
            
            // Cập nhật lại session để hiển thị tên mới ngay lập tức
            $_SESSION['user']['name'] = $_POST['name'];
            
            echo "<script>alert('Cập nhật thành công!'); window.location.href='?action=profile';</script>";
            exit();
        }

        // 3. Lấy thông tin user và danh sách đơn hàng
        $user = $this->userModel->getUserById($userId);
        $orders = $orderModel->getOrdersByUserId($userId);

        // 4. Render view và truyền cả 'orderModel' để dùng cho nút "con mắt"
        $this->render('client.auth.profile', [
            'user'       => $user,
            'orders'     => $orders,
            'orderModel' => $orderModel 
        ]);
    }
public function orderDetail() {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        header("Location: ?action=profile");
        exit();
    }

    $orderModel = new \models\Order();
    
    // 1. Lấy thông tin đơn hàng (để lấy ngày đặt, tổng tiền, địa chỉ)
    $order = $orderModel->getOrderById($id);
    
    // 2. Lấy danh sách sản phẩm trong đơn đó (hàm bạn đã viết)
    $details = $orderModel->getOrderDetails($id);

    // 3. Tính ngày giao hàng dự kiến (Ví dụ: 3 ngày sau ngày đặt)
    $orderDate = strtotime($order['created_at']);
    $expectedDate = date('d/m/Y', strtotime('+3 days', $orderDate));

    $this->render('client.auth.order_detail', [
        'order' => $order,
        'details' => $details,
        'expectedDate' => $expectedDate
    ]);
}
}