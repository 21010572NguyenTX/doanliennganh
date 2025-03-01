<?php

namespace App\Http\Controllers;

use App\Models\MedicineDetail;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        // Sử dụng phương thức paginate để phân trang
        $medicines = MedicineDetail::paginate(20); // Số lượng mục trên mỗi trang
        return view('medicine.detail', compact('medicines'));
    }
}
