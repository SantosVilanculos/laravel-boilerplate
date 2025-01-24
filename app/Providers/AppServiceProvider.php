<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonImmutable;
// use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        DB::prohibitDestructiveCommands(App::isProduction());

        Model::shouldBeStrict(! App::isProduction());
        Model::unguard();

        Password::defaults(fn () => App::isProduction() ? Password::min(8)->max(24)->uncompromised() : null);

        Date::use(CarbonImmutable::class);

        // RedirectIfAuthenticated::redirectUsing(fn () => '/');
    }
}
