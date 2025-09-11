<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\BeforeAfterController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ReelController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', function () {
            return Inertia::render('dashboard');
        })->name('dashboard');
        // branchess
        Route::post('/branches/meta-data/{id}', [BranchController::class, 'metaData'])->name('branches.meta.update');
        Route::get('/branches/restore/{branch}', [BranchController::class, 'restore'])->name('branches.restore');
        Route::put('/branches/reorder', [BranchController::class, 'reorder'])->name('branches.reorder');
        Route::resource('branches', BranchController::class);
        Route::get('/branches/{branch}/content/editor', [BranchController::class, 'contentEditor'])->name('branches.content.editor');
        Route::post('/branches/{branch}/content/editor', [BranchController::class, 'contentEditorSave'])->name('branches.content.editor.save');

        // Categories
        Route::post('/categories/meta-data/{id}', [CategoryController::class, 'metaData'])->name('categories.meta.update');
        Route::get('/categories/restore/{branch}', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::get('/categories/restore/{category}', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::put('/categories/reorder', [CategoryController::class, 'reorder'])->name('categories.reorder');
        Route::resource('categories', CategoryController::class);

        // BeforeAfter
        Route::get('/before-afters/restore/{beforeAfter}', [BeforeAfterController::class, 'restore'])->name('before-afters.restore');
        Route::put('/before-afters/reorder', [BeforeAfterController::class, 'reorder'])->name('before-afters.reorder');
        Route::resource('before-afters', BeforeAfterController::class);
        Route::get('/before-afters/{beforeAfter}/content/editor', [BeforeAfterController::class, 'contentEditor'])->name('before-afters.content.editor');
        Route::post('/before-afters/{beforeAfter}/content/editor', [BeforeAfterController::class, 'contentEditorSave'])->name('before-afters.content.editor.save');

        // Services
        Route::post('/services/meta-data/{id}', [ServiceController::class, 'metaData'])->name('services.meta.update');
        Route::get('/services/restore/{service}', [ServiceController::class, 'restore'])->name('services.restore');
        Route::put('/services/reorder', [ServiceController::class, 'reorder'])->name('services.reorder');
        Route::resource('services', ServiceController::class);
        Route::get('/services/{service}/content/editor', [ServiceController::class, 'contentEditor'])->name('services.content.editor');
        Route::post('/services/{service}/content/editor', [ServiceController::class, 'contentEditorSave'])->name('services.content.editor.save');

        // Doctors
        Route::post('/teams/meta-data/{id}', [TeamController::class, 'metaData'])->name('teams.meta.update');
        Route::get('/doctors/restore/{doctor}', [TeamController::class, 'restore'])->name('doctors.restore');
        Route::put('/teams/reorder', [TeamController::class, 'reorder'])->name('teams.reorder');
        Route::resource('teams', TeamController::class);
        Route::get('/teams/{team}/content/editor', [TeamController::class, 'contentEditor'])->name('teams.content.editor');
        Route::post('/teams/{team}/content/editor', [TeamController::class, 'contentEditorSave'])->name('teams.content.editor.save');

        Route::put('/faqs/reorder', [FaqController::class, 'reorder'])->name('faqs.reorder');
        Route::resource('faqs', FaqController::class);
        Route::get('/faqs/{faq}/content/editor', [FaqController::class, 'contentEditor'])->name('faqs.content.editor');
        Route::post('/faqs/{faq}/content/editor', [FaqController::class, 'contentEditorSave'])->name('faqs.content.editor.save');

        Route::put('/reviews/reorder', [ReviewController::class, 'reorder'])->name('reviews.reorder');
        Route::resource('/reviews', ReviewController::class);

        Route::put('/testimonials/reorder', [TestimonialController::class, 'reorder'])->name('testimonials.reorder');
        Route::resource('testimonials', TestimonialController::class);

        Route::put('/reels/reorder', [ReelController::class, 'reorder'])->name('reels.reorder');
        Route::resource('smile-snaps', ReelController::class);

        Route::put('/youtube-videos/reorder', [YoutubeController::class, 'reorder'])->name('youtube-videos.reorder');
        Route::resource('youtube-videos', YoutubeController::class);

        Route::put('/features/reorder', [FeatureController::class, 'reorder'])->name('features.reorder');
        Route::resource('features', FeatureController::class);

        Route::resource('contacts', ContactController::class);

        Route::resource('callbacks', CallbackController::class);
        Route::post('/callbacks/{callback}/status-update', [CallbackController::class, 'statusUpdate'])->name('callbacks.status.update');
       
        Route::resource('appointments', AppointmentController::class);

        Route::resource('/galleries', GalleryController::class);
        Route::put('/galleries/reorder', [GalleryController::class, 'reorder'])->name('galleries.reorder');

    });
});
