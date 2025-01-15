<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Order;

class TotalOrders extends BaseWidget
{
    // protected static string $view = 'filament.widgets.total-orders';

    protected function getCards(): array
    {
        return [
            Card::make('Total Orders', Order::count())
                ->description('Orders placed')
                ->color('primary'),
        ];
    }

}
