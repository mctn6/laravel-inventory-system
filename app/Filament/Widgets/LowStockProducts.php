<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;


class LowStockProducts extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Product::query()->where('stock_quantity', '<', 10);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')->label('Product Name')->searchable(),
            TextColumn::make('stock_quantity')->label('Stock Quantity'),
            TextColumn::make('category.name')->label('Category'),
            TextColumn::make('supplier.name')->label('Supplier'),
        ];
    }

    protected function getTableHeading(): string
    {
        return 'Low Stock Products';
    }
}
