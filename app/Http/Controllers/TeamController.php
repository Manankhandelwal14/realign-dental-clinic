<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Branch;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
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

        $query = Team::query()->with(['branch', 'meta']);

        if ($request->filled('status') && $validated['status']) {
            $query->statusFilter($validated['status']);
        }

        if ($request->filled('search')) {
            $query->search($validated['search']);
        }

        $teams = $query->orderBy('order', 'asc')->paginate(perPage: 10)->withQueryString();

        return inertia('teams/index', [
            'teams' => $teams,
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
        return inertia('teams/create', [
            'branches' => Branch::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'sort_description' => 'nullable|string',
            'about' => 'nullable|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'branch_id' => 'nullable|uuid|exists:branches,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_media' => 'nullable|array',
            'social_media.*.platform' => 'required_with:social_media|string|max:255',
            'social_media.*.url' => 'required_with:social_media|url|max:255',
        ]);

        $team = Team::create($validated);

        if ($request->hasFile('image')) {
            $team->addMedia($request->file('image'), 'image');
        }

        return redirect()->route('admin.teams.index')->with('success', 'Team member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $team = Team::withTrashed()->with(['branch', 'content', 'meta'])->findOrFail($id);
        return inertia('teams/show', [
            'team' => $team,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $team = Team::withTrashed()->with(['branch'])->findOrFail($id);
        return inertia('teams/create', [
            'team' => $team,
            'branches' => Branch::select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'sort_description' => 'nullable|string',
            'about' => 'nullable|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'branch_id' => 'nullable|uuid|exists:branches,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_media' => 'nullable|array',
            'social_media.*.platform' => 'required_with:social_media|string|max:255',
            'social_media.*.url' => 'required_with:social_media|url|max:255',
        ]);

        $team = Team::withTrashed()->findOrFail($id);
        $team->update($request->all());


        if ($request->hasFile('image')) {

            if ($team->hasMedia('image')) {
                $team->deleteMedia('image');
            }

            $team->addMedia($request->file('image'), 'image');
        }


        return redirect()->route('admin.teams.index')->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::withTrashed()->findOrFail($id);
        if ($team->image) {
            Storage::disk('public')->delete($team->image);
        }
        $team->delete();

        return redirect()->route('admin.teams.index')->with('success', 'Team member deleted successfully.');
    }

    public function reorder(Request $request)
    {

        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|uuid|exists:teams,id',
            'items.*.order' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();
            foreach ($request->items as $teamData) {
                $team = Team::withTrashed()->findOrFail($teamData['id']);
                $team->order = $teamData['order'];
                $team->save();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Team order updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update team order. Please try again.');
        }
    }

    public function contentEditor(Team $team)
    {
        return inertia('teams/content', [
            'team' => $team->load('content')
        ]);
    }

    public function contentEditorSave(Request $request, Team $team)
    {
        $validated = $request->validate([
            'json' => 'nullable',
            'html' => 'nullable',
        ]);

        if ($team->content) {
            $team->content()->update([
                'content' => $validated['json'],
                'html' => $validated['html'],
            ]);
        } else {
            $team->content()->create([
                'content' => $validated['json'],
                'html' => $validated['html'],
            ]);
        }

        return redirect()->back()->with('success', 'Team content updated successfully.');
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

        $team = Team::withTrashed()->findOrFail($id);

        $team->meta()->updateOrCreate(
            ['seoable_id' => $team->id, 'seoable_type' => Team::class],
            [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'keywords' => $validated['keywords'],
                'canonical_url' => $validated['canonical_url'],
                'tags' => $validated['tags'],
            ]
        );

        return redirect()->back()->with('success', 'Team meta data updated successfully.');
    }
}
