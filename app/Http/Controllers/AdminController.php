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
}