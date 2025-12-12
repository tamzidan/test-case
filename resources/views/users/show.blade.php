@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">User Details</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong>
                @foreach($user->getRoleNames() as $role)
                    <span class="badge bg-info text-dark">{{ $role }}</span>
                @endforeach
            </p>
            <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>

            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
