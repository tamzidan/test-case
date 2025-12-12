@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Edit Order #{{ $order->id }}</div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Customer</label>
                    <select name="customer_id" class="form-select" required>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Total Amount (Rp)</label>
                    <input type="number" name="total_amount" class="form-control" value="{{ old('total_amount', $order->total_amount) }}" required min="0">
                </div>

                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <small class="text-muted d-block mt-2">
                        <i class="fas fa-info-circle"></i> Note: Changing status to <strong>Completed</strong> will automatically record an Income in Finance.
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">Update Order</button>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
