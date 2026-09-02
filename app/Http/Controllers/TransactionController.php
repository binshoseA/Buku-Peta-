<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Baris ini wajib ditambahkan

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
        ]);

        $request->user()->transactions()->create([
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'category' => $request->category,
            'date' => now(), // otomatis tanggal hari ini
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function history(Request $request)
    {
        // Ambil semua transaksi user yang sedang login
        $transactions = $request->user()->transactions()->orderBy('date', 'desc')->get();
        return view('history', compact('transactions'));
    }

    public function exportExcel()
    {
        // Ambil semua transaksi milik pengguna yang sedang login
        $transactions = Auth::user()->transactions()->orderBy('date', 'desc')->get();
        
        // Nama file saat diunduh
        $fileName = 'Riwayat_Transaksi_Buku_PETA_' . date('Y-m-d') . '.csv';

        // Header agar browser membaca ini sebagai file Excel/CSV yang diunduh
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Header kolom tabel di Excel
        $columns = ['Tanggal', 'Tipe', 'Kategori', 'Deskripsi', 'Nominal (Rp)'];

        // Proses merangkai data baris demi baris
        $callback = function() use($transactions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns); // Tulis baris pertama (Judul Kolom)

            foreach ($transactions as $trx) {
                $row['Tanggal']   = \Carbon\Carbon::parse($trx->date)->format('d-m-Y');
                $row['Tipe']      = ucfirst($trx->type);
                $row['Kategori']  = $trx->category ?? 'Lainnya';
                $row['Deskripsi'] = $trx->description;
                $row['Nominal']   = $trx->amount;

                fputcsv($file, [$row['Tanggal'], $row['Tipe'], $row['Kategori'], $row['Deskripsi'], $row['Nominal']]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}