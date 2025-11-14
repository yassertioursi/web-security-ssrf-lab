@extends('layout')

@section('title', 'TechStore - Premium Software & Subscriptions')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-8">
                    <h1 class="text-2xl font-bold text-blue-600">🛒 TechStore</h1>
                    <div class="hidden md:flex gap-6">
                        <a href="#" class="text-gray-600 hover:text-blue-600">Products</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600">Categories</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600">Deals</a>
                        <a href="#" class="text-gray-600 hover:text-blue-600">Support</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <input type="search" placeholder="Search products..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
                    <button class="text-gray-600 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <div class="mb-6 text-sm text-gray-600">
            <a href="#" class="hover:text-blue-600">Home</a> /
            <a href="#" class="hover:text-blue-600">Software</a> /
            <span class="text-gray-900">{{ $product['name'] }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Image & Details -->
            <div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-4">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full">
                </div>

            </div>

            <!-- Purchase Section -->
            <div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product['name'] }}</h1>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="flex text-yellow-400">
                            ★★★★★
                        </div>
                        <span class="text-sm text-gray-600">(2,847 reviews)</span>
                    </div>

                    <div class="border-t border-b py-4 my-4">
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-bold text-gray-900">{{ $product['price'] }}</span>
                            <span class="text-sm text-gray-500 line-through">$129.99</span>
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-sm font-semibold">33% OFF</span>
                        </div>
                    </div>

                    <p class="text-gray-700 mb-6">{{ $product['description'] }}</p>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-gray-700">Instant digital delivery</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-gray-700">30-day money back guarantee</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-gray-700">24/7 customer support</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button onclick="checkStock()" class="w-full bg-blue-600 text-white px-6 py-4 rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200 text-lg shadow-md">
                            Add to Cart
                        </button>
                        <button class="w-full bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200">
                            Add to Wishlist
                        </button>
                    </div>

                    <div id="stockStatus" class="mt-4 p-3 bg-gray-50 rounded border border-gray-200 hidden">
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold">Stock Status:</span>
                            <span id="stockMessage" class="text-gray-900"></span>
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<script>
// Stock checking functionality
function checkStock() {
    const stockStatus = document.getElementById('stockStatus');
    const stockMessage = document.getElementById('stockMessage');

    // Show loading state
    stockStatus.classList.remove('hidden');
    stockMessage.innerHTML = '<span class="text-blue-600">Checking inventory...</span>';

    // Check stock from internal API
    const stockCheckUrl = '{{ $product['stock_check_url'] }}';

    fetch('/ssrf/basic/check-availability', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ url: stockCheckUrl })
    })
    .then(response => {
        if (response.ok) {
            return response.text();
        }
        throw new Error('Stock check failed');
    })
    .then(data => {
        // Simple success - show stock available
        stockMessage.innerHTML = '<span class="text-green-600">✓ Available - 127 units in stock</span>';
    })
    .catch(error => {
        stockMessage.innerHTML = '<span class="text-red-600">Unable to verify stock. Please try again.</span>';
    });
}
</script>
@endsection
