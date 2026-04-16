<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white p-3">
            <h5>Tổng đánh giá: <?= $stats['total'] ?></h5>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white p-3">
            <h5>Đang hiển thị: <?= $stats['showing'] ?></h5>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-warning text-dark p-3">
            <h5>Điểm trung bình: <?= number_format($stats['avg_rating'], 1) ?> ⭐</h5>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <table id="reviewTable" class="table table-hover mt-3">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Sản phẩm</th>
                    <th>Đánh giá</th>
                    <th>Nội dung</th>
                    <th>Ngày</th>
                    <th>Trạng thái</th>
                    <th width="150px">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listReviews as $review): ?>
                <tr>
                    <td>#<?= $review['id'] ?></td>
                    <td><strong><?= $review['name'] ?></strong></td>
                    <td><span class="text-truncate" style="max-width: 150px; display:inline-block;"><?= $review['product_name'] ?></span></td>
                    <td><span class="text-warning"><?= str_repeat('⭐', $review['rating']) ?></span></td>
                    <td><?= $review['comment'] ?></td>
                    <td><?= date('d/m/Y', strtotime($review['created_at'])) ?></td>
                    <td>
                        <?php if ($review['status'] == 'show'): ?>
                            <span class="badge rounded-pill bg-success">Công khai</span>
                        <?php else: ?>
                            <span class="badge rounded-pill bg-secondary">Đang ẩn</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <?php if ($review['status'] == 'show'): ?>
                                <a href="index.php?action=admin/review/toggle&id=<?= $review['id'] ?>&status=hidden" 
                                   class="btn btn-outline-secondary btn-sm" title="Ẩn đánh giá">
                                    <i class="bi bi-eye-slash"></i>
                                </a>
                            <?php else: ?>
                                <a href="index.php?action=admin/review/toggle&id=<?= $review['id'] ?>&status=show" 
                                   class="btn btn-outline-success btn-sm" title="Công khai đánh giá">
                                    <i class="bi bi-eye"></i>
                                </a>
                            <?php endif; ?>

                            <button onclick="confirmDelete(<?= $review['id'] ?>)" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#reviewTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json' }
        });
    });
    
    function confirmDelete(id) {
        if(confirm(' Bạn chắc chắn muốn xóa đánh giá này chứ?')) {
            window.location.href = 'index.php?action=admin/review/delete&id=' + id;
        }
    }
</script>