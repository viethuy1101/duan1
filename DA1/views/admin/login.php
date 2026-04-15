<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookVerse Premium Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            background: #050505;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow: hidden;
            position: relative;
        }

        /* Hiệu ứng nền VIP: Luồng sáng chạy chậm */
        .premium-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 30%, rgba(79, 70, 229, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(168, 85, 247, 0.15) 0%, transparent 40%);
            z-index: -1;
        }

        .vip-card {
            background: rgba(20, 20, 25, 0.8);
            backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.8);
            position: relative;
        }

        /* Viền sáng bao quanh Card cực chuyên nghiệp */
        .vip-card::before {
            content: "";
            position: absolute;
            inset: -1px;
            background: linear-gradient(45deg, transparent, rgba(99, 102, 241, 0.3), transparent);
            border-radius: 2rem;
            z-index: -1;
        }

        .input-premium {
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-premium:focus {
            background: rgba(99, 102, 241, 0.05) !important;
            border-color: #6366f1;
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.15);
        }

        .btn-premium {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.3);
            transition: all 0.3s ease;
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(79, 70, 229, 0.4);
            filter: brightness(1.1);
        }
    </style>
</head>
<body>

    <div class="premium-bg"></div>

    <div class="vip-card p-12 rounded-[2rem] w-full max-w-md text-white border border-white/5">
        <div class="text-center mb-12">
            <div class="inline-block px-4 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-bold tracking-[0.3em] uppercase mb-4">
                Secure Access
            </div>
            <h1 class="text-5xl font-extrabold tracking-tighter mb-2 italic">
                Book<span class="text-indigo-500">Verse</span>
            </h1>
            <p class="text-gray-500 text-sm font-medium">Hệ thống quản trị nội bộ cao cấp</p>
        </div>

        <form action="?action=check-login" method="POST" class="space-y-8">
            
            <div class="relative group">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 ml-1">Email Quản Trị</label>
                <input type="email" name="email" required 
                    class="input-premium w-full rounded-2xl px-6 py-4 outline-none text-white text-lg"
                    placeholder="admin@bookverse.com">
            </div>

            <div class="relative group">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 ml-1">Mật Mã Bảo Mật</label>
                <input type="password" name="password" required 
                    class="input-premium w-full rounded-2xl px-6 py-4 outline-none text-white text-lg"
                    placeholder="••••••••">
            </div>

            <button type="submit" 
                class="btn-premium w-full text-white font-extrabold py-5 rounded-2xl uppercase tracking-[0.2em] text-sm mt-4">
                Đăng Nhập Ngay
            </button>

            <div class="flex justify-center mt-10">
                <a href="javascript:void(0)" onclick="premiumForgot()" class="text-[10px] text-gray-600 hover:text-indigo-400 transition-all uppercase font-bold tracking-[0.2em] border-b border-transparent hover:border-indigo-400/30 pb-1">
                    Quên mật khẩu?
                </a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function premiumForgot() {
            Swal.fire({
                title: '<span style="color:#fff; font-family:Plus Jakarta Sans">Khôi phục mật khẩu</span>',
                html: '<p style="color:#94a3b8">Vui lòng kiểm tra lại <b>Database</b> hoặc liên hệ kỹ thuật viên hệ thống để cấp lại quyền truy cập.</p>',
                icon: 'question',
                background: '#0f172a',
                confirmButtonColor: '#6366f1',
                confirmButtonText: 'Đã hiểu',
                customClass: {
                    popup: 'rounded-[2rem] border border-white/10'
                }
            });
        }
    </script>
</body>
</html>