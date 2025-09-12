<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/home', function () {
    return Inertia::render('welcome');
})->name('home');


// public routes
Route::get('/', [PublicController::class, 'home'])->name('public.index');

// Route::get('/', [PublicController::class, 'home'])->name('public.index');
Route::get('/about', [PublicController::class, 'about'])->name('public.about');
// doctors
Route::get('/doctors', [PublicController::class, 'doctors'])->name('public.doctors');
Route::get('/doctors/{slug}', [PublicController::class, 'doctor'])->name('public.doctor.show');
// services
Route::get('/our-services', [PublicController::class, 'services'])->name('public.services');
Route::get('/our-services/{slug}', [PublicController::class, 'service'])->name('public.service.show');
Route::get('/contact', [PublicController::class, 'contact'])->name('public.contact');
// appointment
Route::get('/appointment', [PublicController::class, 'appointment'])->name('public.appointment');
Route::post('/appointment', [PublicController::class, 'storeAppointment'])->name('public.appointment.store');
// callback-request
Route::get('/callback-request', [PublicController::class, 'callbackRequest'])->name('public.callback-request');
Route::post('/callback-request', [PublicController::class, 'storeCallbackRequest'])->name('public.callback-request.store');
// public.terms
Route::get('/terms', [PublicController::class, 'terms'])->name('public.terms');
// public.privacy-policy
Route::get('/privacy-policy', [PublicController::class, 'privacyPolicy'])->name('public.privacy-policy');
// reels player
Route::get('/reels-player', [PublicController::class, 'reelsPlayer'])->name('public.reels-player');
Route::get('/video-player', [PublicController::class, 'videoPlayer'])->name('public.video-player');
// reviews
Route::get('/reviews', [PublicController::class, 'reviews'])->name('public.reviews');
Route::get('/reviews/{id}', [PublicController::class, 'review'])->name('public.review.show');
// branch show
Route::get('/branches/{slug}', [PublicController::class, 'branch'])->name('public.branch.show');
// faqs
Route::get('/faqs', [PublicController::class, 'faqs'])->name('public.faqs');
Route::get('/gallery', [PublicController::class, 'gallery'])->name('public.gallery');
// patient safetyOA
Route::prefix('patient-safety')->name('public.patient-safety.')->group(function () {
    Route::view('/10x-safety', 'public.patient-safety.10x-safety')->name('10x-safety');
    Route::view('/sterilization', 'public.patient-safety.sterilization')->name('sterilization');
    Route::view('/safety-equipment', 'public.patient-safety.safety-equipment')->name('safety-equipment');
    Route::view('/equipment-technology', 'public.patient-safety.dental-equipment-technology')->name('equipment-technology');
    Route::view('/quality', 'public.patient-safety.quality')->name('quality');
});

// admin routes
require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
