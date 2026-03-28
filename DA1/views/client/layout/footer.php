<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <footer class="footer-area bg-light p-5 mt-4 text-black text-center">
    <div class="container-xl text-start"> <!- Thêm container để giới hạn chiều rộng và căn lề trái ->
        <div class="row row-cols-1 row-cols-md-3 g-4"> <!- Tạo 3 cột, g-4 để có khoảng cách ->
            
            <!- Cột 1: Thông tin thương hiệu ->
            <div class="col footer-brand-col">
                <h3 class="footer-logo">Book<span class="text-danger">Verse</span>.com</h3>
                <div class="footer-brand-info">
                    <p><br>Công Ty Cổ Phần Sách BookVerse</p>
                    <p class="small-text">BookVerse.com nhận đặt hàng trực tuyến và giao hàng tận nơi. KHÔNG hỗ trợ đặt mua và nhận hàng trực tiếp tại văn phòng cũng như tất cả các Hệ Thống BookVerse trên toàn quốc.</p>
                </div>
                <div class="social-links mt-3">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>

            </div>

            <!- Cột 2: Các liên kết Dịch vụ, Hỗ trợ, Liên hệ ->
            <div class="col footer-links-col">
                <div class="footer-section mb-4">
                    <h5 class="fw-bold">DỊCH VỤ</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Điều khoản sử dụng</a></li>
                        <li><a href="#">Chính sách bảo mật thông tin cá nhân</a></li>
                        <li><a href="#">Chính sách bảo mật thanh toán</a></li>
                        <li><a href="#">Giới thiệu BookVerse</a></li>
                        <li><a href="#">Hệ thống nhà sách</a></li>
                    </ul>
                </div>
                <div class="footer-section mb-4">
                    <h5 class="fw-bold">HỖ TRỢ</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Chính sách đổi - trả - hoàn tiền</a></li>
                        <li><a href="#">Chính sách bảo hành - bồi hoàn</a></li>
                        <li><a href="#">Chính sách vận chuyển</a></li>
                        <li><a href="#">Chính sách khách sỉ</a></li>
                    </ul>
                </div>
                <div class="footer-section mb-4">
                    <h5 class="fw-bold">LIÊN HỆ</h5>
                    <p><i class="fas fa-map-marker-alt"></i> Hà Nội</p>
                    <p><i class="fas fa-envelope"></i> <a href="mailto:cskh@bookverse.com.vn">cskh@bookverse.com.vn</a></p>
                    <p><i class="fas fa-phone"></i> <a href="tel:1900636467">1900636467</a></p>
                </div>
            </div>

            <!- Cột 3: Tài khoản & Đối tác ->
            <div class="col footer-account-col">
                <div class="footer-section mb-4">
                    <h5 class="fw-bold">TÀI KHOẢN CỦA TÔI</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Đăng nhập/Tạo mới tài khoản</a></li>
                        <li><a href="#">Thay đổi địa chỉ khách hàng</a></li>
                        <li><a href="#">Chi tiết tài khoản</a></li>
                        <li><a href="#">Lịch sử mua hàng</a></li>
                    </ul>
                </div>
                <div class="partner-logos-section">
                    <h5 class="fw-bold">ĐỐI TÁC</h5>
                    <div class="row row-cols-3 row-cols-lg-4 g-3 partner-logos">
                        <div class="col"><img src="<?= BASE_ASSETS_UPLOADS ?>img/doitac1.png" class="img-fluid"  alt="Partner 1"></div>
                        <div class="col"><img src="<?= BASE_ASSETS_UPLOADS ?>img/doitac2.png" class="img-fluid" alt="Partner 2"></div>
                        <div class="col"><img src="<?= BASE_ASSETS_UPLOADS ?>img/doitac3.png" class="img-fluid" alt="Partner 3"></div>
                        <div class="col"><img src="<?= BASE_ASSETS_UPLOADS ?>img/doitac4.png" class="img-fluid" alt="Partner 4"></div>
                        <!- Thêm các col khác cho nhiều đối tác hơn ->
                    </div>
                </div>
            </div>
            
        </div> <!- Kết thúc .row ->
    </div> <!- Kết thúc .container-xl ->

    <div class="footer-bottom mt-5 border-top pt-3 text-muted">
    </div>
</footer>
</body>
</html>