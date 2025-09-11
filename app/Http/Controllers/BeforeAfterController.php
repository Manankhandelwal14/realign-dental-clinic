<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeforeAfter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BeforeAfterController extends Controller
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

        $query = BeforeAfter::query();

        if ($request->filled('status') && $validated['status'] !== 'all') {
            $query->statusFilter($validated['status']);
        }

        if ($request->filled('search')) {
            $query->search($validated['search']);
        }

        $beforeAfters = $query->orderBy('order', 'asc')->paginate(perPage: 10)->withQueryString();

        return inertia('before-afters/index', [
            'beforeAfters' => $beforeAfters,
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
        return inertia('before-afters/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'before_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'after_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
            'featured' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $beforeAfterData = [
            ...$validated,
            'id' => Str::uuid(),
        ];

        if ($request->hasFile('before_image')) {
            $beforeAfterData['before_image'] = $request->file('before_image')->store('before_after_images', 'public');
        }

        if ($request->hasFile('after_image')) {
            $beforeAfterData['after_image'] = $request->file('after_image')->store('before_after_images', 'public');
        }

        BeforeAfter::create($beforeAfterData);

        return redirect()->route('admin.before-afters.index')->with('success', 'Before & After entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $beforeAfter = BeforeAfter::withTrashed()->findOrFail($id);
        return inertia('before-afters/show', [
            'beforeAfter' => $beforeAfter,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $beforeAfter = BeforeAfter::withTrashed()->findOrFail($id);
        return inertia('before-afters/create', [
            'beforeAfter' => $beforeAfter,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $beforeAfter = BeforeAfter::withTrashed()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'before_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'after_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
            'featured' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        try {
            $beforeAfter->update($validated);
            if ($request->hasFile('before_image')) {
                // Delete old before image if exists
                if ($beforeAfter->hasMedia('before_image')) {
                    $beforeAfter->deleteMedia('before_image');
                }
                $beforeAfter->addMedia($request->file('before_image'), 'before_image');
            }
            if ($request->hasFile('after_image')) {
                // Delete old after image if exists
                if ($beforeAfter->hasMedia('after_image')) {
                    $beforeAfter->deleteMedia('after_image');
                }
                $beforeAfter->addMedia($request->file('after_image'), 'after_image');
            }
            return redirect()->route('admin.before-afters.index')->with('success', 'Before & After entry updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Before & After entry. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $beforeAfter = BeforeAfter::withTrashed()->findOrFail($id);
            if ($beforeAfter->trashed()) {
                // If already trashed, check if it has media and delete it
                if ($beforeAfter->hasMedia('before_image')) {
                    $beforeAfter->deleteMedia('before_image');
                }

                if ($beforeAfter->hasMedia('after_image')) {
                    $beforeAfter->deleteMedia('after_image');
                }
                // If already trashed, permanently delete
                $beforeAfter->forceDelete();
                return redirect()->route('admin.before-afters.index')->with('success', 'Before & After entry permanently deleted successfully.');
            }
            $beforeAfter->delete();
            return redirect()->route('admin.before-afters.index')->with('success', 'Before & After entry deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Before & After entry. Please try again.');
        }
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|uuid|exists:before_afters,id',
            'items.*.order' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();
            foreach ($request->items as $beforeAfter) {
                $before_after = BeforeAfter::withTrashed()->findOrFail($beforeAfter['id']);
                $before_after->order = $beforeAfter['order'];
                $before_after->save();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Before & After order updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update before & after order. Please try again.');
        }
    }

    public function contentEditor(BeforeAfter $beforeAfter)
    {
        return inertia('before-afters/content', [
            'beforeAfter' => $beforeAfter->load('content')
        ]);
    }

    // contentEditorSave
    public function contentEditorSave(Request $request, BeforeAfter $beforeAfter)
    {
        $validated = $request->validate([
            'content' => 'nullable|string',
            'html' => 'nullable|string',
        ]);

        if ($beforeAfter->content) {
            $beforeAfter->content()->update($validated);
        } else {
            $beforeAfter->content()->create($validated);
        }

        return redirect()->route('admin.before-afters.index')->with('success', 'Before & After content updated successfully.');
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

        try {
            $beforeAfter = BeforeAfter::withTrashed()->findOrFail($id);
            $beforeAfter->meta()->updateOrCreate(
                ['seoable_id' => $beforeAfter->id, 'seoable_type' => BeforeAfter::class],
                [
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'keywords' => $validated['keywords'],
                    'canonical_url' => $validated['canonical_url'],
                    'tags' => $validated['tags'],
                ]
            );
            return redirect()->back()->with('success', 'Before & After meta data updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Before & After meta data. Please try again. Error: ' . $e->getMessage());
        }
    }
}
