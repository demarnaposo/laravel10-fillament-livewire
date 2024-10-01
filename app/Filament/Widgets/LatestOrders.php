<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Order;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\OrderResource;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{


    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->searchable(),


                TextColumn::make('user.name')
                    ->searchable(),

                TextColumn::make('grand_total')
                    ->money('IDR'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'New'           => 'info',
                        'Processing'    => 'warning',
                        'Shipped'       => 'success',
                        'Delivered'     => 'success',
                        'Canceled'      => 'danger'
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'New' => 'heroicon-m-sparkles',
                        'Processing' => 'heroicon-m-arrow-path',
                        'Shipped' => 'heroicon-m-truck',
                        'Delivered' => 'heroicon-m-check-badge',
                        'Canceled' => 'heroicon-m-x-circle',
                    })
                    ->sortable(),


                TextColumn::make('payment_method')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('payment_status')
                    ->sortable()
                    ->badge()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime()
            ])
            ->actions([
                Action::make('View Order')
                    ->url(fn(Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-o-eye'),
            ]);
    }
}
