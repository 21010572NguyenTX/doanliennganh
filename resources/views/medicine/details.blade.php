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
            </div>
        </div>
    </div>
</div>
@endsection
