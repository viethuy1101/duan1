<?php
declare(strict_types=1);

namespace controllers\client;

use models\Order;
use models\User;

class CheckoutController {
    protected Order $orderModel;
    protected User $userModel;

    public function __construct() {
        $this->orderModel = new Order();
        $this->userModel = new User();
    }

    // Hiển thị trang thanh toán
    public function index() {
        $currentUser = null;
        if (isset($_SESSION['user'])) {
            // Lấy dữ liệu mới nhất từ DB (bao gồm phone, address vừa thêm)
            $currentUser = $this->userModel->getUserById($_SESSION['user']['id']);
        }

        $subtotal = 0;
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
        }
        $shipping = 30000;
        $total_money = $subtotal + $shipping;

        include_once PATH_VIEW . 'client/checkout/index.php';
    }

    // Xử lý lưu đơn hàng
    public function process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_place_order'])) {
            $fullname = $_POST['fullname'] ?? '';
            $phone    = $_POST['phone'] ?? '';
            $address  = $_POST['address'] ?? '';
            $note     = $_POST['note'] ?? '';
            $user_id  = $_SESSION['user']['id'] ?? null;
            
            // Lấy ID sản phẩm đầu tiên từ giỏ hàng để lưu vào trường mới thêm của bảng orders
            $product_ids = array_keys($_SESSION['cart']);
            $first_product_id = $product_ids[0] ?? null;

            $subtotal = 0;
            foreach ($_SESSION['cart'] as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
            $total_money = $subtotal + 30000;

            try {
                $orderData = [
                    'user_id' => $user_id,
                    'product_id' => $first_product_id,
                    'fullname' => $fullname,
                    'phone' => $phone,
                    'address' => $address,
                    'note' => $note,
                    'total_money' => $total_money,
                    'status' => 'Chờ xác nhận'
                ];

                $order_id = $this->orderModel->saveOrderWithDetails($orderData, $_SESSION['cart']);

                // Xóa giỏ hàng và chuyển hướng
                unset($_SESSION['cart']);
                header("Location: " . BASE_URL . "?action=order-success&id=" . $order_id);
                exit();

            } catch (\Exception $e) {
                die("Lỗi hệ thống khi đặt hàng: " . $e->getMessage());
            }
        }
    }

    public function success() {
        include_once PATH_VIEW . 'client/checkout/success.php';
    }
}