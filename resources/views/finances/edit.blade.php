@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Edit Finance Record</div>
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

            <form action="{{ route('finances.update', $finance->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date', $finance->date) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Type</label>
                        <select name="type" class="form-select" required>
                            <option value="Income" {{ (old('type') ?? $finance->type) == 'Income' ? 'selected' : '' }}>Income</option>
                            <option value="Expense" {{ (old('type') ?? $finance->type) == 'Expense' ? 'selected' : '' }}>Expense</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Amount (Rp)</label>
                    <input type="number" name="amount" class="form-control" value="{{ old('amount', $finance->amount) }}" required min="0">
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ old('description', $finance->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Record</button>
                <a href="{{ route('finances.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
