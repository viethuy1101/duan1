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

    // public function create()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         // Xử lý upload ảnh
    //         $image = '';
    //         if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    //             $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    //             $fileType = $_FILES['image']['type'];
    //             if (in_array($fileType, $allowedTypes)) {
    //                 $uploadDir = PATH_ROOT . 'assets/uploads/img/';
    //                 if (!is_dir($uploadDir)) {
    //                     mkdir($uploadDir, 0755, true);
    //                 }
    //                 $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
    //                 $uploadFile = $uploadDir . $fileName;

    //                 if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
    //                     // Resize ảnh về 300x300
    //                     $this->resizeImage($uploadFile, 300, 300);
    //                     $image = 'img/' . $fileName; // Lưu đường dẫn tương đối
    //                 }
    //             }
    //         }

    //         $data = [
    //             'title' => $_POST['title'] ?? '',
    //             'author' => $_POST['author'] ?? '',
    //             'price' => $_POST['price'] ?? 0,
    //             'description' => $_POST['description'] ?? '',
    //             'image' => $image
    //         ];

    //         (new Product())->create($data);
    //         header('Location: ' . BASE_URL);
    //         exit;
    //     }

    //     require PATH_VIEW . 'product/create.php';
    // }

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