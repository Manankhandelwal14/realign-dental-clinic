<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
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

        $query = Review::query();

        if ($request->filled('status') && $validated['status']) {
            $query->statusFilter($validated['status']);
        }

        if ($request->filled('search')) {
            $query->search($validated['search']);
        }

        $reviews = $query->orderBy('order', 'asc')->paginate(perPage: 10)->withQueryString();
        return inertia('reviews/index', [
            'reviews' => $reviews,
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
        return inertia('reviews/create', [
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
            'author' => 'required|string|max:255',
            'content' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'boolean',
            'featured' => 'boolean',
            'service_id' => 'nullable|uuid|exists:services,id',
            'user_id' => 'nullable|uuid|exists:users,id',
            'date' => 'nullable|date',
        ]);

        Review::create($validated);
        return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::with(['service', 'user'])->findOrFail($id);
        return inertia('reviews/show', [
            'review' => $review,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::with(['service', 'user'])->findOrFail($id);
        return inertia('reviews/create', [
            'review' => $review,
            'services' => Service::select('id', 'name')->get(),
            'users' => User::select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review = Review::findOrFail($id);
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'content' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'boolean',
            'featured' => 'boolean',
            'service_id' => 'nullable|uuid|exists:services,id',
            'user_id' => 'nullable|uuid|exists:users,id',
            'date' => 'nullable|date',
        ]);
        $review->update($validated);
        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
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
            foreach ($request->items as $reviewData) {
                $review = Review::withTrashed()->findOrFail($reviewData['id']);
                $review->order = $reviewData['order'];
                $review->save();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Review order updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update review order. Please try again. Error: ' . $e->getMessage());
        }
    }
}
