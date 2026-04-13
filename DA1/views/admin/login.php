<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Hệ thống Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>

    <div class="glass-card p-10 rounded-2xl w-full max-w-md text-white">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold tracking-widest uppercase">Admin Login</h1>
            <p class="text-sm opacity-80 mt-2">Chào mừng bạn quay trở lại!</p>
        </div>

        <form action="?action=check-login" method="POST" class="space-y-6">
            
            <div class="relative">
                <label class="block text-xs uppercase mb-2 ml-1 opacity-70">Email</label>
                <input type="email" name="email" required
                    class="w-full bg-white/20 border border-white/30 rounded-lg px-4 py-3 outline-none focus:border-white transition-all text-white"
                    placeholder="admin@gmail.com">
            </div>

            <div class="relative">
                <label class="block text-xs uppercase mb-2 ml-1 opacity-70">Mật khẩu</label>
                <input type="password" name="password" required
                    class="w-full bg-white/20 border border-white/30 rounded-lg px-4 py-3 outline-none focus:border-white transition-all text-white"
                    placeholder="••••••">
            </div>

            <button type="submit" 
                class="w-full bg-white text-indigo-700 font-bold py-3 rounded-lg shadow-lg hover:bg-indigo-50 hover:scale-[1.02] transition-all duration-300 uppercase tracking-wider mt-4">
                Đăng nhập ngay
            </button>

            <div class="text-center mt-6">
                <a href="#" class="text-xs opacity-60 hover:opacity-100 transition-opacity">Quên mật khẩu?</a>
            </div>
        </form>
    </div>

</body>
</html>