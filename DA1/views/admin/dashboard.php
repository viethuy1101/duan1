<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
                            <h2 class="fw-bold mb-0">1,280</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-journal-bookmark-fill fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top border-white border-opacity-10 small">
                        <i class="bi bi-arrow-up-short"></i> 12 đầu sách mới tuần này
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-lg rounded-4 text-white" style="background: linear-gradient(135deg, #2af598 0%, #009efd 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="opacity-75 mb-2">Độc Giả</h6>
                            <h2 class="fw-bold mb-0">856</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-people-fill fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top border-white border-opacity-10 small">
                        <i class="bi bi-person-plus-fill"></i> 45 thành viên mới
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
                            <h2 class="fw-bold mb-0">42</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-cart-check-fill fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top border-white border-opacity-10 small">
                        <span class="badge bg-white text-danger">8 đơn chờ duyệt</span>
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
                            <h2 class="fw-bold mb-0">12.5M</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 p-3 rounded-3">
                            <i class="bi bi-currency-exchange fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-top border-white border-opacity-10 small">
                        <i class="bi bi-graph-up"></i> Tăng 5% so với hôm qua
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h5 class="fw-bold mb-4">Sách Bán Chạy Nhất</h5>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <thead>
                            <tr class="text-muted small">
                                <th>TÊN SÁCH</th>
                                <th>THỂ LOẠI</th>
                                <th>GIÁ</th>
                                <th>DOANH SỐ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-2 bg-light p-2 me-3">📚</div>
                                        <div class="fw-bold">Clean Code</div>
                                    </div>
                                </td>
                                <td>Công nghệ</td>
                                <td class="fw-bold">250,000đ</td>
                                <td><span class="badge bg-primary-subtle text-primary">150 bản</span></td>
                            </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-dark text-white">
                <h5 class="fw-bold mb-4">Thông Báo Hệ Thống</h5>
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0 text-warning"><i class="bi bi-circle-fill"></i></div>
                    <div class="ms-3 small">Cập nhật API thanh toán thành công.</div>
                </div>
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0 text-info"><i class="bi bi-circle-fill"></i></div>
                    <div class="ms-3 small">Có 5 đánh giá sách mới cần duyệt.</div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>