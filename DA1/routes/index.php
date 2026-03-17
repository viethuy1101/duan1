<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new HomeController)->index(),
    'detail' => (new ProductController())->detail(),
    'cart' => (new CartController())->index(),
        default => die('404'),

};