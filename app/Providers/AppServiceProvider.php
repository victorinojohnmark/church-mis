<?php

namespace App\Providers;

use App\Models\DocumentRequest;
use App\Observers\DocumentRequestObserver;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DocumentRequest::observe(DocumentRequestObserver::class);
    }
}
