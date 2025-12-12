@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Project Details
        </div>
        <div class="card-body">
            <h3>{{ $project->title }}</h3>
            <p class="text-muted">Managed by: <strong>{{ $project->manager->name ?? 'Unassigned' }}</strong></p>
            <hr>

            <h5>Description</h5>
            <p>{{ $project->description }}</p>

            <h5 class="mt-4">Team Members (Staff)</h5>
            @if($project->staff->count() > 0)
                <ul class="list-group list-group-horizontal">
                    @foreach($project->staff as $staff)
                        <li class="list-group-item">{{ $staff->name }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No staff assigned yet.</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to List</a>

                {{-- Gunakan @can jika ingin membatasi tombol edit --}}
                @can('update', $project)
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Edit</a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
