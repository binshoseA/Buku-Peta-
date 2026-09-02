<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now();
        
        // Ringkasan Bulan Ini
        $pemasukanBulanIni = $user->transactions()->where('type', 'pemasukan')->whereMonth('date', $now->month)->sum('amount');
        $pengeluaranBulanIni = $user->transactions()->where('type', 'pengeluaran')->whereMonth('date', $now->month)->sum('amount');
        $keuntungan = $pemasukanBulanIni - $pengeluaranBulanIni;

        // 5 Transaksi Terbaru
        $recentTransactions = $user->transactions()->orderBy('created_at', 'desc')->take(5)->get();

        // Ambil transaksi 30 hari terakhir untuk Grafik
        $tx30Days = $user->transactions()->where('created_at', '>=', Carbon::now()->subDays(30))->get();

        // Fungsi bantuan pembuat data kategori
        $getCategoryData = function($txs) {
            $pengeluaran = $txs->where('type', 'pengeluaran');
            $total = $pengeluaran->sum('amount');
            if ($total == 0) return [];
            
            $cats = [];
            foreach ($pengeluaran->groupBy(fn($q) => $q->category ?: 'Operasional') as $cat => $items) {
                $sum = $items->sum('amount');
                $cats[] = [
                    'name' => $cat,
                    'amount' => $sum,
                    'percent' => round(($sum / $total) * 100)
                ];
            }
            usort($cats, fn($a, $b) => $b['amount'] <=> $a['amount']);
            return array_slice($cats, 0, 4); // Ambil 4 kategori teratas
        };

        $chartData = [
            '12_jam'  => ['labels' => [], 'in' => [], 'out' => [], 'cats' => []],
            '1_hari'  => ['labels' => [], 'in' => [], 'out' => [], 'cats' => []],
            '7_hari'  => ['labels' => [], 'in' => [], 'out' => [], 'cats' => []],
            '30_hari' => ['labels' => [], 'in' => [], 'out' => [], 'cats' => []],
        ];

        // Format 12 Jam Terakhir
        $tx12h = $tx30Days->where('created_at', '>=', Carbon::now()->subHours(12));
        $chartData['12_jam']['cats'] = $getCategoryData($tx12h);
        for ($i = 11; $i >= 0; $i--) {
            $dt = Carbon::now()->subHours($i);
            $chartData['12_jam']['labels'][] = $dt->format('H:00');
            $chartData['12_jam']['in'][] = $tx12h->where('type', 'pemasukan')->filter(fn($t) => $t->created_at->format('Y-m-d H') == $dt->format('Y-m-d H'))->sum('amount');
            $chartData['12_jam']['out'][] = $tx12h->where('type', 'pengeluaran')->filter(fn($t) => $t->created_at->format('Y-m-d H') == $dt->format('Y-m-d H'))->sum('amount');
        }

        // Format 1 Hari (24 Jam)
        $tx24h = $tx30Days->where('created_at', '>=', Carbon::now()->subHours(24));
        $chartData['1_hari']['cats'] = $getCategoryData($tx24h);
        for ($i = 23; $i >= 0; $i -= 2) { // Loncat 2 jam agar label tidak menumpuk
            $dt = Carbon::now()->subHours($i);
            $chartData['1_hari']['labels'][] = $dt->format('H:00');
            $chartData['1_hari']['in'][] = $tx24h->where('type', 'pemasukan')->filter(fn($t) => $t->created_at->format('Y-m-d H') == $dt->format('Y-m-d H'))->sum('amount');
            $chartData['1_hari']['out'][] = $tx24h->where('type', 'pengeluaran')->filter(fn($t) => $t->created_at->format('Y-m-d H') == $dt->format('Y-m-d H'))->sum('amount');
        }

        // Format 7 Hari Terakhir
        $tx7d = $tx30Days->where('created_at', '>=', Carbon::now()->subDays(7));
        $chartData['7_hari']['cats'] = $getCategoryData($tx7d);
        for ($i = 6; $i >= 0; $i--) {
            $dt = Carbon::now()->subDays($i);
            $chartData['7_hari']['labels'][] = $dt->format('d M');
            $chartData['7_hari']['in'][] = $tx7d->where('type', 'pemasukan')->filter(fn($t) => $t->date == $dt->format('Y-m-d'))->sum('amount');
            $chartData['7_hari']['out'][] = $tx7d->where('type', 'pengeluaran')->filter(fn($t) => $t->date == $dt->format('Y-m-d'))->sum('amount');
        }

        // Format 30 Hari Terakhir
        $chartData['30_hari']['cats'] = $getCategoryData($tx30Days);
        for ($i = 29; $i >= 0; $i -= 3) { // Loncat 3 hari agar label rapi
            $dt = Carbon::now()->subDays($i);
            $chartData['30_hari']['labels'][] = $dt->format('d/m');
            $chartData['30_hari']['in'][] = $tx30Days->where('type', 'pemasukan')->filter(fn($t) => $t->date == $dt->format('Y-m-d'))->sum('amount');
            $chartData['30_hari']['out'][] = $tx30Days->where('type', 'pengeluaran')->filter(fn($t) => $t->date == $dt->format('Y-m-d'))->sum('amount');
        }

        return view('dashboard', compact(
            'keuntungan', 'pemasukanBulanIni', 'pengeluaranBulanIni', 
            'recentTransactions', 'chartData'
        ));
    }
}