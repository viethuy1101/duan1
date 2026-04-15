<?php
namespace controllers\admin;
use models\Order;

if (file_exists('controllers/BaseController.php')) {
    require_once 'controllers/BaseController.php';
}

class OrderController extends BaseAdminController {
    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new Order();
    }

    public function view($view, $data = [], $layout = 'admin') {
        extract($data);
        $viewPath = "views/$view.php";
        include_once "views/admin/layout/header.php"; 
        include_once $viewPath; 
        echo '</div>'; 
        include_once "views/admin/layout/footer.php";
    }

    public function index() {
        $orders = $this->model->getAll(); 
        $totalOrders = $this->model->countTotalOrders();
        $pendingOrders = $this->model->countPendingOrders();
        $totalRevenue = $this->model->sumTotalRevenue();
        return $this->view('admin/order/index', compact('orders', 'totalOrders', 'pendingOrders', 'totalRevenue'));
    }

    public function detail() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $order = $this->model->find($id); 
            $order_details = $this->model->getOrderDetails($id); 
            if ($order) {
                return $this->view('admin/order/detail', compact('order', 'order_details'));
            }
        }
        die("Không tìm thấy đơn hàng #$id!");
    }

    public function export() {
        $orders = $this->model->getAllOrdersForExport();
        if (empty($orders)) die("Không có dữ liệu!");

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=bao-cao-' . date('d-m-Y') . '.csv');
        $output = fopen('php://output');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($output, ['Mã Đơn', 'Khách Hàng', 'Tổng Giá Trị', 'Trạng Thái', 'Ngày Đặt']);
        
        foreach ($orders as $row) {
            fputcsv($output, [
                '#' . $row['id'],
                $row['receiver_name'],
                number_format($row['total_price']) . 'đ',
                $row['status'],
                date('d/m/Y', strtotime($row['created_at']))
            ]);
        }
        fclose($output);
        exit;
    }
    public function delete() {
    $id = $_GET['id'] ?? null;
    
    if ($id) {

        $result = $this->model->deleteOrder($id);
        
        if ($result) {
            header("Location: ?action=admin/order&msg=Xóa thành công");
            exit;
        } else {
            die("Lỗi: Không thể xóa đơn hàng #$id");
        }
    }
    
    header("Location: ?action=admin/order");
    exit;
}
}