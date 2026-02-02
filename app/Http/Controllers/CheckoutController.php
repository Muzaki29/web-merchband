<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    protected $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }
        return view('checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'customer_city' => 'required',
            'customer_postal_code' => 'required',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        DB::beginTransaction();
        try {
            $subtotal = 0;
            $orderItems = [];

            // Re-validate price and stock
            foreach ($cart as $id => $item) {
                $variant = ProductVariant::with('product')->lockForUpdate()->find($id);
                
                if (!$variant) {
                    throw new \Exception("Produk tidak ditemukan.");
                }

                if ($variant->stock < $item['quantity']) {
                    throw new \Exception("Stok {$variant->product->name} ({$variant->size}) tidak mencukupi.");
                }

                $price = $variant->product->price;
                $subtotal += $price * $item['quantity'];

                $orderItems[] = [
                    'product_variant_id' => $variant->id,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'product_name' => $variant->product->name,
                    'product_size' => $variant->size,
                ];
            }

            $shippingCost = 20000; // Flat shipping
            $totalPrice = $subtotal + $shippingCost;
            $orderNumber = 'ORD-' . strtoupper(Str::random(10));

            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'customer_city' => $request->customer_city,
                'customer_postal_code' => $request->customer_postal_code,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            foreach ($orderItems as $item) {
                $order->items()->create($item);
            }

            // Generate Snap Token
            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => (int) $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => $request->customer_name,
                    'email' => $request->customer_email,
                    'phone' => $request->customer_phone,
                ],
            ];

            $snapToken = $this->midtrans->createSnapToken($params);
            $order->update(['snap_token' => $snapToken]);

            DB::commit();
            
            session()->forget('cart');

            // Redirect to the new order status page
            return redirect()->route('orders.show', $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        $snapToken = $order->snap_token;
        if ($order->status == 'pending' && empty($snapToken)) {
            // Regenerate token if missing for pending order
             $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => (int) $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => $order->customer_name,
                    'email' => $order->customer_email,
                    'phone' => $order->customer_phone,
                ],
            ];
            try {
                $snapToken = $this->midtrans->createSnapToken($params);
                $order->update(['snap_token' => $snapToken]);
            } catch (\Exception $e) {
                // Log error
            }
        }
        return view('checkout.payment', compact('order', 'snapToken'));
    }

    public function track()
    {
        return view('orders.track');
    }

    public function find(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string|exists:orders,order_number',
        ], [
            'order_number.exists' => 'Order not found. Please check your order number.',
        ]);

        return redirect()->route('orders.show', $request->order_number);
    }
}
