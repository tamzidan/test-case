<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek Policy: viewAny
        Gate::authorize('viewAny', Project::class);

        // LOGIKA KHUSUS: Gunakan Scope 'forUser' yang kita buat di Model Project
        // Ini otomatis memfilter jika user adalah Staff
        $projects = Project::forUser(auth()->user())->with('manager')->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Project::class);

        // Ambil data Manager dan Staff untuk dropdown
        $managers = User::role(['Manager', 'Super Admin'])->get();
        $staffs = User::role('Staff')->get();

        return view('projects.create', compact('managers', 'staffs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        Gate::authorize('create', Project::class);

        // Tidak perlu $request->validate([...]) lagi!
        // Data yang lolos validasi bisa diambil via $request->validated()
        $validated = $request->validated();

        $project = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'manager_id' => $validated['manager_id'],
        ]);

        if (isset($validated['staff_ids'])) {
            $project->staff()->sync($validated['staff_ids']);
        }

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Policy akan otomatis cek apakah Staff berhak melihat project ini (via logic di ProjectPolicy)
        Gate::authorize('view', $project);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        Gate::authorize('update', $project);

        $managers = User::role(['Manager', 'Super Admin'])->get();
        $staffs = User::role('Staff')->get();

        return view('projects.edit', compact('project', 'managers', 'staffs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        Gate::authorize('update', $project);

        $validated = $request->validated(); // Otomatis tervalidasi

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'manager_id' => $validated['manager_id'],
        ]);

        if (isset($validated['staff_ids'])) {
            $project->staff()->sync($validated['staff_ids']);
        }

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Gate::authorize('delete', $project);

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
