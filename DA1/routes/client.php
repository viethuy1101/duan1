<?php

use controllers\client\HomeController;
use controllers\client\ProductController;
use controllers\client\CartController;
use controllers\client\CheckoutController;

match ($action) {
    '/' => (new HomeController())->index(),

    'detail' => (new ProductController())->detail(),

    // CART
    'cart' => (new CartController())->index(),
    'add-to-cart' => (new CartController())->add(),
    'delete-cart' => (new CartController())->delete(),
    'update-cart' => (new CartController())->update(),
    // CHECKOUT
    'checkout' => (new CheckoutController())->index(),
    'checkout-process' => (new CheckoutController())->process(),

    default => die('404 CLIENT'),
};
?>