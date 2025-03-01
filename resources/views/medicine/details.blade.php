{{-- resources/views/medicine/details.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="md:flex">
            <!-- Ảnh thuốc -->
            <div class="md:flex-shrink-0">
                <img class="h-48 w-full object-contain md:w-48" 
                     src="{{ $medicine->image_url }}" 
                     alt="{{ $medicine->medicine_name }}">
            </div>
            <!-- Thông tin chi tiết -->
            <div class="p-6">
                <h1 class="block mt-1 text-2xl font-bold text-gray-900">
                    {{ $medicine->medicine_name }}
                </h1>
                <p class="mt-2 text-gray-600">
                    <strong>Nhà sản xuất:</strong> {{ $medicine->manufacturer }}
                </p>
                <div class="mt-4">
                    <h2 class="text-xl font-semibold text-gray-800">Thành phần</h2>
                    <p class="text-gray-700">{{ $medicine->composition }}</p>
                </div>
                <div class="mt-4">
                    <h2 class="text-xl font-semibold text-gray-800">Công dụng</h2>
                    <p class="text-gray-700">{{ $medicine->uses }}</p>
                </div>
                <div class="mt-4">
                    <h2 class="text-xl font-semibold text-gray-800">Tác dụng phụ</h2>
                    <p class="text-gray-700">{{ $medicine->side_effects }}</p>
                </div>
                <div class="mt-6 grid grid-cols-3 gap-4">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-green-600">
                            {{ $medicine->excellent_review_percent }}%
                        </p>
                        <p class="text-gray-600">Đánh giá xuất sắc</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-yellow-600">
                            {{ $medicine->average_review_percent }}%
                        </p>
                        <p class="text-gray-600">Đánh giá trung bình</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-red-600">
                            {{ $medicine->poor_review_percent }}%
                        </p>
                        <p class="text-gray-600">Đánh giá kém</p>
                    </div>
                </div>
                <!-- Nút hành động -->
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('medicine.addNote', $medicine->id) }}" 
                       class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Thêm vào ghi chú
                    </a>
                    <a href="{{ route('medicine.consult_doctor', $medicine->id) }}" 
                       class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Tư vấn bác sĩ
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Hiển thị 5 loại thuốc ngẫu nhiên -->
    <div class="mt-10">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Có thể bạn quan tâm</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach($randomMedicines as $randomMedicine)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <a href="{{ route('medicine.show', $randomMedicine->id) }}">
                        <img class="w-full h-40 object-contain" 
                             src="{{ $randomMedicine->image_url }}" 
                             alt="{{ $randomMedicine->medicine_name }}">
                        <div class="p-4">
                            <h2 class="text-lg font-bold mb-2">{{ $randomMedicine->medicine_name }}</h2>
                            <p class="text-gray-600 text-sm">
                                Nhà sản xuất: {{ $randomMedicine->manufacturer }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
