<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - BookVerse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f4f7f6;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            border: none;
            border-radius: 25px; /* Khớp với nút Tài Khoản của bạn */
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background: #ffffff;
            width: 100%;
            max-width: 400px;
            margin: auto;
            padding: 40px;
        }
        .login-header h2 {
            font-weight: 700;
            color: #212529;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e1e1e1;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(33, 37, 41, 0.1);
            border-color: #212529;
        }
        .btn-login {
            background-color: #212529;
            color: white;
            border-radius: 50px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            border: none;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: #000;
            transform: translateY(-2px);
        }
        .register-link a {
            color: #212529;
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>
  <div class="container">
    <div class="login-card">
        <div class="text-center mb-4">
            <h2 class="text-uppercase">Đăng nhập</h2>
            <p class="text-muted small">Đăng nhập để tiếp tục hành trình tri thức</p>
        </div>

        <form action="<?= BASE_URL ?>?action=post-login" method="POST">
            <div class="mb-3">
                <label class="form-label small fw-bold">Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;">
                        <i class="bi bi-envelope text-muted"></i>
                    </span>
                    <input type="email" name="email" class="form-control border-start-0" 
                           style="border-radius: 0 12px 12px 0;" placeholder="example@gmail.com" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold">Mật khẩu</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;">
                        <i class="bi bi-lock text-muted"></i>
                    </span>
                    <input type="password" name="password" class="form-control border-start-0" 
                           style="border-radius: 0 12px 12px 0;" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-login mb-3">
                Đăng nhập ngay
            </button>

            <div class="text-center register-link small">
                Bạn chưa có tài khoản? <a href="<?= BASE_URL ?>?action=register">Tham gia ngay</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>