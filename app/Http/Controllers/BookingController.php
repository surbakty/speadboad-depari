<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller 
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_pemesan'  => 'required|string|max:255',
            'tgl_kunjungan' => 'required|date',
            'jumlah_orang'  => 'required|numeric|min:1',
            'kategori'      => 'required',
        ]);

        try {
            // 2. Logika Hitung Harga (Sesuaikan dengan value di welcome.blade.php)
            // Value di form biasanya 'wisata' atau 'prewed'
            $hargaBase = ($request->kategori == 'prewed') ? 500000 : 150000;

            // 3. Simpan Data ke Database
            $transaction = new Transaction();
            $transaction->user_id       = Auth::id(); // Pastikan user sudah login google
            $transaction->kode_tiket    = 'DEP-' . strtoupper(Str::random(6));
            $transaction->nama_pemesan  = $request->nama_pemesan;
            $transaction->tgl_kunjungan = $request->tgl_kunjungan;
            $transaction->jumlah_orang  = $request->jumlah_orang;
            $transaction->kategori      = $request->kategori;
            $transaction->total_harga   = $hargaBase;
            $transaction->status        = 'Lunas';
            $transaction->save();

            // 4. Redirect ke halaman Riwayat dengan pesan sukses
            return redirect()->route('tiket.saya')->with('success', 'Booking berhasil! Kode Tiket: ' . $transaction->kode_tiket);

        } catch (\Exception $e) {
            // Jika gagal simpan, kita akan melihat error aslinya di layar
            return dd("DATABASE ERROR: " . $e->getMessage());
        }
    }

    public function show(Request $request)
    {
        $tiket = null;
        if ($request->has('search')) {
            $tiket = Transaction::where('kode_tiket', $request->search)->first();
        }

        return view('cek_tiket', compact('tiket'));
    }

    public function myHistory()
    {
        // Pastikan hanya user yang login yang bisa akses
        if (!Auth::check()) {
            return redirect()->route('google.login');
        }

        // Ambil transaksi milik user yang login
        $tickets = Transaction::where('user_id', Auth::id())->latest()->get();
        return view('user.history', compact('tickets'));
    }
}