@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Projects List</h2>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Create New Project</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Manager</th>
                        <th>Assigned Staff</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $project->manager->name ?? 'Unassigned' }}</span>
                        </td>
                        <td>
                            @foreach($project->staff as $staff)
                                <span class="badge bg-secondary">{{ $staff->name }}</span>
                            @endforeach
                            @if($project->staff->isEmpty())
                                <small class="text-muted">No staff assigned</small>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-info">Show</a>
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this project?');">
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
