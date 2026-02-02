<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Revenue', 'Rp ' . number_format(Order::where('status', 'paid')->sum('total_price'), 0, ',', '.'))
                ->description('Total income from paid orders')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            
            Stat::make('New Orders', Order::where('status', 'pending')->count())
                ->description('Orders waiting for processing')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning'),
            
            Stat::make('Total Products', Product::count())
                ->description('Active products in catalog')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('primary'),
        ];
    }
}
