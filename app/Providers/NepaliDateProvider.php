<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Anuzpandey\LaravelNepaliDate\Mixin\NepaliDateMixin;

class NepaliDateProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
        }
        Carbon::mixin(new NepaliDateMixin());
        View::composer('*', function ($view) {
            $timeZone = Carbon::now('Asia/Kathmandu');
            $nepaliDate = '';

            if (App::getLocale() == 'np') {
                $nepaliDate = $timeZone->toNepaliDate('j F Y, l');
            } else if (App::getLocale() == 'en') {
                $nepaliDate = $timeZone->format('l, j F Y');
            }

            $view->with('nepaliDate', $nepaliDate);
        });
    }
}
