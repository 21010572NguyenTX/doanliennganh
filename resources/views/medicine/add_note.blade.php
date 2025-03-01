@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-center">Thêm vào ghi chú cho {{ $medicine->medicine_name }}</h1>
    <!-- Form thêm ghi chú (chưa xử lý) -->
    <form method="POST" action="#">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="note">Ghi chú</label>
            <textarea name="note" id="note" class="w-full p-2 border border-gray-300 rounded" placeholder="Nhập ghi chú của bạn" required></textarea>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
            Lưu ghi chú
        </button>
    </form>
</div>
@endsection
