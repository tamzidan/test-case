<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB; // Untuk Transaction
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Order::class);
        $orders = Order::with('customer')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Order::class);
        $customers = Customer::all();
        return view('orders.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Order::class);

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        Gate::authorize('update', $order);
        $customers = Customer::all();
        return view('orders.edit', compact('order', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        Gate::authorize('update', $order);

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        // BONUS POINT: Database Transaction
        DB::transaction(function () use ($order, $validated) {
            // Cek jika status berubah jadi 'completed'
            if ($order->status !== 'completed' && $validated['status'] === 'completed') {
                // Catat otomatis ke Finance sebagai Income
                Finance::create([
                    'type' => 'income',
                    'amount' => $validated['total_amount'],
                    'description' => 'Payment for Order #' . $order->id,
                    'date' => now(),
                ]);
            }

            $order->update($validated);
        });

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // Policy OrderPolicy otomatis memblokir Manager & Finance di sini
        Gate::authorize('delete', $order);

        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted.');
    }
}
