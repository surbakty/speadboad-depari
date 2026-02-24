<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Depari Boat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
        }

        /* Warna Identitas Website Kamu */
        .bg-primary {
            background-color: #1B4F72;
        }

        /* Biru Utama */
        .bg-secondary {
            background-color: #117A65;
        }

        /* Teal */
        .text-primary {
            color: #1B4F72;
        }

        .text-secondary {
            color: #117A65;
        }

        .border-secondary {
            border-color: #117A65;
        }
    </style>
</head>

<body class="bg-gray-50 flex">

    <aside class="w-72 bg-primary min-h-screen text-white sticky top-0 shadow-2xl">
        <div class="p-6 border-b border-white/10">
            <h2 class="text-xl font-bold tracking-widest text-center">DEPARI BOAT</h2>
            <p class="text-[10px] text-teal-300 text-center uppercase tracking-widest mt-1">Admin Panel</p>
        </div>

        <nav class="p-4 mt-4 space-y-2">
            <a href="#" class="flex items-center space-x-3 p-4 bg-secondary rounded-xl shadow-lg transition">
                <i class="fas fa-chart-pie w-5"></i>
                <span class="font-semibold">Dashboard</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-4 hover:bg-white/10 rounded-xl transition text-white/70">
                <i class="fas fa-history w-5"></i>
                <span>Data Transaksi</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-4 hover:bg-white/10 rounded-xl transition text-white/70">
                <i class="fas fa-calculator w-5"></i>
                <span>Analisis Holt-Winters</span>
            </a>
            <div class="pt-10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        class="w-full flex items-center space-x-3 p-4 text-red-300 hover:bg-red-500/10 rounded-xl transition">
                        <i class="fas fa-power-off w-5"></i>
                        <span>Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="flex-1">
        <header class="bg-white p-6 shadow-sm flex justify-between items-center border-b border-gray-100">
            <h1 class="text-2xl font-bold text-primary italic">Manajemen Operasional</h1>
            <div class="flex items-center space-x-4">
                <div class="text-right border-r pr-4 hidden md:block">
                    <p class="text-xs text-gray-400">Status Login</p>
                    <p class="text-sm font-bold text-secondary">{{ Auth::user()->name ?? 'Administrator' }}</p>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=1B4F72&color=fff"
                    class="w-10 h-10 rounded-full border-2 border-secondary">
            </div>
        </header>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-primary">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-400 font-bold uppercase mb-1">Total Booking</p>
                            <h3 class="text-3xl font-black text-primary">{{ $transactions->count() }}</h3>
                        </div>
                        <div class="p-3 bg-blue-50 text-primary rounded-lg italic font-bold">LIVE</div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-secondary">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-400 font-bold uppercase mb-1">Estimasi Omzet</p>
                            <h3 class="text-3xl font-black text-secondary">Rp
                                {{ number_format($transactions->count() * 150000, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="p-3 bg-teal-50 text-secondary rounded-lg"><i class="fas fa-wallet"></i></div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-yellow-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-400 font-bold uppercase mb-1">Prediksi (Holt-Winters)</p>
                            <h3 class="text-3xl font-black text-yellow-600">Pending</h3>
                        </div>
                        <div class="p-3 bg-yellow-50 text-yellow-600 rounded-lg"><i class="fas fa-brain"></i></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 bg-primary text-white flex justify-between items-center">
                        <h3 class="font-bold uppercase tracking-widest text-sm italic">Log Pesanan Tiket</h3>
                        <i class="fas fa-list-ul"></i>
                    </div>
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-400 text-[10px] uppercase font-bold border-b">
                            <tr>
                                <th class="p-4">Customer</th>
                                <th class="p-4">Kunjungan</th>
                                <th class="p-4 text-center">Pax</th>
                                <th class="p-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($transactions as $item)
                                <tr class="hover:bg-teal-50/50 transition">
                                    <td class="p-4 font-bold text-primary">{{ $item->nama_pemesan }}</td>
                                    <td class="p-4 text-sm">{{ $item->tgl_kunjungan }}</td>
                                    <td class="p-4 text-center font-bold text-secondary">{{ $item->jumlah_orang }}</td>
                                    <td class="p-4">
                                        <span
                                            class="bg-secondary/10 text-secondary px-3 py-1 rounded-lg text-[10px] font-black uppercase">Confirmed</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-secondary p-8 rounded-3xl text-white shadow-xl flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-4 italic underline decoration-teal-300">Quick Analysis</h3>
                        <p class="text-sm text-teal-100 leading-relaxed">
                            Data ini akan diproses menggunakan metode <strong>Triple Exponential Smoothing</strong>
                            untuk menentukan tren kunjungan wisata Lau Kawar pada periode berikutnya.
                        </p>

                        <div class="mt-8 space-y-4">
                            <div class="flex justify-between text-sm border-b border-white/20 pb-2">
                                <span>Total Record:</span>
                                <span class="font-bold">{{ $transactions->count() }} Data</span>
                            </div>
                            <div class="flex justify-between text-sm border-b border-white/20 pb-2">
                                <span>Target Prediksi:</span>
                                <span class="font-bold">Bulan Depan</span>
                            </div>
                        </div>
                    </div>

                    <button
                        class="mt-10 bg-white text-secondary w-full py-3 rounded-xl font-bold hover:bg-teal-50 transition shadow-lg">
                        Mulai Hitung Prediksi
                    </button>
                </div>
            </div>
        </div>
    </main>

</body>

</html>