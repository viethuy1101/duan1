<?php

class HomeController
{
    public function index() 
    {

     $products = (new Product())->getAll();
        $content = PATH_VIEW . 'home.php';
        
        require PATH_VIEW . 'layout/main.php';
    }
}