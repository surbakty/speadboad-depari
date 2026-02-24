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
                        class="bg-white rounded-2xl shadow-sm border overflow-hidden flex flex-col md:flex-row border-l-8 
                                {{ $tiket->status == 'Lunas' ? 'border-[#117A65]' : ($tiket->status == 'Pending' ? 'border-amber-500' : 'border-blue-500') }}">

                        <div class="p-6 flex-1">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">ID Pesanan:
                                        #DB-{{ $tiket->id + 1000 }}</span>
                                    <h3 class="text-xl font-bold text-[#1B4F72]">
                                        {{ $tiket->kategori == 'prewed' ? 'Sesi Prewedding' : 'Paket Wisata Keliling' }}
                                    </h3>
                                </div>

                                <span
                                    class="text-[10px] font-black px-3 py-1 rounded-full uppercase 
                                            {{ $tiket->status == 'Lunas' ? 'bg-green-100 text-green-700' :
                    ($tiket->status == 'Pending' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700') }}">
                                    {{ $tiket->status }}
                                </span>
                            </div>

                            <div class="flex flex-wrap gap-4 text-sm text-gray-500 mb-4">
                                <div class="flex items-center"><i class="far fa-calendar-alt mr-2 text-[#117A65]"></i>
                                    {{ \Carbon\Carbon::parse($tiket->tgl_kunjungan)->format('d M Y') }}</div>
                                <div class="flex items-center"><i class="fas fa-users mr-2 text-[#117A65]"></i>
                                    {{ $tiket->jumlah_orang }} Orang</div>
                                <div class="flex items-center font-bold text-[#117A65] uppercase tracking-tighter">
                                    <i class="fas fa-barcode mr-2"></i> {{ $tiket->kode_tiket }}
                                </div>
                            </div>

                            <div class="pt-2">
                                @if($tiket->status == 'Lunas')
                                    <a href="{{ route('tiket.detail', $tiket->kode_tiket) }}"
                                        class="inline-flex items-center text-[#117A65] hover:text-[#1B4F72] font-bold text-xs uppercase tracking-wider transition">
                                        Lihat Detail & Cetak Tiket <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                @elseif($tiket->status == 'Pending')
                                    <div class="flex flex-col md:flex-row md:items-center gap-3">
                                        <span class="text-xs text-amber-600 font-medium italic italic">Belum ada pembayaran
                                            terdeteksi</span>
                                        <button onclick="openPaymentModal('{{ $tiket->kode_tiket }}', '{{ $tiket->total_harga }}')"
                                            class="bg-amber-500 text-white text-[10px] font-black px-4 py-2 rounded-lg hover:bg-amber-600 transition inline-block w-fit">
                                            <i class="fas fa-wallet mr-1"></i> BAYAR SEKARANG
                                        </button>
                                    </div>
                                @else
                                    <div class="flex items-center text-blue-600 text-xs font-bold italic">
                                        <i class="fas fa-hourglass-half mr-2 animate-pulse"></i> Menunggu Konfirmasi Admin
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div
                            class="bg-gray-50 p-6 flex flex-col justify-center items-center md:w-48 border-t md:border-t-0 md:border-l border-gray-100">
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Total Bayar</p>
                            <p class="text-lg font-black text-[#1B4F72]">Rp
                                {{ number_format($tiket->total_harga, 0, ',', '.') }}</p>

                            @if($tiket->status == 'Lunas')
                                <a href="{{ route('tiket.detail', $tiket->kode_tiket) }}"
                                    class="mt-3 bg-[#1B4F72] text-white text-[10px] font-bold px-4 py-2 rounded-lg hover:bg-[#117A65] transition md:hidden">
                                    CETAK PDF
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div id="paymentModal"
        class="fixed inset-0 bg-black/60 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl relative">
            <button onclick="closePaymentModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>

            <div class="text-center">
                <h2 class="text-xl font-bold text-[#1B4F72] mb-1">Pembayaran</h2>
                <p id="display_kode" class="text-xs font-bold text-[#117A65] mb-4 uppercase tracking-widest"></p>

                <div class="bg-white p-3 border-2 border-gray-100 rounded-2xl mb-4 inline-block">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=DEPARIBOAT_PAYMENT"
                        alt="QRIS" class="w-40 h-40 mx-auto">
                </div>

                <div class="bg-gray-50 p-3 rounded-xl mb-6 text-left border border-gray-100">
                    <p class="text-[9px] text-gray-400 font-bold uppercase">Total Tagihan</p>
                    <p id="display_total" class="text-lg font-black text-gray-800"></p>
                </div>

                <form action="{{ route('tiket.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="kode_tiket" id="modal_input_kode">
                    <div class="text-left mb-4">
                        <label class="block text-[10px] font-bold text-gray-500 uppercase mb-2">Upload Bukti
                            Transfer</label>
                        <input type="file" name="bukti_bayar" required
                            class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-[#117A65] file:text-white hover:file:bg-[#1B4F72]">
                    </div>

                    <button type="submit"
                        class="w-full bg-[#1B4F72] text-white py-3 rounded-xl font-bold shadow-lg hover:shadow-none transition uppercase text-xs tracking-widest">
                        Kirim Bukti Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openPaymentModal(kode, total) {
            document.getElementById('modal_input_kode').value = kode;
            document.getElementById('display_kode').innerText = "KODE: " + kode;
            document.getElementById('display_total').innerText = "Rp " + new Intl.NumberFormat('id-ID').format(total);
            document.getElementById('paymentModal').classList.remove('hidden');
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
        }
    </script>

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