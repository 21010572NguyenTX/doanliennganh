@extends('layouts.app')

@section('content')
<div class="bg-blue-900 py-10">
    <div class="container mx-auto px-4">
        <!-- Phần tìm kiếm với gợi ý tự động -->
        <div class="relative">
            <input type="text" id="searchInput" placeholder="Nhập tên bệnh cần tìm kiếm..." class="w-full p-4 text-lg rounded text-gray-700 focus:outline-none shadow-lg bg-white">
            <button id="searchBtn" class="absolute right-2 top-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tìm kiếm
            </button>
            <!-- Container hiển thị gợi ý -->
            <div id="suggestions" class="absolute left-0 right-0 mt-1 bg-white border border-gray-300 rounded shadow-md z-10 hidden"></div>
        </div>
    </div>
</div>

<!-- Bộ lọc theo chữ cái A-Z -->
<div class="bg-blue-800 py-2">
    <div class="container mx-auto flex justify-center space-x-1">
        @foreach(range('A', 'Z') as $char)
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm filter-btn" data-char="{{ $char }}">
                {{ $char }}
            </button>
        @endforeach
    </div>
</div>

<!-- Danh sách bệnh và phân trang -->
<div class="container mx-auto px-4 py-8">
    <div id="diseaseList" class="grid grid-cols-3 gap-6">
        {{-- Dữ liệu sẽ được load qua JS --}}
    </div>
    
    <!-- Phần điều hướng phân trang -->
    <div id="pagination" class="flex justify-center space-x-2 mt-4"></div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const perPage = 12; // Số sản phẩm mỗi trang
    let currentPage = 1;
    const defaultChar = 'A'; // Mặc định lọc theo chữ A khi vào trang
    const diseases = @json($allDiseases); // Lấy danh sách tất cả các bệnh từ controller
    let filteredDiseases = []; // Danh sách bệnh hiện tại (sau khi lọc hoặc tìm kiếm)

    // DOM Elements
    const diseaseContainer = document.getElementById('diseaseList');
    const paginationContainer = document.getElementById('pagination');
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const suggestionsContainer = document.getElementById('suggestions');

    // Hàm render danh sách bệnh
    function renderDiseases(list) {
        diseaseContainer.innerHTML = '';
        list.forEach(disease => {
            const diseaseElement = `
            <div class="p-6 max-w-sm bg-white rounded-lg border shadow-md">
                <h5 class="mb-2 text-xl tracking-tight text-gray-900">${disease.ten_benh}</h5>
            </div>`;
            diseaseContainer.innerHTML += diseaseElement;
        });
    }

    // Hàm render phân trang dựa trên tổng số sản phẩm
    function renderPagination(total) {
        const pageCount = Math.ceil(total / perPage);
        paginationContainer.innerHTML = '';
        for (let i = 1; i <= pageCount; i++) {
            const activeClass = (i === currentPage) ? 'bg-blue-700' : 'bg-blue-500';
            const pageElement = `<button class="${activeClass} hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm"
                onclick="changePage(${i})">${i}</button>`;
            paginationContainer.innerHTML += pageElement;
        }
    }

    // Hàm chuyển trang và render lại danh sách bệnh
    window.changePage = (page) => {
        currentPage = page;
        const start = (currentPage - 1) * perPage;
        const end = start + perPage;
        renderDiseases(filteredDiseases.slice(start, end));
        renderPagination(filteredDiseases.length);
    };

    // Hàm lọc danh sách theo chữ cái (bộ lọc A-Z)
    function filterDiseases(char) {
        filteredDiseases = diseases.filter(d => {
            const normalized = d.ten_benh.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
            return normalized.startsWith(char);
        });
        currentPage = 1;
        renderDiseases(filteredDiseases.slice(0, perPage));
        renderPagination(filteredDiseases.length);
    }

    // Hàm lọc theo từ khóa tìm kiếm (so sánh với tên bệnh đã normalize)
    function filterByKeyword(keyword) {
        if (!keyword) {
            filterDiseases(defaultChar);
            return;
        }
        // Normalize từ khóa nhập vào
        const normalizedKeyword = keyword.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
        filteredDiseases = diseases.filter(d => {
            const normalized = d.ten_benh.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
            return normalized.includes(normalizedKeyword);
        });
        currentPage = 1;
        renderDiseases(filteredDiseases.slice(0, perPage));
        renderPagination(filteredDiseases.length);
    }

    // Hàm highlight từ khóa trong gợi ý
    function highlightKeyword(text, keyword) {
        const lowerText = text.toLowerCase();
        const lowerKeyword = keyword.toLowerCase();
        const startIndex = lowerText.indexOf(lowerKeyword);
        if (startIndex === -1) return text;
        const endIndex = startIndex + keyword.length;
        return text.substring(0, startIndex) +
               '<span class="font-bold text-blue-600">' +
               text.substring(startIndex, endIndex) +
               '</span>' +
               text.substring(endIndex);
    }

    // Hiển thị gợi ý dựa trên ký tự đã nhập
    function showSuggestions() {
        const query = searchInput.value.trim();
        if (query === '') {
            suggestionsContainer.classList.add('hidden');
            return;
        }
        // Normalize query nhập vào
        const normalizedQuery = query.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
        const suggestionList = diseases.filter(d => {
            const normalized = d.ten_benh.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
            return normalized.includes(normalizedQuery);
        }).slice(0, 5);

        if (suggestionList.length === 0) {
            suggestionsContainer.classList.add('hidden');
            return;
        }
        suggestionsContainer.innerHTML = '';
        suggestionList.forEach(suggestion => {
            const suggestionText = highlightKeyword(suggestion.ten_benh, query);
            const suggestionItem = `<div class="cursor-pointer p-2 hover:bg-blue-100" data-value="${suggestion.ten_benh}">
                ${suggestionText}
            </div>`;
            suggestionsContainer.innerHTML += suggestionItem;
        });
        suggestionsContainer.classList.remove('hidden');
    }

    // Ẩn gợi ý
    function hideSuggestions() {
        suggestionsContainer.classList.add('hidden');
    }

    // Sự kiện cho ô tìm kiếm: hiển thị gợi ý khi nhập ký tự
    searchInput.addEventListener('input', showSuggestions);

    // Khi click vào một gợi ý, sử dụng closest() để lấy phần tử chứa data-value
    suggestionsContainer.addEventListener('click', function(e) {
        const suggestionItem = e.target.closest('[data-value]');
        if (suggestionItem) {
            searchInput.value = suggestionItem.getAttribute('data-value');
            hideSuggestions();
        }
    });

    // Xử lý sự kiện khi nhấn Enter trong ô tìm kiếm
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            hideSuggestions();
            filterByKeyword(searchInput.value.trim());
            // Reset thanh tìm kiếm sau khi thực hiện tìm kiếm
            searchInput.value = '';
        }
    });

    // Xử lý sự kiện click nút "Tìm kiếm"
    searchBtn.addEventListener('click', function() {
        hideSuggestions();
        filterByKeyword(searchInput.value.trim());
        // Reset thanh tìm kiếm sau khi thực hiện tìm kiếm
        searchInput.value = '';
    });

    // Xử lý sự kiện cho các nút lọc theo chữ cái A-Z
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Làm nổi bật nút được chọn
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('bg-blue-700'));
            this.classList.add('bg-blue-700');
            // Reset ô tìm kiếm và ẩn gợi ý
            searchInput.value = '';
            hideSuggestions();
            filterDiseases(this.getAttribute('data-char'));
        });
    });

    // Khi load trang, hiển thị kết quả theo chữ A mặc định
    filterDiseases(defaultChar);
});
</script>
