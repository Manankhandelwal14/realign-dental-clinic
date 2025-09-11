<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Callback;

class CallbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'status' => ['nullable', 'string', Rule::in(['all', 'pending', 'completed', 'failed', 'deleted'])],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $query = Callback::query();

        if ($request->filled('status') && $validated['status']) {
            $query->statusFilter($validated['status']);
        }

        if ($request->filled('search')) {
            $query->search($validated['search']);
        }

        $callbacks = $query->orderBy('created_at', 'desc')
            ->paginate(perPage: 10)
            ->withQueryString();

        return inertia('callbacks/index', [
            'callbacks' => $callbacks,
            'filters' => array_filter([
                'status' => $validated['status'] ?? null,
                'search' => $validated['search'] ?? null,
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('callbacks/add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'datetime' => 'nullable|date_format:Y-m-d\TH:i',
        ]);

        Callback::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'time' => $validated['datetime'] ? date('H:i', strtotime($validated['datetime'])) : null,
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip(),
            'created_at' => $validated['datetime'] ? date('Y-m-d H:i:s', strtotime($validated['datetime'])) : now(),
        ]);

        return redirect()->route('admin.callbacks.index')->with('success', 'Callback created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $callback = Callback::withTrashed()->findOrFail($id);
        return inertia('callbacks/show', [
            'callback' => $callback,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $callback = Callback::withTrashed()->findOrFail($id);
        return inertia('callbacks/edit', [
            'callback' => $callback,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $callback = Callback::withTrashed()->findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'time' => 'nullable|date_format:H:i',
            'user_agent' => 'nullable|string',
            'ip' => 'nullable|ip',
            'status' => ['required', Rule::in(['pending', 'completed', 'failed'])],
        ]);

        $callback->update($validated);

        return redirect()->route('admin.callbacks.index')->with('success', 'Callback updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $callback = Callback::withTrashed()->findOrFail($id);
        $callback->delete();
        return redirect()->route('admin.callbacks.index')->with('success', 'Callback deleted successfully.');
    }

    // statusUpdate
    public function statusUpdate(Request $request, string $id)
    {
        $callback = Callback::withTrashed()->findOrFail($id);
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'completed', 'failed'])],
        ]);

        $callback->update($validated);

        return redirect()->route('admin.callbacks.index')->with('success', 'Callback status updated successfully.');
    }
}
