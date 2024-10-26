<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Illuminate\Support\Facades\Cache;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class TourPackageSales extends ChartWidget
{
    protected static ?string $heading = 'Trend Penjualan Tiket Wisata';
    protected static ?string $pollingInterval = '600s';

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'elements' => [
                'line' => [
                    'tension' => 0.4, // Menambahkan kelengkungan untuk garis yang lebih mulus
                    'borderWidth' => 3, // Menyesuaikan ketebalan garis
                ],
                'point' => [
                    'radius' => 3, // Menyesuaikan ukuran titik data
                    'hitRadius' => 10, // Menambah area klik di sekitar titik data
                    'hoverRadius' => 5, // Ukuran titik saat dihover
                ],
            ],
            'scales' => [
                'x' => [
                    'grid' => [
                        'display' => false, // Menghilangkan garis grid vertikal
                    ],
                ],
                'y' => [
                    'grid' => [
                        'color' => '#f3f3f3', // Warna garis grid horizontal
                    ],
                    'beginAtZero' => true, // Mulai skala dari 0
                ],
            ],
        ];
    }

    protected function getData(): array
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfMonth = Carbon::now()->endOfMonth();

        $data = Transaction::selectRaw('
                DATE_FORMAT(transactions.transaction_date, "%Y-%m") as month,
                tour_packages.name as package_name,
                SUM(quantity) as total_quantity
            ')
            ->join('tour_packages', 'package_id', '=', 'tour_packages.id')
            ->whereBetween('transactions.transaction_date', [$startOfYear, $endOfMonth])
            ->where('transactions.status', 'completed')
            ->groupBy('month', 'tour_packages.name', )
            ->get()
            ->groupBy('month')
            ->mapWithKeys(function ($items, $month) {
                return [
                    $month => $items->mapWithKeys(function ($item) {
                        return [
                            $item->package_name => $item->total_quantity,
                        ];
                    }),
                ];
            });

        $labels = [];
        $datasets = [];
        $colors = ['#93aec1', '#f8b042', '#ec6a52', '#f3b7ad'];
        $colorIndex = [];

        for ($date = $startOfYear; $date <= $endOfMonth; $date->addMonth()) {
            $monthStr = $date->format('Y-m');
            $labels[] = $date->format('M');

            foreach ($data as $month => $packages) {
                foreach ($packages as $pkgName => $quantity) {
                    if (!isset($datasets[$pkgName])) {
                        if (!isset($colorIndex[$pkgName])) {
                            $colorIndex[$pkgName] = count($colorIndex) % count($colors);
                        }
                        $datasets[$pkgName] = [
                            'label' => $pkgName,
                            'data' => array_fill(0, count($labels), 0),
                            'backgroundColor' => $colors[$colorIndex[$pkgName]],
                            'borderColor' => $colors[$colorIndex[$pkgName]],
                            'fill' => false, // Garis tidak akan diisi warna
                        ];
                    }
                    $datasets[$pkgName]['data'][] = isset($data[$month][$pkgName]) ? $data[$month][$pkgName] : 0;
                }
            }
        }

        return [
            'datasets' => array_values($datasets),
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
