<nav class="glass sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <a href="{{ route('catalog.index') }}" class="shrink-0 flex items-center gap-2 group">
                    <!-- Logo Image -->
                    <img src="{{ asset('images/logo.png') }}" alt="Pancarona Merch Official" class="h-10 w-10 object-cover rounded-full transition-transform duration-300 group-hover:scale-105">
                </a>
                <div class="hidden md:ml-10 md:flex md:space-x-8">
                    <a href="{{ route('catalog.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('catalog.*') ? 'border-brand text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }} text-sm font-semibold transition duration-150 ease-in-out">
                        Catalog
                    </a>
                    <a href="{{ route('orders.track') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('orders.track') ? 'border-brand text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }} text-sm font-semibold transition duration-150 ease-in-out">
                        Track Order
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-brand text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }} text-sm font-semibold transition duration-150 ease-in-out">
                            Dashboard
                        </a>
                    @endauth
                </div>
            </div>
            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-500 hover:text-brand transition-colors">
                        Login
                    </a>
                    <span class="text-slate-300">|</span>
                    <a href="{{ route('register') }}" class="text-sm font-medium text-slate-500 hover:text-brand transition-colors">
                        Register
                    </a>
                @endguest
                <a href="{{ route('cart.index') }}" class="group relative p-2 text-slate-500 hover:text-brand transition duration-300 bg-slate-100/50 hover:bg-slate-100 rounded-full">
                    <span class="sr-only">View Cart</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    @php $count = count(session('cart', [])); @endphp
                    @if($count > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-brand rounded-full shadow-lg group-hover:scale-110 transition-transform">
                            {{ $count }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</nav>
