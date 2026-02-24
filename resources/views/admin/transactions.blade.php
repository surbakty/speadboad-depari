<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi | Depari Boat</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                class="flex items-center space-x-3 p-4 hover:bg-white/10 rounded-xl transition text-white/70">
                <i class="fas fa-chart-pie w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.transaksi') }}"
                class="flex items-center space-x-3 p-4 bg-secondary rounded-xl shadow-lg transition">
                <i class="fas fa-history w-5"></i>
                <span class="font-semibold">Data Transaksi</span>
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
            <h1 class="text-2xl font-bold text-primary italic">Data Transaksi Tiket</h1>
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
            <div class="bg-white rounded-3xl shadow-sm border overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 text-xs font-bold text-gray-400 uppercase">Customer</th>
                            <th class="p-4 text-xs font-bold text-gray-400 uppercase">Kode Tiket</th>
                            <th class="p-4 text-xs font-bold text-gray-400 uppercase">Total</th>
                            <th class="p-4 text-xs font-bold text-gray-400 uppercase">Bukti Bayar</th>
                            <th class="p-4 text-xs font-bold text-gray-400 uppercase">Status</th>
                            <th class="p-4 text-xs font-bold text-gray-400 uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($transactions as $t)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="p-4">
                                                    <p class="font-bold text-primary">{{ $t->nama_pemesan }}</p>
                                                    <p class="text-[10px] text-gray-400">
                                                        {{ \Carbon\Carbon::parse($t->tgl_kunjungan)->format('d M Y') }}</p>
                                                </td>
                                                <td class="p-4">
                                                    <span class="font-mono font-bold text-secondary bg-teal-50 px-2 py-1 rounded text-sm">
                                                        {{ $t->kode_tiket }}
                                                    </span>
                                                </td>
                                                <td class="p-4 font-bold text-gray-700 italic">Rp
                                                    {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                                                <td class="p-4">
                                                    @if($t->bukti_bayar)
                                                        <a href="{{ asset('storage/' . $t->bukti_bayar) }}" target="_blank"
                                                            class="flex items-center text-blue-500 text-xs font-bold hover:text-blue-700 transition">
                                                            <i class="fas fa-image mr-2 text-base"></i> LIHAT STRUK
                                                        </a>
                                                    @else
                                                        <span class="text-gray-300 text-[10px] font-bold uppercase italic">Belum Upload</span>
                                                    @endif
                                                </td>
                                                <td class="p-4">
                                                    <span
                                                        class="px-3 py-1 rounded-full text-[9px] font-black uppercase shadow-sm
                                                        {{ $t->status == 'Lunas' ? 'bg-green-100 text-green-700' :
                            ($t->status == 'Pending' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700') }}">
                                                        {{ $t->status }}
                                                    </span>
                                                </td>
                                                <td class="p-4 text-center">
                                                    @if($t->status != 'Lunas' && $t->bukti_bayar)
                                                        <form action="{{ route('admin.konfirmasi', $t->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="bg-secondary text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase hover:bg-primary transition shadow-md">
                                                                Konfirmasi Lunas
                                                            </button>
                                                        </form>
                                                    @elseif($t->status == 'Lunas')
                                                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                                                    @else
                                                        <span class="text-gray-300 text-[10px] font-bold">MENUNGGU USER</span>
                                                    @endif
                                                </td>
                                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($transactions->isEmpty())
                    <div class="p-20 text-center">
                        <i class="fas fa-folder-open text-gray-200 text-5xl mb-4"></i>
                        <p class="text-gray-400 font-bold uppercase text-xs tracking-widest">Belum ada transaksi masuk</p>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Mantap!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#117A65'
            });
        </script>
    @endif
</body>

</html>