<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class RevenueTransactionOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;


        // Ambil jumlah transaksi bulan ini
        $currentMonthTransactions = Transaction::whereMonth('transaction_date', now()->month)
            ->where('status', 'completed')
            ->count();

        // Ambil jumlah transaksi bulan lalu
        $lastMonthTransactions = Transaction::whereMonth('transaction_date', now()->subMonth()->month)
            ->where('status', 'completed')
            ->count();

        // Hitung total pendapatan bulan ini
        $currentMonthRevenue = Transaction::whereMonth('transaction_date', now()->month)
        ->where('status', 'completed')
        ->get()
        ->sum(function ($transaction) {
            return $transaction->quantity * $transaction->price * (1 - $transaction->discount / 100);
        });

        // Hitung total pendapatan bulan lalu
        $lastMonthRevenue = Transaction::whereMonth('transaction_date', now()->subMonth()->month)
        ->where('status', 'completed')
        ->get()
        ->sum(function ($transaction) {
            return $transaction->quantity * $transaction->price * (1 - $transaction->discount / 100);
        });

            // dd($lastMonthRevenue, $currentMonthRevenue);

        // Ambil data transaksi harian untuk chart
        $dailyTransactions = Transaction::selectRaw('DAY(transaction_date) as day, COUNT(*) as count')
            ->whereMonth('transaction_date', now()->month)
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('count', 'day')
            ->toArray();

        // Ambil data user baru bulan ini dan bulan lalu
        $newUsersData = User::where('role', 'visitor')
            ->selectRaw('
                COUNT(CASE WHEN MONTH(created_at) = ? THEN 1 END) as currentMonthNewUsers,
                COUNT(CASE WHEN MONTH(created_at) = ? THEN 1 END) as lastMonthNewUsers
                ', [$currentMonth, $lastMonth])
                ->first();

        // Hitung pertumbuhan user baru dibanding bulan lalu
        $newUserGrowth = $newUsersData->lastMonthNewUsers > 0
        ? (($newUsersData->currentMonthNewUsers - $newUsersData->lastMonthNewUsers) / $newUsersData->lastMonthNewUsers) * 100
        : 0;

        // Hitung pertumbahan pendapatan dalam bentu persentase
        $transactionChange = $lastMonthTransactions > 0
            ? (($currentMonthTransactions - $lastMonthTransactions) / $lastMonthTransactions) * 100
            : 0;

        // Hitung perubahan pendapatan dibanding bulan lalu
        $revenueChange = $lastMonthRevenue > 0
            ? (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
            : 0;


        // Siapkan data untuk chart harian
        $chartData = [];
        for ($i = 1; $i <= now()->day; $i++) {
            $chartData[] = ($dailyTransactions[$i] ?? 0) * 10;
        }

        // Mengembalikan array statistik
        return [
            Stat::make('Total Transaksi', $currentMonthTransactions)
                ->description(($transactionChange >= 0 ? '+' : '') . number_format($transactionChange, 2) . '% dibanding bulan lalu')
                ->descriptionIcon($transactionChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($transactionChange >= 0 ? 'success' : 'danger')
                ->chart($chartData),

            Stat::make('Total Pendapatan', 'Rp ' . number_format($currentMonthRevenue, 0, ',', '.'))
                ->description(($revenueChange >= 0 ? '+' : '') . number_format($revenueChange, 2) . '% dibanding bulan lalu')
                ->descriptionIcon($revenueChange >= 0 ? 'heroicon-m-currency-dollar' : 'heroicon-m-arrow-trending-down')
                ->color($revenueChange >= 0 ? 'success' : 'danger'),

            Stat::make('User Baru Bulan Ini', $newUsersData->currentMonthNewUsers)
                ->description(($newUserGrowth >= 0 ? '+' : '') . number_format($newUserGrowth, 2) . '% dibanding bulan lalu')
                ->descriptionIcon($newUserGrowth >= 0 ? 'heroicon-o-user-plus' : 'heroicon-o-user-minus')
                ->color($newUserGrowth >= 0 ? 'success' : 'danger'),


            Stat::make('Rata-rata Nilai Transaksi', 'Rp ' . number_format($currentMonthRevenue / max($currentMonthTransactions, 1), 0, ',', '.'))
                ->description('Rata-rata nilai per transaksi')
                ->descriptionIcon('heroicon-m-calculator')
                ->color('primary'),
        ];
    }

}
