<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* CSS tùy chỉnh bổ sung cho đẹp hơn nữa */
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .profile-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .profile-header {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        padding: 30px;
        color: white;
        text-align: center;
    }
    .avatar-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 15px;
    }
    .avatar-img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #ced4da;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.1);
    }
    .btn-custom-save {
        background-color: #007bff;
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-custom-save:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
    .btn-custom-back {
        background-color: #e2e6ea;
        color: #495057;
        border-radius: 8px;
        padding: 12px 24px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .btn-custom-back:hover {
        background-color: #dae0e5;
        color: #212529;
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            <div class="card profile-card">
                
                <div class="profile-header">
                    <div class="avatar-wrapper">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Avatar" class="avatar-img">
                    </div>
                    <h2 class="mb-1"><?= htmlspecialchars($user['name']) ?></h2>
                    <p class="mb-0 text-white-50">Thành viên</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="?action=profile" method="POST">
                        <h4 class="mb-4 border-bottom pb-3"><i class="fas fa-user-edit me-2 text-primary"></i>Cập nhật thông tin</h4>
                        
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="name" class="form-label">Họ và tên</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required placeholder="Nhập họ và tên đầy đủ">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">Địa chỉ Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required placeholder="duonguyhuy@gmail.com">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fas fa-phone text-muted"></i></span>
                                    <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" placeholder="Ví dụ: 0987654321">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Địa chỉ nhận hàng</label>
                                <textarea name="address" id="address" class="form-control" rows="4" placeholder="Nhập địa chỉ chi tiết (số nhà, tên đường, phường/xã...)"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-2">
                            <a href="<?= BASE_URL ?>" class="btn-custom-back">
                                <i class="fas fa-arrow-left me-2"></i>Quay lại trang chủ
                            </a>
                            <button type="submit" class="btn-custom-save">
                                <i class="fas fa-save me-2"></i>Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Trang cá nhân</h4>
                </div>
                <div class="card-body">
                    <form action="<?= BASE_URL ?>?action=profile" method="POST">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?? '' ?>" placeholder="Chưa có số điện thoại">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <textarea name="address" class="form-control" rows="3" placeholder="Nhập địa chỉ của bạn"><?= $user['address'] ?? '' ?></textarea>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= BASE_URL ?>" class="btn btn-secondary mt-3">Quay lại</a>
                            <button type="submit" class="btn btn-success mt-3">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>