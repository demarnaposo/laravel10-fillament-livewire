<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Illuminate\Support\Number;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Orders', Order::query()->where('status', 'New')->count()),
            Stat::make('Order Processing', Order::query()->where('status', 'Processing')->count()),
            Stat::make('Order Shipped', Order::query()->where('status', 'Shipped')->count()),
            Stat::make('Average Price', str_replace('.00', '', Number::currency(Order::query()->avg('grand_total') ?? 0, 'IDR')))
        ];
    }
}
