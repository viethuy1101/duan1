<?php
namespace controllers\admin;

class DashboardController {
    public function index() {
        view('dashboard', ['title' => 'Dashboard'], 'admin');
    }
}
?>