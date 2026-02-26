<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Depari Boat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
        }

        .bg-primary {
            background-color: #1B4F72;
        }

        .bg-secondary {
            background-color: #117A65;
        }

        .text-primary {
            color: #1B4F72;
        }

        .text-secondary {
            color: #117A65;
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
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center space-x-3 p-4 {{ request()->routeIs('admin.dashboard') ? 'bg-secondary' : 'hover:bg-white/10' }} rounded-xl shadow-lg transition">
                <i class="fas fa-chart-pie w-5"></i>
                <span class="font-semibold">Dashboard</span>
            </a>
            <a href="{{ route('admin.transaksi') }}"
                class="flex items-center space-x-3 p-4 {{ request()->routeIs('admin.transaksi') ? 'bg-secondary' : 'hover:bg-white/10 text-white/70' }} rounded-xl transition text-white/70">
                <i class="fas fa-history w-5"></i>
                <span>Data Transaksi</span>
            </a>
            <a href="{{ route('admin.users') }}"
                class="flex items-center space-x-3 p-4 {{ request()->routeIs('admin.users') ? 'bg-secondary' : 'hover:bg-white/10 text-white/70' }} rounded-xl transition text-white/70">
                <i class="fas fa-user-shield w-5"></i>
                <span>Manajemen User</span>
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
                    <p class="text-sm font-bold text-secondary">{{ Auth::user()->name }}</p>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=1B4F72&color=fff"
                    class="w-10 h-10 rounded-full border-2 border-secondary">
            </div>
        </header>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-primary">
                    <p class="text-sm text-gray-400 font-bold uppercase mb-1">Total Booking</p>
                    <h3 class="text-3xl font-black text-primary">{{ $transactions->count() }}</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-secondary">
                    <p class="text-sm text-gray-400 font-bold uppercase mb-1">Estimasi Omzet</p>
                    <h3 class="text-3xl font-black text-secondary">
                        Rp {{ number_format($transactions->where('status', 'Lunas')->sum('total_harga'), 0, ',', '.') }}
                    </h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-yellow-500">
                    <p class="text-sm text-gray-400 font-bold uppercase mb-1">Prediksi</p>
                    <h3 class="text-xl font-black text-yellow-600 italic">Menunggu Analisis...</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch h-[450px]">
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm overflow-hidden border flex flex-col h-full">
                    <div class="p-5 bg-primary text-white flex justify-between items-center h-16">
                        <h3 class="font-bold uppercase tracking-widest text-sm italic">Tren Kunjungan Wisata</h3>
                        <select id="filterChart"
                            class="bg-white/10 border border-white/20 text-white text-xs rounded-lg p-2 outline-none">
                            <option value="all" class="text-black">Keseluruhan</option>
                        </select>
                    </div>
                    <div class="p-6 flex-1 relative min-h-0">
                        <canvas id="visitChart" class="w-full h-full"></canvas>
                    </div>
                </div>

                <div class="bg-secondary p-8 rounded-3xl text-white shadow-xl flex flex-col justify-between h-full">
                    <div>
                        <h3 class="text-xl font-bold mb-4 italic underline decoration-teal-300">Quick Analysis</h3>
                        <p class="text-sm text-teal-100 leading-relaxed">
                            Data diproses menggunakan metode <strong>Holt-Winters</strong> untuk menentukan tren
                            kunjungan secara akurat berdasarkan data historis.
                        </p>
                    </div>

                    <div class="mt-auto">
                        <p class="text-[10px] uppercase tracking-widest mb-4 opacity-70">Aksi Sistem:</p>
                        <button
                            class="bg-white text-secondary w-full py-4 rounded-xl font-black hover:bg-teal-50 transition shadow-lg uppercase tracking-tight">
                            Mulai Hitung Prediksi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const ctx = document.getElementById('visitChart').getContext('2d');
        const allData = [
            @foreach($transactions->sortBy('tgl_kunjungan') as $item)
                {
                label: "{{ \Carbon\Carbon::parse($item->tgl_kunjungan)->format('d M') }}",
                pax: {{ $item->jumlah_orang }}
                },
            @endforeach
        ];

        let visitChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: allData.map(d => d.label),
                datasets: [{
                    label: 'Jumlah Orang',
                    data: allData.map(d => d.pax),
                    borderColor: '#117A65',
                    backgroundColor: 'rgba(17, 122, 101, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</body>

</html>