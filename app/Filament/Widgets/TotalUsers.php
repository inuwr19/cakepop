<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\User;

class TotalUsers extends BaseWidget
{
    // protected static string $view = 'filament.widgets.total-users';

    protected function getCards(): array
    {
        return [
            Card::make('Total Users', User::count())
                ->description('Registered users')
                ->color('success'),
        ];
    }
}
