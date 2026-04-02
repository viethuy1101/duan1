<?php

// Định nghĩa lại hằng số PATH_VIEW chuẩn nhất nếu nó chưa có
if (!defined('PATH_VIEW')) {
    define('PATH_VIEW', __DIR__ . '/../views/');
}

if (!function_exists('debug')) {
    function debug($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>'; // Thêm đóng thẻ pre cho dễ nhìn
        die;
    }
}

if (!function_exists('upload_file')) {
    function upload_file($folder, $file)
    {
        $targetFile = $folder . '/' . time() . '-' . $file["name"];
        // Chú ý: Đảm bảo PATH_ASSETS_UPLOADS đã được định nghĩa
        if (move_uploaded_file($file["tmp_name"], PATH_ASSETS_UPLOADS . $targetFile)) {
            return $targetFile;
        }

        throw new Exception('Upload file không thành công!');
    }
}

if (!function_exists('connectDB')) {
    function connectDB()
    {
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', DB_HOST, DB_PORT, DB_NAME);

        try {
            return new PDO($dsn, DB_USERNAME, DB_PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
        }
    }
}
if (!function_exists('view')) {
    function view($viewName, $data = [], $type = 'client')
    {
        extract($data);
        
        // Đường dẫn file nội dung chính
        $viewPath = PATH_VIEW . $type . '/' . $viewName . '.php';

        if ($type === 'admin') {
            // Chỉ trang Admin mới tự động nạp Header và Sidebar chuẩn
            $headerPath  = PATH_VIEW . 'admin/layout/header.php';
            $sidebarPath = PATH_VIEW . 'admin/layout/sidebar.php';
            $footerPath  = PATH_VIEW . 'admin/layout/footer.php';

            if (file_exists($headerPath))  require_once $headerPath;
            if (file_exists($sidebarPath)) require_once $sidebarPath;
            
            if (file_exists($viewPath)) {
                require_once $viewPath;
            } else {
                die("Lỗi: Không tìm thấy view tại $viewPath");
            }

            if (file_exists($footerPath))  require_once $footerPath;
        } else {
            // Trang Client (Người dùng) thường có layout riêng, không dùng chung Sidebar Admin
            if (file_exists($viewPath)) {
                require_once $viewPath;
            }
        }
    }
}