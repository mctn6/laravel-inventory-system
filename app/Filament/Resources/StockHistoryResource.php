<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockHistoryResource\Pages;
use App\Filament\Resources\StockHistoryResource\RelationManagers;
use App\Models\StockHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StockHistoryResource extends Resource
{
    protected static ?string $model = StockHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required(),
                Forms\Components\TextInput::make('quantity_change')->numeric()->required(),
                Forms\Components\TextInput::make('reason'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name'),
                Tables\Columns\TextColumn::make('quantity_change'),
                Tables\Columns\TextColumn::make('reason'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ])
        ->actions([
            // Edit Action
            EditAction::make()
            ->record(fn($record) => $record->id) // Assuming you want to edit by ID
            ->successNotification(
                Notification::make()
                    ->success()
                    ->title('Stock updated')
                    ->body('The stock has been updated successfully.')
            ),
            // Delete Action
            DeleteAction::make()
                ->record(fn($record) => $record->id)
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Stock deleted')
                        ->body('The stock has been deleted successfully.')
            ),
      ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockHistories::route('/'),
            'create' => Pages\CreateStockHistory::route('/create'),
            'edit' => Pages\EditStockHistory::route('/{record}/edit'),
        ];
    }
}
