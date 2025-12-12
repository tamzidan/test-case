@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Create New Order</div>
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

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Customer</label>
                    <select name="customer_id" class="form-select" required>
                        <option value="">-- Select Customer --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Order Date</label>
                    <input type="date" name="order_date" class="form-control" value="{{ old('order_date', date('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label>Total Amount (Rp)</label>
                    <input type="number" name="total_amount" class="form-control" value="{{ old('total_amount') }}" required min="0">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select" required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Save Order</button>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
