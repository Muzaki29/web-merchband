<x-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold text-brand tracking-wide uppercase">Support</h2>
                <p class="mt-1 text-4xl font-extrabold text-slate-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
                    Track Your Order
                </p>
                <p class="max-w-xl mx-auto mt-5 text-xl text-slate-500">
                    Enter your order number to check the current status and delivery details.
                </p>
            </div>

            <div class="mt-12 max-w-lg mx-auto">
                <form action="{{ route('orders.find') }}" method="POST" class="grid grid-cols-1 gap-y-6">
                    @csrf
                    <div>
                        <label for="order_number" class="block text-sm font-medium text-slate-700">Order Number</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" name="order_number" id="order_number" class="focus:ring-brand focus:border-brand block w-full sm:text-lg border-slate-300 rounded-md py-3" placeholder="ORD-XXXXXXXX" required value="{{ old('order_number') }}">
                        </div>
                        @error('order_number')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand hover:bg-brand-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand transition-colors duration-200">
                        Check Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
