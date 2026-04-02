<?php
namespace controllers\client;

use Product;

class HomeController
{
    public function index() 
    {

        $products = (new Product())->getAll();
        $content = PATH_VIEW . 'client/home.php';

        require PATH_VIEW . 'client/layout/main.php';
    }
}
?>