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
            $variantId = $_POST['variant_id'] ?? null;

            // gọi model
            require_once PATH_MODEL . 'Product.php';
            $productModel = new \Product();
            $product = $productModel->getById($id);

            if (!$product) {
                die("Sản phẩm không tồn tại");
            }

            // Lấy giá: nếu có variant thì lấy giá variant, không thì lấy giá sản phẩm
            $price = $product['price'];
            $variantName = '';
            
            if ($variantId) {
                $db = connectDB();
                $stmt = $db->prepare("SELECT * FROM product_variants WHERE id = ? AND product_id = ?");
                $stmt->execute([$variantId, $id]);
                $variant = $stmt->fetch();
                
                if ($variant) {
                    $price = $variant['price'];
                    $variantName = $variant['variant_name'];
                }
            }

            // nếu chưa có giỏ
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Tạo key duy nhất cho combo product + variant
            $cartKey = $variantId ? $id . '_' . $variantId : $id;

            // nếu đã tồn tại → cộng thêm
            if (isset($_SESSION['cart'][$cartKey])) {
                $_SESSION['cart'][$cartKey]['quantity'] += $qty;
            } else {
                $_SESSION['cart'][$cartKey] = [
                    'id' => $id,
                    'variant_id' => $variantId,
                    'name' => $product['title'],
                    'variant_name' => $variantName,
                    'price' => $price,
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
