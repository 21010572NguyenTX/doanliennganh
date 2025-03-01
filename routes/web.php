<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\ProductController;

// Trang chủ
Route::get('/', [MedicineController::class, 'home'])->name('home');

// Đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); // Hiển thị form đăng ký
Route::post('/register', [AuthController::class, 'register']); // Xử lý logic đăng ký

// Đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Hiển thị form đăng nhập
Route::post('/login', [AuthController::class, 'login']); // Xử lý logic đăng nhập

//Danh sách thuốc
Route::get('/products', [ProductController::class, 'index'])->name('products');
//Thanh tìm kiếm
Route::get('/search', [ProductController::class, 'search']);
Route::get('/manufacturer-search', [ProductController::class, 'manufacturerSearch']);


// Chi tiết thuốc
Route::get('/medicine/{id}', [MedicineController::class, 'show'])->name('medicine.show');


// Triệu chứng
Route::get('/symptoms', [SymptomController::class, 'index'])->name('symptoms'); // Trang danh sách triệu chứng

Route::get('/', function () {
    return view('home');
})->name('home');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
