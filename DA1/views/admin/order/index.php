<?php 
// Fix lỗi đường dẫn bằng __DIR__ (Dứt điểm lỗi Fatal error dòng 3)
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Quản lý <span class="text-primary">Đơn hàng</span></h2>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Mã Đơn</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $o): ?>
                        <tr>
                            <td class="ps-4">#<?= $o['id'] ?></td>
                            <td><?= $o['customer_name'] ?></td>
                            <td class="text-danger fw-bold"><?= $o['total'] ?></td>
                            <td>
                                <span class="badge bg-<?= $o['status'] == 0 ? 'warning' : 'info' ?> text-dark rounded-pill">
                                    <?= $o['status'] == 0 ? 'Chờ xử lý' : 'Đang giao' ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center p-4">Không có đơn hàng nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
// Tương tự cho footer
require_once __DIR__ . '/../layout/footer.php'; 
//// fix linguist
?>