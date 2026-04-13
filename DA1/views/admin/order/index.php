<div class="container-fluid p-4" style="background: #f4f7f6; min-height: 100vh;">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h3 class="fw-bold mb-1 text-dark">Quản lý <span class="text-primary">Đơn hàng</span></h3>
            <p class="text-muted small mb-0"><i class="bi bi-info-circle me-1"></i> Hệ thống đang ghi nhận <strong><?= count($orders) ?></strong> đơn hàng trong tháng này.</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 border-start border-4 border-primary">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-cart-check text-primary fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Tổng đơn hàng</small>
                        <h4 class="fw-bold mb-0"><?= count($orders) ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 border-start border-4 border-warning">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-clock-history text-warning fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Đang chờ xử lý</small>
                        <h4 class="fw-bold mb-0"><?= $pendingOrders ?></h4> </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 border-start border-4 border-success">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-cash-stack text-success fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Tổng doanh thu</small>
                        <h4 class="fw-bold mb-0"><?= number_format($totalRevenue) ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 border-start border-4 border-info">
                <div class="d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-person-badge text-info fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Khách hàng mới</small>
                        <h4 class="fw-bold mb-0"><?= $totalOrders ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mt-2">
        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold"><i class="bi bi-list-ul me-2"></i>Danh sách chi tiết</h5>
            <div class="input-group w-25">
                <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control bg-light border-0 small" placeholder="Tìm đơn hàng...">
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="text-secondary" style="background: #f8f9fa;">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase fs-7 fw-bold">Mã Đơn</th>
                        <th class="py-3 text-uppercase fs-7 fw-bold">Khách Hàng</th>
                        <th class="py-3 text-uppercase fs-7 fw-bold">Tổng Giá Trị</th>
                        <th class="py-3 text-uppercase fs-7 fw-bold">Trạng Thái</th>
                        <th class="pe-4 py-3 text-center text-uppercase fs-7 fw-bold">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $o): ?>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-primary">#<?= $o['id'] ?? 'DH001' ?></span>
                                <small class="text-muted" style="font-size: 10px;">Ngày: <?= date('d/m/Y') ?></small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                                     style="width: 40px; height: 40px; background: linear-gradient(45deg, #0d6efd, #0dcaf0); color: #fff;">
                                    <?= substr($o['customer_name'] ?? 'N', 0, 1) ?>
                                </div>
                                <div>
                                    <span class="fw-bold d-block text-dark">User ID: <?= $o['user_id'] ?></span>
                                    <small class="text-muted italic">Khách hàng hệ thống</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="badge bg-danger bg-opacity-10 text-danger fw-bold fs-6 px-3 py-2 rounded-3">
                                <?= number_format($o['total_price']) ?>đ
                            </div>
                        </td>
<td>
    <?php
    $statusRaw = $o['status'] ?? 'pending';
    $statusText = 'Chờ xử lý'; // Mặc định
    $badgeStyle = 'background: #fff3cd; color: #856404; border: 1px solid #ffeeba;'; // Vàng

    if ($statusRaw == 'confirmed') {
        $statusText = 'Đã xác nhận';
        $badgeStyle = 'background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb;'; 
    } elseif ($statusRaw == 'shipping') {
        $statusText = 'Đang giao';
        $badgeStyle = 'background: #cce5ff; color: #004085; border: 1px solid #b8daff;'; 
    } elseif ($statusRaw == 'delivered' || $statusRaw == 'Completed' || $statusRaw == 'Hoàn thành') {
        $statusText = 'Thành công';
        $badgeStyle = 'background: #d4edda; color: #155724; border: 1px solid #c3e6cb;'; 
    } elseif ($statusRaw == 'canceled' || $statusRaw == 'Đã hủy') {
        $statusText = 'Đã hủy';
        $badgeStyle = 'background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;'; 
    }
    ?>

    <span class="badge rounded-pill px-3 py-2 fw-bold text-uppercase" style="<?= $badgeStyle ?> font-size: 11px;">
        <i class="bi bi-dot fs-5 align-middle"></i> <?= $statusText ?>
    </span>
</td>
                        <td class="pe-4 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="?action=admin/order/detail&id=<?= $o['id'] ?>" class="btn btn-sm btn-light rounded-circle shadow-sm" title="Xem chi tiết">
                                    <i class="bi bi-eye-fill text-primary"></i>
                                </a>
                                <a href="?action=admin/order/delete&id=<?= $o['id'] ?>" class="btn btn-sm btn-light rounded-circle shadow-sm" 
                                   onclick="return confirm('Bạn có chắc muốn xóa đơn này không?')" title="Xóa">
                                    <i class="bi bi-trash-fill text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-light border-0 py-3 text-center">
            <p class="mb-0 text-muted small fw-medium">Hiển thị tất cả đơn hàng hiện có trong hệ thống Book Verse</p>
        </div>
              <button class="btn btn-success rounded-pill px-4 shadow-sm fw-bold">
        <a href="<?= BASE_URL ?>admin/order/export" class="btn btn-success w-100 py-2 rounded-pill fw-bold text-white shadow-sm transition-all">
    <i class="fas fa-file-excel me-2"></i>Xuất báo cáo (CSV)
</a>
</button>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Inter', sans-serif; }
    .fs-7 { font-size: 0.75rem; letter-spacing: 0.5px; }
    .card { transition: transform 0.2s ease-in-out; }
    tbody tr { cursor: pointer; border-bottom: 1px solid #f1f1f1; }
    tbody tr:hover { background-color: #fcfdfe !important; }
    .btn-light:hover { background-color: #fff !important; transform: scale(1.1); }
    .badge { letter-spacing: 0.3px; }
</style>