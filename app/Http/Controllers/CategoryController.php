<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Branch;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
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

        $query = Category::query();

        if ($request->filled('status') && $validated['status']) {
            $query->statusFilter($validated['status']);
        }

        if ($request->filled('search')) {
            $query->search($validated['search']);
        }

        $categories = $query->with(['parent'])->orderBy('order', 'asc')->paginate(perPage: 10)->withQueryString();

        return inertia('categories/index', [
            'categories' => $categories,
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
        return inertia('categories/create', [
            'categories' => Category::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'sort_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'parent_id' => 'nullable|uuid|exists:categories,id',
            'banner' => 'nullable|image|max:2048',
        ]);

        $category = Category::create($validated);

        if ($request->hasFile('banner')) {
            $category->addMedia($request->file('banner'), 'banner');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::withTrashed()->with(['parent', 'meta'])->findOrFail($id);
        return inertia('categories/show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::withTrashed()->with(['parent'])->findOrFail($id);
        return inertia('categories/create', [
            'category' => $category,
            'categories' => Category::select('id', 'name')->where('id', '!=', $id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $parentCategory = Category::withTrashed()->find($request->input('parent_id'));

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)],
            'sort_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'parent_id' => 'nullable|uuid|exists:categories,id|different:' . $category->id,
            'banner' => 'nullable|image|max:2048',
        ]);

        if ($request->has('parent_id')) {
            $parentCategory = Category::withTrashed()->find($request->input('parent_id'));
            if ($parentCategory && $parentCategory->parent_id === $category->id) {
                return redirect()->route('admin.categories.edit', $category->id)->with('error', 'You cannot set a category as its own parent.');
            }
        }

        $category->update($validated);

        if ($request->hasFile('banner')) {
            // Remove old media if exists
            if ($category->hasMedia('banner')) {
                $category->deleteMedia('banner');
            }
            $category->addMedia($request->file('banner'), 'banner');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::withTrashed()->findOrFail($id);
            if ($category->trashed()) {
                // delete all media associated with the category
                if ($category->hasMedia('banner')) {
                    $category->deleteMedia('banner');
                }
                $category->forceDelete();
                return redirect()->back()->with('success', 'Category restored successfully.');
            }
            $category->delete();
            return redirect()->back()->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Category cannot be deleted because it has subcategories or products.');
        }
    }

    public function restore(string $id)
    {
        try {
            $category = Category::withTrashed()->findOrFail($id);
            $category->restore();
            return redirect()->back()->with('success', 'Category restored successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Category cannot be restored.');
        }
    }

    public function reorder(Request $request)
    {
        try {
            $validated = $request->validate([
                'items' => 'required|array',
                'items.*.id' => 'required|uuid|exists:categories,id',
                'items.*.order' => 'required|integer',
            ]);

            foreach ($validated['items'] as $category) {
                Category::where('id', $category['id'])->update(['order' => $category['order']]);
            }

            return redirect()->route('admin.categories.index')->with('success', 'Categories reordered successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Categories cannot be reordered.');
        }
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

        $category = Category::withTrashed()->findOrFail($id);

        $category->meta()->updateOrCreate(
            ['seoable_id' => $category->id, 'seoable_type' => Category::class],
            [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'keywords' => $validated['keywords'],
                'canonical_url' => $validated['canonical_url'],
                'tags' => $validated['tags'],
            ]
        );

        return redirect()->back()->with('success', 'Category meta data updated successfully.');
    }
}
