<?php
// 1. URL cơ bản
define('BASE_URL', 'http://localhost/duan1-master/DA1/');

// 2. Đường dẫn thư mục gốc - Dùng __DIR__ và lùi ra 1 cấp để ra khỏi thư mục configs
define('PATH_ROOT', __DIR__ . '/../');

// 3. Đường dẫn các thư mục con
define('PATH_VIEW',       PATH_ROOT . 'views/');
define('PATH_CONTROLLER', PATH_ROOT . 'controllers/');
define('PATH_MODEL',      PATH_ROOT . 'models/');

// 4. Đường dẫn Assets/Uploads
define('BASE_ASSETS_UPLOADS', BASE_URL . 'assets/uploads/');
define('PATH_ASSETS_UPLOADS', PATH_ROOT . 'assets/uploads/');

// 5. Cấu hình Database
define('DB_HOST',     'localhost');
define('DB_PORT',     '3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME',     'duan1_wd21103');
?>