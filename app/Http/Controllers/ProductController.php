<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        public function index(Request $request)
    {
        // Lấy danh sách nhà sản xuất để lọc
        $manufacturers = Product::distinct()->pluck('manufacturer');

        // Lọc theo tên thuốc và nhà sản xuất nếu có
        $query = Product::query();

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where('medicine_name', 'like', $search . '%');  // Tìm kiếm theo chữ cái đầu của tên thuốc
        }

        if ($request->has('manufacturer') && $request->input('manufacturer') != '') {
            $manufacturer = $request->input('manufacturer');
            $query->where('manufacturer', 'like', $manufacturer . '%'); // Lọc theo nhà sản xuất
        }

        // Lấy danh sách sản phẩm với phân trang
        $products = $query->paginate(20); // 20 sản phẩm mỗi trang

        return view('medicine.products', [
            'products' => $products,
            'manufacturers' => $manufacturers,
            'search' => $request->input('search', ''),
            'manufacturer_filter' => $request->input('manufacturer', ''),
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('medicine_name', 'like', $search . '%')
                        ->limit(5)
                        ->get();

        return response()->json($products);
    }


    public function manufacturerSearch(Request $request)
    {
        // Tìm kiếm theo nhà sản xuất
        $search = $request->input('search');
        $manufacturers = Product::where('manufacturer', 'like', $search . '%')
                                ->distinct()
                                ->pluck('manufacturer')
                                ->limit(5);

        return response()->json($manufacturers);
    }

}
