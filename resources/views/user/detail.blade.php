<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket #{{ $ticket->kode_tiket }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        body {
            background-color: #f3f4f6;
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body class="p-4 md:p-10">

    <div class="max-w-2xl mx-auto">
        <div class="no-print mb-6 flex justify-between">
            <a href="{{ route('tiket.saya') }}" class="text-[#1B4F72] font-bold"><i class="fas fa-arrow-left"></i>
                Kembali</a>
            <button onclick="window.print()" class="bg-[#117A65] text-white px-4 py-2 rounded-lg font-bold shadow-lg">
                <i class="fas fa-print"></i> Cetak ke PDF
            </button>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-2 border-gray-100">
            <div class="bg-[#1B4F72] p-8 text-white flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-black italic tracking-tighter">DEPARI BOAT</h1>
                    <p class="text-[10px] opacity-70 uppercase tracking-widest">Official E-Ticket Lau Kawar</p>
                </div>
                <div class="text-right">
                    <span class="bg-green-500 text-[10px] font-black px-3 py-1 rounded-full">CONFIRMED</span>
                </div>
            </div>

            <div class="p-8">
                <div class="flex flex-col md:flex-row justify-between mb-8 gap-6">
                    <div>
                        <p class="text-gray-400 text-[10px] font-bold uppercase">Nama Penumpang</p>
                        <p class="text-lg font-bold text-gray-800">{{ $ticket->nama_pemesan }}</p>
                    </div>
                    <div class="md:text-right">
                        <p class="text-gray-400 text-[10px] font-bold uppercase">Kode Booking</p>
                        <p class="text-2xl font-black text-[#117A65] tracking-widest">{{ $ticket->kode_tiket }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 border-y border-dashed border-gray-200 py-6 mb-8">
                    <div>
                        <p class="text-gray-400 text-[10px] font-bold uppercase">Tanggal Kunjungan</p>
                        <p class="font-bold text-gray-800">
                            {{ \Carbon\Carbon::parse($ticket->tgl_kunjungan)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-[10px] font-bold uppercase">Kategori Layanan</p>
                        <p class="font-bold text-gray-800">
                            {{ $ticket->kategori == 'prewed' ? 'Sesi Prewedding' : 'Wisata Keliling' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-[10px] font-bold uppercase">Jumlah Orang</p>
                        <p class="font-bold text-gray-800">{{ $ticket->jumlah_orang }} Pax</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-[10px] font-bold uppercase">Total Bayar</p>
                        <p class="font-bold text-gray-800">Rp {{ number_format($ticket->total_harga, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div
                    class="bg-gray-50 p-6 rounded-2xl flex flex-col items-center justify-center border border-gray-100">
                    <div class="text-4xl tracking-[15px] font-mono text-gray-300 mb-2">||||| || |||| |||</div>
                    <p class="text-[10px] text-gray-400 font-medium">Tunjukkan kode ini kepada petugas dermaga Depari
                        Boat</p>
                </div>
            </div>

            <div class="bg-gray-100 p-4 text-center">
                <p class="text-[9px] text-gray-400 leading-tight italic">Tiket ini sah sebagai bukti pembayaran dan
                    kunjungan ke Danau Lau Kawar melalui layanan Speed Boat Depari. Pastikan datang 15 menit sebelum
                    jadwal.</p>
            </div>
        </div>
    </div>

</body>

</html>