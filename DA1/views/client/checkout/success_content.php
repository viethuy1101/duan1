<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
            <div class="card-body">
                <h2 class="fw-bold mb-3">Đặt hàng thành công!</h2>
                <p class="lead text-muted mb-4">Cảm ơn bạn đã đặt hàng. Mã đơn hàng của bạn là <strong>#<?= htmlspecialchars($_GET['id'] ?? '') ?></strong>.</p>
                <a href="<?= BASE_URL ?>" class="btn btn-primary rounded-pill px-4">Về trang chủ</a>
            </div>
        </div>
    </div>
</div>