@extends('layouts.app')

@section('title', 'Trang chủ - Tra cứu thuốc chữa bệnh')

@section('content')
<section class="bg-gradient-to-b from-teal-100 to-teal-50 rounded-b-[40px] py-24 relative">
    <div class="container mx-auto flex flex-wrap items-center">
        <!-- Content -->
        <div class="w-full lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
            <h1 class="text-teal-800 font-extrabold text-4xl lg:text-5xl mb-4 leading-tight">
                <span>Tra cứu thông tin</span> <br>
                <span class="text-3xl lg:text-4xl">Dễ dàng và nhanh chóng!</span>
            </h1>
            <p class="text-gray-600 font-medium text-lg mb-6">
                Cung cấp thông tin chính xác về thuốc và các loại bệnh lý phổ biến, giúp bạn và gia đình yên tâm hơn về sức khỏe.
            </p>
            <div class="flex space-x-6">
                <a href="#" class="px-6 py-2 bg-transparent border border-teal-800 text-teal-800 rounded-full font-medium hover:bg-teal-800 hover:text-white transition">
                    Xem Chi Tiết <i class="fa-regular fa-circle-play"></i>
                </a>
                <a href="#" class="px-6 py-2 bg-teal-500 text-white rounded-full font-medium hover:bg-teal-600 transition">
                    Bắt Đầu Tra Cứu
                </a>
            </div>
        </div>
        <!-- Image -->
        <div class="w-full lg:w-1/2 flex justify-center relative">
            <div class="absolute top-0 left-0 right-0 bottom-0 z-[-1] bg-gradient-to-tr from-teal-100 to-teal-50 rounded-full blur-2xl"></div>
            <img src="{{ asset('storage/image/a.jpg') }}" alt="Minh họa y tế" class="w-3/4 rounded-xl shadow-lg border border-teal-200">
        </div>
    </div>
</section>
@endsection
