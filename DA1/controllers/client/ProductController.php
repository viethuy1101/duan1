<?php
namespace controllers\client;

use Product;

require_once PATH_MODEL . 'Product.php';

class ProductController
{
    public function index()
    {
        $products = (new Product())->getAll();
        require PATH_VIEW . 'product/list.php';
    }

    public function detail()
    {
        $id = $_GET['id'] ?? 0;
        $product = (new Product())->getById($id);
        

        require_once PATH_VIEW . 'client/product/detail.php';
        
    }
    private function resizeImage($file, $width, $height)
    {
        $imageInfo = getimagesize($file);
        if (!$imageInfo) return;

        $mime = $imageInfo['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($file);
                break;
            case 'image/png':
                $source = imagecreatefrompng($file);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($file);
                break;
            default:
                return;
        }

        $originalWidth = imagesx($source);
        $originalHeight = imagesy($source);

        // Tính toán kích thước mới giữ tỷ lệ
        $ratio = min($width / $originalWidth, $height / $originalHeight);
        $newWidth = $originalWidth * $ratio;
        $newHeight = $originalHeight * $ratio;

        $resized = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

        // Lưu ảnh resized
        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($resized, $file, 90); // Chất lượng 90%
                break;
            case 'image/png':
                imagepng($resized, $file, 9); // Nén tối đa
                break;
            case 'image/gif':
                imagegif($resized, $file);
                break;
        }

        imagedestroy($source);
        imagedestroy($resized);
    }
}
?>