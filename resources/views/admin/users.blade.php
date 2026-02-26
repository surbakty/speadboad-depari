<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User | Depari Boat</title>
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
                class="flex items-center space-x-3 p-4 hover:bg-white/10 text-white/70 rounded-xl transition">
                <i class="fas fa-chart-pie w-5"></i><span>Dashboard</span>
            </a>

            <a href="{{ route('admin.transaksi') }}"
                class="flex items-center space-x-3 p-4 hover:bg-white/10 text-white/70 rounded-xl transition">
                <i class="fas fa-history w-5"></i><span>Data Transaksi</span>
            </a>

            <a href="{{ route('admin.users') }}"
                class="flex items-center space-x-3 p-4 bg-secondary rounded-xl shadow-lg transition">
                <i class="fas fa-user-shield w-5"></i><span class="font-semibold">Manajemen User</span>
            </a>

            <a href="#" class="flex items-center space-x-3 p-4 hover:bg-white/10 text-white/70 rounded-xl transition">
                <i class="fas fa-calculator w-5"></i><span>Analisis Holt-Winters</span>
            </a>

            <div class="pt-10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        class="w-full flex items-center space-x-3 p-4 text-red-300 hover:bg-red-500/10 rounded-xl transition text-left">
                        <i class="fas fa-power-off w-5"></i><span>Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="flex-1">
        <header class="bg-white p-6 shadow-sm flex justify-between items-center border-b border-gray-100">
            <h1 class="text-2xl font-bold text-primary italic">Kontrol Akses Pengguna</h1>
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
            <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
                <div class="p-6 bg-primary text-white">
                    <h3 class="font-bold uppercase italic tracking-widest text-sm">Daftar Akun Terdaftar</h3>
                </div>
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-4 text-gray-400 uppercase font-bold text-xs">Nama Lengkap</th>
                            <th class="p-4 text-gray-400 uppercase font-bold text-xs">Alamat Email</th>
                            <th class="p-4 text-gray-400 uppercase font-bold text-xs">Role</th>
                            <th class="p-4 text-gray-400 uppercase font-bold text-xs text-center">Aksi Perubahan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">
                                    <p class="font-bold text-primary">{{ $user->name }}</p>
                                    <p class="text-[10px] text-gray-400 text-xs">ID Pengguna: #{{ $user->id }}</p>
                                </td>
                                <td class="p-4 text-gray-600">{{ $user->email }}</td>
                                <td class="p-4">
                                    <span
                                        class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-[10px] font-black uppercase">
                                        <i class="fas fa-user mr-1"></i> {{ $user->role }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="role"
                                            value="{{ $user->role == 'admin' ? 'user' : 'admin' }}">
                                        <button type="submit"
                                            class="bg-teal-50 text-secondary px-4 py-2 rounded-lg text-[10px] font-bold uppercase hover:bg-secondary hover:text-white transition shadow-sm border border-teal-100">
                                            {{ $user->role == 'admin' ? 'Turunkan ke User' : 'Berikan Akses Admin' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="mt-4 text-[10px] text-gray-400 italic">* Catatan: Anda tidak dapat mengubah role akun Anda sendiri
                melalui halaman ini untuk alasan keamanan.</p>
        </div>
    </main>
</body>

</html>