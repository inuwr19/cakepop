<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class DailyChart extends ChartWidget
{
    protected static ?string $heading = 'Daily Revenue';

    protected function getData(): array
    {
        $data = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => array_values($data),
                ],
            ],
            'labels' => array_map(fn($month) => date('F', mktime(0, 0, 0, $month, 1)), array_keys($data)),
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Tipe chart, bisa diganti dengan 'bar', 'pie', dll.
    }
}

