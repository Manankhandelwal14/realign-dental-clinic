<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Service;
use App\Models\YoutubeVideo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class YoutubeController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', Rule::in(['all', 'active', 'inactive'])],
        ]);

        $query = YoutubeVideo::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $validated['search'] . '%')
                ->orWhere('description', 'like', '%' . $validated['search'] . '%');
        }

        if ($request->filled('status') && $validated['status'] !== 'all') {
            $query->where('status', $validated['status'] === 'active' ? 1 : 0);
        }

        $videos = $query->ordered()->paginate(10)->withQueryString();

        return Inertia::render('youtube-videos/index', [
            'videos' => $videos,
            'filters' => array_filter([
                'search' => $validated['search'] ?? null,
                'status' => $validated['status'] ?? null,
            ]),
        ]);
    }

    public function create()
    {
        $services = Service::active()->orderBy('name')->get();
        $branches = Branch::active()->orderBy('name')->get();
        return Inertia::render('youtube-videos/create', [
            'services' => $services,
            'branches' => $branches,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_id' => 'required|string|max:255|unique:youtube_videos,video_id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'service_id' => 'nullable|exists:services,id',
            'branch_id' => 'nullable|exists:branches,id',
            'published_at' => 'nullable|date',
            'status' => 'boolean',
            'featured' => 'boolean',
        ]);

        $video = YoutubeVideo::create($validated);

        if ($request->hasFile('thumbnail')) {
            $video->addMedia($request->file('thumbnail'), 'thumbnail');
        } else {
            $video->addMediaFromUrl('https://img.youtube.com/vi/' . $validated['video_id'] . '/hqdefault.jpg', 'thumbnail');
        }

        return redirect()->route('admin.youtube-videos.index')->with('success', 'YouTube video created successfully.');
    }

    public function show(string $id)
    {
        $video = YoutubeVideo::withTrashed()->findOrFail($id);
        return Inertia::render('youtube-videos/show', [
            'video' => $video,
        ]);
    }

    public function edit(string $id)
    {
        $video = YoutubeVideo::withTrashed()->findOrFail($id);
        $services = Service::active()->orderBy('name')->get();
        $branches = Branch::active()->orderBy('name')->get();
        return Inertia::render('youtube-videos/edit', [
            'video' => $video,
            'services' => $services,
            'branches' => $branches,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $video = YoutubeVideo::withTrashed()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_id' => ['required', 'string', 'max:255', Rule::unique('youtube_videos')->ignore($video->id)],
            'published_at' => 'nullable|date',
            'status' => 'boolean',
            'featured' => 'boolean',
        ]);

        $video->update($validated);

        return redirect()->route('admin.youtube-videos.index')->with('success', 'YouTube video updated successfully.');
    }

    public function destroy(string $id)
    {
        $video = YoutubeVideo::withTrashed()->findOrFail($id);
        $video->delete();

        return redirect()->route('admin.youtube-videos.index')->with('success', 'YouTube video deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|uuid|exists:youtube_videos,id',
            'items.*.order' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();
            foreach ($request->items as $youtubeVideoData) {
                $youtubeVideo = YoutubeVideo::withTrashed()->findOrFail($youtubeVideoData['id']);
                $youtubeVideo->order = $youtubeVideoData['order'];
                $youtubeVideo->save();
            }
            DB::commit();
            return redirect()->route('admin.youtube-videos.index')->with('success', 'Videos order updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.youtube-videos.index')->with('error', 'Failed to update videos order. Please try again.');
        }
    }
}
