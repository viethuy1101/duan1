<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Quản lý Sách - BookVerse Admin</title>
    <style>
        .table-hover tbody tr { transition: all 0.2s ease; }
        .table-hover tbody tr:hover { background-color: #f8f9fa !important; }
        .variant-row { background-color: #fcfcfc; display: none; } /* Ẩn mặc định */
        .text-gradient { background: linear-gradient(45deg, #0d6efd, #6610f2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .btn-toggle-variant { cursor: pointer; transition: 0.3s; }
        .btn-toggle-variant.active { transform: rotate(180deg); }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded-4 shadow-sm">
            <div>
                <h3 class="fw-bold mb-1 text-gradient">Hệ Thống Kho Sách</h3>
                <p class="text-muted small mb-0">Quản lý kho hàng và biến thể sản phẩm thông minh</p>
            </div>
            <a href="?action=admin/product/create" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">
                <i class="bi bi-plus-lg me-2"></i>Thêm Sách Mới
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th class="ps-4 py-3 border-0 text-uppercase small fw-bold text-secondary" style="width: 50px;"></th>
                                <th class="py-3 border-0 text-uppercase small fw-bold text-secondary">Thông tin sách</th>
                                <th class="py-3 border-0 text-uppercase small fw-bold text-secondary text-center">Giá (Khoảng)</th>
                                <th class="py-3 border-0 text-uppercase small fw-bold text-secondary text-center">Kho tổng</th>
                                <th class="pe-4 py-3 border-0 text-uppercase small fw-bold text-secondary text-end">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $p): ?>
                            <tr>
                                <td class="ps-4">
                                    <i class="bi bi-chevron-down btn-toggle-variant text-secondary" onclick="toggleVariants(<?= $p['id'] ?>, this)"></i>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center py-2">
                                        <div class="rounded-3 shadow-sm border overflow-hidden me-3" style="width: 50px; height: 70px;">
                                            <?php 
                                                $imgName = !empty($p['image']) ? trim($p['image']) : 'no-image-book.png';
                                                $imagePath = "assets/uploads/img/" . $imgName;
                                            ?>
                                            <img src="<?= $imagePath ?>" class="w-100 h-100" style="object-fit: cover;" onerror="this.src='assets/uploads/img/no-image-book.png';">
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark mb-0"><?= $p['title'] ?></div>
                                            <div class="text-muted small"><i class="bi bi-person me-1"></i><?= $p['author'] ?? 'Chưa rõ' ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        $db = connectDB();
                                        $vStmt = $db->prepare("SELECT MIN(price) as min_p, MAX(price) as max_p FROM product_variants WHERE product_id = ?");
                                        $vStmt->execute([$p['id']]);
                                        $range = $vStmt->fetch();
                                        
                                        if ($range && $range['min_p'] > 0): 
                                            echo '<span class="text-danger fw-bold">' . number_format($range['min_p']) . 'đ - ' . number_format($range['max_p']) . 'đ</span>';
                                        else: 
                                            echo '<span class="text-danger fw-bold">' . number_format($p['price']) . 'đ</span>';
                                        endif;
                                    ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge rounded-pill <?= $p['stock'] <= 5 ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success' ?> px-3 py-2">
                                        <?= $p['stock'] ?> cuốn
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="?action=admin/product/edit&id=<?= $p['id'] ?>" class="btn btn-sm btn-light border text-warning"><i class="bi bi-pencil-square"></i></a>
                                        <a href="?action=admin/product/delete&id=<?= $p['id'] ?>" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xóa là mất luôn đó m?')"><i class="bi bi-trash3-fill"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <tr id="variants-<?= $p['id'] ?>" class="variant-row">
                                <td colspan="5" class="p-0">
                                    <div class="bg-light p-3 border-top">
                                        <h6 class="small fw-bold text-primary mb-3"><i class="bi bi-layers-half me-2"></i>Chi tiết biến thể sản phẩm:</h6>
                                        <table class="table table-sm table-bordered bg-white mb-0 shadow-sm">
                                            <thead class="table-secondary small">
                                                <tr>
                                                    <th>Tên biến thể</th>
                                                    <th class="text-center">Giá bán</th>
                                                    <th class="text-center">Tồn kho</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $vListStmt = $db->prepare("SELECT * FROM product_variants WHERE product_id = ?");
                                                    $vListStmt->execute([$p['id']]);
                                                    $vList = $vListStmt->fetchAll();
                                                    if(empty($vList)):
                                                ?>
                                                    <tr><td colspan="3" class="text-center text-muted small">Sách này chưa có biến thể</td></tr>
                                                <?php else: foreach($vList as $v): ?>
                                                    <tr class="small">
                                                        <td class="ps-3 fw-medium"><?= $v['variant_name'] ?></td>
                                                        <td class="text-center text-danger fw-bold"><?= number_format($v['price']) ?>đ</td>
                                                        <td class="text-center"><?= $v['stock'] ?></td>
                                                    </tr>
                                                <?php endforeach; endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleVariants(id, btn) {
            const row = document.getElementById('variants-' + id);
            if (row.style.display === 'none' || row.style.display === '') {
                row.style.display = 'table-row';
                btn.classList.add('active');
            } else {
                row.style.display = 'none';
                btn.classList.remove('active');
            }
        }
    </script>
</body>
</html>