<div class="container-fluid py-4" style="background: #f8f9fa; min-height: 100vh;">
    <div class="d-flex justify-content-between align-items-center mb-5 p-4 rounded-4 bg-white shadow-sm">
        <div>
            <h2 class="fw-bold text-dark mb-1">Thống Kê Tổng Quan <span class="text-primary">BookVerse</span></h2>
            <p class="text-muted mb-0">Hệ thống đang vận hành với hiệu suất tối ưu.</p>
        </div>
        <div class="text-end">
            <div class="fw-bold fs-5"><?= date('H:i') ?></div>
            <div class="text-muted small"><?= date('l, d/m/Y') ?></div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="opacity-75 mb-2">Kho Sách</h6>
                            <h2 class="fw-bold mb-0"><?= number_format($totalProducts) ?></h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-journal-bookmark-fill fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top border-white border-opacity-10 small">
                        <i class="bi bi-arrow-up-short"></i> Cập nhật dữ liệu thực tế
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #2af598 0%, #009efd 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="opacity-75 mb-2">Danh Mục</h6>
                            <h2 class="fw-bold mb-0"><?= number_format($totalCategories) ?></h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-tag fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top border-white border-opacity-10 small">
                        <i class="bi bi-tag-fill"></i> Quản lý phân loại sách
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="opacity-75 mb-2">Đơn Hàng</h6>
                            <h2 class="fw-bold mb-0"><?= $totalOrders ?></h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-cart-check-fill fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top border-white border-opacity-10 small">
                         <i class="bi bi-clock-history"></i> Kiểm tra đơn hàng mới
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #fccb90 0%, #d57eeb 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="opacity-75 mb-2">Doanh Thu</h6>
                            <h2 class="fw-bold mb-0"><?= number_format($totalRevenue) ?>đ</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-currency-exchange fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top border-white border-opacity-10 small">
                        <i class="bi bi-graph-up"></i> Tổng giá trị đơn hàng
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h5 class="fw-bold mb-4">Sách Mới Nhất</h5>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <thead>
                            <tr class="text-muted small">
                                <th>TÊN SÁCH</th>
                                <th>THỂ LOẠI</th>
                                <th>GIÁ</th>
                                <th>TRẠNG THÁI</th>
                            </tr>
                        </thead>
                      <tbody>
    <?php 
    if(!empty($latestBooks)): foreach ($latestBooks as $book): 
    ?>
    <tr>
        <td>
            <div class="d-flex align-items-center">
                <div class="rounded-2 bg-light p-1 me-3" style="width: 45px; height: 60px; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid #eee;">
                    <?php
                        $image_path = "assets/uploads/img/" . $book['image']; 

                        if(!empty($book['image']) && file_exists($image_path)): 
                    ?>
                        <img src="<?= $image_path ?>" style="width: 100%; height: 100%; object-fit: cover;" class="rounded">
                    <?php else: ?>
                        <span style="font-size: 20px;">📚</span>
                    <?php endif; ?>
                </div>
                <div class="fw-bold"><?= $book['title'] ?></div>
            </div>
        </td>
        <td><?= $book['category_name'] ?? 'Chưa phân loại' ?></td>
        <td class="fw-bold"><?= number_format($book['price']) ?>đ</td>
        <td>
            <?php if($book['stock'] > 0): ?>
                <span class="badge bg-primary-subtle text-primary">Đang bán</span>
            <?php else: ?>
                <span class="badge bg-danger-subtle text-danger">Hết hàng</span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; else: ?>
        <tr><td colspan="4" class="text-center text-muted">Chưa có dữ liệu sách mới.</td></tr>
    <?php endif; ?>
</tbody>
                    </table>
                </div>
            </div>
        </div>

      <div class="col-md-4">
    <div class="card border-0 shadow-lg rounded-4 p-4 h-100 text-white" 
         style="background: #111827; border: 1px solid rgba(255, 255, 255, 0.1) !important;">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-0 text-uppercase" style="letter-spacing: 1px; font-size: 16px;">Hoạt Động Hệ Thống</h5>
                <small class="text-muted" style="font-size: 10px;">Thời gian thực: <?= date('H:i:s') ?></small>
            </div>
            <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-3 py-2" style="font-size: 9px; letter-spacing: 0.5px;">
                <span class="spinner-grow spinner-grow-sm me-1" role="status" style="width: 6px; height: 6px;"></span> ĐANG CHẠY
            </span>
        </div>

        <div class="d-flex align-items-center mb-3 p-3 rounded-4" 
             style="background: rgba(99, 102, 241, 0.05); border: 1px solid rgba(99, 102, 241, 0.15);">
            <div class="flex-shrink-0" 
                 style="background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); padding: 12px; border-radius: 12px; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);">
                <i class="bi bi-cart-check-fill fs-5 text-white"></i>
            </div>
            <div class="ms-3">
                <div class="small fw-bold text-muted text-uppercase" style="font-size: 9px;">Giao dịch mới nhất</div>
                <div class="fw-bold" style="color: #e5e7eb; font-size: 15px;">Đơn hàng mới #<?= $totalOrders ?></div>
            </div>
        </div>

        <div class="d-flex align-items-center mb-4 p-3 rounded-4" 
             style="background: rgba(6, 182, 212, 0.05); border: 1px solid rgba(6, 182, 212, 0.15);">
            <div class="flex-shrink-0" 
                 style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); padding: 12px; border-radius: 12px; box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);">
                <i class="bi bi-hdd-network-fill fs-5 text-white"></i>
            </div>
            <div class="ms-3">
                <div class="small fw-bold text-muted text-uppercase" style="font-size: 9px;">Kết nối dữ liệu</div>
                <div class="small fw-bold" style="color: #22d3ee;">Ổn định (Latency: 5ms)</div>
            </div>
        </div>

        <div class="mt-auto pt-3 border-top border-secondary border-opacity-25">
            <h6 class="small fw-bold text-white-50 mb-3" style="letter-spacing: 1px;">TRẠNG THÁI HỆ THỐNG</h6>
            
            <div class="mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small" style="color: #9ca3af;"><i class="bi bi-cpu me-1 text-info"></i> Vi xử lý (CPU)</span>
                    <span class="small fw-bold text-info">24%</span>
                </div>
                <div class="progress" style="height: 6px; background: #1f2937; border-radius: 10px; overflow: visible;">
                    <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" 
                         role="progressbar" style="width: 24%; border-radius: 10px; position: relative;">
                         <div style="position: absolute; right: 0; top: 50%; transform: translate(50%, -50%); width: 12px; height: 12px; background: #0dcaf0; border-radius: 50%; filter: blur(4px);"></div>
                    </div>
                </div>
            </div>
            
            <div class="mb-2">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small" style="color: #9ca3af;"><i class="bi bi-memory me-1 text-warning"></i> Bộ nhớ (RAM)</span>
                    <span class="small fw-bold text-warning">48%</span>
                </div>
                <div class="progress" style="height: 6px; background: #1f2937; border-radius: 10px; overflow: visible;">
                    <div class="progress-bar bg-warning" 
                         role="progressbar" style="width: 48%; border-radius: 10px; position: relative;">
                         <div style="position: absolute; right: 0; top: 50%; transform: translate(50%, -50%); width: 12px; height: 12px; background: #ffc107; border-radius: 50%; filter: blur(4px);"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    </div>
</div>