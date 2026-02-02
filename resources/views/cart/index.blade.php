<x-layout title="Shopping Cart - Merch Band">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-display font-extrabold tracking-tight text-slate-900 mb-10">Shopping Cart</h1>
        
        @if(count($cart) > 0)
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
                <section class="lg:col-span-7">
                    <ul role="list" class="border-t border-slate-200 divide-y divide-slate-200">
                        @foreach($cart as $id => $item)
                            <li class="flex py-8">
                                <div class="shrink-0">
                                    <img src="{{ $item['image'] ?? 'https://placehold.co/200x200' }}" 
                                         alt="{{ $item['name'] }}" 
                                         class="w-24 h-24 rounded-2xl object-center object-cover sm:w-32 sm:h-32 shadow-sm border border-slate-100">
                                </div>

                                <div class="ml-6 flex-1 flex flex-col justify-between">
                                    <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                        <div>
                                            <div class="flex justify-between">
                                                <h3 class="text-lg font-bold font-display text-slate-900">
                                                    <a href="#" class="hover:text-brand transition-colors">
                                                        {{ $item['name'] }}
                                                    </a>
                                                </h3>
                                            </div>
                                            <div class="mt-1 flex text-sm">
                                                <p class="text-slate-500 font-medium">Size: {{ $item['size'] }}</p>
                                            </div>
                                            <p class="mt-2 text-lg font-bold text-slate-900">
                                                <x-money :amount="$item['price']" />
                                            </p>
                                        </div>

                                        <div class="mt-4 sm:mt-0 sm:pr-9">
                                            <form action="{{ route('cart.update') }}" method="POST" class="inline-block">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <label for="quantity-{{ $id }}" class="sr-only">Quantity, {{ $item['name'] }}</label>
                                                <div class="relative">
                                                    <select id="quantity-{{ $id }}" name="quantity" onchange="this.form.submit()" class="max-w-full rounded-xl border border-slate-300 py-2 pl-3 pr-8 text-base font-bold text-slate-700 text-left shadow-sm focus:outline-none focus:ring-2 focus:ring-brand focus:border-brand sm:text-sm bg-white">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </form>

                                            <div class="absolute top-0 right-0">
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <button type="submit" class="-m-2 p-2 inline-flex text-slate-400 hover:text-red-500 transition-colors">
                                                        <span class="sr-only">Remove</span>
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <!-- Order Summary -->
                <section class="mt-16 glass-card rounded-3xl px-6 py-8 sm:p-10 lg:mt-0 lg:col-span-5">
                    <h2 id="summary-heading" class="text-xl font-bold font-display text-slate-900 mb-6">Order summary</h2>

                    <dl class="space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-slate-600">Subtotal</dt>
                            <dd class="text-sm font-bold text-slate-900">
                                @php 
                                    $subtotal = collect($cart)->sum(function($item) { return $item['price'] * $item['quantity']; });
                                @endphp
                                <x-money :amount="$subtotal" />
                            </dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                            <dt class="text-sm text-slate-600">Shipping estimate</dt>
                            <dd class="text-sm font-bold text-slate-900">
                                <x-money :amount="20000" />
                            </dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                            <dt class="text-lg font-bold text-slate-900">Order total</dt>
                            <dd class="text-lg font-bold text-brand">
                                <x-money :amount="$subtotal + 20000" />
                            </dd>
                        </div>
                    </dl>

                    <div class="mt-8">
                        <a href="{{ route('checkout.index') }}" class="w-full flex justify-center py-4 px-6 border border-transparent rounded-full shadow-lg shadow-brand/20 text-base font-bold text-white bg-brand hover:bg-brand-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand transition-all duration-300 hover:-translate-y-1">
                            Proceed to Checkout
                        </a>
                    </div>
                </section>
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-slate-100">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-6">
                    <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold font-display text-slate-900 mb-2">Your cart is empty</h2>
                <p class="text-slate-500 mb-8">Looks like you haven't added any merch yet.</p>
                <a href="{{ route('catalog.index') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-bold rounded-full text-white bg-brand hover:bg-brand-hover shadow-lg shadow-brand/20 transition-all duration-300">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</x-layout>
