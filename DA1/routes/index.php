<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new HomeController)->index(),
    'detail' => (new ProductController())->detail(),
    'create' => (new ProductController())->create(),
    'cart' => (new CartController())->index(),
        default => die('404'),

};