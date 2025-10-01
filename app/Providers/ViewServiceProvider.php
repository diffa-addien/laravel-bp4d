<?php

namespace App\Providers;

use App\Models\Visitor;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Bagikan data statistik ke view layouts.footer
        View::composer('layouts.footer', function ($view) {
            $dailyVisitors = Visitor::whereDate('visit_date', today())->count();
            $weeklyVisitors = Visitor::whereBetween('visit_date', [now()->startOfWeek(), now()->endOfWeek()])->count();
            $totalVisitors = Visitor::count();

            $view->with([
                'dailyVisitors' => $dailyVisitors,
                'weeklyVisitors' => $weeklyVisitors,
                'totalVisitors' => $totalVisitors,
            ]);
        });
    }
}