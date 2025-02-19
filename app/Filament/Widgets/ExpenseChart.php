<?php

namespace App\Filament\Widgets;

use Illuminate\Support\Carbon;
use App\Models\Category;
use Flowframe\Trend\Filters\LastYearFilter;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class ExpenseChart extends ChartWidget
{
    protected static ?string $heading = 'unit';
    protected static string $color = 'warning';

    protected function getData(): array
    
{
    $category = Category::all();
    $namecategory = $category->pluck('unit')->toArray();
    $jumlahcategory = $category->pluck('qty')->toArray();
    $tanggalcategory = $category->pluck('date_category')->toArray();
    return [
        'datasets' => [
            [
                'label' => 'Blog posts created',
                'data' => $jumlahcategory,
                'backgroundColor' =>[
                    'rgba(242, 44, 9, 0.92)',
                    'rgba(241, 192, 15, 0.93)',
                    'rgba(62, 70, 217, 0.99)',
                    'rgba(9, 242, 48, 0.92)',
                    'rgba(15, 233, 241, 0.93)',
                    'rgba(217, 62, 70, 0.99)',
                    'rgba(242, 141, 9, 0.92)',
                    ''
                ],
                'borderColor' => '#9BD0F5',
                'barPercentage'=> '0.5',
            ],
        ],
        'labels' =>$namecategory,
    ];

}
    protected function getType(): string
    {
        return 'bar';
    }
}
