@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Order Details #{{ $order->id }}</span>
            @if($order->status == 'completed')
                <span class="badge bg-success">Completed</span>
            @elseif($order->status == 'cancelled')
                <span class="badge bg-danger">Cancelled</span>
            @else
                <span class="badge bg-warning text-dark">Pending</span>
            @endif
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="text-muted">Customer Info</h5>
                    <h3>{{ $order->customer->name ?? 'Unknown' }}</h3>
                    <p>
                        Email: {{ $order->customer->email ?? '-' }}<br>
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5 class="text-muted">Order Info</h5>
                    <p><strong>Date:</strong> {{ $order->order_date }}</p>
                    <h2 class="text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h2>
                </div>
            </div>

            <hr>

            <div class="mt-4">
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to List</a>

                @can('update', $order)
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit Order</a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
