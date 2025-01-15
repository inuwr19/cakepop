<x-filament::widget>
    <x-filament::card>
        <canvas id="daily-chart"></canvas>
    </x-filament::card>
</x-filament::widget>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('daily-chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: @json($this->getChartData()),
            options: {
                responsive: true,
                scales: {
                    x: { display: true },
                    y: { display: true, beginAtZero: true },
                },
            },
        });
    });
</script>
