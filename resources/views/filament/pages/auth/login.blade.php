@php
    $brandColor = \Filament\Support\Colors\Color::hex('#AA2B1D');
@endphp

<div class="flex min-h-screen">
    <div class="hidden w-1/2 bg-brand lg:block relative overflow-hidden">
        <div class="absolute inset-0 bg-linear-to-br from-brand to-brand-active opacity-90"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center p-12 text-white z-10">
            <div class="mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-32 w-auto rounded-full shadow-2xl">
            </div>
            <h1 class="text-4xl font-bold mb-4">Pancarona Merch Official</h1>
            <p class="text-xl text-brand-50 text-center max-w-lg">
                Manage your store with ease and style. Welcome back, Administrator!
            </p>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-black/10 blur-3xl"></div>
        </div>
    </div>

    <div class="flex w-full flex-col justify-center px-4 py-12 lg:w-1/2 sm:px-6 lg:px-8 bg-gray-50">
        <div class="mx-auto w-full max-w-md space-y-8 bg-white p-10 rounded-2xl shadow-xl">
            <div class="text-center lg:hidden">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-20 w-auto rounded-full">
                <h2 class="mt-4 text-2xl font-bold tracking-tight text-gray-900">
                    Sign in to admin panel
                </h2>
            </div>
            
            <div class="hidden lg:block text-center">
                <h2 class="text-2xl font-bold tracking-tight text-brand">
                    Welcome Back
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Please sign in to your account
                </p>
            </div>

            {{ $this->form }}

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Back to 
                    <a href="{{ url('/') }}" class="font-medium text-brand hover:text-brand-hover transition-colors">
                        Storefront
                    </a>
                </p>
            </div>
        </div>
        
        <div class="mt-8 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} Pancarona Merch Official. All rights reserved.
        </div>
    </div>
</div>
