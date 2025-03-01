<?php
// Nếu form được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Tài khoản mẫu
    $sample_email = 'abc@gmail.com';
    $sample_password = '123456';

    // Kiểm tra thông tin đăng nhập
    if ($email === $sample_email && $password === $sample_password) {
        // Đăng nhập thành công -> lưu thông tin người dùng vào session
        session_start();
        $_SESSION['user'] = $sample_email;

        // Chuyển hướng đến trang chủ
        header("Location: /"); // Trang chủ Laravel route('home')
        exit;
    } else {
        // Sai thông tin đăng nhập
        $error_message = 'Email hoặc mật khẩu không chính xác!';
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Tra cứu thuốc và bệnh</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Đăng Nhập</h2>

        <!-- Hiển thị lỗi nếu có -->
        <?php if (!empty($error_message)): ?>
            <div class="text-red-500 text-sm mb-4 text-center">
                <?= $error_message ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-4">
            <!-- CSRF token để bảo vệ -->
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required 
                    placeholder="Nhập email" 
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu:</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    placeholder="Nhập mật khẩu" 
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition"
            >
                Đăng nhập
            </button>
            <p class="text-center text-sm text-gray-600 mt-4">
                Chưa có tài khoản? 
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Đăng ký ngay</a>
            </p>
        </form>
    </div>

</body>
</html>
