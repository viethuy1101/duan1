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
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }

    header("Location: " . BASE_URL);
    exit();
}
public function profile()
    {

        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "?action=login");
            exit();
        }

        $userId = $_SESSION['user']['id'];
        $orderModel = new Order(); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dataUpdate = [
                'name'    => $_POST['name'],
                'email'   => $_POST['email'],
                'phone'   => $_POST['phone'],
                'address' => $_POST['address']
            ];
            $this->userModel->updateProfile($userId, $dataUpdate);
            
            $_SESSION['user']['name'] = $_POST['name'];
            
            echo "<script>alert('Cập nhật thành công!'); window.location.href='?action=profile';</script>";
            exit();
        }

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

public function postReview()
{
    // 1. Kiểm tra đăng nhập
    if (!isset($_SESSION['user'])) {
        header("Location: " . BASE_URL . "?action=login");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_SESSION['user']['id'];
        $productId = $_POST['product_id'] ?? null;
        $orderId = $_POST['order_id'] ?? null;
        $rating = $_POST['rating'] ?? null;
        $comment = $_POST['comment'] ?? '';

        // 2. Validate dữ liệu
        if (!$productId || !$orderId || !$rating) {
            echo "<script>alert('Thiếu thông tin đánh giá!'); window.history.back();</script>";
            exit();
        }

        // 3. Kiểm tra trạng thái đơn hàng và quyền đánh giá
        $orderModel = new Order();
        $order = $orderModel->find($orderId);
        if (!$order || $order['user_id'] != $userId) {
            echo "<script>alert('Không tìm thấy đơn hàng hoặc bạn không có quyền đánh giá.'); window.history.back();</script>";
            exit();
        }

        $allowedReviewStatus = ['completed', 'delivered', 'đã hoàn thành'];
        $currentStatus = mb_strtolower(trim($order['status']));
        if (!in_array($currentStatus, $allowedReviewStatus, true)) {
            echo "<script>alert('Chỉ được đánh giá khi đơn hàng đã hoàn thành.'); window.history.back();</script>";
            exit();
        }

        $isReviewed = $orderModel->checkProductReviewed($productId, $orderId);
        if ($isReviewed) {
            echo "<script>alert('Bạn đã đánh giá sản phẩm này rồi!'); window.history.back();</script>";
            exit();
        }

        // 4. Thêm đánh giá
        $reviewData = [
            'product_id' => $productId,
            'user_id' => $userId,
            'order_id' => $orderId,
            'rating' => $rating,
            'comment' => $comment
        ];

        $result = $orderModel->addReview($reviewData);

        if ($result) {
            echo "<script>alert('Cảm ơn bạn đã đánh giá sản phẩm!'); window.location.href='?action=profile';</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra, vui lòng thử lại!'); window.history.back();</script>";
        }
    }
}
}