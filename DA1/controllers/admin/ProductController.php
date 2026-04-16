<?php
namespace controllers\admin;

require_once PATH_MODEL . 'Product.php';

class ProductController extends BaseAdminController {
    private $model;

    public function __construct() {
        parent::__construct();
        $this->model = new \Product(); 
    }

    public function view($view, $data = []) {
        extract($data);
        include_once "views/admin/layout/header.php"; 
        
        $viewPath = "views/admin/$view.php";
        if (file_exists($viewPath)) {
            include_once $viewPath;
        } else {
            echo "Lỗi: Không tìm thấy file view tại $viewPath";
        }

        echo '</div>'; 
        include_once "views/admin/layout/footer.php";
    }

    public function index() {
        $products = $this->model->getAll();
        $this->view('product/index', compact('products'));
    }

    public function create() {
        $db = connectDB();
        $categories = $db->query("SELECT * FROM categories")->fetchAll();
        $this->view('product/create', ['categories' => $categories]);
    }

    public function store() {
        $db = connectDB();

        $title = $_POST['title'] ?? '';
        $price = $_POST['price'] ?? 0;
        $author = $_POST['author'] ?? '';
        $category_id = $_POST['category_id'] ?? null;
        $description = $_POST['description'] ?? '';

        $image = "";
        if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] == 0) {
            $image = time() . "_" . $_FILES['image_upload']['name'];
            move_uploaded_file($_FILES['image_upload']['tmp_name'], "assets/uploads/img/" . $image);
        }

        // Bước 1: Tính tổng stock từ các biến thể trước khi lưu
        $totalStock = 0;
        if (isset($_POST['variant_stocks']) && is_array($_POST['variant_stocks'])) {
            $totalStock = array_sum($_POST['variant_stocks']);
        } else {
            $totalStock = $_POST['stock'] ?? 0; // Nếu không có biến thể thì lấy stock chính
        }

        $sql = "INSERT INTO books (title, author, price, description, image, stock, category_id, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $db->prepare($sql);
        $stmt->execute([$title, $author, $price, $description, $image, $totalStock, $category_id]);

        $productId = $db->lastInsertId();

        // Lưu biến thể
        if (isset($_POST['variant_names']) && is_array($_POST['variant_names'])) {
            foreach ($_POST['variant_names'] as $index => $vName) {
                if (!empty($vName)) {
                    $vPrice = $_POST['variant_prices'][$index] ?? $price;
                    $vStock = $_POST['variant_stocks'][$index] ?? 0;

                    $vSql = "INSERT INTO product_variants (product_id, variant_name, price, stock) VALUES (?, ?, ?, ?)";
                    $vStmt = $db->prepare($vSql);
                    $vStmt->execute([$productId, $vName, $vPrice, $vStock]);
                }
            }
        }

        header("Location: ?action=admin/product");
        exit();
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: ?action=admin/product"); exit(); }

        $product = $this->model->getById($id);
        $variants = $this->model->getVariantsByProductId($id);
        
        $db = connectDB();
        $categories = $db->query("SELECT * FROM categories")->fetchAll();

        $this->view('product/edit', [ 
            'product'    => $product,
            'variants'   => $variants,
            'categories' => $categories
        ]);
    }

   public function update($id = null) {
        $id = $id ?? $_GET['id'];
        $data = $_POST;
        $product = $this->model->getById($id);
        $db = connectDB();

        // Cập nhật biến thể hiện có
        if (isset($_POST['variant_id']) && is_array($_POST['variant_id'])) {
            $variantPrices = $_POST['variant_price'] ?? [];
            $variantStocks = $_POST['variant_stock'] ?? [];
            $stmtVariant = $db->prepare("UPDATE product_variants SET price = ?, stock = ? WHERE id = ?");
            foreach ($_POST['variant_id'] as $index => $variantId) {
                $stmtVariant->execute([
                    $variantPrices[$index] ?? 0,
                    $variantStocks[$index] ?? 0,
                    $variantId
                ]);
            }
        }

        // Thêm biến thể mới nếu form gửi
        if (!empty(trim($_POST['new_variant_name'] ?? ''))) {
            $this->model->addVariant(
                $id,
                trim($_POST['new_variant_name']),
                $_POST['new_variant_price'] ?? 0,
                $_POST['new_variant_stock'] ?? 0
            );
        }

        // Tự động tính lại kho tổng từ bảng biến thể để cập nhật vào bảng books
        $vStmt = $db->prepare("SELECT SUM(stock) as total FROM product_variants WHERE product_id = ?");
        $vStmt->execute([$id]);
        $result = $vStmt->fetch();
        $stockFromForm = $_POST['stock'] ?? $product['stock'] ?? 0;
        $data['stock'] = ($result && $result['total'] !== null) ? $result['total'] : $stockFromForm;

        if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] === 0 && $_FILES['image_upload']['size'] > 0) {
            $filename = time() . '_' . $_FILES['image_upload']['name'];
            move_uploaded_file($_FILES['image_upload']['tmp_name'], 'assets/uploads/img/' . $filename);
            $data['image'] = $filename;
        } else {
            $data['image'] = $_POST['current_image'];
        }

        if ($this->model->update($id, $data)) {
            header("Location: ?action=admin/product");
            exit();
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: ?action=admin/product");
            exit();
        }

        if ($this->model->hasOrderReferences($id)) {
            header("Location: ?action=admin/product&delete_error=order");
            exit();
        }

        // Xóa biến thể trước để tránh xung đột FK nếu có
        $this->model->deleteVariantsByProductId($id);

        if ($this->model->delete('books', $id)) {
            header("Location: ?action=admin/product");
            exit();
        }
    }

    public function addVariant() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = $_POST['product_id'];
            $this->model->addVariant($productId, $_POST['variant_name'], $_POST['price'], $_POST['stock']);
            header("Location: ?action=admin/product/edit&id=" . $productId);
        }
    }

    public function deleteVariant() {
        $variantId = $_GET['id'];
        $productId = $_GET['product_id'];

        // Xóa biến thể
        $this->model->delete('product_variants', $variantId);

        // Sau khi xóa biến thể, phải cập nhật lại kho tổng của sách đó ngay
        $db = connectDB();
        $vStmt = $db->prepare("SELECT SUM(stock) as total FROM product_variants WHERE product_id = ?");
        $vStmt->execute([$productId]);
        $result = $vStmt->fetch();
        $newTotalStock = $result['total'] ?? 0;

        $updateSql = "UPDATE books SET stock = ? WHERE id = ?";
        $db->prepare($updateSql)->execute([$newTotalStock, $productId]);

        header("Location: ?action=admin/product/edit&id=" . $productId);
        exit();
    }
}