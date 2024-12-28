<?php

namespace App\Providers;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

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
        RateLimiter::for('limitRequest', function (Request $request) {
            return Limit::perMinute(30)->by($request->user()?->id ?: $request->ip())
            ->response(function (Request $request, array $headers) {
                return response('Ограничение скорости... 30 запросов в мин', 429, $headers);
            });
            ;
        });
    }
}
