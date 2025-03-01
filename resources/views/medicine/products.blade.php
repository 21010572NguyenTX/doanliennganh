@extends('layouts.app')

@section('title', 'Danh Sách Thuốc Chữa Bệnh')

@section('content')
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-semibold text-center mb-6">Danh Sách Thuốc Chữa Bệnh</h1>

            <!-- Thanh tìm kiếm và bộ lọc -->
            <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Tìm kiếm theo tên thuốc -->
                <div class="relative col-span-1">
                    <input type="text" id="search" name="search" value="{{ old('search', $search) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Tìm kiếm theo tên thuốc..." 
                        onkeyup="searchProducts()" />
                    <div id="suggestions" class="absolute w-full bg-white border border-gray-300 mt-1 rounded-lg shadow-lg z-10 hidden"></div>
                </div>

                <!-- Thanh tìm kiếm nhà sản xuất -->
                <div class="relative col-span-1">
                    <input type="text" id="manufacturer" name="manufacturer" value="{{ old('manufacturer', $manufacturer_filter) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Tìm kiếm theo nhà sản xuất..." 
                        onkeyup="searchManufacturers()" />
                    <div id="manufacturer-suggestions" class="absolute w-full bg-white border border-gray-300 mt-1 rounded-lg shadow-lg z-10 hidden"></div>
                </div>  

                <button onclick="filterByManufacturer()" class="relative col-span-1 text-white bg-blue-500 px-4 py-2 rounded-lg" style="right: 15px;">
                    Tìm kiếm
                </button>
            </div>
    <!-- Danh sách thuốc -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img class="w-full h-40 object-contain" src="{{ $product->image_url }}" alt="Hình ảnh thuốc">
                <div class="p-4">
                    <!-- Thêm link tới trang chi tiết -->
                    <h2 class="text-lg font-bold mb-2">
                        <a href="{{ route('medicine.show', $product->id) }}" class="hover:text-blue-600">
                            {{ $product->medicine_name }}
                        </a>
                    </h2>
                    <p class="text-gray-600 text-sm">
                        Nhà sản xuất: {{ $product->manufacturer }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

            <!-- Phân trang -->
            <div class="mt-6 flex justify-center items-center space-x-2">
                <!-- Nút Quay lại trang trước -->
                <a href="{{ $products->previousPageUrl() }}" class="px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400 {{ $products->onFirstPage() ? 'cursor-not-allowed' : '' }}">
                    <i class="fas fa-chevron-left"></i> Quay lại
                </a>

                <!-- Số trang phân trang -->
                @for ($i = $products->currentPage(); $i <= min($products->lastPage(), $products->currentPage() + 2); $i++)
                    <a href="{{ $products->url($i) }}" class="px-4 py-2 mx-1 bg-blue-500 text-white rounded-lg {{ $i == $products->currentPage() ? 'bg-blue-700' : '' }}">
                        {{ $i }}
                    </a>
                @endfor

                <!-- Hiển thị dấu "..." nếu có trang không hiển thị -->
                @if ($products->currentPage() < $products->lastPage() - 2)
                    <span class="px-4 py-2">...</span>
                @endif

                <!-- Trang cuối -->
                @if ($products->lastPage() > 1)
                    <a href="{{ $products->url($products->lastPage()) }}" class="px-4 py-2 mx-1 bg-blue-500 text-white rounded-lg">
                        {{ $products->lastPage() }}
                    </a>
                @endif

                <!-- Nút Tiếp theo -->
                <a href="{{ $products->nextPageUrl() }}" class="px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400 {{ $products->hasMorePages() ? '' : 'cursor-not-allowed' }}">
                    Tiếp theo <i class="fas fa-chevron-right"></i>
                </a>

                <!-- Ô nhập số trang -->
                <div class="ml-4 flex items-center space-x-2">
                    <input type="number" id="page-number" min="1" max="{{ $products->lastPage() }}" class="px-4 py-2 border border-gray-300 rounded-lg" placeholder="Nhập số trang">
                    <button onclick="goToPage()" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Đi đến trang</button>
                </div>
            </div>
        </div>

        <script>
        // Tìm kiếm theo tên thuốc (gợi ý theo từng ký tự nhập vào)
        function searchProducts() {
            let query = document.getElementById('search').value;
            if (query.length > 0) {
                fetch(`/search?search=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        let suggestions = document.getElementById('suggestions');
                        suggestions.innerHTML = '';
                        data.forEach(product => {
                            let suggestionItem = document.createElement('div');
                            suggestionItem.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                            suggestionItem.innerHTML = `${product.medicine_name} - ${product.manufacturer}`;
                            suggestionItem.onclick = function() {
                                document.getElementById('search').value = product.medicine_name;
                                suggestions.innerHTML = '';
                            };
                            suggestions.appendChild(suggestionItem);
                        });
                        suggestions.classList.remove('hidden');
                    });
            } else {
                document.getElementById('suggestions').classList.add('hidden');
            }
        }

        // Tìm kiếm nhà sản xuất (gợi ý theo từng ký tự nhập vào)
        function searchManufacturers() {
            let query = document.getElementById('manufacturer').value;
            if (query.length > 0) {
                fetch(`/manufacturer-search?search=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        let suggestions = document.getElementById('manufacturer-suggestions');
                        suggestions.innerHTML = '';
                        data.forEach(manufacturer => {
                            let suggestionItem = document.createElement('div');
                            suggestionItem.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                            suggestionItem.innerHTML = manufacturer;
                            suggestionItem.onclick = function() {
                                document.getElementById('manufacturer').value = manufacturer;
                                suggestions.innerHTML = '';
                            };
                            suggestions.appendChild(suggestionItem);
                        });
                        suggestions.classList.remove('hidden');
                    })
                    .catch(error => console.log('Error:', error));  // Kiểm tra lỗi nếu có
            } else {
                document.getElementById('manufacturer-suggestions').classList.add('hidden');
            }
        }

        // Lọc sản phẩm theo nhà sản xuất
        function filterByManufacturer() {
            let manufacturer = document.getElementById('manufacturer').value;
            let search = document.getElementById('search').value;
            window.location.href = `?manufacturer=${manufacturer}&search=${search}`;  // Reload trang với bộ lọc mới
        }

        // Chuyển đến trang được nhập khi nhấn nút "Đi đến trang"
        function goToPage() {
            let pageNumber = document.getElementById('page-number').value;
            if (pageNumber >= 1 && pageNumber <= {{ $products->lastPage() }}) {
                window.location.href = `?page=${pageNumber}`;
            }
        }
        </script>



@endsection
