<div class="container-fluid p-4">

   

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-0">Quản lý <span class="text-primary">Đơn hàng</span></h3>

            <p class="text-muted small">Theo dõi và xử lý đơn hàng từ hệ thống Book Verse</p>

        </div>

        <a href="?action=admin/order/create" class="btn btn-primary rounded-pill px-4 shadow-sm">

            <i class="bi bi-plus-lg me-1"></i> Tạo đơn mới

        </a>

    </div>



    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="bg-light text-secondary">

                    <tr>

                        <th class="ps-4 py-3 text-uppercase fs-7 fw-bold">Mã Đơn</th>

                        <th class="py-3 text-uppercase fs-7 fw-bold">Khách Hàng</th>

                        <th class="py-3 text-uppercase fs-7 fw-bold">Tổng Tiền</th>

                        <th class="py-3 text-uppercase fs-7 fw-bold">Trạng Thái</th>

                        <th class="pe-4 py-3 text-center text-uppercase fs-7 fw-bold">Thao Tác</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($orders as $o): ?>

                    <tr>

                        <td class="ps-4">

                            <span class="fw-bold text-dark">#<?= $o['id'] ?? 'DH001' ?></span>

                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <div class="avatar-sm bg-primary-subtle text-primary rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold" style="width: 35px; height: 35px;">

                                    <?= substr($o['customer_name'] ?? 'N', 0, 1) ?>

                                </div>

                                <span class="fw-medium">Khách hàng ID: <?= $o['user_id'] ?></span>

                            </div>

                        </td>

                        <td>

                            <span class="text-danger fw-bold"><?= number_format($o['total_price']) ?>đ</span>

                        </td>

                       <td>
    <?php 
        $status = $o['status'] ?? 'Pending';
        // Đặt màu sắc dựa trên chữ m nhập trong DB
        $badgeClass = 'bg-warning text-dark'; // Mặc định là vàng
        if ($status == 'Hoàn thành' || $status == 'Completed') $badgeClass = 'bg-success';
        if ($status == 'Đã hủy' || $status == 'Cancelled') $badgeClass = 'bg-danger';
    ?>
    <span class="badge <?= $badgeClass ?> rounded-pill px-3 py-2 opacity-75">
        <?= $status ?>
    </span>
</td>

                        <td class="pe-4 text-center">

                            <div class="btn-group">

                                <a href="?action=admin/order/detail&id=<?= $o['id'] ?>" class="btn btn-sm btn-outline-primary border-0" title="Xem chi tiết">

                                    <i class="bi bi-eye-fill"></i>

                                </a>

                                <a href="?action=admin/order/delete&id=<?= $o['id'] ?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('M có chắc muốn xóa đơn này không?')" title="Xóa">

                                    <i class="bi bi-trash-fill"></i>

                                </a>

                            </div>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

       

        <div class="card-footer bg-white border-0 py-3 text-center">

            <small class="text-muted">Hiển thị tất cả đơn hàng hiện có trong hệ thống</small>

        </div>

    </div>

</div>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



<style>

    .fs-7 { font-size: 0.8rem; }

    .table thead th { border-bottom: 0; }

    .card { background-color: #fff; }

    .avatar-sm { font-size: 0.9rem; background-color: #e7f1ff; color: #0d6efd; }

    tbody tr:hover { background-color: #f8f9fa; transition: 0.2s; }

</style>đúng chiwa