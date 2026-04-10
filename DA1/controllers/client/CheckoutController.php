<?php
declare(strict_types=1);

// Namespace phải khớp với cấu trúc thư mục của bạn
namespace controllers\client;

class CheckoutController {
    /**
     * Hiển thị trang thanh toán
     */
    public function index() {
        global $conn; // Đảm bảo biến kết nối database có sẵn

        // 1. Tính toán số tiền để hiển thị trên View
        $subtotal = 0;
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
        }
        $shipping = 30000;
        $total_money = $subtotal + $shipping;

        // 2. Gọi sang file View index của checkout để bắt đầu luồng nạp Layout
        // Đường dẫn này phải trỏ đúng vào thư mục views/client/checkout/ của bạn
        include_once PATH_VIEW . 'client/checkout/index.php'; 
    }

    /**
     * Xử lý lưu đơn hàng khi người dùng nhấn đặt hàng
     */
    public function process() {
        global $conn;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_place_order'])) {
            // Lấy dữ liệu từ form và xử lý bảo mật cơ bản
            $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
            $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
            $address  = mysqli_real_escape_string($conn, $_POST['address']);
            $note     = mysqli_real_escape_string($conn, $_POST['note']);
            
            // Tính lại tổng tiền để đảm bảo tính chính xác trước khi lưu
            $subtotal = 0;
            foreach ($_SESSION['cart'] as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
            $total_money = $subtotal + 30000;

            // Bước A: Lưu vào bảng orders
            $sql_order = "INSERT INTO orders (fullname, phone, address, note, total_money) 
                          VALUES ('$fullname', '$phone', '$address', '$note', '$total_money')";
            
            if (mysqli_query($conn, $sql_order)) {
                $order_id = mysqli_insert_id($conn);

                // Bước B: Lưu chi tiết từng sản phẩm vào bảng order_details
                foreach ($_SESSION['cart'] as $product_id => $item) {
                    $qty = (int)$item['quantity'];
                    $price = (float)$item['price'];
                    $sql_detail = "INSERT INTO order_details (order_id, product_id, quantity, price) 
                                   VALUES ('$order_id', '$product_id', '$qty', '$price')";
                    mysqli_query($conn, $sql_detail);
                }

                // Bước C: Xóa giỏ hàng và chuyển trang thành công
                unset($_SESSION['cart']);
                header("Location: " . BASE_URL . "?action=order-success&id=" . $order_id);
                exit();
            }
        }
    }
}