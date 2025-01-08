<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::count())
                ->description('Number of products in the system')
                ->icon('heroicon-o-cube')
                ->color('primary'),
            Stat::make('Total Categories', Category::count())
                ->description('Number of categories')
                ->icon('heroicon-o-tag')
                ->color('success'),
            Stat::make('Total Suppliers', Supplier::count())
                ->description('Number of suppliers')
                ->icon('heroicon-o-truck')
                ->color('warning'),
        ];
    }
}
