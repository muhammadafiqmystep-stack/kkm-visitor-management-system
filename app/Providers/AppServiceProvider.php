<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        View::composer('layouts.app', function ($view) {
            $view->with([
                'navbarUnreadNotifications' => Auth::check()
                    ? Auth::user()->unreadNotifications()->latest()->take(8)->get()
                    : collect(),
                'navbarUnreadCount' => Auth::check()
                    ? Auth::user()->unreadNotifications()->count()
                    : 0,
            ]);
        });
    }
}
