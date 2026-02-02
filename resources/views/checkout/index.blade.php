<x-layout title="Checkout - Merch Band">
    <div class="max-w-7xl mx-auto">
        <h1 class="sr-only">Checkout</h1>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            <!-- Order Summary (Desktop: Right, Mobile: Bottom usually but here logical flow is left->right or top->bottom) -->
            <!-- Actually standard checkout often has summary on right. -->
            
            <section aria-labelledby="order-summary-heading" class="bg-gray-50 rounded-lg p-6 lg:col-start-2 lg:row-start-1 lg:bg-transparent lg:p-0 border border-gray-200 lg:border-none mb-10 lg:mb-0">
                <h2 id="order-summary-heading" class="text-lg font-medium text-gray-900 mb-6">Order Summary</h2>

                <ul role="list" class="flex-auto overflow-y-auto divide-y divide-gray-200">
                    @php 
                        $subtotal = 0;
                    @endphp
                    @foreach($cart as $item)
                        @php $subtotal += $item['price'] * $item['quantity']; @endphp
                        <li class="flex py-6 space-x-6">
                            <img src="{{ $item['image'] ?? 'https://placehold.co/150x150' }}" alt="{{ $item['name'] }}" class="flex-none w-20 h-20 rounded-md object-center object-cover bg-gray-200">
                            <div class="flex-auto space-y-1">
                                <h3 class="text-gray-900">{{ $item['name'] }}</h3>
                                <p class="text-gray-500">{{ $item['size'] }}</p>
                                <p class="text-gray-500">Qty {{ $item['quantity'] }}</p>
                            </div>
                            <p class="flex-none font-medium text-gray-900">
                                <x-money :amount="$item['price'] * $item['quantity']" />
                            </p>
                        </li>
                    @endforeach
                </ul>

                <dl class="text-sm font-medium text-gray-500 space-y-6 border-t border-gray-200 pt-6 mt-6">
                    <div class="flex justify-between">
                        <dt>Subtotal</dt>
                        <dd class="text-gray-900"><x-money :amount="$subtotal" /></dd>
                    </div>
                    <div class="flex justify-between">
                        <dt>Shipping</dt>
                        <dd class="text-gray-900"><x-money :amount="20000" /></dd>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-6 text-gray-900">
                        <dt class="text-base">Total</dt>
                        <dd class="text-base"><x-money :amount="$subtotal + 20000" /></dd>
                    </div>
                </dl>
            </section>

            <!-- Checkout Form -->
            <section aria-labelledby="payment-heading" class="lg:col-start-1 lg:row-start-1 glass-card rounded-3xl p-6 lg:p-8">
                <h2 id="payment-heading" class="text-xl font-bold font-display text-slate-900 mb-8">Contact & Shipping Information</h2>

                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!-- Contact Info -->
                        <div class="sm:col-span-6">
                            <h3 class="text-sm font-medium text-gray-900 mt-4 mb-2">Contact</h3>
                        </div>

                        <div class="sm:col-span-3">
                            <x-label for="customer_name" value="Full Name" />
                            <x-input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required />
                        </div>

                        <div class="sm:col-span-3">
                            <x-label for="customer_email" value="Email Address" />
                            <x-input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required />
                        </div>

                        <div class="sm:col-span-6">
                            <x-label for="customer_phone" value="Phone Number" />
                            <x-input type="tel" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required />
                        </div>

                        <!-- Shipping Info -->
                        <div class="sm:col-span-6 border-t border-gray-200 pt-6 mt-2">
                            <h3 class="text-sm font-medium text-gray-900 mb-2">Shipping Address</h3>
                        </div>

                        <div class="sm:col-span-6">
                            <x-label for="customer_address" value="Street Address" />
                            <x-input type="text" id="customer_address" name="customer_address" value="{{ old('customer_address') }}" required />
                        </div>

                        <div class="sm:col-span-3">
                            <x-label for="customer_city" value="City" />
                            <x-input type="text" id="customer_city" name="customer_city" value="{{ old('customer_city') }}" required />
                        </div>

                        <div class="sm:col-span-3">
                            <x-label for="customer_postal_code" value="Postal Code" />
                            <x-input type="text" id="customer_postal_code" name="customer_postal_code" value="{{ old('customer_postal_code') }}" required />
                        </div>
                    </div>

                    <div class="mt-10 border-t border-gray-200 pt-6">
                        <x-button class="w-full py-4 text-lg" full>
                            Continue to Payment
                        </x-button>
                        <p class="mt-4 text-center text-sm text-gray-500">
                            Secure payment processing by Midtrans.
                        </p>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-layout>
