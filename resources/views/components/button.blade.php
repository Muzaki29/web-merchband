@props(['type' => 'submit', 'variant' => 'primary', 'full' => false])

@php
    $baseClasses = 'inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-full font-bold text-sm tracking-wide focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-300 transform active:scale-95';
    
    $variants = [
        'primary' => 'bg-brand text-white hover:bg-brand-hover hover:shadow-lg hover:shadow-brand/30 focus:ring-brand/30',
        'secondary' => 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 focus:ring-slate-200',
        'success' => 'bg-emerald-600 text-white hover:bg-emerald-500 hover:shadow-lg hover:shadow-emerald/30 focus:ring-emerald-500',
        'danger' => 'bg-red-600 text-white hover:bg-red-500 hover:shadow-lg hover:shadow-red/30 focus:ring-red-500',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ($full ? ' w-full' : '');
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
