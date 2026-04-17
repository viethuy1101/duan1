<?php
namespace controllers\client;

use Product;

require_once PATH_MODEL . 'Product.php';
require_once PATH_MODEL . 'Category.php';

class CategoryController
{
    public function index() {
        $id = $_GET['id'] ?? null;
        if (!$id) { 
            header("Location: index.php"); 
            exit(); 
        }

        $productModel = new Product();
        
        // If id is 'all', show all products
        if ($id === 'all') {
            $products = $productModel->getAll();
        } else {
            $db = connectDB();
            
            // Get category details
            $sqlCategory = "SELECT * FROM categories WHERE id = ?";
            $stmtCategory = $db->prepare($sqlCategory);
            $stmtCategory->execute([$id]);
            $category = $stmtCategory->fetch();

            if (!$category) { 
                echo "Danh mục không tồn tại!"; 
                exit(); 
            }

            // Get products in this category
            $products = $productModel->getByCategory($id);
        }

        require PATH_VIEW . 'client/product/list.php';
    }
}
?>