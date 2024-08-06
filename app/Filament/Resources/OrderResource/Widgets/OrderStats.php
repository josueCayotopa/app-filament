<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;


class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // clase de para mostrar estadisiticas Stat
            Stat::make('Nuevas Ordenes', Order::query()->where('status', 'new')->count()),
            Stat::make('Orden en proceso', Order::query()->where('status', 'processing')->count()),
            Stat::make('Ordenes Enviadas', Order::query()->where('status', 'shipped')->count()),
            Stat::make('Precio Promedio', Number::currency(Order::query()->avg('grand_total'), 'PEN')),
        ];
    }
}
