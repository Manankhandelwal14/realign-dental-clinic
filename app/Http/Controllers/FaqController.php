<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FaqController extends Controller
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

        $query = Faq::query();

        if ($request->filled('status') && $validated['status']) {
            $query->statusFilter($validated['status']);
        }

        if ($request->filled('search')) {
            $query->search($validated['search']);
        }

        $faqs = $query->orderBy('order', 'asc')->paginate(perPage: 10)->withQueryString();

        return inertia('faqs/index', [
            'faqs' => $faqs,
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
        return inertia('faqs/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'boolean',
            'featured' => 'boolean',
        ]);

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        return inertia('faqs/show', [
            'faq' => $faq,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        return inertia('faqs/edit', [
            'faq' => $faq,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }

    public function reorder(Request $request)
    {

        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|uuid|exists:faqs,id',
            'items.*.order' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();
            foreach ($request->items as $faqData) {
                $faq = Faq::withTrashed()->findOrFail($faqData['id']);
                $faq->order = $faqData['order'];
                $faq->save();
            }
            DB::commit();
            return redirect()->back()->with('success', 'FAQ order updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update FAQ order. Please try again.');
        }
    }
}
