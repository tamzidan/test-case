<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Finance;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

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
    public function store(StoreOrderRequest $request)
    {
        Gate::authorize('create', Order::class);

        // Validasi otomatis jalan sebelum masuk sini
        Order::create($request->validated());

        return redirect()->route('orders.index')->with('success', 'Order created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        Gate::authorize('view', $order);
        return view('orders.show', compact('order'));
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
    public function update(UpdateOrderRequest $request, Order $order)
    {
        Gate::authorize('update', $order);

        $validated = $request->validated();

        DB::transaction(function () use ($order, $validated) {
            // Logika Bonus Point: Cek perubahan status
            if ($order->status !== 'completed' && $validated['status'] === 'completed') {
                Finance::create([
                    'type' => 'income',
                    'amount' => $validated['total_amount'], // Pastikan field ini ada di rules request
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
