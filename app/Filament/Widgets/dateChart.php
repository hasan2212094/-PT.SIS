<?php

namespace App\Filament\Widgets;



use App\Models\Category;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Carbon;


class dateChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'date produksi';
    

    protected function getData(): array
    {
       $startDate = $this->filters['startDate'];
       $endDate = $this->filters['endDate'];

        $data = Trend::model(Category::class)
            ->between(
                start: $startDate ? Carbon::parse($startDate): now()->subMonths(6),
                end: $endDate ? Carbon::parse($endDate): now(),
            )
            ->perMonth()
            ->sum('qty');
     
        return [
            'datasets' => [
                [
                    'label' => 'date_category',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
    protected function getType(): string
    {
        return 'line';
    }
}
