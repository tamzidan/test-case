<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Http\Requests\StoreFinanceRequest;
use App\Http\Requests\UpdateFinanceRequest;
use Illuminate\Support\Facades\Gate;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Finance::class);
        $finances = Finance::orderBy('date', 'desc')->get();
        return view('finances.index', compact('finances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Finance::class);
        return view('finances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFinanceRequest $request)
    {
        Gate::authorize('create', Finance::class);

        Finance::create($request->validated());

        return redirect()->route('finances.index')->with('success', 'Finance record added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finance $finance)
    {
        Gate::authorize('update', $finance);
        return view('finances.edit', compact('finance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFinanceRequest $request, Finance $finance)
    {
        Gate::authorize('update', $finance);

        $finance->update($request->validated());

        return redirect()->route('finances.index')->with('success', 'Finance record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Finance $finance)
    {
        Gate::authorize('delete', $finance);
        $finance->delete();
        return redirect()->route('finances.index')->with('success', 'Record deleted.');
    }
}
