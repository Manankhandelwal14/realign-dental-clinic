<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feature;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FeatureController extends Controller
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

        $query = Feature::query();

        if ($request->filled('status') && $validated['status']) {
            $query->statusFilter($validated['status']);
        }

        if ($request->filled('search')) {
            $query->search($validated['search']);
        }

        $features = $query->orderBy('order', 'asc')->paginate(perPage: 10)->withQueryString();

        return inertia('features/index', [
            'features' => $features,
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
        return inertia('features/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        Feature::create($validated);

        return redirect()->route('admin.features.index')->with('success', 'Feature created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feature = Feature::withTrashed()->findOrFail($id);
        return inertia('features/show', [
            'feature' => $feature,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feature = Feature::withTrashed()->findOrFail($id);
        return inertia('features/edit', [
            'feature' => $feature,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feature = Feature::withTrashed()->findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $feature->update($validated);

        return redirect()->route('admin.features.index')->with('success', 'Feature updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature = Feature::withTrashed()->findOrFail($id);
        $feature->delete();

        return redirect()->route('admin.features.index')->with('success', 'Feature deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|uuid|exists:features,id',
            'items.*.order' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();
            foreach ($request->items as $featureData) {
                $feature = Feature::withTrashed()->findOrFail($featureData['id']);
                $feature->order = $featureData['order'];
                $feature->save();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Feature order updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update feature order. Please try again.');
        }
    }
}
