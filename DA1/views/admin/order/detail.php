<style>
        .invoice-wrapper { background: #f8f9fa; border-radius: 20px; }
        .card { border: none; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); transition: all 0.3s; }
        .text-primary { color: #2c3e50 !important; }
        .bg-dark-blue { background-color: #2c3e50 !important; }
        .img-book { box-shadow: 0 2px 5px rgba(0,0,0,0.1); border: 1px solid #eee; object-fit: cover; }
        .transition-all { transition: all 0.3s ease; }
        .transition-all:hover { transform: translateY(-2px); shadow: 0 5px 15px rgba(0,0,0,0.1); }

        @media print {
            body * { visibility: hidden; }
            #print-area, #print-area * { visibility: visible; }
            #print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100% !important;
                margin: 0 !important;
                padding: 10px !important;
            }
            .print-hide, .btn, .card.bg-dark-blue { display: none !important; }
        }
    </style>

    <div id="print-area" class="container-fluid p-4 invoice-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <div>
                <h3 class="fw-bold text-primary mb-0">HÓA ĐƠN ĐƠN HÀNG <span class="text-muted">#<?= $order['id'] ?></span></h3>
                <p class="text-muted mb-0"><i class="far fa-calendar-alt me-1"></i> Ngày đặt: <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
            </div>
            <div class="print-hide">
                <a href="?action=admin/order/print&id=<?= $order['id'] ?>" class="btn btn-dark px-4 rounded-pill shadow-sm fw-bold" title="Tải xuống hóa đơn PDF">
                    <i class="fas fa-download me-2"></i>In hóa đơn PDF
                </a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-7">
                <div class="card h-100 rounded-4 shadow-sm">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase fw-bold text-muted mb-3 small"><i class="fas fa-truck me-2 text-primary"></i>Thông tin nhận sách</h6>
                        <div class="ps-2">
                            <h5 class="fw-bold mb-1 text-dark"><?= $order['fullname'] ?: '<span class="text-muted">Chưa cập nhật tên</span>' ?></h5>
                            <p class="mb-1 text-dark"><i class="fas fa-phone-alt me-2 small text-muted"></i><?= $order['phone'] ?: 'Chưa cập nhật SĐT' ?></p>
                            <p class="mb-2 text-dark"><i class="fas fa-home me-2 small text-muted"></i><?= $order['address'] ?: 'Chưa cập nhật địa chỉ' ?></p>
                            <div class="p-3 bg-light rounded-3 small text-muted mt-2 border-start border-4 border-primary">
                                <strong>Ghi chú đơn hàng:</strong> <?= $order['note'] ?: 'Không có ghi chú từ khách.' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card h-100 rounded-4 shadow-sm">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase fw-bold text-muted mb-3 small"><i class="fas fa-credit-card me-2 text-primary"></i>Trạng thái & Thanh toán</h6>
                        <div class="mb-3">
                           <p class="text-muted small mb-1">Hình thức thanh toán:</p>
                           <div class="fw-bold text-dark">
                                <i class="bi bi-cash-stack text-success me-1"></i> Tiền mặt (COD)
                           </div>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Tình trạng xử lý:</p>
                            <form action="?action=admin/order/update-status" method="POST" class="d-flex gap-2 align-items-center">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($order['id']) ?>">
                                <select name="status" class="form-select form-select-sm w-auto">
                                    <?php
                                        $statusOptions = [
                                            'pending'   => 'Chờ xử lý',
                                            'confirmed' => 'Đã xác nhận',
                                            'shipping'  => 'Đang giao hàng',
                                            'completed' => 'Hoàn thành',
                                            'cancelled' => 'Đã hủy',
                                        ];
                                        $currentStatus = strtolower($order['status'] ?? 'pending');
                                        foreach ($statusOptions as $value => $label) {
                                            $selected = $currentStatus === $value ? 'selected' : '';
                                            echo "<option value=\"$value\" $selected>$label</option>";
                                        }
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary rounded-pill">Cập nhật</button>
                            </form>
                            <div class="mt-3">
                            <?php
                            switch ($currentStatus) {
                                case 'pending':
                                    echo '<span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-clock-history me-1"></i> Chờ xử lý</span>';
                                    break;
                                case 'confirmed':
                                    echo '<span class="badge bg-info text-white px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-check-circle me-1"></i> Đã xác nhận</span>';
                                    break;
                                case 'shipping':
                                    echo '<span class="badge bg-primary text-white px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-truck me-1"></i> Đang giao hàng</span>';
                                    break;
                                case 'completed':
                                    echo '<span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-house-check me-1"></i> Đã hoàn thành</span>';
                                    break;
                                case 'cancelled':
                                    echo '<span class="badge bg-danger text-white px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-x-circle me-1"></i> Đã hủy</span>';
                                    break;
                                default:
                                    echo '<span class="badge bg-secondary text-white px-3 py-2 rounded-pill">Không xác định</span>';
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="bg-light p-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="fas fa-book me-2 text-primary"></i>Danh sách sách đặt mua</h6>
                <span class="badge bg-secondary rounded-pill"><?= count($order_details) ?> đầu sách</span>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-hover">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th class="ps-4 py-3 border-0">Ảnh</th>
                            <th class="py-3 border-0">Tên sách / Tác giả</th>
                            <th class="text-center py-3 border-0">Số lượng</th>
                            <th class="text-end py-3 border-0">Đơn giá</th>
                            <th class="pe-4 text-end py-3 border-0">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_details as $item): ?>
                        <tr>
                            <td class="ps-4">
                                <img src="<?= BASE_URL ?>assets/uploads/img/<?= htmlspecialchars($item['image'] ?? 'no-image-book.png') ?>" 
                                    width="45" height="60" class="rounded img-book" 
                                    onerror="this.src='<?= BASE_URL ?>assets/uploads/img/no-image-book.png'">
                            </td>
                            <td>
                                <div class="fw-bold text-dark"><?= $item['product_name'] ?></div>
                                <small class="text-muted">Mã: #<?= $item['book_id'] ?> | Tác giả: Đang cập nhật</small>
                            </td>
                            <td class="text-center fw-bold text-dark">x<?= $item['quantity'] ?></td>
                            <td class="text-end text-muted"><?= number_format($item['price']) ?>đ</td>
                            <td class="pe-4 text-end fw-bold text-primary"><?= number_format($item['price'] * $item['quantity']) ?>đ</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="border-top-2">
                        <tr>
                            <td colspan="3" class="border-0"></td>
                            <td class="text-end py-2 text-muted">Tổng tiền sách và vận chuyển:</td>
                            <td class="text-end py-2 pe-4 fw-bold"><?= number_format($order['total_money']) ?>đ</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="border-0"></td>
                            <td class="text-end py-2 text-muted">Mã giảm giá (Coupon):</td>
                            <td class="text-end py-2 pe-4 text-success fw-bold">- 20,000đ</td>
                        </tr>
                        <!-- <tr>
                            <td colspan="3" class="border-0"></td>
                            <td class="text-end py-2 text-muted">Phí giao hàng:</td>
                            <td class="text-end py-2 pe-4 text-primary fw-bold">MIỄN PHÍ</td>
                        </tr> -->
                        <tr class="bg-dark-blue text-white">
                            <td colspan="3" class="border-0"></td>
                            <td class="text-end py-3 fw-bold text-uppercase">Thực thu (Tổng thanh toán):</td>
                            <td class="text-end py-3 pe-4 fw-bold fs-4 text-warning">
                                <?= number_format($order['total_money'] - 20000) ?>đ
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="print-hide mt-5 mb-4 d-flex justify-content-center border-top pt-4">
            <a href="<?= BASE_URL ?>admin/order" class="btn btn-outline-secondary btn-lg rounded-pill px-5 shadow-sm transition-all">
                <i class="bi bi-arrow-left-circle me-2"></i> Quay lại danh sách đơn hàng
            </a>
        </div>

        <div class="card bg-dark-blue text-white rounded-4 border-0 shadow print-hide">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1 fw-bold text-warning"><i class="fas fa-shield-alt me-2"></i>Hệ thống quản lý Admin</h5>
                    <p class="mb-0 small opacity-75">Vui lòng kiểm tra kỹ trạng thái kho trước khi thay đổi trạng thái giao hàng.</p>
                </div>
                <div class="text-end">
                    <span class="badge bg-white text-dark px-3 py-2 rounded-pill fw-bold">BẢN QUYỀN SHOP SÁCH WD21103</span>
                </div>
            </div>
        </div>
    </div>