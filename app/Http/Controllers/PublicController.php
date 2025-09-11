<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Reel;
use App\Models\Review;
use App\Models\Service;
use App\Models\Team;
use App\Models\YoutubeVideo;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;
use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Callback;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $reels = Reel::featured()->ordered()->active()->limit(6)->get();
        $reviews = Review::featured()->ordered()->active()->limit(6)->get();
        $services = Service::featured()->active()->ordered()->limit(8)->get();
        $teams = Team::featured()->active()->ordered()->limit(8)->get();
        $youtubeVideos = YoutubeVideo::featured()->active()->ordered()->limit(4)->get();
        $faqs = Faq::featured()->active()->ordered()->limit(4)->get();
        return view('public.index', compact('reels', 'reviews', 'services', 'teams', 'youtubeVideos', 'faqs'));
    }

    /**
     * Display the about page.
     */

    public function about()
    {
        $reviews = Review::featured()->ordered()->active()->limit(6)->get();
        $teams = Team::featured()->active()->ordered()->limit(8)->get();
        $services = Service::featured()->active()->ordered()->limit(8)->get();
        return view('public.about', compact('reviews', 'teams', 'services'));
    }

    /**
     * Display the doctors page.
     */

    public function doctors()
    {
        $teams = Team::active()->ordered()->get();
        return view('public.doctor.index', compact('teams'));
    }

    /**
     * Display the doctor page.
     */
    public function doctor($slug)
    {
        $team = Team::where('slug', $slug)->with(['content', 'meta'])->firstOrFail();
        return view('public.doctor.show', compact('team'));
    }

    /**
     * Display the services page.
     */

    public function services()
    {
        $services = Service::active()->ordered()->get();
        return view('public.service.index', compact('services'));
    }

    /**
     * Display the service page.
     */
    public function service($slug)
    {
        $service = Service::with('content', 'meta')->where('slug', $slug)->firstOrFail();
        $services = Service::active()->ordered()->get();
        return view('public.service.show', compact('service', 'services'));
    }

    /**
     * Show the contact form.
     */
    public function contact()
    {
        $contact = Contact::first();
        return view('public.contact', compact('contact'));
    }

    /**
     * Show the appointment form.
     */
    public function appointment()
    {
        return view('public.appointment');
    }

    public function storeAppointment(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:2|regex:/^[a-zA-Z\s]*$/',
            'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/',
            'date' => 'nullable|date',
            'time' => ['required', $this->timeValidationRule()],
            'problem_description' => 'nullable|string|max:1000',
        ]);

        try {
            Appointment::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'date' => $validated['date'],
                'time' => $validated['time'],
                'problem_description' => $validated['problem_description'] ?? null,
                'user_agent' => $request->header('User-Agent', 'Unknown'),
                'ip' => $request->ip(),
            ]);
            return back()->with('success', 'Your appointment has been booked successfully. We will contact you soon.');
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    /**
     * Display the callback request form.
     */
    public function callbackRequest()
    {
        return view('public.callback-request');
    }

    public function storeCallbackRequest(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:2|regex:/^[a-zA-Z\s]*$/',
            'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/|unique:callbacks,phone,NULL,id,created_at,' . now()->toDateString(),
            'time' => ['nullable', $this->timeValidationRule()],
            'terms' => 'required|accepted',
        ]);

        try {
            Callback::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'user_agent' => $request->header('User-Agent', 'Unknown'),
                'ip' => $request->ip(),
            ]);

            return back()->with('success', 'Your request has been submitted successfully. We will contact you soon.');
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    // reviews
    public function reviews()
    {
        $reviews = Review::active()->ordered()->paginate(24);
        return view('public.review.index', compact('reviews'));
    }

    public function review(string $id)
    {
        $review = Review::findOrFail($id);
        $reviews = Review::active()->ordered()->get();
        return view('public.review.show', compact('review', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function branch(string $slug)
    {
        $branch = Branch::where('slug', $slug)->with(['content', 'meta'])->firstOrFail();
        $commonServices = Service::select('name', 'slug')->ordered()->active()->featured()->lazy();
        return view('public.branch.show', compact('branch', 'commonServices'));
    }

    // FAQs
    public function faqs()
    {
        $faqs = Faq::active()->ordered()->get();
        return view('public.faq', compact('faqs'));
    }

    // gallery
    public function gallery()
    {
        $gallery = Gallery::active()->ordered()->get();
        return view('public.gallery', compact('gallery'));
    }


    // reels player
    public function reelsPlayer(Request $request)
    {

        $request->validate([
            'reel' => 'nullable|uuid|exists:reels,id',
        ]);

        $reels = Reel::active()->ordered()->get();
        $initialReel = Reel::find($request->reel) ?? $reels->first();

        return inertia('public/reels/player', [
            'reels' => $reels,
            'initialReel' => $initialReel,
        ]);
    }

    public function videoPlayer(Request $request)
    {
        $request->validate([
            'video' => 'nullable|uuid|exists:youtube_videos,id',
        ]);

        $videos = YoutubeVideo::active()->ordered()->get();
        $initialVideo = YoutubeVideo::find($request->video) ?? $videos->first();

        return inertia('public/youtube/player', [
            'videos' => $videos,
            'initialVideo' => $initialVideo,
        ]);
    }

    private function timeValidationRule()
    {
        return function ($attribute, $value, $fail) {
            $selectedTime = Carbon::createFromFormat('H:i', $value);
            $startTime = Carbon::createFromFormat('H:i', '09:00');
            $endTime = Carbon::createFromFormat('H:i', '18:00');

            if ($selectedTime->lt($startTime) || $selectedTime->gt($endTime)) {
                $fail("The $attribute must be between 09:00 AM and 06:00 PM.");
            }
        };
    }

    // terms
    public function terms()
    {
        return view('public.terms');
    }

    // privacyPolicy
    public function privacyPolicy()
    {
        return view('public.privacy-policy');
    }
}
