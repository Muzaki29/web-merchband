@php
    $brandColor = \Filament\Support\Colors\Color::hex('#AA2B1D');
@endphp

<div class="flex min-h-screen w-full bg-[#0a0a0a] text-white font-sans overflow-hidden">
    
    <!-- Left Section: Visual Identity -->
    <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-12 bg-[#AA2B1D] overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-overlay"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/90"></div>
        
        <!-- Animated Glows -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-red-600 rounded-full mix-blend-screen filter blur-[128px] opacity-40 animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-orange-600 rounded-full mix-blend-screen filter blur-[128px] opacity-30 animate-blob"></div>

        <!-- Logo & Brand -->
        <div class="relative z-10">
            <div class="flex items-center space-x-3 mb-6">
                <div class="h-12 w-12 rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/20">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8 object-contain">
                </div>
                <span class="text-xl font-bold tracking-wider uppercase opacity-90">Pancarona Merch</span>
            </div>
        </div>

        <!-- Hero Text -->
        <div class="relative z-10 mb-20">
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 tracking-tight">
                Manage Your <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-white/50">Empire.</span>
            </h1>
            <p class="text-lg text-white/60 max-w-md leading-relaxed">
                Complete control over your merchandise, orders, and customer relationships in one powerful dashboard.
            </p>
        </div>

        <!-- Footer -->
        <div class="relative z-10 flex items-center justify-between text-xs font-medium tracking-widest text-white/40 uppercase">
            <p>© {{ date('Y') }} Pancarona Merch</p>
            <p>System v1.0</p>
        </div>
    </div>

    <!-- Right Section: Login Form -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 relative bg-[#0a0a0a]">
        <!-- Mobile Background Glow -->
        <div class="absolute inset-0 lg:hidden overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] right-[-10%] w-[80%] h-[80%] bg-[#AA2B1D] rounded-full mix-blend-screen filter blur-[100px] opacity-20"></div>
        </div>

        <div class="w-full max-w-md relative z-10">
            <!-- Header -->
            <div class="mb-10 text-center lg:text-left">
                <h2 class="text-3xl font-bold mb-2">Welcome Back</h2>
                <p class="text-zinc-500">Enter your credentials to access the admin panel.</p>
            </div>

            <!-- Form -->
            <div class="filament-login-form space-y-6">
                {{ $this->form }}
            </div>

            <!-- Footer Links -->
            <div class="mt-10 flex items-center justify-between pt-6 border-t border-zinc-800/50">
                <a href="{{ url('/') }}" class="group flex items-center text-sm text-zinc-500 hover:text-white transition-colors">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Store
                </a>
                <span class="text-xs text-zinc-600">Secure Environment</span>
            </div>
        </div>
        
        <div class="absolute bottom-6 text-center w-full pointer-events-none lg:hidden">
            <p class="text-[10px] text-zinc-600 uppercase tracking-widest">
                Powered by Pancarona Technology
            </p>
        </div>
    </div>

    <style>
        /* Custom overrides for Filament Form Inputs in Dark Mode */
        .fi-input-wrp {
            background-color: #171717 !important; /* Zinc 900 */
            border-color: #27272a !important; /* Zinc 800 */
            color: white !important;
            border-radius: 0.5rem !important;
            transition: all 0.2s ease;
        }
        .fi-input-wrp input {
            color: white !important;
        }
        .fi-input-wrp:focus-within {
            border-color: #AA2B1D !important;
            box-shadow: 0 0 0 1px #AA2B1D !important;
            background-color: #27272a !important;
        }
        
        /* Button Styling */
        .fi-btn-primary {
            background-color: #AA2B1D !important;
            color: white !important;
            border-radius: 0.5rem !important;
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
        }
        .fi-btn-primary:hover {
            background-color: #8F2418 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(170, 43, 29, 0.4) !important;
        }

        /* Checkbox Styling */
        input[type="checkbox"] {
            background-color: #171717 !important;
            border-color: #27272a !important;
            color: #AA2B1D !important;
            border-radius: 4px !important;
        }
        input[type="checkbox"]:checked {
            background-color: #AA2B1D !important;
            border-color: #AA2B1D !important;
        }
        
        /* Labels */
        label {
            color: #a1a1aa !important; /* Zinc 400 */
        }
    </style>
</div>
