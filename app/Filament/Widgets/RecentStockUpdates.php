<?php

namespace App\Filament\Widgets;

use App\Models\StockHistory;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class RecentStockUpdates extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return StockHistory::query()->latest()->limit(10);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('product.name')->label('Product Name'),
            TextColumn::make('quantity_change')->label('Quantity Change'),
            TextColumn::make('reason')->label('Reason'),
            TextColumn::make('created_at')->label('Updated At')->dateTime(),
        ];
    }

    protected function getTableHeading(): string
    {
        return 'Recent Stock Updates';
    }
}