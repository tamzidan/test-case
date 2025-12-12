@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Edit Task: {{ $task->title }}</div>
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

            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Task Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $task->title) }}" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Project</label>
                        <select name="project_id" class="form-select" required>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                                    {{ $project->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Assign To</label>
                        <select name="assigned_to_user_id" class="form-select">
                            <option value="">-- Unassigned --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $task->assigned_to_user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Due Date</label>
                        <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $task->due_date) }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
