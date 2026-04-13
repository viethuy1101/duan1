<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        --input-bg: #f8fafc;
        --text-label: #1e293b;
    }

    /* Background bao phủ toàn màn hình giống ảnh */
    .create-user-body {
        background-color: #f1f5f9;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        font-family: 'Inter', sans-serif;
    }

    /* Card màu trắng bo góc cực lớn */
    .glass-form-card {
        background: white;
        width: 100%;
        max-width: 650px;
        padding: 50px 60px;
        border-radius: 40px; /* Bo góc lớn đúng chuẩn ảnh */
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03);
    }

    .form-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .form-header h2 {
        font-weight: 800;
        color: #7c3aed; /* Màu tím đặc trưng trong ảnh */
        font-size: 28px;
        margin-bottom: 12px;
    }

    .form-header p {
        color: #64748b;
        font-size: 15px;
    }

    /* Label in hoa và đậm */
    .input-group-custom {
        margin-bottom: 25px;
    }

    .input-group-custom label {
        display: block;
        font-weight: 700;
        color: var(--text-label);
        margin-bottom: 12px;
        font-size: 13px;
        letter-spacing: 0.5px;
    }

    /* Input xám nhạt bo góc nhẹ */
    .form-control-vip {
        width: 100%;
        height: 55px;
        background: var(--input-bg);
        border: 1px solid #f1f5f9;
        border-radius: 15px;
        padding: 0 25px;
        font-size: 15px;
        color: #334155;
        transition: all 0.3s ease;
    }

    .form-control-vip:focus {
        background: white;
        border-color: #a855f7;
        box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.1);
        outline: none;
    }

    /* Custom Select */
    .select-vip {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='C19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
        background-size: 18px;
    }

    /* Nút bấm màu tím loang Gradient */
    .btn-submit-vip {
        width: 100%;
        height: 60px;
        background: linear-gradient(90deg, #7c3aed 0%, #a855f7 100%);
        color: white;
        border: none;
        border-radius: 18px;
        font-weight: 700;
        font-size: 16px;
        margin-top: 30px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-submit-vip:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .btn-cancel-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #64748b;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
    }

    .btn-cancel-link:hover {
        color: #334155;
    }
</style>

<div class="create-user-body">
    <div class="glass-form-card">
        <div class="form-header">
            <h2>Thêm Thành Viên Mới</h2>
            <p>Thiết lập thông tin tài khoản để truy cập hệ thống</p>
        </div>

        <form action="?action=admin/user/store" method="POST">
            <div class="input-group-custom">
                <label>HỌ VÀ TÊN</label>
                <input type="text" name="name" class="form-control-vip" placeholder="Nhập tên người dùng..." required>
            </div>

            <div class="input-group-custom">
                <label>EMAIL</label>
                <input type="email" name="email" class="form-control-vip" placeholder="example@gmail.com" required>
            </div>

            <div class="input-group-custom">
                <label>MẬT KHẨU</label>
                <input type="password" name="password" class="form-control-vip" placeholder="••••••••" required>
            </div>

            <div class="input-group-custom">
                <label>VAI TRÒ</label>
                <select name="role" class="form-control-vip select-vip">
                    <option value="user">Thành viên (User)</option>
                    <option value="admin">Quản trị viên (Admin)</option>
                </select>
            </div>

            <button type="submit" name="btn_submit" class="btn-submit-vip">
                Lưu thông tin tài khoản
            </button>

            <a href="?action=admin/users" class="btn-cancel-link">Hủy bỏ và quay lại</a>
        </form>
    </div>
</div>