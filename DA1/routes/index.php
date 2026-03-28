<?php

$action = $_GET['action'] ?? '/';

// nếu là admin
if (str_contains($action, 'admin')) {
    require_once 'admin.php';
} else {
    require_once 'client.php';
}