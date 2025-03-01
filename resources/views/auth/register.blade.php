<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Tra cứu thuốc và bệnh</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Đăng Ký</h2>
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
            <div>
                <label for="fullname" class="block text-sm font-medium text-gray-700">Họ và Tên:</label>
                <input 
                    type="text" 
                    id="fullname" 
                    name="fullname" 
                    required 
                    placeholder="Nhập họ và tên"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
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
                    placeholder="Tạo mật khẩu"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition"
            >
                Đăng Ký
            </button>
            <p class="text-center text-sm text-gray-600 mt-4">
                Đã có tài khoản? 
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Đăng nhập</a>
            </p>
        </form>
    </div>

</body>
</html>
