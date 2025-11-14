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
                        <span class="text-sm text-gray-600">(1,524 reviews)</span>
                    </div>

                    <div class="border-t border-b py-4 my-4">
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-bold text-gray-900">{{ $product['price'] }}</span>
                            <span class="text-sm text-gray-500 line-through">$129.99</span>
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-sm font-semibold">23% OFF</span>
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

    fetch('/ssrf/dns-rebinding/check-availability', {
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
            <a href="/" class="hover:text-blue-600">Home</a> /
            <a href="#" class="hover:text-blue-600">Security Services</a> /
            <span class="text-gray-900">{{ $product['name'] }}</span>
        </div>

        <!-- Security Badge -->
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-semibold text-green-800">🛡️ Enhanced Security Protection Active</h3>
                    <div class="mt-1 text-sm text-green-700">
                        <p>✓ Advanced DNS validation • ✓ Private IP blocking • ✓ Real-time threat detection</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Image & Details -->
            <div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-4">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full">
                </div>
                <div class="grid grid-cols-4 gap-2">
                    <div class="bg-gray-200 rounded aspect-square flex items-center justify-center text-gray-400">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="bg-gray-200 rounded aspect-square flex items-center justify-center text-gray-400">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="bg-gray-200 rounded aspect-square flex items-center justify-center text-gray-400">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 7H7v6h6V7z"/>
                            <path fill-rule="evenodd" d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="bg-gray-200 rounded aspect-square flex items-center justify-center text-gray-400">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
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
                        <span class="text-sm text-gray-600">(487 reviews)</span>
                        <span class="ml-2 bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">Enterprise Grade</span>
                    </div>

                    <div class="border-t border-b py-4 my-4">
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-bold text-gray-900">{{ $product['price'] }}</span>
                            <span class="text-sm text-gray-500 line-through">$3,499.00</span>
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-sm font-semibold">28% OFF</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Annual license • Billed yearly</p>
                    </div>

                    <p class="text-gray-700 mb-6">{{ $product['description'] }}</p>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-gray-700">24/7 Security Monitoring</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-gray-700">Advanced DNS Protection</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-gray-700">Webhook Validation System</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-gray-700">Real-time Threat Intelligence</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button onclick="checkAvailability()" class="w-full bg-blue-600 text-white px-6 py-4 rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200 text-lg shadow-md">
                            Check Availability
                        </button>
                        <button class="w-full bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200">
                            Request Enterprise Demo
                        </button>
                    </div>

                    <div id="availabilityStatus" class="mt-4 p-3 bg-gray-50 rounded border border-gray-200 hidden">
                        <p class="text-sm text-gray-600">
                            <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></span>
                            Checking availability with internal security API...
                        </p>
                    </div>

                    <div id="stockResult" class="mt-4 hidden"></div>
                </div>

                <!-- Features -->
                <div class="mt-6 bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-lg mb-4">🔒 Security Features</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">IP Whitelisting</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">DNS Validation</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Rate Limiting</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Audit Logging</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Encryption at Rest</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">SOC 2 Compliant</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description Tabs -->
        <div class="mt-8 bg-white rounded-lg shadow-md">
            <div class="border-b">
                <div class="flex gap-8 px-6">
                    <button class="py-4 border-b-2 border-blue-600 text-blue-600 font-semibold">Description</button>
                    <button class="py-4 text-gray-600 hover:text-gray-900">Features</button>
                    <button class="py-4 text-gray-600 hover:text-gray-900">Reviews</button>
                    <button class="py-4 text-gray-600 hover:text-gray-900">Support</button>
                </div>
            </div>
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-4">Enterprise Security Audit Pro</h2>
                <div class="prose max-w-none text-gray-700">
                    <p class="mb-4">
                        Our Enterprise Security Audit Pro service provides comprehensive security testing and monitoring for your critical infrastructure.
                        With advanced DNS protection and IP validation, you can trust that your systems are protected against the latest threats.
                    </p>
                    <h3 class="text-lg font-semibold mt-6 mb-3">What's Included:</h3>
                    <ul class="list-disc pl-6 space-y-2 mb-4">
                        <li>Continuous security monitoring and threat detection</li>
                        <li>Advanced DNS rebinding protection with real-time validation</li>
                        <li>Webhook security validation system</li>
                        <li>Private IP address blocking and filtering</li>
                        <li>Custom security rules and policies</li>
                        <li>Dedicated security team support</li>
                        <li>Monthly security reports and recommendations</li>
                        <li>Compliance assistance (SOC 2, ISO 27001, GDPR)</li>
                    </ul>
                    <h3 class="text-lg font-semibold mt-6 mb-3">Perfect For:</h3>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Enterprise organizations with complex infrastructure</li>
                        <li>Companies handling sensitive customer data</li>
                        <li>Organizations requiring compliance certifications</li>
                        <li>Teams looking to enhance their security posture</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Customer Reviews -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-6">Customer Reviews</h2>
            <div class="space-y-6">
                <div class="border-b pb-6">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-semibold">Sarah Mitchell</span>
                                <span class="text-sm text-gray-500">Verified Purchase</span>
                            </div>
                            <div class="flex text-yellow-400 text-sm">★★★★★</div>
                        </div>
                        <span class="text-sm text-gray-500">2 weeks ago</span>
                    </div>
                    <p class="text-gray-700">
                        "Excellent security service! The DNS protection features caught several attempted attacks that our previous solution missed.
                        Highly recommend for enterprise environments."
                    </p>
                </div>
                <div class="border-b pb-6">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-semibold">David Chen</span>
                                <span class="text-sm text-gray-500">Verified Purchase</span>
                            </div>
                            <div class="flex text-yellow-400 text-sm">★★★★★</div>
                        </div>
                        <span class="text-sm text-gray-500">1 month ago</span>
                    </div>
                    <p class="text-gray-700">
                        "The webhook validation system is a game-changer. We integrated it into our CI/CD pipeline and it's been rock solid.
                        Great support team too!"
                    </p>
                </div>
                <div>
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-semibold">Emily Rodriguez</span>
                                <span class="text-sm text-gray-500">Verified Purchase</span>
                            </div>
                            <div class="flex text-yellow-400 text-sm">★★★★★</div>
                        </div>
                        <span class="text-sm text-gray-500">2 months ago</span>
                    </div>
                    <p class="text-gray-700">
                        "Worth every penny. The real-time monitoring gives us peace of mind, and the detailed reports help us stay compliant with SOC 2 requirements."
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function checkAvailability() {
    const statusDiv = document.getElementById('availabilityStatus');
    const resultDiv = document.getElementById('stockResult');

    statusDiv.classList.remove('hidden');
    resultDiv.classList.add('hidden');
    resultDiv.innerHTML = '';

    fetch('/ssrf/dns-rebinding/fetch', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            url: '{{ $product['stock_check_url'] }}'
        })
    })
    .then(response => response.json())
    .then(data => {
        statusDiv.classList.add('hidden');
        resultDiv.classList.remove('hidden');

        if (data.success) {
            resultDiv.innerHTML = `
                <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold text-green-800">✅ Security Check Passed</span>
                    </div>
                    <p class="text-sm text-green-700">DNS validation successful. Service available.</p>
                    <details class="mt-3">
                        <summary class="text-sm text-green-600 cursor-pointer hover:text-green-800">View Technical Details</summary>
                        <div class="mt-2 p-3 bg-white rounded border border-green-200 text-xs">
                            <div class="mb-2"><strong>Validation:</strong> ${JSON.stringify(data.validation, null, 2)}</div>
                            <div class="mb-2"><strong>Resolved IP:</strong> ${data.actual_ip}</div>
                            <div class="mb-2"><strong>Status Code:</strong> ${data.status_code}</div>
                            <div class="text-yellow-700 font-semibold mt-2">${data.warning || ''}</div>
                        </div>
                    </details>
                </div>
            `;
        } else {
            resultDiv.innerHTML = `
                <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold text-red-800">🛡️ Security Protection Active</span>
                    </div>
                    <p class="text-sm text-red-700 mb-2"><strong>Access Blocked:</strong> ${data.error}</p>
                    ${data.ip ? `<p class="text-xs text-red-600">Attempted to resolve to: ${data.ip}</p>` : ''}
                    ${data.hint ? `<p class="text-xs text-red-500 mt-2"><em>${data.hint}</em></p>` : ''}
                </div>
            `;
        }
    })
    .catch(error => {
        statusDiv.classList.add('hidden');
        resultDiv.classList.remove('hidden');
        resultDiv.innerHTML = `
            <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold text-yellow-800">Connection Error</span>
                </div>
                <p class="text-sm text-yellow-700 mt-2">Unable to reach security API. Please try again later.</p>
            </div>
        `;
    });
}

// Auto-check on page load (like other labs)
window.addEventListener('load', function() {
    setTimeout(checkAvailability, 500);
});
</script>
@endsection
