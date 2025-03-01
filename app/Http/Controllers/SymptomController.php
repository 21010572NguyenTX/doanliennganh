<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SymptomController extends Controller
{
    public function index()
    {
        $symptoms = [
            'Ho, sốt',
            'Đau đầu',
            'Khó thở',
        ];

        return view('symptoms.index', ['symptoms' => $symptoms]);
    }
}
