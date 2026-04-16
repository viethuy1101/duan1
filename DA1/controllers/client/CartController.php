<?php
namespace controllers\client;

class CartController
{
    public function index()
    {
         if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        require_once PATH_VIEW . 'client/cart/index.php';
    }

    // Thêm vào giỏ hàng
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id'];
            $qty = $_POST['quantity'];

            // gọi model
            require_once PATH_MODEL . 'Product.php';
            $productModel = new \Product();
            $product = $productModel->getById($id);

            if (!$product) {
                die("Sản phẩm không tồn tại");
            }

            // nếu chưa có giỏ
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // nếu đã tồn tại → cộng thêm
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity'] += $qty;
            } else {
                $_SESSION['cart'][$id] = [
                    'id' => $id,
                    'name' => $product['title'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'quantity' => $qty
                ];
            }

            // redirect về giỏ hàng
            header("Location: " . BASE_URL . "?action=cart");
            exit;
        }
    }

    // Xóa sản phẩm
    public function delete() {
        $id = $_GET['id'];

        unset($_SESSION['cart'][$id]);

        header("Location: " . BASE_URL . "?action=cart");
        exit;
    }

    // Cập nhật số lượng
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST['qty'] as $id => $qty) {
                $_SESSION['cart'][$id]['quantity'] = $qty;
            }

            header("Location: " . BASE_URL . "?action=cart");
            exit;
    }
    }
}
