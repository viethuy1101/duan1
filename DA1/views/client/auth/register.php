<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - BookVerse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f4f7f6;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .register-card {
            border: none;
            border-radius: 25px; /* Bo cong mạnh như nút Tài Khoản của bạn */
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            background: #ffffff;
            width: 100%;
            max-width: 450px;
            margin: auto;
            padding: 40px;
        }
        .register-header h2 {
            font-weight: 700;
            color: #212529;
            margin-bottom: 30px;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e1e1e1;
            margin-bottom: 20px;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
            border-color: #0d6efd;
        }
        .btn-register {
            background-color: #212529;
            color: white;
            border-radius: 50px; /* Nút hình con nhộng */
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            width: 100%;
            margin-top: 10px;
        }
        .btn-register:hover {
            background-color: #000;
            transform: translateY(-2px);
        }
        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: #6c757d;
        }
        .login-link a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="register-card">
        <div class="register-header text-center">
            <h2 class="text-uppercase">Tạo Tài Khoản</h2>
            <p class="text-muted small">Khám phá thế giới mới qua từng trang sách</p>
        </div>

        <form action="<?= BASE_URL ?>?action=post-register" method="POST">
            <div class="mb-3">
                <label class="form-label small fw-bold">Họ và Tên</label>
                <input type="text" name="name" class="form-control" placeholder="Nguyễn Văn A" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-register">
                <i class="bi bi-person-plus-fill me-2"></i> Đăng ký ngay
            </button>

            <div class="login-link">
                Bạn đã có tài khoản? <a href="<?= BASE_URL ?>?action=login">Đăng nhập</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>