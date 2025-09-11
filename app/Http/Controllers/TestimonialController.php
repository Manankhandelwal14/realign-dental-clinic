<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\User;
use Illuminate\Validation\Rule;

class TestimonialController extends Controller
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

        $query = Testimonial::query();

        if ($request->filled('status') && $validated['status']) {
            $query->statusFilter($validated['status']);
        }

        if ($request->filled('search')) {
            $query->search($validated['search']);
        }

        $testimonials = $query->orderBy('order', 'asc')->paginate(perPage: 10)->withQueryString();

        return inertia('testimonials/index', [
            'testimonials' => $testimonials,
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
        return inertia('testimonials/create', [
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
            'caption' => 'required|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'service_id' => 'nullable|uuid|exists:services,id',
            'user_id' => 'nullable|uuid|exists:users,id',
            'date' => 'nullable|date',
            'video' => 'required|file|mimes:mp4,mov,avi,wmv|max:10240',
            'poster' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $testimonial = Testimonial::create($validated);

        if ($request->hasFile('video')) {
            $testimonial->addMedia($request->file('video'), 'video');
        }

        if ($request->hasFile('poster')) {
            $testimonial->addMedia($request->file('poster'), 'poster');
        }

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testimonial = Testimonial::with(['service', 'user'])->findOrFail($id);
        return inertia('testimonials/create', [
            'testimonial' => $testimonial,
            'services' => Service::select('id', 'name')->get(),
            'users' => User::select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'caption' => 'required|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'service_id' => 'nullable|uuid|exists:services,id',
            'user_id' => 'nullable|uuid|exists:users,id',
            'date' => 'nullable|date',
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:10240',
            'poster' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $testimonial->update($validated);

        if ($request->hasFile('video')) {
            $testimonial->addMedia($request->file('video'), 'video');
        }

        if ($request->hasFile('poster')) {
            $testimonial->addMedia($request->file('poster'), 'poster');
        }

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
