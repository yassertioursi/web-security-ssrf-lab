<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SSRF Lab - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico?v={{ time() }}">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v={{ time() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .htb-glow { box-shadow: 0 0 20px #1e293b; }
        .code-block { background: #1e293b; color: #e2e8f0; padding: 1rem; border-radius: 0.5rem; overflow-x: auto; font-family: 'Courier New', monospace; font-size: 0.875rem; }
        .response-container { max-height: 500px; overflow-y: auto; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#141d2f] min-h-screen flex flex-col">
    <nav class="bg-[#1e293b] border-b border-[#2d3748]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-3">
                        <div class="w-11 h-11 bg-[#141d2f] border border-[#2d3748] rounded-lg flex items-center justify-center p-1.5">
                            <img src="/favicon.ico?v={{ time() }}" alt="SSRF Lab" class="w-full h-full object-contain">
                        </div>
                        <span class="text-xl font-bold text-white tracking-tight">SSRF LAB</span>
                    </a>
                </div>
                <div class="flex space-x-6">
                    <a href="/" class="text-gray-400 hover:text-[#9fef00] transition-colors duration-200 font-medium">Home</a>
                    <a href="/ssrf/basic" class="text-gray-400 hover:text-[#9fef00] transition-colors duration-200 font-medium">Basic</a>
                    <a href="/ssrf/blind" class="text-gray-400 hover:text-[#9fef00] transition-colors duration-200 font-medium">Blind</a>
                    <a href="/ssrf/dns-rebinding" class="text-gray-400 hover:text-[#9fef00] transition-colors duration-200 font-medium">DNS</a>
                </div>
            </div>
        </div>
    </nav>
    <main class="flex-grow">
        @yield('content')
    </main>
    <footer class="bg-[#1e293b] border-t border-[#2d3748] py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-white font-mono">Made with 💚 by SH3LLT3R Yasser Tioursi</p>
        </div>
    </footer>
    <script>
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        function formatJSON(json) { try { const obj = typeof json === 'string' ? JSON.parse(json) : json; return JSON.stringify(obj, null, 2); } catch (e) { return json; } }
        function copyToClipboard(text) { navigator.clipboard.writeText(text).then(() => { alert('Copied to clipboard!'); }); }
    </script>
    @stack('scripts')
</body>
</html>
