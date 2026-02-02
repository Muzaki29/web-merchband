<x-layout title="Catalog - Merch Band">
    <!-- Hero Section -->
    <div class="relative overflow-hidden mb-16 lg:mb-24 rounded-3xl">
        <div class="absolute inset-0 bg-slate-50"></div>
        
        <!-- Expressive Background Elements -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-brand/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-slate-200/50 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12 lg:pt-24 lg:pb-24">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                <!-- Text Content -->
                <div class="text-center lg:text-left z-10">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-brand/5 border border-brand/10 text-brand text-sm font-semibold mb-6">
                        <span class="flex h-2 w-2 rounded-full bg-brand mr-2"></span>
                        Official Merchandise
                    </div>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-display font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-6">
                        PANCARONA <br>
                        <span class="text-brand">MERCH OFFICIAL.</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-slate-500 max-w-2xl mx-auto lg:mx-0 mb-8 font-light leading-relaxed">
                        Authentic merchandise that connects you to the sound. Premium quality, sustainable materials, and designs that speak louder than words.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#catalog" class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-lg font-bold rounded-full text-white bg-brand hover:bg-brand-hover hover:scale-105 transition-all duration-300 shadow-lg shadow-brand/20">
                            Shop Latest Drops
                        </a>
                    </div>
                </div>

                <!-- Visual Content -->
                <div class="relative lg:h-auto z-10 hidden lg:block">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl transform rotate-2 hover:rotate-0 transition-all duration-500">
                        <img class="w-full h-full object-cover" src="https://placehold.co/800x1000/AA2B1D/FFFFFF/png?text=Pancarona+Merch" alt="Hero Image">
                        <div class="absolute inset-0 bg-linear-to-t from-black/40 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <p class="font-display font-bold text-2xl">Pancarona Collection</p>
                            <p class="text-white/80">Limited Edition</p>
                        </div>
                    </div>
                    <!-- Decorative floating element -->
                    <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl animate-bounce" style="animation-duration: 3s;">
                        <div class="flex items-center gap-3">
                            <div class="bg-green-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Selling Fast</p>
                                <p class="text-xs text-slate-500">24 sold in last hour</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Catalog Section -->
    <div id="catalog" class="mb-24">
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
            <div>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-slate-900">Latest Drops</h2>
                <p class="text-slate-500 mt-2">Fresh from the studio to your wardrobe.</p>
            </div>
            <div class="flex gap-2">
                <button class="px-4 py-2 text-sm font-semibold text-white bg-slate-900 rounded-full">All</button>
                <button class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-full transition">T-Shirts</button>
                <button class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-full transition">Hoodies</button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 gap-y-12 sm:grid-cols-2 gap-x-8 lg:grid-cols-3 xl:gap-x-10">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</x-layout>
