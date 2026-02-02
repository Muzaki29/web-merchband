<nav class="glass sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <a href="{{ route('catalog.index') }}" class="shrink-0 flex items-center gap-2 group">
                    <!-- Logo Icon -->
                    <svg class="h-9 w-9 text-brand transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 3-2 3-2zm0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M9 19v2m0-2h2" />
                    </svg>
                    <span class="font-display font-bold text-2xl tracking-tight text-slate-900">Merch<span class="text-brand">Band</span></span>
                </a>
                <div class="hidden md:ml-10 md:flex md:space-x-8">
                    <a href="{{ route('catalog.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('catalog.*') ? 'border-brand text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-900 hover:border-slate-300' }} text-sm font-semibold transition duration-150 ease-in-out">
                        Catalog
                    </a>
                </div>
            </div>
            <div class="flex items-center gap-4">
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
