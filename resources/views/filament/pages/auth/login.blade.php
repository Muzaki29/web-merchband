@php
    $brandColor = \Filament\Support\Colors\Color::hex('#AA2B1D');
@endphp

<div class="flex min-h-screen items-center justify-center relative overflow-hidden bg-slate-50 font-sans">
    
    <!-- Animated Background Mesh -->
    <div class="absolute inset-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-brand/20 rounded-full mix-blend-multiply filter blur-[80px] opacity-70 animate-blob"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-purple-200 rounded-full mix-blend-multiply filter blur-[80px] opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute top-[20%] right-[20%] w-[40%] h-[40%] bg-orange-100 rounded-full mix-blend-multiply filter blur-[80px] opacity-70 animate-blob animation-delay-4000"></div>
        <!-- Noise Texture -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjZmZmIi8+CjxyZWN0IHdpZHRoPSIxIiBoZWlnaHQ9IjEiIGZpbGw9IiNjY2MiLz4KPC9zdmc+')] opacity-20"></div>
    </div>

    <!-- Main Card Container -->
    <div class="relative w-full max-w-5xl bg-white/60 backdrop-blur-2xl rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row m-4 border border-white/50">
        
        <!-- Left Side: Visual/Brand -->
        <div class="relative w-full lg:w-5/12 bg-brand text-white overflow-hidden flex flex-col items-center justify-center p-12 text-center group">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-20">
                <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
                </svg>
            </div>
            <div class="absolute inset-0 bg-linear-to-br from-brand via-brand to-brand-active opacity-90"></div>
            
            <!-- Floating Circles Decor -->
            <div class="absolute -top-12 -left-12 w-32 h-32 rounded-full bg-white/10 blur-xl group-hover:scale-110 transition-transform duration-700"></div>
            <div class="absolute -bottom-12 -right-12 w-40 h-40 rounded-full bg-black/10 blur-xl group-hover:scale-110 transition-transform duration-700"></div>

            <!-- Content -->
            <div class="relative z-10 transform group-hover:-translate-y-1 transition-transform duration-500">
                <div class="mb-8 relative">
                    <div class="absolute inset-0 bg-white/20 rounded-full blur-xl transform scale-110"></div>
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="relative h-32 w-32 rounded-full shadow-2xl border-4 border-white/10 object-cover">
                </div>
                <h1 class="text-3xl font-display font-bold mb-3 tracking-tight">Pancarona Merch</h1>
                <p class="text-brand-50 text-sm font-light max-w-xs mx-auto leading-relaxed opacity-90">
                    Control Panel & Management System
                </p>
            </div>
            
            <div class="absolute bottom-8 text-xs text-brand-100/60 font-medium tracking-widest uppercase">
                Est. {{ date('Y') }}
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-7/12 p-8 lg:p-16 bg-white/40">
            <div class="max-w-md mx-auto">
                <div class="text-center lg:text-left mb-10">
                    <h2 class="text-2xl font-bold text-slate-800 font-display">Welcome Back</h2>
                    <p class="text-slate-500 mt-2 text-sm">Please enter your details to sign in.</p>
                </div>

                <div class="filament-login-form space-y-6">
                    {{ $this->form }}
                </div>

                <div class="mt-8 pt-6 border-t border-slate-200/60 flex items-center justify-between text-sm">
                    <a href="{{ url('/') }}" class="flex items-center text-slate-500 hover:text-brand transition-colors font-medium group">
                        <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Store
                    </a>
                    <span class="text-slate-400 text-xs">Secure Connection</span>
                </div>
            </div>
        </div>

    </div>
    
    <!-- Bottom Credit -->
    <div class="absolute bottom-4 text-center w-full pointer-events-none">
        <p class="text-[10px] text-slate-400 uppercase tracking-widest opacity-60">
            Powered by Pancarona Technology
        </p>
    </div>

    <style>
        /* Custom overrides for Filament Form Inputs to match the theme */
        .fi-input-wrp {
            border-radius: 0.75rem !important; /* rounded-xl */
            background-color: rgba(255, 255, 255, 0.5) !important;
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
        }
        .fi-input-wrp:focus-within {
            background-color: #fff !important;
            box-shadow: 0 4px 6px -1px rgba(170, 43, 29, 0.1), 0 2px 4px -1px rgba(170, 43, 29, 0.06) !important;
            border-color: #AA2B1D !important;
        }
        .fi-btn-primary {
            background-color: #AA2B1D !important;
            border-radius: 0.75rem !important;
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 14px 0 rgba(170, 43, 29, 0.39) !important;
        }
        .fi-btn-primary:hover {
            background-color: #8F2418 !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(170, 43, 29, 0.23) !important;
        }
        /* Checkbox styling */
        input[type="checkbox"] {
            border-radius: 0.25rem;
            color: #AA2B1D !important;
        }
    </style>
</div>
