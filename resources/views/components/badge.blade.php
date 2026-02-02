@props(['status'])

@php
    $baseClasses = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 capitalize';
    
    $colors = [
        'pending' => 'bg-yellow-100 text-yellow-800',
        'paid' => 'bg-green-100 text-green-800',
        'settlement' => 'bg-green-100 text-green-800',
        'capture' => 'bg-green-100 text-green-800',
        'expired' => 'bg-gray-100 text-gray-800',
        'cancelled' => 'bg-red-100 text-red-800',
        'deny' => 'bg-red-100 text-red-800',
        'default' => 'bg-gray-100 text-gray-800',
        'brand' => 'bg-brand-soft text-brand border border-brand/20',
    ];

    $classes = $baseClasses . ' ' . ($colors[$status] ?? $colors['default']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $status }}
</span>
