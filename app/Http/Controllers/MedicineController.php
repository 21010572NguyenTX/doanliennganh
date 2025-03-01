<?php

namespace App\Http\Controllers;

use App\Models\MedicineDetail;
use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicineController extends Controller
{
    public function index()
    {
        // Sử dụng phương thức paginate để phân trang
        $medicines = MedicineDetail::paginate(20); // Số lượng mục trên mỗi trang
        return view('medicine.details', compact('medicines'));
        
    }
    public function show($id)
    {
        // Tìm trong bảng medicine theo id
        $medicine = Medicine::findOrFail($id);
        $randomMedicines = Medicine::inRandomOrder()->limit(5)->get();
        return view('medicine.details', compact('medicine', 'randomMedicines'));

        // Trả về view tên là 'medicine.details'
        // và truyền biến $medicine qua cho view
        return view('medicine.details', compact('medicine'));
    }
    // Hàm xử lý "Thêm vào ghi chú"
    public function addNote($id)
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để sử dụng chức năng này.');
        }
        $medicine = Medicine::findOrFail($id);
        // Logic thêm ghi chú hoặc trả về view form thêm ghi chú (ví dụ: resources/views/medicine/add_note.blade.php)
        return view('medicine.add_note', compact('medicine'));
    }

    // Hàm xử lý "Tư vấn bác sĩ"
    public function consultDoctor($id)
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để sử dụng chức năng này.');
        }
        $medicine = Medicine::findOrFail($id);
        // Logic tư vấn bác sĩ hoặc trả về view tương ứng (ví dụ: resources/views/medicine/consult_doctor.blade.php)
        return view('medicine.consult_doctor', compact('medicine'));
    }

}
