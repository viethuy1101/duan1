<?php
// views/client/checkout/index.php

// 1. Gọi Controller để xử lý logic (Tính toán tổng tiền, lưu DB)
require_once PATH_CONTROLLER . 'client/CheckoutController.php'; 

// 2. Chuyển sang file trung gian để nạp giao diện
require_once 'checkout.php'; 
?>