<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Speed Boat Depari | Danau Lau Kawar</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            scroll-behavior: smooth;
        }

        /* Custom Warna Primer untuk sinkronisasi */
        .text-primary {
            color: #1B4F72;
        }

        .bg-primary {
            background-color: #1B4F72;
        }

        .bg-secondary {
            background-color: #117A65;
        }
    </style>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonColor: '#117A65',
                    confirmButtonText: 'Oke'
                });
            });
        </script>
    @endif
</head>

<body class="bg-gray-50 text-gray-800">

    <nav class="bg-[#1B4F72] p-4 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex-1">
                <h1 class="text-xl font-bold tracking-widest italic">DEPARI BOAT</h1>
            </div>

            <div class="hidden md:flex flex-1 justify-center items-center space-x-8 font-medium">
                <a href="#"
                    class="hover:text-teal-300 transition border-b-2 border-transparent hover:border-teal-300 pb-1">Home</a>

                <a href="{{ route('tiket.cek') }}"
                    class="hover:text-teal-300 transition border-b-2 border-transparent hover:border-teal-300 pb-1">Cek
                    Pesanan</a>

                @auth
                    <a href="{{ route('tiket.saya') }}"
                        class="hover:text-teal-300 transition border-b-2 border-transparent hover:border-teal-300 pb-1 flex items-center">
                        <i class="fas fa-ticket-alt mr-2 text-xs"></i> Tiket Saya
                    </a>
                @endauth
            </div>

            <div class="flex flex-1 justify-end items-center">
                <div class="flex items-center space-x-4 border-white/20">
                    @auth
                        <div class="flex items-center space-x-3 bg-white/10 px-4 py-2 rounded-full">
                            <span
                                class="text-xs font-semibold hidden sm:inline italic text-teal-100">{{ Auth::user()->name }}</span>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="text-[10px] bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md transition font-black uppercase">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    @else
                        <a href="{{ route('google.login') }}"
                            class="flex items-center space-x-2 bg-white text-gray-800 px-4 py-2 rounded-full text-sm font-bold shadow-md hover:bg-gray-100 transition">
                            <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-4 h-4" alt="Google">
                            <span>Login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <header class="relative h-[80vh] flex items-center justify-center text-white">
        <div class="absolute inset-0 bg-[#1B4F72] opacity-50 z-10"></div>
        <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=2070"
            class="absolute inset-0 w-full h-full object-cover" alt="Danau Lau Kawar">

        <div class="relative z-20 text-center px-4">
            <h2 class="text-4xl md:text-6xl font-bold mb-4">Jelajahi Pesona Lau Kawar</h2>
            <p class="text-lg md:text-xl mb-8">Nikmati perjalanan speedboat yang aman dan nyaman bersama keluarga.</p>
            <a href="#booking"
                class="bg-[#117A65] text-white px-8 py-4 rounded-full text-lg font-bold hover:scale-105 transition-transform inline-block shadow-2xl">Pesan
                Tiket</a>
        </div>
    </header>

    <section id="services" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-[#1B4F72]">Daftar Layanan & Harga</h2>
                <div class="w-20 h-1 bg-[#117A65] mx-auto mt-2"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <div
                    class="border-2 border-gray-100 rounded-2xl p-8 shadow-lg hover:border-[#117A65] transition-all group">
                    <div class="text-[#117A65] mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1B4F72] mb-2">Paket Wisata Keliling</h3>
                    <p class="text-gray-600 mb-6">Menikmati keindahan Danau Lau Kawar dari tengah air dengan durasi
                        15-20 menit.</p>
                    <div class="text-3xl font-bold text-[#117A65]">Rp 150.000 <span
                            class="text-sm text-gray-400 font-normal">/ Kapal</span></div>
                </div>

                <div
                    class="border-2 border-gray-100 rounded-2xl p-8 shadow-lg hover:border-[#117A65] transition-all group">
                    <div class="text-[#117A65] mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1B4F72] mb-2">Sesi Prewedding</h3>
                    <p class="text-gray-600 mb-6">Layanan khusus dokumentasi prewedding dengan kapal standby di
                        titik-titik estetik.</p>
                    <div class="text-3xl font-bold text-[#117A65]">Rp 500.000 <span
                            class="text-sm text-gray-400 font-normal">/ Sesi</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-[#1B4F72]">Galeri Lau Kawar</h2>
                <div class="w-20 h-1 bg-[#117A65] mx-auto mt-2"></div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="h-48 bg-gray-300 rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=500"
                        class="w-full h-full object-cover hover:scale-110 transition">
                </div>
                <div class="h-48 bg-gray-300 rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1470770841072-f978cf4d019e?auto=format&fit=crop&q=80&w=500"
                        class="w-full h-full object-cover hover:scale-110 transition">
                </div>
                <div class="h-48 bg-gray-300 rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&q=80&w=500"
                        class="w-full h-full object-cover hover:scale-110 transition">
                </div>
                <div class="h-48 bg-gray-300 rounded-xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=500"
                        class="w-full h-full object-cover hover:scale-110 transition">
                </div>
            </div>
        </div>
    </section>

    <section id="booking" class="py-16 container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            <div class="bg-[#1B4F72] text-white p-8 md:w-1/3">
                <h3 class="text-2xl font-bold mb-4">Formulir Pesanan</h3>
                <p class="text-sm opacity-80">Silakan isi data kunjungan Anda. Pastikan tanggal dan jumlah orang sesuai.
                </p>
                <div class="mt-8 space-y-4">
                    <div class="flex items-center space-x-3 text-sm">
                        <span>📍 Dermaga Lau Kawar</span>
                    </div>
                    <div class="flex items-center space-x-3 text-sm">
                        <span>📞 0812-xxxx-xxxx</span>
                    </div>
                </div>
            </div>

            <div class="p-8 md:w-2/3">
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm border-l-4 border-red-500">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-1">Nama Pemesan</label>
                            <input type="text" name="nama_pemesan" required
                                value="{{ Auth::check() ? Auth::user()->name : '' }}"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-teal-500 outline-none"
                                placeholder="Contoh: Budi">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Tanggal Kunjungan</label>
                            <input type="date" name="tgl_kunjungan" id="tgl_kunjungan" required
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-teal-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Jumlah Orang</label>
                            <input type="number" name="jumlah_orang" required
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-teal-500 outline-none"
                                min="1">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Kategori Jasa</label>
                            <select name="kategori" required
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-teal-500 outline-none">
                                <option value="wisata">Keliling Danau (Wisata)</option>
                                <option value="prewed">Sesi Prewedding</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#117A65] text-white font-bold py-3 rounded-lg hover:bg-teal-700 transition flex justify-center items-center">
                        Booking Sekarang
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-8 text-center">
        <p>&copy; 2026 Speed Boat Depari - Lau Kawar</p>
    </footer>

    <script>
        // Ambil input tanggal berdasarkan ID
        const dateInput = document.getElementById('tgl_kunjungan');

        // Dapatkan tanggal hari ini dalam format YYYY-MM-DD
        const today = new Date().toISOString().split('T')[0];

        // Set atribut 'min' agar tanggal sebelum hari ini tidak bisa dipilih
        dateInput.setAttribute('min', today);
    </script>

</body>

</html>