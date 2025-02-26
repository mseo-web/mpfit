<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\BadgeColumn;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('customer_name')->required(),
            Forms\Components\DatePicker::make('created_at')->default(now())->required(),
            Forms\Components\Select::make('status')
                ->options([
                    'new' => 'Новый',
                    'completed' => 'Выполнен'
                ])
                ->default('new')
                ->required()
                ->placeholder('Выберите статус'),
            Forms\Components\Textarea::make('comment'),
            Forms\Components\Select::make('product_id')
                ->relationship('product', 'name')->required(),
            Forms\Components\TextInput::make('quantity')->numeric()->required(),
            Forms\Components\TextInput::make('total_price')->numeric()->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Номер заказа'),
                Tables\Columns\TextColumn::make('created_at')->label('Дата создания'),
                Tables\Columns\TextColumn::make('customer_name')->label('ФИО покупателя'),
                Tables\Columns\BadgeColumn::make('status')
                ->label('Статус')
                ->colors([
                    'primary' => 'новый',
                    'success' => 'выполнен',
                ])
                ->getStateUsing(function ($record) {
                    $statuses = [
                        'новый' => 'Новый',
                        'выполнен' => 'Выполнен',
                    ];
            
                    return $statuses[$record->status] ?? $record->status;
                }),
                // Tables\Columns\NumberColumn::make('total_price')->label('Итоговая цена')->currency('RUB'),
                Tables\Columns\TextColumn::make('total_price')
                ->label('Итоговая цена')
                ->formatStateUsing(function ($state) {
                    return '₽ ' . number_format($state, 2);
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
