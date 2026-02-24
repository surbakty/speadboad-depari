<?php

namespace App\Http\Controllers;

use App\Models\Transaction; // Penting untuk memanggil data transaksi

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil semua data transaksi terbaru
        $transactions = Transaction::latest()->get();
        
        // Mengirim data ke folder admin file dashboard
        return view('admin.dashboard', compact('transactions'));
    }

    public function dataTransaksi()
    {
        // Ambil semua transaksi, urutkan yang terbaru di atas
        $transactions = \App\Models\Transaction::latest()->get();
        return view('admin.transactions', compact('transactions'));
    }

    public function konfirmasiLunas($id)
    {
        $transaction = \App\Models\Transaction::findOrFail($id);
        $transaction->status = 'Lunas';
        $transaction->save();

        return back()->with('success', 'Pembayaran Berhasil Dikonfirmasi!');
    }
}