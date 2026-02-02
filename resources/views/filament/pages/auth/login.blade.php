@php
    $brandColor = \Filament\Support\Colors\Color::hex('#AA2B1D');
@endphp

<div class="min-h-screen flex flex-col lg:flex-row">
    <!-- Left Side: Brand/Image -->
    <div class="hidden lg:flex w-full lg:w-1/2 bg-[#AA2B1D] items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#AA2B1D] to-[#7A1F15] opacity-90"></div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
            <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full">
                <path d="M0 100 L100 0 L100 100 Z" fill="white" />
            </svg>
        </div>

        <div class="relative z-10 text-white p-12 text-center max-w-lg">
            <div class="mb-8 flex justify-center">
                <!-- Icon or Logo placeholder -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-20 h-20 text-white/90">
                    <path fill-rule="evenodd" d="M19.902 4.098a3.75 3.75 0 0 0-5.304 0l-4.598 4.598-4.598-4.598a3.75 3.75 0 0 0-5.304 5.304l9.196 9.196a.75.75 0 0 0 1.06 0l9.196-9.196a3.75 3.75 0 0 0 0-5.304ZM3.75 18.5a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5a.75.75 0 0 1 .75-.75Zm3.75 0a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5a.75.75 0 0 1 .75-.75Zm3.75 0a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5a.75.75 0 0 1 .75-.75Zm3.75 0a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5a.75.75 0 0 1 .75-.75Zm3.75 0a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                </svg>
            </div>
            <h1 class="text-5xl font-bold font-display mb-6 tracking-tight">MerchBand</h1>
            <p class="text-xl text-white/80 font-light leading-relaxed">
                Manage your products, track orders, and connect with fans.
                <br>All in one place.
            </p>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-8 sm:p-12 lg:p-16">
        <div class="w-full max-w-md space-y-8">
            <div class="text-center lg:hidden mb-8">
                <h2 class="text-3xl font-bold text-[#AA2B1D] font-display">MerchBand</h2>
            </div>
            
            <div class="space-y-2">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 font-display">
                    Admin Access
                </h2>
                <p class="text-slate-500">
                    Enter your credentials to access the dashboard.
                </p>
            </div>

            <div class="mt-8">
                {{ $this->form }}
            </div>

            @if (filament()->hasRegistration())
                <p class="text-center text-sm text-slate-600 mt-6">
                    Don't have an account?
                    <a href="{{ filament()->getRegistrationUrl() }}" class="font-semibold text-[#AA2B1D] hover:text-[#8F2418] hover:underline">
                        Sign up
                    </a>
                </p>
            @endif
        </div>
    </div>
</div>
