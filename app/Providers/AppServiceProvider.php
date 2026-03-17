<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Safe method to force HTTPS and URL
        try {
            // Force Scheme
            URL::forceScheme('https');
            
            // Force Root URL (Only if APP_URL is set)
            if (config('app.url')) {
                URL::forceRootUrl(config('app.url'));
            }
        } catch (\Exception $e) {
            // Do nothing if error, let site run
        }

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}