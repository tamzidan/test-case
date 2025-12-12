@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Transaction Details</span>
                    <span class="badge {{ strtolower($finance->type) == 'income' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($finance->type) }}
                    </span>
                </div>
                <div class="card-body text-center">
                    <h5 class="text-muted">Amount</h5>
                    <h1 class="display-4 {{ strtolower($finance->type) == 'income' ? 'text-success' : 'text-danger' }}">
                        Rp {{ number_format($finance->amount, 0, ',', '.') }}
                    </h1>

                    <hr>

                    <div class="text-start">
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($finance->date)->format('l, d F Y') }}</p>
                        <p><strong>Description:</strong></p>
                        <div class="p-3 bg-light rounded border">
                            {{ $finance->description }}
                        </div>
                    </div>

                    <div class="mt-4 text-start">
                        <a href="{{ route('finances.index') }}" class="btn btn-secondary">Back</a>
                        @can('update', $finance)
                            <a href="{{ route('finances.edit', $finance->id) }}" class="btn btn-warning">Edit</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
