<?php

namespace App\Providers;

use App\Policies\{
    ReadingPlanDayPolicy,
    VersePolicy
};
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('view-any-verse', [VersePolicy::class, 'viewAny']);
        Gate::define('view-any-reading-plan-day', [ReadingPlanDayPolicy::class, 'viewAny']);
    }
}
