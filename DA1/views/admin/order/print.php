<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hóa Đơn #<?= $order['id'] ?></title>
    <style>
        * { margin: 0; padding: 0; }
        body { 
            font-family: "Times New Roman", Times, serif; 
            margin: 0; 
            padding: 20px;
            color: #333; 
            line-height: 1.6;
        }
        .container { max-width: 900px; margin: 0 auto; }
        .invoice-header { 
            text-align: center; 
            border-bottom: 3px solid #2c3e50; 
            padding-bottom: 15px; 
            margin-bottom: 25px; 
        }
        .invoice-title { font-size: 28px; font-weight: bold; color: #2c3e50; }
        .invoice-subtitle { color: #666; font-size: 14px; margin-top: 5px; }
        .info-section { margin-bottom: 20px; }
        .info-row { display: table; width: 100%; margin-bottom: 15px; }
        .info-col { display: table-cell; width: 50%; vertical-align: top; padding-right: 20px; }
        .section-title { 
            font-weight: bold; 
            color: #2c3e50; 
            font-size: 14px; 
            margin-bottom: 10px;
            text-transform: uppercase;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .info-item { 
            margin-bottom: 6px; 
            font-size: 13px; 
        }
        .info-label { 
            color: #555; 
            font-weight: bold; 
            display: inline-block;
            width: 120px;
        }
        .info-value { 
            display: inline-block;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0;
        }
        table th { 
            background-color: #2c3e50; 
            color: white; 
            padding: 12px; 
            text-align: left; 
            font-size: 13px;
            font-weight: bold;
        }
        table td { 
            padding: 10px 12px; 
            border-bottom: 1px solid #ddd; 
            font-size: 12px; 
        }
        .text-right { text-align: right; }
        .total-section {
            margin-top: 20px;
            text-align: right;
        }
        .total-row { 
            display: table;
            width: 350px;
            margin-left: auto;
            margin-bottom: 8px;
            font-size: 13px;
        }
        .total-label { 
            display: table-cell;
            width: 200px;
            text-align: left;
        }
        .total-amount { 
            display: table-cell;
            width: 150px;
            text-align: right;
            font-weight: bold;
        }
        .total-final {
            display: table;
            width: 350px;
            margin-left: auto;
            border-top: 2px solid #2c3e50;
            border-bottom: 2px solid #2c3e50;
            padding: 10px 0;
            margin-bottom: 15px;
        }
        .final-label { 
            display: table-cell;
            width: 200px;
            text-align: left;
            font-size: 14px;
            font-weight: bold;
        }
        .final-amount { 
            display: table-cell;
            width: 150px;
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            color: #e74c3c;
        }
        .footer { 
            text-align: center; 
            margin-top: 40px; 
            color: #999; 
            font-size: 11px; 
            border-top: 1px solid #ddd; 
            padding-top: 15px;
            page-break-inside: avoid;
        }
        .signature-section {
            display: table;
            width: 100%;
            margin-top: 30px;
        }
        .signature-col {
            display: table-cell;
            width: 50%;
            text-align: center;
            padding-top: 30px;
        }
        @page {
            margin: 10mm;
        }
        @media print {
            body { margin: 0; padding: 10mm; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-header">
            <div class="invoice-title">HÓA ĐƠN ĐƠN HÀNG</div>
            <div class="invoice-subtitle">Số: #<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?> | Ngày: <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></div>
        </div>

        <div class="info-section">
            <div class="info-row">
                <div class="info-col">
                    <div class="section-title">Thông Tin Người Nhận</div>
                    <div class="info-item"><span class="info-label">Tên:</span><span class="info-value"><?= htmlspecialchars($order['fullname']) ?></span></div>
                    <div class="info-item"><span class="info-label">Điện thoại:</span><span class="info-value"><?= htmlspecialchars($order['phone']) ?></span></div>
                    <div class="info-item"><span class="info-label">Email:</span><span class="info-value"><?= htmlspecialchars($order['email'] ?? 'N/A') ?></span></div>
                    <div class="info-item"><span class="info-label">Địa chỉ:</span><span class="info-value"><?= htmlspecialchars($order['address']) ?></span></div>
                </div>
                <div class="info-col">
                    <div class="section-title">Thông Tin Đặt Hàng</div>
                    <div class="info-item"><span class="info-label">Mã đơn:</span><span class="info-value">#<?= $order['id'] ?></span></div>
                    <div class="info-item"><span class="info-label">Trạng thái:</span><span class="info-value"><?= ucfirst($order['status']) ?></span></div>
                    <div class="info-item"><span class="info-label">Hình thức TT:</span><span class="info-value">Tiền mặt (COD)</span></div>
                    <div class="info-item"><span class="info-label">Ghi chú:</span><span class="info-value"><?= htmlspecialchars($order['note'] ?? 'Không có') ?></span></div>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Sách</th>
                    <th class="text-right">Số Lượng</th>
                    <th class="text-right">Đơn Giá</th>
                    <th class="text-right">Thành Tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $stt = 1;
                foreach ($order_details as $item): 
                    $itemTotal = $item['price'] * $item['quantity'];
                ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td class="text-right">x<?= $item['quantity'] ?></td>
                    <td class="text-right"><?= number_format($item['price']) ?> ₫</td>
                    <td class="text-right"><strong><?= number_format($itemTotal) ?> ₫</strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                <div class="total-label">Tổng tiền hàng:</div>
                <div class="total-amount"><?= number_format($subtotal) ?> ₫</div>
            </div>
            <div class="total-row">
                <div class="total-label">Phí vận chuyển:</div>
                <div class="total-amount"><?= number_format($shipping) ?> ₫</div>
            </div>
            <div class="total-final">
                <div class="final-label">TỔNG CỘNG:</div>
                <div class="final-amount"><?= number_format($total) ?> ₫</div>
            </div>
        </div>

        <div class="signature-section">
            <div class="signature-col">
                <div>Người gửi</div>
                <div style="margin-top: 30px; border-top: 1px solid #333; width: 120px; margin-left: auto; margin-right: auto;"></div>
            </div>
            <div class="signature-col">
                <div>Người nhận</div>
                <div style="margin-top: 30px; border-top: 1px solid #333; width: 120px; margin-left: auto; margin-right: auto;"></div>
            </div>
        </div>

        <div class="footer">
            <p>Cảm ơn bạn đã mua hàng. Vui lòng giữ lại hóa đơn này để khi nhận hàng.</p>
            <p>In ngày: <?= date('d/m/Y H:i:s') ?></p>
        </div>
    </div>

    <script>
        window.addEventListener("load", function() {
            setTimeout(function() {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
