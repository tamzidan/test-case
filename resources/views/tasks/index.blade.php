@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Tasks List</h2>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Project</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>
                            <a href="{{ route('projects.show', $task->project_id) }}" class="text-decoration-none">
                                {{ $task->project->title ?? 'No Project' }}
                            </a>
                        </td>
                        <td>
                            @if($task->assignedUser)
                                <span class="badge bg-info text-dark">{{ $task->assignedUser->name }}</span>
                            @else
                                <span class="badge bg-secondary">Unassigned</span>
                            @endif
                        </td>
                        <td>
                            @if($task->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif($task->status == 'in_progress')
                                <span class="badge bg-primary">In Progress</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-info">Show</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this task?');">
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
