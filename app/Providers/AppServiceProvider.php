<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Ye line zaroori hai

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
        // --- YE LINES ADD KAREIN (START) ---
        
        // Force HTTPS for all generated links
        URL::forceScheme('https');
        
        // Force the root URL (Ye Railway par CSS fix karega)
        URL::forceRootUrl(config('app.url'));
        
        // --- YE LINES ADD KAREIN (END) ---

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}