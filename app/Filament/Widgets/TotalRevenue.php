<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Order;

class TotalRevenue extends BaseWidget
{
    protected function getCards(): array
    {
        $totalRevenue = Order::sum('total_amount');
        return [
            Card::make('Total Revenue', 'Rp ' . number_format($totalRevenue, 2, ',', '.'))
                ->description('Revenue generated')
                ->color('success'),
        ];
    }
}
