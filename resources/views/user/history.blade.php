<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Saya | Depari Boat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">

    <nav class="bg-[#1B4F72] p-5 text-white shadow-md">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <a href="/" class="font-bold text-xl italic tracking-tighter">DEPARI BOAT</a>
            <a href="/" class="text-sm bg-white/10 px-4 py-2 rounded-lg hover:bg-white/20 transition">Kembali ke
                Beranda</a>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto p-8">
        <div class="mb-10">
            <h1 class="text-3xl font-black text-[#1B4F72]">Riwayat Tiket</h1>
            <p class="text-gray-500">Halo, <span class="text-[#117A65] font-bold">{{ Auth::user()->name }}</span>!
                Berikut adalah daftar pesananmu.</p>
        </div>

        @if($tickets->isEmpty())
            <div class="bg-white p-16 text-center rounded-3xl shadow-sm border-2 border-dashed border-gray-200">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-ticket-alt text-3xl text-gray-300"></i>
                </div>
                <p class="text-gray-500 mb-6">Kamu belum memiliki riwayat pemesanan tiket baru.</p>
                <a href="/" class="bg-[#117A65] text-white px-8 py-3 rounded-xl font-bold hover:shadow-lg transition">Pesan
                    Tiket Sekarang</a>
            </div>
        @else
            <div class="grid gap-6">
                @foreach($tickets as $tiket)
                    <div
                        class="bg-white rounded-2xl shadow-sm border overflow-hidden flex flex-col md:flex-row border-l-8 border-[#117A65]">
                        <div class="p-6 flex-1">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">ID Pesanan:
                                        #DB-{{ $tiket->id + 1000 }}</span>
                                    <h3 class="text-xl font-bold text-[#1B4F72]">
                                        {{ $tiket->kategori == 'prewed' ? 'Sesi Prewedding' : 'Paket Wisata Keliling' }}</h3>
                                </div>
                                <span
                                    class="bg-green-100 text-green-700 text-[10px] font-black px-3 py-1 rounded-full uppercase">Lunas</span>
                            </div>
                            <div class="flex space-x-6 text-sm text-gray-500">
                                <div class="flex items-center"><i class="far fa-calendar-alt mr-2 text-[#117A65]"></i>
                                    {{ \Carbon\Carbon::parse($tiket->tgl_kunjungan)->format('d M Y') }}</div>
                                <div class="flex items-center"><i class="fas fa-users mr-2 text-[#117A65]"></i>
                                    {{ $tiket->jumlah_orang }} Orang</div>
                                <div class="flex items-center font-bold text-[#117A65] uppercase tracking-tighter"><i
                                        class="fas fa-barcode mr-2"></i> {{ $tiket->kode_tiket }}</div>
                            </div>
                        </div>
                        <div
                            class="bg-gray-50 p-6 flex flex-col justify-center items-center md:w-48 border-t md:border-t-0 md:border-l border-gray-100">
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Total Bayar</p>
                            <p class="text-lg font-black text-[#1B4F72]">Rp
                                {{ number_format($tiket->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: "{!! session('success') !!}",
                icon: 'success',
                confirmButtonColor: '#117A65'
            });
        </script>
    @endif
</body>

</html>