<?php

use controllers\client\HomeController;
use controllers\client\ProductController;
use controllers\client\CartController;
use controllers\client\CheckoutController;
use controllers\client\AuthController;

match ($action) {
    '/' => (new HomeController())->index(),

    'detail' => (new ProductController())->detail(),

    // AUTH (Đăng nhập - Đăng ký)
    'register' => (new AuthController())->register(),
    'login' => (new AuthController())->login(),
    'post-login' => (new AuthController())->postLogin(),
    'post-register' => (new AuthController())->postRegister(),
    'logout' => (new AuthController())->logout(),
    'profile' => (new AuthController())->profile(),
    'post-review' => (new AuthController())->postReview(),
    'order-detail' => (new AuthController())->orderDetail(),

    // CART
    'cart' => (new CartController())->index(),
    'add-to-cart' => (new CartController())->add(),
    'delete-cart' => (new CartController())->delete(),
    'update-cart' => (new CartController())->update(),
    // CHECKOUT
    'checkout' => (new CheckoutController())->index(),
    'checkout-process' => (new CheckoutController())->process(),
    'order-success' => (new CheckoutController())->success(),

    default => die('404 CLIENT'),
};
?>