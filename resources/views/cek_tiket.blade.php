<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tiket | Speed Boat Depari</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden border-t-8 border-[#1B4F72]">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-[#1B4F72] text-center mb-6">Detail Tiket Anda</h2>

            <form action="{{ route('tiket.cek') }}" method="GET" class="mb-8">
                <input type="text" name="search" placeholder="Masukkan Kode Tiket (Contoh: DEP-XXXX)"
                    class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-teal-500 outline-none uppercase">
                <button type="submit" class="w-full mt-2 bg-[#1B4F72] text-white py-2 rounded-lg font-bold">Cari
                    Tiket</button>
            </form>

            @if($tiket)
                <div class="bg-blue-50 border-2 border-dashed border-blue-200 p-6 rounded-xl relative">
                    <div class="mb-4">
                        <span class="text-xs text-gray-400 uppercase">Kode Tiket</span>
                        <p class="text-xl font-black text-[#117A65]">{{ $tiket->kode_tiket }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-400 block">Nama</span>
                            <p class="font-bold uppercase text-gray-700">{{ $tiket->nama_pemesan }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Tanggal</span>
                            <p class="font-bold text-gray-700">{{ $tiket->tgl_kunjungan }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Orang</span>
                            <p class="font-bold text-gray-700">{{ $tiket->jumlah_orang }} Orang</p>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Total</span>
                            <p class="font-bold text-[#117A65]">Rp {{ number_format($tiket->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200 text-center">
                        <p class="text-[10px] text-gray-400">Tunjukkan tiket ini ke petugas di dermaga Lau Kawar</p>
                    </div>
                </div>
            @elseif(request()->has('search'))
                <p class="text-red-500 text-center text-sm">Tiket tidak ditemukan. Periksa kembali kode Anda.</p>
            @endif

            <a href="/" class="block text-center mt-6 text-sm text-gray-500 hover:underline">← Kembali ke Beranda</a>
        </div>
    </div>

</body>

</html>