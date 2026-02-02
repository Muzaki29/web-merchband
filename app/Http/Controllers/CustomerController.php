<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $orders = Order::where('customer_email', $user->email)
            ->latest()
            ->get();

        return view('customer.dashboard', compact('user', 'orders'));
    }
}
