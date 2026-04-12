<style>
    .card-custom { border: none !important; box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important; border-radius: 20px !important; }
    .btn-submit { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; font-weight: 700; padding: 12px; border-radius: 10px; border: none; }
</style>

<div class="main-content"> <div class="container py-5">
        <div class="card card-custom p-4">
            <h3 class="text-primary fw-bold mb-4"><i class="bi bi-pencil-square me-2"></i>CẬP NHẬT DANH MỤC</h3>
            
            <form action="<?= BASE_URL ?>admin/category/update?id=<?= $category['id'] ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">TÊN DANH MỤC SÁCH</label>
                    <input type="text" name="name" class="form-control" value="<?= $category['name'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">MÔ TẢ NGẮN</label>
                    <textarea name="description" class="form-control" rows="3"><?= $category['description'] ?? '' ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">TRẠNG THÁI</label>
                        <select name="status" class="form-select">
                            <?php $currentStatus = $category['status'] ?? 1; ?>
                            <option value="1" <?= $currentStatus == 1 ? 'selected' : '' ?>>Đang hoạt động</option>
                            <option value="0" <?= $currentStatus == 0 ? 'selected' : '' ?>>Tạm ngưng</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">THỨ TỰ HIỂN THỊ</label>
                        <input type="number" name="sort_order" class="form-control" value="<?= $category['sort_order'] ?? 0 ?>">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-submit w-100 mb-2">XÁC NHẬN THAY ĐỔI</button>
                    <a href="<?= BASE_URL ?>admin/category" class="btn btn-light w-100">HỦY BỎ</a>
                </div>
            </form>
        </div>
    </div>
</div>