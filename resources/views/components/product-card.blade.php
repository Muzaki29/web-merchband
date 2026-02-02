@props(['product'])

<div class="group relative bg-white rounded-2xl flex flex-col overflow-hidden card-hover border border-slate-100">
    <!-- Image Container -->
    <div class="aspect-4/5 bg-slate-100 relative overflow-hidden">
        <img src="{{ $product->image_url }}" 
             alt="{{ $product->name }}" 
             class="w-full h-full object-center object-cover transform transition-transform duration-700 group-hover:scale-105">
        
        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-linear-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

        <!-- Quick Action Button -->
        <div class="absolute bottom-4 left-4 right-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
            <a href="{{ route('catalog.show', $product->slug) }}" class="w-full block bg-white/90 backdrop-blur text-slate-900 text-center py-3 rounded-xl font-bold text-sm hover:bg-white shadow-lg">
                View Details
            </a>
        </div>
        
        <!-- Badge -->
        <div class="absolute top-3 left-3">
             <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-white/90 backdrop-blur text-slate-900 shadow-sm">
                New
             </span>
        </div>
    </div>

    <!-- Content -->
    <div class="flex-1 p-5 flex flex-col">
        <div class="flex justify-between items-start mb-2">
            <h3 class="text-lg font-display font-bold text-slate-900 leading-tight">
                <a href="{{ route('catalog.show', $product->slug) }}">
                    <span aria-hidden="true" class="absolute inset-0"></span>
                    {{ $product->name }}
                </a>
            </h3>
            <p class="text-lg font-bold text-brand ml-2">
                <x-money :amount="$product->price" />
            </p>
        </div>
        
        <p class="text-sm text-slate-500 line-clamp-2 mb-4">{{ $product->description }}</p>
        
        <!-- Color/Size placeholders or other metadata could go here -->
        <div class="mt-auto flex items-center gap-2 text-xs font-medium text-slate-400">
            <span>Official Merch</span>
            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
            <span>In Stock</span>
        </div>
    </div>
</div>
