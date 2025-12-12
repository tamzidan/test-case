@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Customer Details</div>
        <div class="card-body">
            <h3>{{ $customer->name }}</h3>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Email:</strong> {{ $customer->email }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Address:</strong><br> {{ $customer->address ?? '-' }}</p>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection
