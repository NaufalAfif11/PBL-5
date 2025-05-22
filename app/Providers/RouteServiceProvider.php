<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home'; // Atau /dashboard, sesuai konfigurasi Anda

    /**
     * The controller namespace for the application.
     *
     * When you are not hitting the root namespace, it's recommended to complete it with the namespace of your controller.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers'; // Contoh jika Anda ingin menggunakannya

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        // Konfigurasi Rate Limiter untuk API
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // Memuat rute API dari 'api.php'
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Memuat rute web dari 'web.php'
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Memuat rute console dari 'console.php' (opsional, tergantung versi Laravel)
            // Route::middleware('web') // Atau 'api' jika relevan
            //     ->group(base_path('routes/console.php'));

            // Memuat rute channels dari 'channels.php' (untuk Broadcasting)
            // Route::middleware('web') // Atau 'api' jika relevan
            //     ->group(base_path('routes/channels.php'));
        });
    }
}