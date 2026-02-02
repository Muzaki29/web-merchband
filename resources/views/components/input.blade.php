@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'shadow-sm border-gray-300 focus:border-brand focus:ring-brand rounded-md w-full sm:text-sm py-2 px-3 border']) !!}>
