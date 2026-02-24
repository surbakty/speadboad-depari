<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Penting untuk urusan upload file

class BookingController extends Controller 
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_pemesan'  => 'required|string|max:255',
            'tgl_kunjungan' => 'required|date|after_or_equal:today', 
            'jumlah_orang'  => 'required|numeric|min:1',
            'kategori'      => 'required',
        ], [
            'tgl_kunjungan.after_or_equal' => 'Tanggal kunjungan tidak boleh tanggal yang sudah lewat!',
        ]);

        try {
            // 2. Logika Hitung Harga (Rp 50.000 per orang)
            $hargaSatuan = ($request->kategori == 'prewed') ? 500000 : 50000;
            $totalHarga = $hargaSatuan * $request->jumlah_orang;

            // 3. Simpan Data dengan Status PENDING
            $transaction = new Transaction();
            $transaction->user_id       = Auth::id(); 
            $transaction->kode_tiket    = 'DEP-' . strtoupper(Str::random(6));
            $transaction->nama_pemesan  = $request->nama_pemesan;
            $transaction->tgl_kunjungan = $request->tgl_kunjungan;
            $transaction->jumlah_orang  = $request->jumlah_orang;
            $transaction->kategori      = $request->kategori;
            $transaction->total_harga   = $totalHarga;
            $transaction->status        = 'Pending'; // Status awal adalah menunggu bayar
            $transaction->save();

            return redirect()->route('tiket.saya')->with('success', 'Pesanan dibuat! Silakan upload bukti pembayaran.');

        } catch (\Exception $e) {
            return back()->withErrors(['db_error' => 'Gagal: ' . $e->getMessage()]);
        }
    }

    // FUNGSI BARU: Menangani Upload Bukti Bayar dari User
    public function uploadBukti(Request $request)
    {
        $request->validate([
            'kode_tiket' => 'required|exists:transactions,kode_tiket',
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $transaction = Transaction::where('kode_tiket', $request->kode_tiket)->first();

        if ($request->hasFile('bukti_bayar')) {
            // Simpan gambar ke folder storage/app/public/bukti_bayar
            $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
            
            $transaction->bukti_bayar = $path;
            $transaction->status = 'Menunggu Konfirmasi'; // Update status setelah upload
            $transaction->save();

            return back()->with('success', 'Bukti berhasil diupload! Tunggu konfirmasi admin ya.');
        }

        return back()->with('error', 'Gagal mengupload file.');
    }

    public function myHistory()
    {
        if (!Auth::check()) { return redirect()->route('google.login'); }
        $tickets = Transaction::where('user_id', Auth::id())->latest()->get();
        return view('user.history', compact('tickets'));
    }

    public function detail($kode_tiket)
    {
        $ticket = Transaction::where('kode_tiket', $kode_tiket)
                            ->where('user_id', Auth::id())
                            ->where('status', 'Lunas') // Hanya bisa lihat detail jika sudah lunas
                            ->firstOrFail();

        return view('user.detail', compact('ticket'));
    }
}