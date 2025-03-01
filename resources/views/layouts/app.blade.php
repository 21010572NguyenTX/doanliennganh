<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang chủ - Tra cứu thuốc chữa bệnh')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700&display=swap');
        body {
            font-family: 'Be Vietnam Pro', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <header class="py-6 bg-teal-500 text-white">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="assets/image/logo.svg" alt="Logo" class="h-10">
                <span class="ml-4 font-bold text-xl">Tra cứu thuốc & bệnh</span>
            </div>

            <!-- Menu -->
            <nav class="hidden md:block">
                <ul class="flex space-x-10 text-white font-medium text-base">
                    <li><a href="{{ route('home') }}" class="hover:text-teal-300">Trang Chủ</a></li>
                    <li><a href="{{ route('products') }}" class="hover:text-teal-300">Thuốc chữa bệnh</a></li>
<<<<<<< HEAD
                    <li><a href="#" class="hover:text-teal-300">Giới Thiệu</a></li>
=======
                    <li><a href="{{ route('diseases') }}" class="hover:text-teal-300">tra cứu bệnh</a></li>
>>>>>>> 4f1eaef (BV Truong)
                    <li><a href="#" class="hover:text-teal-300">Liên Hệ</a></li>
                </ul>
            </nav>

            <!-- Actions -->
        <div class="flex items-center space-x-4">
            @if(session()->has('user'))
                <!-- Nếu đã đăng nhập -->
                <span class="font-medium text-white">Xin chào, <strong>{{ session('user.name') }}</strong></span>
                <a href="{{ route('logout') }}" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                class="px-4 py-2 bg-white text-teal-500 font-semibold rounded-full hover:bg-teal-600 hover:text-white transition">
                    Đăng Xuất
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <!-- Nếu chưa đăng nhập -->
                <a href="{{ route('login') }}" class="px-4 py-2 bg-white text-teal-500 font-semibold rounded-full hover:bg-teal-600 hover:text-white transition">
                    Đăng Nhập
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-teal-500 font-semibold rounded-full hover:bg-teal-600 hover:text-white transition">
                    Đăng Ký
                </a>
            @endif
        </div>


            <!-- Mobile Menu -->
            <button class="block md:hidden text-white">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-teal-500 text-white py-12 mt-16">
        <div class="container mx-auto text-center">
            <p class="text-white font-medium text-sm">
                © 2025 Tra cứu thuốc & bệnh. Mọi quyền được bảo lưu.
            </p>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
