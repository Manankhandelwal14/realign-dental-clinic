<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Branch;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
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

        $query = Service::query()->with(['branch', 'category', 'meta']);

        if ($request->filled('status') && $validated['status']) {
            $query->statusFilter($validated['status']);
        }

        if ($request->filled('search')) {
            $query->search($validated['search']);
        }

        $services = $query->orderBy('order', 'asc')
            ->paginate(perPage: 10)
            ->withQueryString();


        return inertia('services/index', [
            'services' => $services,
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
        return inertia('services/create', [
            'branches' => Branch::select('id', 'name')->get(),
            'categories' => Category::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:services,name',
            'sort_description' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'status' => 'boolean',
            'featured' => 'boolean',
            'category_id' => 'nullable|uuid|exists:categories,id',
            'branch_id' => 'nullable|uuid|exists:branches,id',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $service = Service::create($validated);
        if ($request->hasFile('banner')) {
            $service->addMedia($request->file('banner'), 'banners');
        }

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::withTrashed()->with(['branch', 'category', 'content', 'meta'])->findOrFail($id);
        return inertia('services/show', [
            'service' => $service,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::withTrashed()->with(['branch', 'category'])->findOrFail($id);
        return inertia('services/create', [
            'service' => $service,
            'branches' => Branch::select('id', 'name')->get(),
            'categories' => Category::select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::withTrashed()->findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('services')->ignore($service->id)],
            'sort_description' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'boolean',
            'featured' => 'boolean',
            'category_id' => 'nullable|uuid|exists:categories,id',
            'branch_id' => 'nullable|uuid|exists:branches,id',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('banner')) {
            if ($service->banner) {
                $service->deleteMedia('banners');
                $service->addMedia($request->file('banner'), 'banners');
            }
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::withTrashed()->findOrFail($id);
        if ($service->trashed()) {
            if ($service->banner) {
                $service->deleteMedia('banners');
            }
            $service->forceDelete();
            return redirect()->back()->with('success', 'Service permanently deleted successfully.');
        }

        $service->delete();
        return redirect()->back()->with('success', 'Service deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|uuid|exists:services,id',
            'items.*.order' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();
            foreach ($request->items as $serviceData) {
                $service = Service::withTrashed()->findOrFail($serviceData['id']);
                $service->order = $serviceData['order'];
                $service->save();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Service order updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update service order. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function contentEditor(Service $service)
    {
        return inertia('services/content', [
            'service' => $service->load('content')
        ]);
    }

    // contentEditorSave
    public function contentEditorSave(Request $request, Service $service)
    {

        if ($service->content) {
            $service->content()->update([
                'content' => $request->input('json'),
                'html' => $request->input('html'),
            ]);
        } else {
            $service->content()->create([
                'content' => $request->input('json'),
                'html' => $request->input('html'),
            ]);
        }

        return redirect()->back()->with('success', 'Service content updated successfully.');
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

        $branch = Service::withTrashed()->findOrFail($id);

        $branch->meta()->updateOrCreate(
            ['seoable_id' => $branch->id, 'seoable_type' => Service::class],
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
