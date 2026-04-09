<div class="container-fluid p-4">
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h4 class="fw-bold">Chi tiết đơn hàng #<?= $order['id'] ?></h4>
            <p class="text-muted">Mã khách: <?= $order['user_id'] ?> | Ngày đặt: <?= $order['created_at'] ?></p>
            <span class="badge bg-success rounded-pill px-3"><?= $order['status'] ?></span>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <table class="table align-middle mb-0">
                <thead class="bg-light text-uppercase small fw-bold">
                    <tr>
                        <th class="ps-4 py-3">Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th class="pe-4 text-end">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
    <?php foreach ($order_details as $item): ?>
    <tr>
       <td class="ps-4">
    <div class="d-flex align-items-center py-2">
        <img src="assets/uploads/img/<?= trim($item['product_image']) ?>" 
     width="60" 
     height="80" 
     style="object-fit: cover;" 
     class="rounded me-3 shadow-sm"
     onerror="this.src='https://ui-avatars.com/api/?name=Book&color=7F9CF5&background=EBF4FF'">
             
        <div>
            <div class="fw-bold"><?= $item['product_name'] ?></div>
            <small class="text-muted">Mã sách: #<?= $item['book_id'] ?></small>
        </div>
    </div>
</td>
        <td><?= number_format($item['price']) ?>đ</td>
        
        <td class="text-center">x<?= $item['quantity'] ?></td>
        
        <td class="pe-4 text-end fw-bold text-danger">
            <?= number_format($item['price'] * $item['quantity']) ?>đ
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
                <tfoot class="bg-light">
                    <tr>
                        <td colspan="3" class="ps-4 py-3 fw-bold">TỔNG TIỀN:</td>
                        <td class="pe-4 py-3 text-end fw-bold text-danger fs-5">
                            <?= number_format($order['total_price']) ?>đ
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>