<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductVariant;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    protected $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }

    public function handle(Request $request)
    {
        try {
            $notification = new \Midtrans\Notification();

            $orderNumber = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;

            // Verify Signature
            $input = (array) $notification->getResponse();
            $signatureKey = $input['signature_key'];
            $statusCode = $input['status_code'];
            $grossAmount = $input['gross_amount'];
            $serverKey = config('services.midtrans.server_key');
            $mySignature = hash('sha512', $orderNumber . $statusCode . $grossAmount . $serverKey);

            if ($signatureKey !== $mySignature) {
                return response()->json(['message' => 'Invalid Signature'], 403);
            }

            $order = Order::where('order_number', $orderNumber)->firstOrFail();

            // Log event
            $order->paymentEvents()->create([
                'event_type' => $transactionStatus,
                'payload' => $request->all(),
            ]);

            DB::beginTransaction();
            
            // Reload order with lock to prevent race conditions during status update
            $order = Order::where('id', $order->id)->lockForUpdate()->first();

            // Update payment details from webhook input
            $order->payment_provider = $input['payment_type'] ?? $order->payment_provider;
            $order->payment_ref = $input['transaction_id'] ?? $order->payment_ref;

            if ($order->status == 'paid') {
                DB::commit();
                return response()->json(['message' => 'Order already paid']);
            }

            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $order->status = 'pending';
                } else {
                    $order->status = 'paid';
                }
            } else if ($transactionStatus == 'settlement') {
                $order->status = 'paid';
            } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                $order->status = 'cancelled';
            } else if ($transactionStatus == 'pending') {
                $order->status = 'pending';
            }

            if ($order->status == 'paid') {
                $this->decreaseStock($order);
            }

            $order->save();
            DB::commit();

            return response()->json(['message' => 'Webhook received']);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Midtrans Webhook Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error'], 500);
        }
    }

    protected function decreaseStock(Order $order)
    {
        foreach ($order->items as $item) {
            $variant = ProductVariant::where('id', $item->product_variant_id)->lockForUpdate()->first();
            if ($variant) {
                $variant->stock -= $item->quantity;
                $variant->save();
            }
        }
    }
}
