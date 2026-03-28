<?php

use controllers\client\HomeController;
use controllers\client\ProductController;
use controllers\client\CartController;

match ($action) {
    '/' => (new HomeController())->index(),
    'detail' => (new ProductController())->detail(),
    'cart' => (new CartController())->index(),

    default => die('404 CLIENT'),
};