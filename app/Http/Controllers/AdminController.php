<?php

namespace App\Http\Controllers;

use App\Models\Transaction; // Memanggil model transaksi
use App\Models\User;        // Memanggil model user
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Penting untuk Auth::id()

class AdminController extends Controller
{
    /**
     * Menampilkan Dashboard Utama
     */
    public function dashboard()
    {
        $transactions = Transaction::latest()->get();

        // Di sini saya hapus \App\Models\ dan \Illuminate\Support\ karena sudah ada 'use' di atas
        $users = User::where('id', '!=', Auth::id())->get();
        
        return view('admin.dashboard', compact('transactions', 'users'));
    }

    /**
     * Menampilkan Halaman Daftar Transaksi
     */
    public function dataTransaksi()
    {
        $transactions = Transaction::latest()->get();
        return view('admin.transactions', compact('transactions'));
    }

    /**
     * Sisanya tetap sama karena sudah benar...
     */
    public function konfirmasiLunas($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'Lunas';
        $transaction->save();

        return back()->with('success', 'Pembayaran Berhasil Dikonfirmasi!');
    }

    public function users()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,user'
        ]);

        $user->update([
            'role' => $request->role
        ]);

        return back()->with('success', 'Role user berhasil diperbarui!');
    }
}