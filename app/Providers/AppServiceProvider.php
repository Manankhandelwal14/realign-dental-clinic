<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Contact;
use Illuminate\Support\Facades\Cache;
use App\Services\BranchService;
use App\Models\Branch;
use App\Models\Service;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(['layouts.public.app'], function ($view) {
            $data = [
                'contact' => Cache::remember('contact', now()->addHour(), function () {
                    return Contact::first(['phone', 'email']);
                }),
                'branches' => Branch::select('state', 'name', 'slug')->orderBy('state')->ordered()->active()->featured()->lazy(),
                'commonServices' => Service::select('name','slug')->ordered()->active()->featured()->lazy(),
            ];
            $view->with($data);
        });
    }
}
