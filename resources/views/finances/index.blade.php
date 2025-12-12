@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Finance Records</h2>
        <a href="{{ route('finances.create') }}" class="btn btn-primary">Add New Record</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($finances as $finance)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($finance->date)->format('d M Y') }}</td>
                        <td>
                            @if(strtolower($finance->type) == 'income')
                                <span class="badge bg-success">Income</span>
                            @else
                                <span class="badge bg-danger">Expense</span>
                            @endif
                        </td>
                        <td>{{ $finance->description }}</td>
                        <td class="{{ strtolower($finance->type) == 'income' ? 'text-success fw-bold' : 'text-danger fw-bold' }}">
                            {{ strtolower($finance->type) == 'income' ? '+' : '-' }}
                            Rp {{ number_format($finance->amount, 0, ',', '.') }}
                        </td>
                        <td>
                            <a href="{{ route('finances.show', $finance->id) }}" class="btn btn-sm btn-info">Show</a>
                            <a href="{{ route('finances.edit', $finance->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('finances.destroy', $finance->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this record?');">
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
