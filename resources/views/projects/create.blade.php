@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Create New Project</div>
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

            <form action="{{ route('projects.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Project Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Project Manager</label>
                    <select name="manager_id" class="form-control" required>
                        <option value="">-- Select Manager --</option>
                        @foreach($managers as $manager)
                            <option value="{{ $manager->id }}" {{ old('manager_id') == $manager->id ? 'selected' : '' }}>
                                {{ $manager->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Assign Staff</label>
                    <div class="card p-3 bg-light">
                        <div class="row">
                            @foreach($staffs as $staff)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="staff_ids[]" value="{{ $staff->id }}" id="staff_{{ $staff->id }}">
                                        <label class="form-check-label" for="staff_{{ $staff->id }}">
                                            {{ $staff->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <small class="text-muted">You can select multiple staff members.</small>
                </div>

                <button type="submit" class="btn btn-success">Save Project</button>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
