<x-layout :title="$product->name . ' - Merch Band'">
    <div class="glass-card rounded-3xl p-6 lg:p-12 overflow-hidden">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-16 xl:gap-x-20">
            <!-- Product Image -->
            <div class="product-image-container mb-10 lg:mb-0">
                <div class="aspect-[4/5] rounded-2xl overflow-hidden bg-slate-100 relative group">
                    <img src="{{ $product->image_url }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-center object-cover transform transition-transform duration-700 group-hover:scale-105">
                    
                    <!-- Zoom hint -->
                    <div class="absolute bottom-4 right-4 bg-white/80 backdrop-blur p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="product-info flex flex-col justify-center">
                <div class="mb-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 uppercase tracking-wide">
                        Official Merch
                    </span>
                </div>
                
                <h1 class="text-4xl lg:text-5xl font-display font-extrabold tracking-tight text-slate-900 mb-6">{{ $product->name }}</h1>
                
                <div class="mb-8 flex items-center gap-4">
                    <p class="text-4xl text-brand font-bold font-display">
                        <x-money :amount="$product->price" />
                    </p>
                    @if($product->price > 100000)
                        <span class="text-sm text-green-600 font-medium bg-green-50 px-2 py-1 rounded-lg">Free Shipping</span>
                    @endif
                </div>

                <div class="prose prose-lg text-slate-500 mb-10 leading-relaxed">
                    <p>{{ $product->description }}</p>
                </div>

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    
                    <!-- Variants -->
                    <div class="mb-10">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Select Size</h3>
                            <a href="#" class="text-sm text-brand hover:underline">Size Guide</a>
                        </div>
                        
                        <div class="grid grid-cols-4 gap-4" role="radiogroup">
                            @foreach($product->variants as $variant)
                                <label class="group relative border-2 rounded-xl py-4 px-4 flex items-center justify-center text-sm font-bold uppercase cursor-pointer hover:border-brand/30 transition-all duration-200 focus:outline-none sm:flex-1 bg-white text-slate-700 shadow-sm has-[:checked]:bg-brand has-[:checked]:text-white has-[:checked]:border-brand has-[:checked]:shadow-brand/30 {{ $variant->stock == 0 ? 'opacity-50 cursor-not-allowed bg-slate-50' : '' }}">
                                    <input type="radio" name="product_variant_id" value="{{ $variant->id }}" class="sr-only" {{ $variant->stock == 0 ? 'disabled' : '' }} required data-stock="{{ $variant->stock }}">
                                    <span id="size-choice-{{ $variant->id }}-label">{{ $variant->size }}</span>
                                    
                                    @if($variant->stock == 0)
                                        <span aria-hidden="true" class="absolute inset-0 border-2 border-slate-200 pointer-events-none rounded-xl">
                                            <svg class="absolute inset-0 w-full h-full text-slate-300 stroke-1" viewBox="0 0 100 100" preserveAspectRatio="none" stroke="currentColor">
                                                <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke" />
                                            </svg>
                                        </span>
                                    @endif
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Stock Status & Quantity -->
                    <div class="flex items-end gap-6 mb-10">
                        <div class="w-32">
                            <label for="quantity" class="block text-sm font-bold text-slate-900 mb-2 uppercase tracking-wider">Quantity</label>
                            <div class="relative">
                                <select id="quantity" name="quantity" class="appearance-none block w-full pl-4 pr-10 py-3 text-base border-2 border-slate-200 focus:outline-none focus:ring-0 focus:border-brand sm:text-sm rounded-xl font-bold text-slate-900 bg-white transition-colors">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div id="stock-display" class="pb-3 text-sm font-medium text-slate-500 flex items-center gap-2">
                            <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Select a size to see stock
                        </div>
                    </div>

                    <x-button class="w-full py-5 text-lg shadow-xl shadow-brand/20" full>
                        Add to Cart
                    </x-button>
                </form>

                <div class="mt-10 pt-8 border-t border-slate-100">
                    <div class="flex items-center space-x-3 text-sm font-medium text-slate-600">
                        <div class="flex items-center gap-2 bg-green-50 px-3 py-1.5 rounded-full text-green-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>In stock</span>
                        </div>
                        <span class="text-slate-300">|</span>
                        <span>Ships within 24 hours</span>
                        <span class="text-slate-300">|</span>
                        <span>Secure checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[name="product_variant_id"]').forEach(input => {
            input.addEventListener('change', function() {
                const stock = parseInt(this.dataset.stock);
                const stockDisplay = document.getElementById('stock-display');
                
                // Update stock display
                if (stock > 10) {
                    stockDisplay.innerHTML = '<span class="flex items-center gap-2 text-green-600 font-bold"><span class="w-2 h-2 bg-green-500 rounded-full"></span>In Stock (Ready to ship)</span>';
                } else if (stock > 0) {
                    stockDisplay.innerHTML = `<span class="flex items-center gap-2 text-orange-600 font-bold"><span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>Only ${stock} left!</span>`;
                } else {
                    stockDisplay.innerHTML = '<span class="flex items-center gap-2 text-red-600 font-bold"><span class="w-2 h-2 bg-red-500 rounded-full"></span>Out of Stock</span>';
                }
            });
        });
    </script>
</x-layout>
