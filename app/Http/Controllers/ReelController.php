<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reel;
use App\Models\Service;
use App\Models\User;
use Illuminate\Validation\Rule;

class ReelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $validated = $request->validate([
            'status' => ['nullable', 'string', Rule::in(['all', 'active', 'inactive', 'featured', 'unfeatured', 'deleted'])],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $query = Reel::query();

        if ($request->filled('status') && $validated['status']) {
            $query->statusFilter($validated['status']);
        }

        if ($request->filled('search')) {
            $query->search($validated['search']);
        }

        $reels = $query->orderBy('order', 'asc')->paginate(perPage: 10)->withQueryString();

        return inertia('reels/index', [
            'reels' => $reels,
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
        return inertia('reels/create', [
            'services' => Service::select('id', 'name')->get(),
            'users' => User::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'service_id' => 'nullable|uuid|exists:services,id',
            'user_id' => 'nullable|uuid|exists:users,id',
            'date' => 'nullable|date',
            'video' => 'required|file|mimes:mp4,mov,avi,wmv|max:10240',
            'poster' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);


        $reel = Reel::create($validated);

        if ($request->hasFile('video')) {
            $reel->addMedia($request->file('video'), 'video', 'public');
        }

        if ($request->hasFile('poster')) {
            $reel->addMedia($request->file('poster'), 'poster', 'public');
        }

        return redirect()->route('admin.smile-snaps.index')->with('success', 'Reel created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reel = Reel::withTrashed()->with(['service', 'user'])->findOrFail($id);
        return inertia('reels/show', [
            'reel' => $reel,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reel = Reel::withTrashed()->with(['service', 'user'])->findOrFail($id);
        return inertia('reels/create', [
            'reel' => $reel,
            'services' => Service::select('id', 'name')->get(),
            'users' => User::select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reel = Reel::withTrashed()->findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'service_id' => 'nullable|uuid|exists:services,id',
            'user_id' => 'nullable|uuid|exists:users,id',
            'date' => 'nullable|date',
        ]);

        $reel->update($validated);

        return redirect()->route('admin.smile-snaps.index')->with('success', 'Reel updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reel = Reel::withTrashed()->findOrFail($id);
        $reel->delete();

        return redirect()->route('admin.smile-snaps.index')->with('success', 'Reel deleted successfully.');
    }
}
