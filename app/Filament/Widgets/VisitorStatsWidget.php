<?php

namespace App\Filament\Widgets;

use App\Models\Visitor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class VisitorStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Menghitung total pengunjung unik
        $totalVisitors = Visitor::count();

        // Menghitung pengunjung unik minggu ini
        $weeklyVisitors = Visitor::whereBetween('visit_date', [now()->startOfWeek(), now()->endOfWeek()])->count();

        // Menghitung pengunjung unik hari ini
        $dailyVisitors = Visitor::whereDate('visit_date', today())->count();

        return [
            Stat::make('Pengunjung Hari Ini', $dailyVisitors)
                ->description('Jumlah pengunjung unik hari ini')
                ->icon('heroicon-o-user-group'),
            Stat::make('Pengunjung Minggu Ini', $weeklyVisitors)
                ->description('Jumlah pengunjung unik dalam 7 hari terakhir')
                ->icon('heroicon-o-calendar-days'),
            Stat::make('Total Pengunjung', $totalVisitors)
                ->description('Total pengunjung unik sepanjang waktu')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}