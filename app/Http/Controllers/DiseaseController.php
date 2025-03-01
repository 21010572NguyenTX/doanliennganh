<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    public function index()
{
    $allDiseases = Disease::all(); // Lấy tất cả các bệnh
    $initialDiseases = Disease::where('ten_benh', 'LIKE', 'A%')->get(); 
    $diseases = Disease::paginate(12);
    return view('diseases.index', compact('allDiseases', 'initialDiseases'));
}

}
