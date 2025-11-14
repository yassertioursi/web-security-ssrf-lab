@extends('layout')

@section('title', 'Home')

@section('content')
<div class="bg-[#141d2f] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-[#9fef00] mb-4 tracking-tight">SSRF VULNERABILITY LAB</h1>
            <p class="text-xl text-gray-400">Master Server-Side Request Forgery techniques in a controlled environment</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-[#1e293b] rounded-lg border border-[#2d3748] hover:border-[#9fef00] transition-all duration-300 overflow-hidden group">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-[#9fef00] text-4xl">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-mono text-gray-500 bg-[#141d2f] px-3 py-1 rounded">LAB 01</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Basic SSRF</h3>
                    <p class="text-gray-400 mb-6 text-sm leading-relaxed">Learn fundamental SSRF exploitation by manipulating URL parameters to access internal resources and services.</p>
                    <a href="/ssrf/basic" class="block w-full bg-[#9fef00] text-[#141d2f] text-center py-3 rounded font-bold hover:bg-[#88d600] transition-colors duration-300 uppercase tracking-wide">Launch Lab</a>
                </div>
                <div class="h-1 bg-gradient-to-r from-[#9fef00] to-[#88d600] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
            </div>

            <div class="bg-[#1e293b] rounded-lg border border-[#2d3748] hover:border-[#9fef00] transition-all duration-300 overflow-hidden group">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-[#9fef00] text-4xl">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-mono text-gray-500 bg-[#141d2f] px-3 py-1 rounded">LAB 02</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Blind SSRF</h3>
                    <p class="text-gray-400 mb-6 text-sm leading-relaxed">Master blind SSRF techniques using port scanning and timing-based attacks to discover internal network topology.</p>
                    <a href="/ssrf/blind" class="block w-full bg-[#9fef00] text-[#141d2f] text-center py-3 rounded font-bold hover:bg-[#88d600] transition-colors duration-300 uppercase tracking-wide">Launch Lab</a>
                </div>
                <div class="h-1 bg-gradient-to-r from-[#9fef00] to-[#88d600] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
            </div>

            <div class="bg-[#1e293b] rounded-lg border border-[#2d3748] hover:border-[#9fef00] transition-all duration-300 overflow-hidden group">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-[#9fef00] text-4xl">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-mono text-gray-500 bg-[#141d2f] px-3 py-1 rounded">LAB 03</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">DNS Resolution</h3>
                    <p class="text-gray-400 mb-6 text-sm leading-relaxed">Exploit DNS rebinding vulnerabilities to bypass SSRF protections and access restricted internal services.</p>
                    <a href="/ssrf/dns-rebinding" class="block w-full bg-[#9fef00] text-[#141d2f] text-center py-3 rounded font-bold hover:bg-[#88d600] transition-colors duration-300 uppercase tracking-wide">Launch Lab</a>
                </div>
                <div class="h-1 bg-gradient-to-r from-[#9fef00] to-[#88d600] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
            </div>
        </div>

        <div class="mt-8 bg-red-900/20 border border-red-500/50 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <div>
                    <p class="text-red-400 font-mono text-sm"><strong>WARNING:</strong> This environment contains intentionally vulnerable code for educational purposes only. Never deploy in production.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
