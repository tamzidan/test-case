@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Task Details</span>
            <span class="badge bg-secondary">{{ strtoupper($task->status) }}</span>
        </div>
        <div class="card-body">
            <h3>{{ $task->title }}</h3>

            <div class="row mt-3">
                <div class="col-md-6">
                    <p><strong>Project:</strong> {{ $task->project->title ?? 'Unknown Project' }}</p>
                    <p><strong>Assigned To:</strong> {{ $task->assignedUser->name ?? 'Unassigned' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Due Date:</strong> {{ $task->due_date ?? 'Not Set' }}</p>
                    <p><strong>Created At:</strong> {{ $task->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <hr>
            <h5>Description</h5>
            <p>{{ $task->description ?? 'No description provided.' }}</p>

            <div class="mt-4">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to List</a>

                @can('update', $task)
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit Task</a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
