<?php 

session_start();

spl_autoload_register(function ($class) {
    $normalized = str_replace('\\', '/', $class);

    $candidates = [
        PATH_MODEL . $normalized . '.php',
        PATH_CONTROLLER . $normalized . '.php',
        PATH_ROOT . $normalized . '.php',
    ];

    if (str_starts_with($normalized, 'controllers/')) {
        $candidates[] = PATH_CONTROLLER . substr($normalized, strlen('controllers/')) . '.php';
    }

    if (str_starts_with($normalized, 'models/')) {
        $candidates[] = PATH_MODEL . substr($normalized, strlen('models/')) . '.php';
    }

    foreach ($candidates as $file) {
        if (is_readable($file)) {
            require_once $file;
            return;
        }
    }
});

require_once './configs/env.php';
require_once './configs/helper.php';

// Điều hướng
require_once './routes/index.php';
