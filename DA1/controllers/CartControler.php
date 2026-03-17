<?php

require_once PATH_MODEL . 'Cart.php';

class CartController
{
    public function index()
    {
        $cart = (new Cart())->getAll();
        require PATH_VIEW . 'cart/index.php';
    }
}