<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý logic đăng nhập
    public function login(Request $request)
    {
        // Tài khoản mẫu
        $sample_email = 'abc@gmail.com';
        $sample_password = '123456';

        // Kiểm tra thông tin đăng nhập
        if ($request->email === $sample_email && $request->password === $sample_password) {
            // Lưu thông tin người dùng vào session
            session(['user' => [
                'email' => $sample_email,
                'name' => 'abc', // Thêm tên người dùng mẫu
            ]]);

            // Chuyển hướng đến trang chủ
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        } else {
            // Thông báo lỗi nếu sai thông tin
            return back()->withErrors(['email' => 'Email hoặc mật khẩu không chính xác.']);
        }
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register'); // Tạo view auth.register cho trang đăng ký
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        // Xóa session
        $request->session()->forget('user');

        // Chuyển hướng về trang chủ
        return redirect()->route('home')->with('success', 'Đăng xuất thành công!');
    }
}
