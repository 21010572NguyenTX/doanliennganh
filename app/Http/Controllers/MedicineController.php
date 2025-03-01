<?php

namespace App\Http\Controllers;

use App\Models\MedicineDetail;
use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Medicine;
=======

>>>>>>> 4f1eaef (BV Truong)
class MedicineController extends Controller
{
    public function index()
    {
        // Sử dụng phương thức paginate để phân trang
        $medicines = MedicineDetail::paginate(20); // Số lượng mục trên mỗi trang
        return view('medicine.detail', compact('medicines'));
    }
<<<<<<< HEAD
    public function show($id)
    {
        // Tìm trong bảng medicine theo id
        $medicine = Medicine::findOrFail($id);

        // Trả về view tên là 'medicine.details'
        // và truyền biến $medicine qua cho view
        return view('medicine.details', compact('medicine'));
    }
=======
>>>>>>> 4f1eaef (BV Truong)
}
