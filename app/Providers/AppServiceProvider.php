<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\LessonObserver;
use App\Models\Lesson;


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
        Lesson::observe(LessonObserver::class);
    }
}
