<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class LogoProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $logoImages = Storage::files('public/logos/logo');

        // Fetch images from 'logos/logo-name/' directory
        $logoNameImages = Storage::files('public/logos/logo-name');

        // Convert file paths to URLs
        $logoImageUrls = array_map(function ($path) {
            return url(Storage::url($path));
        }, $logoImages);

        $logoNameImageUrls = array_map(function ($path) {
            return url(Storage::url($path));
        }, $logoNameImages);

        // Share image URLs with all views
        view()->share('logoImageUrls', $logoImageUrls);
        view()->share('logoNameImageUrls', $logoNameImageUrls);
    }
}
