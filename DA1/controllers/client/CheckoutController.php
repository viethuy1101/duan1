<?php
declare(strict_types=1);

namespace controllers\client;

use models\BaseModel;

class CheckoutController extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    // Hiển thị trang thanh toán
    public function index() {
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
                $this->pdo->beginTransaction();

                // 1. Lưu vào bảng orders (Khớp hoàn toàn với các trường bạn đã thêm)
                $sql_order = "INSERT INTO orders (user_id, product_id, fullname, phone, address, note, total_money, status) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->pdo->prepare($sql_order);
                $stmt->execute([
                    $user_id, 
                    $first_product_id, 
                    $fullname, 
                    $phone, 
                    $address, 
                    $note, 
                    $total_money, 
                    'Chờ xác nhận'
                ]);
                
                $order_id = $this->pdo->lastInsertId();

                // 2. Lưu vào bảng order_details để quản lý số lượng sách
                $sql_detail = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
                $stmt_detail = $this->pdo->prepare($sql_detail);

                foreach ($_SESSION['cart'] as $p_id => $item) {
                    $stmt_detail->execute([
                        $order_id, 
                        $p_id, 
                        (int)$item['quantity'], 
                        (float)$item['price']
                    ]);
                }

                $this->pdo->commit();

                // Xóa giỏ hàng và chuyển hướng
                unset($_SESSION['cart']);
                header("Location: " . BASE_URL . "?action=order-success&id=" . $order_id);
                exit();

            } catch (\Exception $e) {
                $this->pdo->rollBack();
                die("Lỗi hệ thống khi đặt hàng: " . $e->getMessage());
            }
        }
    }

    public function success() {
        include_once PATH_VIEW . 'client/checkout/success.php';
    }
}