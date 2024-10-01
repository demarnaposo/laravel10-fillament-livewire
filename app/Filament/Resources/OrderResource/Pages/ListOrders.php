<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array {
        return [
            OrderStats::class
        ];
    }

    public function getTabs(): array {
        return [
            null => Tab::make('All'),
            'new' => Tab::make()->query(fn ($query) => $query->where('status', 'New')),
            'processing' => Tab::make()->query(fn ($query) => $query->where('status', 'Processing')),
            'shipped' => Tab::make()->query(fn ($query) => $query->where('status', 'Shipped')),
            'delivered' => Tab::make()->query(fn ($query) => $query->where('status', 'Delivered')),
            'canceled' => Tab::make()->query(fn ($query) => $query->where('status', 'Canceled'))
        ];
    }
}
