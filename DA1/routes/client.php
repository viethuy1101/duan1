<?php

use controllers\client\HomeController;
use controllers\client\ProductController;
use controllers\client\CategoryController;
use controllers\client\CartController;
use controllers\client\CheckoutController;
use controllers\client\AuthController;

match ($action) {
    // Trang chủ
    '/' => (new HomeController())->index(),
    ''  => (new HomeController())->index(), // Thêm trường hợp action trống

    // CATEGORY
    'category' => (new CategoryController())->index(),

    // PRODUCT - Đổi tên cho chuyên nghiệp và khớp redirect
    'product-detail' => (new ProductController())->detail(),
    'detail'         => (new ProductController())->detail(), // Giữ lại detail để không lỗi link cũ
    'post-review'    => (new ProductController())->postReview(), // CHỈ ĐỂ Ở ĐÂY

    // AUTH (Đăng nhập - Đăng ký)
    'register'      => (new AuthController())->register(),
    'login'         => (new AuthController())->login(),
    'post-login'    => (new AuthController())->postLogin(),
    'post-register' => (new AuthController())->postRegister(),
    'logout'        => (new AuthController())->logout(),
    'profile'       => (new AuthController())->profile(),
    'order-detail'  => (new AuthController())->orderDetail(),
    // XÓA cái post-review ở Auth đi nhé

    // CART
    'cart'        => (new CartController())->index(),
    'add-to-cart' => (new CartController())->add(),
    'delete-cart' => (new CartController())->delete(),
    'update-cart' => (new CartController())->update(),

    // CHECKOUT
    'checkout'         => (new CheckoutController())->index(),
    'checkout-process' => (new CheckoutController())->process(),
    'order-success'    => (new CheckoutController())->success(),

    default => die('404 CLIENT - Không tìm thấy action: ' . htmlspecialchars($action)),
};
?>