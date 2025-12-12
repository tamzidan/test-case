@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Orders List</h2>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">Create New Order</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>
                            <a href="{{ route('customers.show', $order->customer_id) }}" class="text-decoration-none">
                                {{ $order->customer->name ?? 'Unknown Customer' }}
                            </a>
                        </td>
                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>
                            @if($order->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif($order->status == 'cancelled')
                                <span class="badge bg-danger">Cancelled</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">Show</a>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
