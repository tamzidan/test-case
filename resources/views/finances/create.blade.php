@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Add Finance Record</div>
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

            <form action="{{ route('finances.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Type</label>
                        <select name="type" class="form-select" required>
                            <option value="">-- Select Type --</option>
                            <option value="Income" {{ old('type') == 'Income' ? 'selected' : '' }}>Income (Pemasukan)</option>
                            <option value="Expense" {{ old('type') == 'Expense' ? 'selected' : '' }}>Expense (Pengeluaran)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Amount (Rp)</label>
                    <input type="number" name="amount" class="form-control" value="{{ old('amount') }}" required min="0">
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="e.g. Payment for Hosting, Client Invoice #123" required>{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Save Record</button>
                <a href="{{ route('finances.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
