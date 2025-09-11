<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'status' => ['nullable', 'string', Rule::in(['all', 'active', 'inactive', 'featured', 'deleted'])],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $query = Branch::query();

        if ($request->filled('status') && $validated['status']) {
            $query->statusFilter($validated['status']);
        }

        if ($request->filled('search')) {
            $query->search($validated['search']);
        }

        $branches = $query->with('meta')->orderBy('order', 'asc')->paginate(perPage: 10)->withQueryString();

        return inertia('branches/index', [
            'branches' => $branches,
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
        return inertia('branches/create/index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:branches,name',
            'tagline' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'map_iframe' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'status' => 'boolean',
            'featured' => 'boolean',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'opening_hours' => 'nullable|array',
            'opening_hours.*.day' => 'nullable|string',
            'opening_hours.*.slots' => 'nullable|array',
            'opening_hours.*.slots.*.opening' => 'required_with:opening_hours.*.slots.*.closing|date_format:H:i',
            'opening_hours.*.slots.*.closing' => 'required_with:opening_hours.*.slots.*.opening|date_format:H:i',
            // meta details
            'title'
        ]);

        $branch = Branch::create($validated);

        if ($request->hasFile('banner')) {
            $branch->addMedia($request->file('banner'), 'banner');
        }

        return redirect()->route('admin.branches.index')->with('success', 'Branch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $branch = Branch::withTrashed()->with(['content', 'teams', 'services', 'meta'])->findOrFail($id);
        return inertia('branches/show', [
            'branch' => $branch
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branch = Branch::with('meta')->withTrashed()->findOrFail($id);
        return inertia('branches/create/index', [
            'branch' => $branch,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $branch = Branch::withTrashed()->findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:branches,name,' . $branch->id,
            'tagline' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'map_iframe' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'status' => 'boolean',
            'featured' => 'boolean',
            'order' => 'nullable|integer',
            'opening_hours' => 'nullable|array',
            'opening_hours.*.day' => 'nullable|string',
            'opening_hours.*.slots' => 'nullable|array',
            'opening_hours.*.slots.*.opening' => 'required_with:opening_hours.*.slots.*.closing|date_format:H:i',
            'opening_hours.*.slots.*.closing' => 'required_with:opening_hours.*.slots.*.opening|date_format:H:i',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('banner')) {
            $branch->deleteMedia('banner');
            $branch->addMedia($request->file('banner'), 'banner');
        }

        $branch->update($validated);

        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = Branch::withTrashed()->findOrFail($id);

        if ($branch->trashed()) {
            $branch->forceDelete();
            return redirect()->back()->with('success', 'Branch Permanently deleted successfully.');
        }

        $branch->delete();
        return redirect()->back()->with('success', 'Branch deleted successfully.');
    }

    // restore
    public function restore(string $id)
    {
        $branch = Branch::withTrashed()->findOrFail($id);
        $branch->restore();
        return redirect()->back()->with('success', 'Branch restored successfully.');
    }

    // reorder
    public function reorder(Request $request)
    {

        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|uuid|exists:branches,id',
            'items.*.order' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();
            foreach ($request->items as $branchData) {
                $branch = Branch::withTrashed()->findOrFail($branchData['id']);
                $branch->order = $branchData['order'];
                $branch->save();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Branch order updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update branch order. Please try again.');
        }
    }

    public function contentEditor(Branch $branch)
    {
        return inertia('branches/content', [
            'branch' => $branch->load('content')
        ]);
    }

    // contentEditorSave
    public function contentEditorSave(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'json' => 'nullable',
            'html' => 'nullable',
        ]);

        if ($branch->content) {
            $branch->content()->update([
                'content' => $validated['json'],
                'html' => $validated['html'],
            ]);
        } else {
            $branch->content()->create([
                'content' => $validated['json'],
                'html' => $validated['html'],
            ]);
        }

        return redirect()->back()->with('success', 'Branch content updated successfully.');
    }

    public function metaData(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'keywords' => 'nullable|array|max:255',
            'canonical_url' => 'nullable|url|max:255',
            'tags' => 'nullable|array',
        ]);

        $branch = Branch::withTrashed()->findOrFail($id);

        $branch->seo()->updateOrCreate(
            ['seoable_id' => $branch->id, 'seoable_type' => Branch::class],
            [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'keywords' => $validated['keywords'],
                'canonical_url' => $validated['canonical_url'],
                'tags' => $validated['tags'],
            ]
        );

        return redirect()->back()->with('success', 'Branch meta data updated successfully.');
    }
}
