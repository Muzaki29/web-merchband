<x-layout :title="'Order #' . $order->order_number . ' - Merch Band'">
    <div class="max-w-3xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center bg-gray-50 border-b border-gray-200">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Order Information
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        {{ $order->order_number }}
                    </p>
                </div>
                <div>
                    <x-badge :status="$order->status" class="px-3 py-1 text-sm font-semibold" />
                </div>
            </div>
            
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Full name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->customer_name }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Email address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->customer_email }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Phone number</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->customer_phone }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Shipping address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $order->customer_address }}<br>
                            {{ $order->customer_city }}, {{ $order->customer_postal_code }}
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Order Items -->
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Items</h4>
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach($order->items as $item)
                        <li class="py-3 flex justify-between">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $item->product_name }}</p>
                                    <p class="text-sm text-gray-500">Size: {{ $item->product_size }} | Qty: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                <x-money :amount="$item->price * $item->quantity" />
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4 flex justify-end pt-4 border-t border-gray-200">
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Subtotal: <x-money :amount="$order->subtotal" /></p>
                        <p class="text-sm text-gray-500">Shipping: <x-money :amount="$order->shipping_cost" /></p>
                        <p class="text-lg font-bold text-gray-900 mt-1">Total: <x-money :amount="$order->total_price" /></p>
                    </div>
                </div>
            </div>

            <!-- Payment Action -->
            <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-end border-t border-gray-200">
                @if($order->status == 'pending' && $snapToken)
                    <x-button id="pay-button">
                        Pay Now
                    </x-button>
                @elseif($order->status == 'paid' || $order->status == 'settlement' || $order->status == 'capture')
                    <div class="flex items-center text-green-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Payment Successful
                    </div>
                @elseif($order->status == 'cancelled' || $order->status == 'expire')
                     <div class="flex items-center text-red-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Order Cancelled
                    </div>
                @endif
            </div>
        </div>
        
        <div class="mt-6 text-center">
            <a href="{{ route('catalog.index') }}" class="text-sm font-medium text-brand hover:text-brand-hover">
                &larr; Back to Catalog
            </a>
        </div>
    </div>

    @if($order->status == 'pending' && $snapToken)
        <script type="text/javascript">
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function () {
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result){
                        /* You may add your own implementation here */
                        // alert("payment success!"); 
                        console.log(result);
                        window.location.reload();
                    },
                    onPending: function(result){
                        /* You may add your own implementation here */
                        // alert("wating your payment!"); 
                        console.log(result);
                        window.location.reload();
                    },
                    onError: function(result){
                        /* You may add your own implementation here */
                        // alert("payment failed!"); 
                        console.log(result);
                        window.location.reload();
                    },
                    onClose: function(){
                        /* You may add your own implementation here */
                        // alert('you closed the popup without finishing the payment');
                    }
                })
            });
        </script>
    @endif
</x-layout>
